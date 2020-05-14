<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class SalesDistribution extends Model
{
    private static $parentTable = 'tmm_salesmst', $childTable = 'tmm_saleschd',
        $pKey = 'tmm_salesmst.SALESMST_ID', $fKey = 'tmm_saleschd.SALESMST_ID';

    public static function getSalesDistributionData(){
        return self::millerSales()->get();
    }

    public static function millerSales(){
        return DB::table(self::$childTable)
            ->select('tmm_saleschd.*','smm_item.ITEM_NAME','tmm_salesmst.SALES_DATE','ssc_lookupchd.LOOKUPCHD_NAME', 'ssc_lookupchd.DESCRIPTION')
            ->leftJoin('smm_item','tmm_saleschd.ITEM_ID','=','smm_item.ITEM_NO')
            ->leftJoin(self::$parentTable, self::$fKey,'=', self::$pKey)
            ->leftJoin('ssc_lookupchd','tmm_saleschd.PACK_TYPE','=','ssc_lookupchd.LOOKUPCHD_ID')
            ->where('tmm_saleschd.center_id','=',Auth::user()->center_id)
            ->orderBy('tmm_saleschd.SALESMST_ID', 'DESC');
    }

    public static function getTradingName(){
        $centerId = Auth::user()->center_id;
        $customerInfo =  DB::table('ssm_customer_info');
        $customerInfo->select('ssm_customer_info.*');
        if($centerId){
            $customerInfo->where('ssm_customer_info.center_id','=',$centerId);
        }
        return $customerInfo->get();
    }

    public static function insertSalesDistributionData($request, $washAndCrushId, $iodizeId){

        try{
            DB::beginTransaction();
            $salesDistributionMstId = DB::table('tmm_salesmst')->insertGetId([
                'SELLER_TYPE'=> $request->input('SELLER_TYPE'),
                'SALES_DATE'=> date('Y-m-d', strtotime(Input::get('SALES_DATE'))),
                'CUSTOMER_ID'=> $request->input('CUSTOMER_ID'),
                'DRIVER_NAME'=> $request->input('DRIVER_NAME'),
                'VEHICLE_NO'=> $request->input('VEHICLE_NO'),
                'VEHICLE_LICENSE'=> $request->input('VEHICLE_LICENSE'),
                'TRANSPORT_NAME'=> $request->input('TRANSPORT_NAME'),
                'MOBILE_NO'=> $request->input('MOBILE_NO'),
                'REMARKS'=> $request->input('REMARKS'),
                'center_id' => Auth::user()->center_id,
                'ENTRY_BY' => Auth::user()->id,
                'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
            ]);

            $requestTime = count($_POST['PACK_TYPE']);
            for ($i=0; $i < $requestTime; $i++){
                $pactInput = $request->input('PACK_TYPE')[$i];
                $extractPact = explode(',', $pactInput);
                $packTypeId = $extractPact[0];
                $measurementPack = $extractPact[1];
                $totalPacket =  (float)$request->input('PACK_QTY')[$i];
                $totalQuantity = $totalPacket * $measurementPack;
                $salesChdData = array(
                    'SALESMST_ID'=>$salesDistributionMstId,
                    'ITEM_ID'=> $request->input('ITEM_ID')[$i],
                    'brand_id'=> $request->input('brand_id')[$i],
                    'PACK_TYPE'=> $packTypeId,
                    'PACK_QTY'=> $totalPacket,
                    'center_id' => Auth::user()->center_id,
                    'QTY'=> $totalQuantity
                );

                DB::table('tmm_saleschd')->insertGetId($salesChdData);

                $finishSaltId = $request->input('ITEM_ID')[$i];

                // return $finishSaltId;

                if($finishSaltId == $washAndCrushId){
//                echo $packageQuantity;exit;
                    $stockData = array(
                        'TRAN_DATE' => date('Y-m-d', strtotime(Input::get('SALES_DATE'))),
                        'TRAN_TYPE' => 'W', //  W=Wash
                        'TRAN_NO' => $salesDistributionMstId,
                        'ITEM_NO' => $request->input('ITEM_ID')[$i],
                        'QTY' => '-'.$totalQuantity,
                        'TRAN_FLAG' => 'SD', // SD = Sales & Distribution
                        'center_id' => Auth::user()->center_id,
                        //'SUPP_ID_AUTO' => $request->input('SUPP_ID_AUTO'),
                        'ENTRY_BY' => Auth::user()->id,
                        'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
                    );
                    DB::table('tmm_itemstock')->insert($stockData);
                }

                if($finishSaltId == $iodizeId){
//                  echo $packageQuantity;exit;
                    $stockData = array(
                        'TRAN_DATE' => date('Y-m-d', strtotime(Input::get('SALES_DATE'))),
                        'TRAN_TYPE' => 'I', //  I= Iodize
                        'TRAN_NO' => $salesDistributionMstId,
                        'ITEM_NO' => $request->input('ITEM_ID')[$i],
                        'QTY' => '-'.$totalQuantity,
                        'TRAN_FLAG' => 'SD', // SD = Sales & Distribution
                        'center_id' => Auth::user()->center_id,
                        //'SUPP_ID_AUTO' => $request->input('SUPP_ID_AUTO'),
                        'ENTRY_BY' => Auth::user()->id,
                        'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
                    );
                    DB::table('tmm_itemstock')->insert($stockData);
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }

    }

    public static function showSalesDistributionDataMst($id){
        return DB::table('tmm_salesmst')
            ->select('tmm_salesmst.*','ssc_lookupchd.LOOKUPCHD_NAME','ssm_customer_info.TRADING_NAME')
            ->leftJoin('ssc_lookupchd','tmm_salesmst.SELLER_TYPE','=','ssc_lookupchd.LOOKUPCHD_ID')
            ->leftJoin('ssm_customer_info','tmm_salesmst.CUSTOMER_ID','=','ssm_customer_info.CUSTOMER_ID')
            ->where('SALESMST_ID','=',$id)
            ->first();
    }

    public static function showSalesDistributionDataChd($id){
      return DB::table('tmm_saleschd')
          ->select('tmm_saleschd.*','smm_item.ITEM_NAME','ssc_lookupchd.LOOKUPCHD_NAME')
          ->leftJoin('smm_item','tmm_saleschd.ITEM_ID','=','smm_item.ITEM_NO')
          ->leftJoin('ssc_lookupchd','tmm_saleschd.PACK_TYPE','=','ssc_lookupchd.LOOKUPCHD_ID')
          ->where('tmm_saleschd.SALESMST_ID','=',$id)
          ->get();
    }

    ///-----------------------Sales
    public static function totalWashcrashSales(){
        $centerId = Auth::user()->center_id;
        $countSales = DB::table('tmm_itemstock as stock')
            ->select('stock.QTY')
            ->leftJoin('ssm_associationsetup as association','stock.center_id','=','association.ASSOCIATION_ID')
            ->leftJoin('ssm_mill_info as smi','association.MILL_ID','=','smi.MILL_ID')
            ->where('smi.ACTIVE_FLG','=','1')
            ->where('TRAN_TYPE','=','W')
            ->where('TRAN_FLAG','=','SD')
            ->whereNull('stock.stock_adjustment_id')
            ->whereNotNull('stock.TRAN_NO');

        if($centerId) $countSales->where('stock.center_id','=',$centerId);

        return $countSales->sum('stock.QTY');
    }

    public static function totalIodizeSales(){
        $centerId = Auth::user()->center_id;
        $countSales = DB::table('tmm_itemstock as stock')
            ->select('stock.QTY')
            ->leftJoin('ssm_associationsetup as association','stock.center_id','=','association.ASSOCIATION_ID')
            ->leftJoin('ssm_mill_info as smi','association.MILL_ID','=','smi.MILL_ID')
            ->where('smi.ACTIVE_FLG','=','1')
            ->where('TRAN_TYPE','=','I')
            ->where('TRAN_FLAG','=','SD')
            ->whereNull('stock.stock_adjustment_id')
            ->whereNotNull('stock.TRAN_NO');

        if($centerId) $countSales->where('stock.center_id','=',$centerId);

        return $countSales->sum('stock.QTY');
    }

    public static function totalWashcrashSalesMonthWise(){
        $date = date("Y-m-d", strtotime("- 30 days"));
        $centerId = Auth::user()->center_id;
        $countSales = DB::table('tmm_itemstock as stock')
            ->select('stock.QTY')
            ->leftJoin('ssm_associationsetup as association','stock.center_id','=','association.ASSOCIATION_ID')
            ->leftJoin('ssm_mill_info as smi','association.MILL_ID','=','smi.MILL_ID')
            ->where('smi.ACTIVE_FLG','=','1')
            ->where('TRAN_TYPE','=','W')
            ->where('TRAN_FLAG','=','SD')
            ->where('stock.TRAN_DATE','>', $date)
            ->whereNull('stock.stock_adjustment_id')
            ->whereNotNull('stock.TRAN_NO');

        if($centerId) $countSales->where('stock.center_id','=',$centerId);

        return $countSales->sum('stock.QTY');
    }

    public static function totalIodizeSalesMonthWise(){
        $date = date("Y-m-d", strtotime("- 30 days"));
        $centerId = Auth::user()->center_id;
        $countSales = DB::table('tmm_itemstock as stock')
            ->select('stock.QTY')
            ->leftJoin('ssm_associationsetup as association','stock.center_id','=','association.ASSOCIATION_ID')
            ->leftJoin('ssm_mill_info as smi','association.MILL_ID','=','smi.MILL_ID')
            ->where('smi.ACTIVE_FLG','=','1')
            ->where('stock.TRAN_TYPE','=','I')
            ->where('stock.TRAN_FLAG','=','SD')
            ->where('stock.TRAN_DATE','>',$date)
            ->whereNull('stock.stock_adjustment_id')
            ->whereNotNull('stock.TRAN_NO');
        if($centerId) $countSales->where('stock.center_id','=',$centerId);

        return $countSales->sum('stock.QTY');
    }
    ///-----------------------Sales

    ///-----------------------Dashboard product sale
    public static function productSales(){
        $centerId = Auth::user()->center_id;
        $totalProductionSale = Stock::millerSales($centerId);
        return $totalProductionSale->get();
    }
    ///-----------------------Dashboard product sale

    // ----------------------Total Sale Start
    public static function totalSale(){
        $centerId = Auth::user()->center_id;
        $totalSale = Stock::millerSales($centerId);
        return $totalSale->sum('stock.QTY');
    }
    // ----------------------Total Sale End

    public static function getPacksize($packQuantity){

      return DB::table('ssc_lookupchd')
            ->select('ssc_lookupchd.DESCRIPTION')
            ->where('ssc_lookupchd.LOOKUPCHD_ID','=',$packQuantity)
            ->first();
    }

    //for Service
    public static function totalWashcrashSalesService($child_id){

        $countSales = DB::table('tmm_itemstock');
        $countSales->select('tmm_itemstock.QTY');
        $countSales->where('TRAN_TYPE','=','W');
        $countSales->where('TRAN_FLAG','=','SD');
        $countSales->where('center_id','=',$child_id);


        return $countSales->sum('tmm_itemstock.QTY');
    }

    public static function totalIodizeSalesService($child_id){

        $countSales = DB::table('tmm_itemstock');
        $countSales->select('tmm_itemstock.QTY');
        $countSales->where('TRAN_TYPE','=','I');
        $countSales->where('TRAN_FLAG','=','SD');
        $countSales->where('center_id','=',$child_id);


        return $countSales->sum('tmm_itemstock.QTY');
    }

    //for Service

    public static function totalSaleCurrentMonth(){
        $date = date("Y-m-d", strtotime("- 30 days"));
        $centerId = Auth::user()->center_id;
        $totalSale = Stock::millerSales()->where('stock.TRAN_DATE','>',$date);
        if($centerId) $totalSale->where('stock.center_id','=',$centerId);
        return $totalSale->sum('stock.QTY');
    }

    public static function totalSaleAssociationDashboard(){
        $date = date("Y-m-d", strtotime("- 30 days"));

        $totalSale = DB::table('tmm_itemstock as stock')
            ->select('stock.QTY')
            ->leftJoin('ssm_associationsetup as association','stock.center_id','=','association.ASSOCIATION_ID')
            ->leftJoin('ssm_mill_info as smi','association.MILL_ID','=','smi.MILL_ID')
            ->where('smi.ACTIVE_FLG','=','1')
            ->where('stock.TRAN_FLAG','=','SD')
            ->where('stock.TRAN_DATE','>',$date);

        return $totalSale->sum('stock.QTY');
    }

    public static function saleDistributionDelete($id){
        //dd($id);
        $deleteStock = DB::table('tmm_itemstock')->where('TRAN_NO',$id)->delete();


        if($deleteStock){
            $deleteSaleChd = DB::table('tmm_saleschd')->where('SALESMST_ID',$id)->delete();
            $deleteSalePr = DB::table('tmm_salesmst')->where('SALESMST_ID',$id)->delete();
            return $deleteSalePr;
        }
    }


}
