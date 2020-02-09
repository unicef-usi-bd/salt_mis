<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ChemicalPurchase extends Model
{
    public static function chemicalPurchase(){
        return DB::table('tmm_receivemst')
            ->select('tmm_receivemst.*','smm_item.ITEM_NAME','ssm_supplier_info.TRADING_NAME','tmm_receivechd.RCV_QTY')
            ->leftJoin('smm_item','tmm_receivemst.RECEIVE_NO', '=','smm_item.ITEM_NO')
            ->leftJoin('ssm_supplier_info','tmm_receivemst.SUPP_ID_AUTO', '=','ssm_supplier_info.SUPP_ID_AUTO')
            ->leftJoin('tmm_receivechd','tmm_receivemst.RECEIVEMST_ID', '=','tmm_receivechd.RECEIVEMST_ID')
            ->where('tmm_receivemst.center_id','=', Auth::user()->center_id)
            ->where('tmm_receivemst.RECEIVE_TYPE','=','CR')
            ->get();
    }
    //for service
    public static function chemicalPurchaseService(){
        return DB::table('tmm_receivemst')
            ->select('tmm_receivemst.*','smm_item.ITEM_NAME','ssm_supplier_info.TRADING_NAME','tmm_receivechd.RCV_QTY')
            ->leftJoin('smm_item','tmm_receivemst.RECEIVE_NO', '=','smm_item.ITEM_NO')
            ->leftJoin('ssm_supplier_info','tmm_receivemst.SUPP_ID_AUTO', '=','ssm_supplier_info.SUPP_ID_AUTO')
            ->leftJoin('tmm_receivechd','tmm_receivemst.RECEIVEMST_ID', '=','tmm_receivechd.RECEIVEMST_ID')
            //->where('tmm_receivemst.center_id','=',Auth::user()->center_id)
            ->where('tmm_receivemst.RECEIVE_TYPE','=','CR')
            ->get();
    }

    public static function totalkIpurchase(){
        return DB::table('tmm_receivemst')
            ->leftJoin('tmm_receivechd','tmm_receivemst.RECEIVEMST_ID', '=','tmm_receivechd.RECEIVEMST_ID')
            ->where('tmm_receivemst.RECEIVE_NO', '=', 5)
            ->sum('tmm_receivechd.RCV_QTY');
    }

    public static function totalkio3purchase(){
        return DB::table('tmm_receivemst')
            ->leftJoin('tmm_receivechd','tmm_receivemst.RECEIVEMST_ID', '=','tmm_receivechd.RECEIVEMST_ID')
            ->where('tmm_receivemst.RECEIVE_NO', '=', 6)
            ->sum('tmm_receivechd.RCV_QTY');
    }

    public static function totalchemicalPurchaseTypeWise(){
        return DB::select(DB::raw("SELECT b.LOOKUPCHD_NAME, b.ITEM_NO, b.ITEM_NAME, SUM(b.purchase) purchase
                                        FROM
                                            (SELECT c.LOOKUPCHD_NAME, i.ITEM_NO, i.ITEM_NAME, s.QTY,
                                            CASE WHEN s.TRAN_FLAG = 'IC' AND s.TRAN_TYPE = 'C' THEN
                                                s.QTY
                                            END reduce,
                                        
                                            CASE WHEN s.TRAN_FLAG = 'PR' AND s.TRAN_TYPE = 'CP' THEN
                                                s.QTY
                                            END purchase,
                                            s.TRAN_DATE, s.center_id
                                            FROM smm_item i, tmm_itemstock s, ssc_lookupchd c
                                            WHERE i.ITEM_NO = s.ITEM_NO
                                            AND c.LOOKUPCHD_ID = i.ITEM_TYPE
                                            AND i.item_type = 25
                                            AND s.TRAN_FLAG NOT IN ('WR','II')
                                            AND s.TRAN_TYPE NOT IN ('W','I')) b
                                        GROUP BY b.LOOKUPCHD_NAME, b.ITEM_NO, b.ITEM_NAME"));
    }
    // for service issue fix new
    public static function totalchemicalPurchaseTypeWiseNew($child_id){
        return DB::select(DB::raw("SELECT b.LOOKUPCHD_NAME, b.ITEM_NO, b.ITEM_NAME, SUM(b.purchase) purchase
                                        FROM
                                            (SELECT c.LOOKUPCHD_NAME, i.ITEM_NO, i.ITEM_NAME, s.QTY,
                                            CASE WHEN s.TRAN_FLAG = 'IC' AND s.TRAN_TYPE = 'C' THEN
                                                s.QTY
                                            END reduce,
                                        
                                            CASE WHEN s.TRAN_FLAG = 'PR' AND s.TRAN_TYPE = 'CP' THEN
                                                s.QTY
                                            END purchase,
                                            s.TRAN_DATE, s.center_id
                                            FROM smm_item i, tmm_itemstock s, ssc_lookupchd c
                                            WHERE i.ITEM_NO = s.ITEM_NO
                                            AND c.LOOKUPCHD_ID = i.ITEM_TYPE
                                            AND i.item_type = 25
                                            AND s.TRAN_FLAG NOT IN ('WR','II')
                                            AND s.TRAN_TYPE NOT IN ('W','I')) b WHERE b.center_id='$child_id'
                                        GROUP BY b.LOOKUPCHD_NAME, b.ITEM_NO, b.ITEM_NAME"));
    }
    //for service

    public static function insertChemicalPurchaseData($request, $supplierTypeId){
        $supplierId = $request->input('SUPP_ID_AUTO');
        try{
            DB::beginTransaction();
            if ($supplierId == 1001){
                $supplierId = DB::table('ssm_supplier_info')->insertGetId([
                    'TRADING_NAME' => $request->input('TRADING_NAME'),
                    'PHONE' => $request->input('PHONE'),
                    'ADDRESS' => $request->input('ADDRESS'),
                    'SUPPLIER_TYPE_ID' => $supplierTypeId,
                    'center_id' => Auth::user()->center_id,
                    'ENTRY_BY' => Auth::user()->id,
                    'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
                ]);
            }

            $chemicalPurchaseMstId = DB::table('tmm_receivemst')->insertGetId([
                'RECEIVE_DATE' => date('Y-m-d', strtotime(Input::get('RECEIVE_DATE'))),
                'RECEIVE_NO' => $request->input('RECEIVE_NO'),
                'SUPP_ID_AUTO' => $supplierId,
                'RECEIVE_TYPE' => 'CR',//chemical receive
                'REMARKS' => $request->input('REMARKS'),
                'INVOICE_NO' => $request->input('INVOICE_NO'),
                'center_id' => Auth::user()->center_id,
                'ENTRY_BY' => Auth::user()->id,
                'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
            ]);

            if ($chemicalPurchaseMstId){
                DB::table('tmm_receivechd')->insertGetId([
                    'RECEIVEMST_ID' => $chemicalPurchaseMstId,
                    'ITEM_ID' => $request->input('RECEIVE_NO'),
                    'RCV_QTY' => $request->input('RCV_QTY'),
                    'center_id' => Auth::user()->center_id,
                    'ENTRY_BY' => Auth::user()->id,
                    'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
                ]);

                DB::table('tmm_itemstock')->insertGetId([
                    'TRAN_DATE' => date('Y-m-d', strtotime(Input::get('RECEIVE_DATE'))),
                    'TRAN_TYPE' => 'CP', //CP  = Chemical Purchase
                    'TRAN_NO' => $chemicalPurchaseMstId,
                    'ITEM_NO' => $request->input('RECEIVE_NO'),
                    'QTY' => $request->input('RCV_QTY'),
                    'TRAN_FLAG' => 'PR', // PR = Purchase Receive
                    'SUPP_ID_AUTO' => $request->input('SUPP_ID_AUTO'),
                    'center_id' => Auth::user()->center_id,
                    'ENTRY_BY' => Auth::user()->id,
                    'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
                ]);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public static function chemicalPurchaseShow($id){
        return DB::table('tmm_receivemst')
            ->select('tmm_receivemst.*','smm_item.ITEM_NAME','ssm_supplier_info.TRADING_NAME','tmm_receivechd.RCV_QTY')
            ->leftJoin('smm_item','tmm_receivemst.RECEIVE_NO', '=','smm_item.ITEM_NO')
            ->leftJoin('ssm_supplier_info','tmm_receivemst.SUPP_ID_AUTO', '=','ssm_supplier_info.SUPP_ID_AUTO')
            ->leftJoin('tmm_receivechd','tmm_receivemst.RECEIVEMST_ID', '=','tmm_receivechd.RECEIVEMST_ID')
            ->where('tmm_receivemst.RECEIVEMST_ID','=',$id)
            ->first();
    }

    public static function editChemicalPurchase($id){
        return DB::table('tmm_receivemst')
            ->select('tmm_receivemst.*','smm_item.ITEM_NAME','ssm_supplier_info.TRADING_NAME','tmm_receivechd.RCV_QTY')
            ->leftJoin('smm_item','tmm_receivemst.RECEIVE_NO', '=','smm_item.ITEM_NO')
            ->leftJoin('ssm_supplier_info','tmm_receivemst.SUPP_ID_AUTO', '=','ssm_supplier_info.SUPP_ID_AUTO')
            ->leftJoin('tmm_receivechd','tmm_receivemst.RECEIVEMST_ID', '=','tmm_receivechd.RECEIVEMST_ID')
            ->where('tmm_receivemst.RECEIVEMST_ID','=',$id)
            ->first();
    }

//    public static function insertIntoItemStok($data){
//        return DB::table('tmm_itemstock')->insert($data);
//    }

    public static function updateChemicalPurchaseData($request, $id){
        try{
            DB::beginTransaction();
            $updated = DB::table('tmm_receivemst')
                ->where('RECEIVEMST_ID',$id)
                ->update([
                    'RECEIVE_DATE' => date('Y-m-d', strtotime(Input::get('RECEIVE_DATE'))),
                    'RECEIVE_NO' => $request->input('RECEIVE_NO'),
                    'SUPP_ID_AUTO' => $request->input('SUPP_ID_AUTO'),
                    'RECEIVE_TYPE' => 'CR',//chemical receive
                    'REMARKS' => $request->input('REMARKS'),
                    'INVOICE_NO' => $request->input('INVOICE_NO'),
                    'UPDATE_BY' => Auth::user()->id,
                    'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s")
                ]);

            if ($updated){
                DB::table('tmm_receivechd')
                    ->where('tmm_receivechd.RECEIVEMST_ID',$id)
                    ->update([
                        'ITEM_ID' => $request->input('RECEIVE_NO'),
                        'RCV_QTY' => $request->input('RCV_QTY'),
                        'UPDATE_BY' => Auth::user()->id,
                        'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s")
                    ]);

                DB::table('tmm_itemstock')
                    ->where('tmm_itemstock.TRAN_NO',$id)
                    ->update([
                        'TRAN_TYPE' => 'CP', // CP = Chemical Purchase
                        'ITEM_NO' => $request->input('RECEIVE_NO'),
                        'QTY' => $request->input('RCV_QTY'),
                        'TRAN_FLAG' => 'PR', // PR = Purchase Receive
                        'SUPP_ID_AUTO' => $request->input('SUPP_ID_AUTO'),
                        'UPDATE_BY' => Auth::user()->id,
                        'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s")
                    ]);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public  static function deleteChemicalPurchase($id){
        $deleteStock = DB::table('tmm_itemstock')->where('TRAN_NO',$id)->delete();
        if($deleteStock){
            $deleteChd = DB::table('tmm_receivechd')->where('RECEIVEMST_ID', $id)->delete();
            //return $deleteChd;
        }


        if($deleteChd){
            $deletePr = DB::table('tmm_receivemst')->where('RECEIVEMST_ID', $id)->delete();
            return $deletePr;
        }
    }


    public static function totalProcurment(){
        $date = date("Y-m-d", strtotime("- 90 days"));
        $centerId = Auth::user()->center_id;
        $procurment = DB::table('tmm_receivemst');
        $procurment->select('tmm_receivemst.RECEIVE_TYPE','tmm_receivechd.RCV_QTY');
        $procurment->leftJoin('tmm_receivechd','tmm_receivemst.RECEIVEMST_ID','=','tmm_receivechd.RECEIVEMST_ID');
        $procurment->where('tmm_receivemst.RECEIVE_TYPE','=','CR');
        $procurment->where('tmm_receivemst.RECEIVE_DATE','>',$date);
        if($centerId){
            $procurment->where('tmm_receivemst.center_id','=',$centerId);
        }

        return $procurment->sum('tmm_receivechd.RCV_QTY');
    }

    public static function kiInstock(){
        $date = date("Y-m-d", strtotime("- 90 days"));
        $centerId = Auth::user()->center_id;
        $kiStock = DB::table('tmm_itemstock');
        $kiStock->select('tmm_itemstock.QTY');
        $kiStock->where('tmm_itemstock.TRAN_TYPE','=','CP');
        $kiStock->where('tmm_itemstock.TRAN_FLAG','=','PR');
        $kiStock->where('tmm_itemstock.TRAN_DATE','<=',$date);
        if($centerId){
            $kiStock->where('tmm_itemstock.center_id','=',$centerId);
        }

        return $kiStock->sum('tmm_itemstock.QTY');
    }

    public static function kiInUsed(){
        $date = date("Y-m-d", strtotime(" 90 days"));
        $centerId = Auth::user()->center_id;
        $kiUsed = DB::table('tmm_itemstock');
        $kiUsed->select('tmm_itemstock.QTY');
        $kiUsed->where('tmm_itemstock.TRAN_TYPE','=','C');
        $kiUsed->where('tmm_itemstock.TRAN_FLAG','=','IC');
        $kiUsed->where('tmm_itemstock.TRAN_DATE','<=',$date);
        if($centerId){
            $kiUsed->where('tmm_itemstock.center_id','=',$centerId);
        }

        return $kiUsed->sum('tmm_itemstock.QTY');
    }

    public static function totalAssociationProcurment(){
        $date = date("Y-m-d", strtotime(" -90 days"));

        $procurment = DB::table('tmm_receivemst');
        $procurment->select('tmm_receivemst.RECEIVE_TYPE','tmm_receivechd.RCV_QTY');
        $procurment->leftJoin('tmm_receivechd','tmm_receivemst.RECEIVEMST_ID','=','tmm_receivechd.RECEIVEMST_ID');
        $procurment->where('tmm_receivemst.RECEIVE_TYPE','=','CR');
        $procurment->where('tmm_receivemst.RECEIVE_DATE','>',$date);


        return $procurment->sum('tmm_receivechd.RCV_QTY');
    }

    public static function kiAssociationInstock(){
        $date = date("Y-m-d", strtotime(" -90 days"));

        $kiStock = DB::table('tmm_itemstock');
        $kiStock->select('tmm_itemstock.QTY');
        $kiStock->where('tmm_itemstock.TRAN_TYPE','=','CP');
        $kiStock->where('tmm_itemstock.TRAN_FLAG','=','PR');
        $kiStock->where('tmm_itemstock.TRAN_DATE','<=',$date);


        return $kiStock->sum('tmm_itemstock.QTY');
    }

    public static function kiAssociationInUsed(){
        $date = date("Y-m-d", strtotime(" 90 days"));

        $kiUsed = DB::table('tmm_itemstock');
        $kiUsed->select('tmm_itemstock.QTY');
        $kiUsed->where('tmm_itemstock.TRAN_TYPE','=','C');
        $kiUsed->where('tmm_itemstock.TRAN_FLAG','=','IC');
        $kiUsed->where('tmm_itemstock.TRAN_DATE','<=',$date);


        return $kiUsed->sum('tmm_itemstock.QTY');
    }
}
