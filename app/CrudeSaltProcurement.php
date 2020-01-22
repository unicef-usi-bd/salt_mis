<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;


class CrudeSaltProcurement extends Model
{
    public static function crudeSaltePurchase(){
        return DB::table('tmm_receivemst')
            ->select('tmm_receivemst.*','smm_item.ITEM_NAME','ssm_supplier_info.TRADING_NAME','tmm_receivechd.RCV_QTY','ssc_lookupchd.LOOKUPCHD_NAME')
            ->leftJoin('smm_item','tmm_receivemst.RECEIVE_NO','=','smm_item.ITEM_NO')
            ->leftJoin('ssm_supplier_info','tmm_receivemst.SUPP_ID_AUTO', '=','ssm_supplier_info.SUPP_ID_AUTO')
            ->leftJoin('tmm_receivechd','tmm_receivemst.RECEIVEMST_ID', '=','tmm_receivechd.RECEIVEMST_ID')
            ->leftJoin('ssc_lookupchd','tmm_receivemst.SOURCE_ID', '=','ssc_lookupchd.LOOKUPCHD_ID')
            ->where('tmm_receivemst.center_id','=',Auth::user()->center_id)
            ->where('tmm_receivemst.RECEIVE_TYPE','=','SR')
            ->get();
    }

    //for Service
    public static function crudeSaltePurchaseService(){
        return DB::table('tmm_receivemst')
            ->select('tmm_receivemst.*','smm_item.ITEM_NAME','ssm_supplier_info.TRADING_NAME','tmm_receivechd.RCV_QTY','ssc_lookupchd.LOOKUPCHD_NAME')
            ->leftJoin('smm_item','tmm_receivemst.RECEIVE_NO','=','smm_item.ITEM_NO')
            ->leftJoin('ssm_supplier_info','tmm_receivemst.SUPP_ID_AUTO', '=','ssm_supplier_info.SUPP_ID_AUTO')
            ->leftJoin('tmm_receivechd','tmm_receivemst.RECEIVEMST_ID', '=','tmm_receivechd.RECEIVEMST_ID')
            ->leftJoin('ssc_lookupchd','tmm_receivemst.SOURCE_ID', '=','ssc_lookupchd.LOOKUPCHD_ID')
            //->where('tmm_receivemst.center_id','=',Auth::user()->center_id)
            ->where('tmm_receivemst.RECEIVE_TYPE','=','SR')
            ->get();
    }

    public static function totalSaltpurchaseTypeWise(){
        return DB::select(DB::raw("SELECT b.LOOKUPCHD_NAME, b.ITEM_NO, b.ITEM_NAME, SUM(b.purchase) purchase
                                        FROM
                                         (SELECT c.LOOKUPCHD_NAME, i.ITEM_NO, i.ITEM_NAME, s.QTY,
                                            CASE WHEN s.TRAN_FLAG = 'WS' AND s.TRAN_TYPE = 'S' THEN
                                                s.QTY
                                            END reduce,
                                        
                                            CASE WHEN s.TRAN_FLAG = 'PR' AND s.TRAN_TYPE = 'SP' THEN
                                                s.QTY
                                            END purchase,
                                            s.TRAN_DATE, s.center_id
                                            FROM smm_item i, tmm_itemstock s, ssc_lookupchd c
                                            WHERE i.ITEM_NO = s.ITEM_NO
                                            AND c.LOOKUPCHD_ID = i.ITEM_TYPE
                                            AND i.item_type = 26
                                            AND s.TRAN_FLAG NOT IN ('WR','II')
                                            AND s.TRAN_TYPE NOT IN ('W','I')) b
                                        GROUP BY b.LOOKUPCHD_NAME, b.ITEM_NO, b.ITEM_NAME"));
    }
    // FOR service to solve issue
    public static function totalSaltpurchaseTypeWiseNew($child_id){
        return DB::select(DB::raw("SELECT b.LOOKUPCHD_NAME, b.ITEM_NO, b.ITEM_NAME, SUM(b.purchase) purchase
                                        FROM
                                         (SELECT c.LOOKUPCHD_NAME, i.ITEM_NO, i.ITEM_NAME, s.QTY,
                                            CASE WHEN s.TRAN_FLAG = 'WS' AND s.TRAN_TYPE = 'S' THEN
                                                s.QTY
                                            END reduce,
                                        
                                            CASE WHEN s.TRAN_FLAG = 'PR' AND s.TRAN_TYPE = 'SP' THEN
                                                s.QTY
                                            END purchase,
                                            s.TRAN_DATE, s.center_id
                                            FROM smm_item i, tmm_itemstock s, ssc_lookupchd c
                                            WHERE i.ITEM_NO = s.ITEM_NO
                                            AND c.LOOKUPCHD_ID = i.ITEM_TYPE
                                            AND i.item_type = 26
                                            AND s.TRAN_FLAG NOT IN ('WR','II')
                                            AND s.TRAN_TYPE NOT IN ('W','I')) b WHERE b.center_id = '$child_id' 
                                        GROUP BY b.LOOKUPCHD_NAME, b.ITEM_NO, b.ITEM_NAME"));
    }
    //for service

    public static function getCountryName(){
        return DB::table('ssc_country')
            ->select('ssc_country.*')
            ->get();
    }



    public static function insertCrudeSaltData($request){
        $crudeSaltMstId = DB::table('tmm_receivemst')->insertGetId([
//            'RECEIVE_DATE' => date('Y-m-d', strtotime(Input::get('RECEIVE_DATE'))),
            'RECEIVE_NO' => $request->input('RECEIVE_NO'),
            'RECEIVE_TYPE' => 'SR',//Salt receive
            'SUPP_ID_AUTO' => $request->input('SUPP_ID_AUTO'),
            'SOURCE_ID' => $request->input('SOURCE_ID'),
            'COUNTRY_ID' => $request->input('COUNTRY_ID'),
            'INVOICE_NO' => $request->input('INVOICE_NO'),
            'REMARKS' => $request->input('REMARKS'),
            'DRIVER_NAME'=> $request->input('DRIVER_NAME'),
            'VEHICLE_NO'=> $request->input('VEHICLE_NO'),
            'VEHICLE_LICENSE'=> $request->input('VEHICLE_LICENSE'),
            'TRANSPORT_NAME'=> $request->input('TRANSPORT_NAME'),
            'MOBILE_NO'=> $request->input('MOBILE_NO'),
            'REMARKS_Tansport'=>$request->input('REMARKS_Tansport'),
            'center_id' => Auth::user()->center_id,
            'ENTRY_BY' => Auth::user()->id,
            'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
        ]);
        if ($crudeSaltMstId){
            $crudeSaltChdId = DB::table('tmm_receivechd')->insertGetId([
                'RECEIVEMST_ID' => $crudeSaltMstId,
                'ITEM_ID' => $request->input('RECEIVE_NO'),
                'RCV_QTY' => $request->input('RCV_QTY'),
                'center_id' => Auth::user()->center_id,
                'ENTRY_BY' => Auth::user()->id,
                'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
            ]);
        }
        if($crudeSaltChdId){
            $itemStokId = DB::table('tmm_itemstock')->insertGetId([
                'TRAN_DATE' => date("Y-m-d h:i:s"),
                'TRAN_TYPE' => 'SP', //S  = Salt Purchase
                'TRAN_NO' => $crudeSaltMstId,
                'ITEM_NO' => $request->input('RECEIVE_NO'),
                'QTY' => $request->input('RCV_QTY'),
                'TRAN_FLAG' => 'PR', // PR = Purchase Receive
                'SUPP_ID_AUTO' => $request->input('SUPP_ID_AUTO'),
                'center_id' => Auth::user()->center_id,
                'ENTRY_BY' => Auth::user()->id,
                'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
            ]);
        }
        return $itemStokId;

    }

    public static function crudeSaltPurchaseShow($id){
        return DB::table('tmm_receivemst')
            ->select('tmm_receivemst.*','smm_item.ITEM_NAME','ssm_supplier_info.TRADING_NAME','tmm_receivechd.RCV_QTY','ssc_lookupchd.LOOKUPCHD_NAME')
            ->leftJoin('smm_item','tmm_receivemst.RECEIVE_NO', '=','smm_item.ITEM_NO')
            ->leftJoin('ssm_supplier_info','tmm_receivemst.SUPP_ID_AUTO', '=','ssm_supplier_info.SUPP_ID_AUTO')
            ->leftJoin('tmm_receivechd','tmm_receivemst.RECEIVEMST_ID', '=','tmm_receivechd.RECEIVEMST_ID')
            ->leftJoin('ssc_lookupchd','tmm_receivemst.SOURCE_ID', '=','ssc_lookupchd.LOOKUPCHD_ID')
            ->where('tmm_receivemst.RECEIVEMST_ID','=',$id)
            ->first();
    }

    public static function editCrudeSaltPurchase($id){
        return DB::table('tmm_receivemst')
            ->select('tmm_receivemst.*','smm_item.ITEM_NAME','ssm_supplier_info.TRADING_NAME','tmm_receivechd.RCV_QTY','ssc_lookupchd.LOOKUPCHD_NAME')
            ->leftJoin('smm_item','tmm_receivemst.RECEIVE_NO', '=','smm_item.ITEM_NO')
            ->leftJoin('ssm_supplier_info','tmm_receivemst.SUPP_ID_AUTO', '=','ssm_supplier_info.SUPP_ID_AUTO')
            ->leftJoin('tmm_receivechd','tmm_receivemst.RECEIVEMST_ID', '=','tmm_receivechd.RECEIVEMST_ID')
            ->leftJoin('ssc_lookupchd','tmm_receivemst.SOURCE_ID', '=','ssc_lookupchd.LOOKUPCHD_ID')
            ->where('tmm_receivemst.RECEIVEMST_ID','=',$id)
            ->first();
    }

    public static function updateCrudeSaltPurchase($request,$id){
        $crudeSaltMstId = DB::table('tmm_receivemst')->where('RECEIVEMST_ID',$id)->update([
            //'RECEIVE_DATE' => date('Y-m-d', strtotime(Input::get('RECEIVE_DATE'))),
            'RECEIVE_NO' => $request->input('RECEIVE_NO'),
            'SUPP_ID_AUTO' => $request->input('SUPP_ID_AUTO'),
            'SOURCE_ID' => $request->input('SOURCE_ID'),
            'RECEIVE_TYPE' => 'SR',//Salt receive
            'INVOICE_NO' => $request->input('INVOICE_NO'),
            'REMARKS' => $request->input('REMARKS'),
            'DRIVER_NAME'=> $request->input('DRIVER_NAME'),
            'VEHICLE_NO'=> $request->input('VEHICLE_NO'),
            'VEHICLE_LICENSE'=> $request->input('VEHICLE_LICENSE'),
            'TRANSPORT_NAME'=> $request->input('TRANSPORT_NAME'),
            'MOBILE_NO'=> $request->input('MOBILE_NO'),
            'REMARKS_Tansport'=>$request->input('REMARKS_Tansport'),
            'UPDATE_BY' => Auth::user()->id,
            'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s")
        ]);
        if ($crudeSaltMstId){
            $crudeSaltChdId = DB::table('tmm_receivechd')->where('tmm_receivechd.RECEIVEMST_ID',$id)->update([
                //'RECEIVEMST_ID' => $id,
                'ITEM_ID' => $request->input('RECEIVE_NO'),
                'RCV_QTY' => $request->input('RCV_QTY'),
                'UPDATE_BY' => Auth::user()->id,
                'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s")
            ]);
        }
        if($crudeSaltChdId){
            $itemStokId = DB::table('tmm_itemstock')->where('tmm_itemstock.TRAN_NO',$id)->update([
                //'TRAN_NO' => $id,
                'TRAN_DATE' => date("Y-m-d h:i:s"),
                'TRAN_TYPE' => 'SP', //S  = Salt Purchase
                'ITEM_NO' => $request->input('RECEIVE_NO'),
                'QTY' => $request->input('RCV_QTY'),
                'TRAN_FLAG' => 'PR', // PR = Purchase Receive
                'SUPP_ID_AUTO' => $request->input('SUPP_ID_AUTO'),
                'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s")
            ]);
        }
        return $itemStokId;
    }

    public  static function deleteCrudeSaltPurchase($id){
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

    public static function crudeSaltInvoiceList($crudSaltType){
        $centerId = Auth::user()->center_id;

//        $invoiceList = DB::table('tmm_receivemst');
//        $invoiceList->select('tmm_receivemst.*');
//        $invoiceList->where('tmm_receivemst.RECEIVE_NO','=',$crudSaltType);
//        if($centerId){
//            $invoiceList->where('tmm_receivemst.center_id','=',$centerId);
//        }
//        $invoiceList->get();

        return DB::select(DB::raw("select tmm_receivemst.* 
                                        from tmm_receivemst
                                        where tmm_receivemst.RECEIVE_NO = $crudSaltType
                                        and tmm_receivemst.center_id = $centerId"));
    }
}
