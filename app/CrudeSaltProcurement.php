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
            ->where('tmm_receivemst.RECEIVE_TYPE','=','SR')
            ->get();
    }

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
            'REMARKS' => $request->input('REMARKS'),
            'ENTRY_BY' => Auth::user()->id,
            'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
        ]);
        if ($crudeSaltMstId){
            $crudeSaltChdId = DB::table('tmm_receivechd')->insertGetId([
                'RECEIVEMST_ID' => $crudeSaltMstId,
                'ITEM_ID' => $request->input('RECEIVE_NO'),
                'RCV_QTY' => $request->input('RCV_QTY'),
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
            'REMARKS' => $request->input('REMARKS'),
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
}
