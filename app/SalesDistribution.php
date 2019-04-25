<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class SalesDistribution extends Model
{
    public static function getSalesDistributionData(){
        return DB::table('tmm_saleschd')
            ->select('tmm_saleschd.*','smm_item.ITEM_NAME','tmm_salesmst.SALES_DATE','ssc_lookupchd.LOOKUPCHD_NAME')
            ->leftJoin('smm_item','tmm_saleschd.ITEM_ID','=','smm_item.ITEM_NO')
            ->leftJoin('tmm_salesmst','tmm_saleschd.SALESMST_ID','=','tmm_salesmst.SALESMST_ID')
            ->leftJoin('ssc_lookupchd','tmm_saleschd.PACK_TYPE','=','ssc_lookupchd.LOOKUPCHD_ID')
            ->where('tmm_saleschd.center_id','=',Auth::user()->center_id)
            ->get();
    }
    public static function getTradingName(){
        return DB::table('ssm_customer_info')
            ->select('ssm_customer_info.*')
            ->get();
    }

    public static function insertSalesDistributionData($request,$saltPackId,$washAndCrushId,$iodizeId){

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

        if($salesDistributionMstId){
          $saltDetils = count($_POST['PACK_TYPE']);
          for ($i=0; $i < $saltDetils; $i++){
                 $saltPackingSize = DB::table('ssc_lookupchd')
                     ->select('ssc_lookupchd.DESCRIPTION')
                     ->where('ssc_lookupchd.LOOKUPCHD_ID','=',$request->input('PACK_TYPE')[$i])
                     ->first();

                 $packageCalculation = (float)$saltPackingSize->DESCRIPTION;
                  $test =  (float)$request->input('PACK_QTY')[$i];

                 $packageQuantity = number_format($test * $packageCalculation);

              $salesDistributionChdId = DB::table('tmm_saleschd')->insertGetId([
                  'SALESMST_ID'=>$salesDistributionMstId,
                  'ITEM_ID'=> $request->input('ITEM_ID')[$i],
                  'PACK_TYPE'=> $request->input('PACK_TYPE')[$i],
                  'PACK_QTY'=> $request->input('PACK_QTY')[$i],
                  'center_id' => Auth::user()->center_id,
                  'QTY'=> $packageQuantity,
              ]);

              $finishSaltId = $request->input('ITEM_ID')[$i];

             // return $finishSaltId;

              if($finishSaltId == $washAndCrushId){
                $itemStock = DB::table('tmm_itemstock')->insertGetId([
                    'TRAN_DATE' => date('Y-m-d', strtotime(Input::get('SALES_DATE'))),
                    'TRAN_TYPE' => 'W', //  W=Wash
                    'TRAN_NO' => $salesDistributionMstId,
                    'ITEM_NO' => $request->input('ITEM_ID')[$i],
                    'QTY' => '-'.$packageQuantity,
                    'TRAN_FLAG' => 'SD', // SD = Sales & Distribution
                    'center_id' => Auth::user()->center_id,
                    //'SUPP_ID_AUTO' => $request->input('SUPP_ID_AUTO'),
                    'ENTRY_BY' => Auth::user()->id,
                    'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
                ]);
              }
              if($finishSaltId == $iodizeId){
                  $itemStock =  DB::table('tmm_itemstock')->insertGetId([
                      'TRAN_DATE' => date('Y-m-d', strtotime(Input::get('SALES_DATE'))),
                      'TRAN_TYPE' => 'I', //  I= Iodize
                      'TRAN_NO' => $salesDistributionMstId,
                      'ITEM_NO' => $request->input('ITEM_ID')[$i],
                      'QTY' => '-'.$packageQuantity,
                      'TRAN_FLAG' => 'SD', // SD = Sales & Distribution
                      'center_id' => Auth::user()->center_id,
                      //'SUPP_ID_AUTO' => $request->input('SUPP_ID_AUTO'),
                      'ENTRY_BY' => Auth::user()->id,
                      'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
                  ]);
              }
          }
          return $itemStock;
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
        $countSales = DB::table('tmm_itemstock');
        $countSales->select('tmm_itemstock.QTY');
        $countSales->where('TRAN_TYPE','=','W');
        $countSales->where('TRAN_FLAG','=','SD');
        if($centerId){
            $countSales->where('center_id','=',$centerId);
        }

        return $countSales->sum('tmm_itemstock.QTY');
    }

    public static function totalIodizeSales(){
        $centerId = Auth::user()->center_id;
        $countSales = DB::table('tmm_itemstock');
        $countSales->select('tmm_itemstock.QTY');
        $countSales->where('TRAN_TYPE','=','I');
        $countSales->where('TRAN_FLAG','=','SD');
        if($centerId){
            $countSales->where('center_id','=',$centerId);
        }

        return $countSales->sum('tmm_itemstock.QTY');
    }
    ///-----------------------Sales

    ///-----------------------Dashboard product sale
    public static function totalproductSale(){
        $centerId = Auth::user()->center_id;
        $totalProductionSale = DB::table('tmm_itemstock');
        $totalProductionSale->select('tmm_itemstock.*');
        $totalProductionSale->where('tmm_itemstock.TRAN_FLAG','=','SD');
        if($centerId){
            $totalProductionSale->where('center_id','=',$centerId);
        }
        return $totalProductionSale->get();
    }
    ///-----------------------Dashboard product sale
}
