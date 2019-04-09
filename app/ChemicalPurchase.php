<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ChemicalPurchase extends Model
{
    public static function getChemical(){
        return DB::table('smm_item')
            ->select('*')
            ->where('ITEM_TYPE','=',25)
            ->get();
    }

    public static function getSource(){
        return DB::table('smm_item')
            ->select('*')
            ->where('ITEM_TYPE','=',25)
            ->get();
    }

    public static function getChemicalSupplier(){
        return DB::table('ssm_supplier_info')
            ->select('ssm_supplier_info.*')
            ->get();
    }

    public static function getSupplierName(){
        return DB::table('ssm_supplier_info')
            ->select('ssm_supplier_info.*')
            ->get();
    }

    public static function chemicalPurchase(){
        return DB::table('tmm_receivemst')
            ->select('tmm_receivemst.*','smm_item.ITEM_NAME','ssm_supplier_info.TRADING_NAME','tmm_receivechd.RCV_QTY')
            ->leftJoin('smm_item','tmm_receivemst.RECEIVE_NO', '=','smm_item.ITEM_NO')
            ->leftJoin('ssm_supplier_info','tmm_receivemst.SUPP_ID_AUTO', '=','ssm_supplier_info.SUPP_ID_AUTO')
            ->leftJoin('tmm_receivechd','tmm_receivemst.RECEIVEMST_ID', '=','tmm_receivechd.RECEIVEMST_ID')
            ->where('tmm_receivemst.RECEIVE_TYPE','=','CR')
            ->get();
    }

    public static function insertChemicalPurchaseData($request){
        $supplierId = $request->input('SUPP_ID_AUTO');
        if ($supplierId == 1){
            $supplierId = DB::table('ssm_supplier_info')->insertGetId([
                'TRADING_NAME' => $request->input('TRADING_NAME'),
                'PHONE' => $request->input('PHONE'),
                'ADDRESS' => $request->input('ADDRESS'),
                'ENTRY_BY' => Auth::user()->id,
                'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
            ]);

        }
        $chemicalPurchaseMstId = DB::table('tmm_receivemst')->insertGetId([
            'RECEIVE_DATE' => date('Y-m-d', strtotime(Input::get('RECEIVE_DATE'))),
            'RECEIVE_NO' => $request->input('RECEIVE_NO'),
            'SUPP_ID_AUTO' => $request->input('SUPP_ID_AUTO'),
            'RECEIVE_TYPE' => 'CR',//chemical receive
            'REMARKS' => $request->input('REMARKS'),
            'ENTRY_BY' => Auth::user()->id,
            'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
        ]);
        if ($chemicalPurchaseMstId){
            $chemicalPurchaseChdId = DB::table('tmm_receivechd')->insertGetId([
                'RECEIVEMST_ID' => $chemicalPurchaseMstId,
                'ITEM_ID' => $request->input('RECEIVE_NO'),
                'RCV_QTY' => $request->input('RCV_QTY'),
                'ENTRY_BY' => Auth::user()->id,
                'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
            ]);
        }
        if($chemicalPurchaseChdId){
            $itemStokId = DB::table('tmm_itemstock')->insertGetId([
                'TRAN_DATE' => date('Y-m-d', strtotime(Input::get('TRAN_DATE'))),
                'TRAN_TYPE' => 'C', //C  = Chemical
                'TRAN_NO' => $chemicalPurchaseChdId,
                'ITEM_NO' => $request->input('RECEIVE_NO'),
                'QTY' => $request->input('RCV_QTY'),
                'TRAN_FLAG' => 'CP', // CP = chemical Purchase
                'SUPP_ID_AUTO' => $request->input('SUPP_ID_AUTO'),
                'ENTRY_BY' => Auth::user()->id,
                'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
            ]);
        }

            return $itemStokId;
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

    public static function updateChemicalPurchaseData($request,$id){
        $chemicalPurchaseMstId = DB::table('tmm_receivemst')->where('RECEIVEMST_ID',$id)->update([
            'RECEIVE_DATE' => date('Y-m-d', strtotime(Input::get('RECEIVE_DATE'))),
            'RECEIVE_NO' => $request->input('RECEIVE_NO'),
            'SUPP_ID_AUTO' => $request->input('SUPP_ID_AUTO'),
            'RECEIVE_TYPE' => 'CR',//chemical receive
            'REMARKS' => $request->input('REMARKS'),
            'UPDATE_BY' => Auth::user()->id,
            'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s")
        ]);
        if ($chemicalPurchaseMstId){
            $chemicalPurchaseChdId = DB::table('tmm_receivechd')->where('tmm_receivechd.RECEIVECHD_ID',$id)->update([
                'RECEIVEMST_ID' => $id,
                'ITEM_ID' => $request->input('RECEIVE_NO'),
                'RCV_QTY' => $request->input('RCV_QTY'),
                'UPDATE_BY' => Auth::user()->id,
                'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s")
            ]);
        }
        if($chemicalPurchaseChdId){
            $itemStokId = DB::table('tmm_itemstock')->where('tmm_itemstock.STOCK_NO',$id)->update([
                'TRAN_NO' => $id,
                'TRAN_TYPE' => 'C', // C = Chemical
                'ITEM_NO' => $request->input('RECEIVE_NO'),
                'QTY' => $request->input('RCV_QTY'),
                'TRAN_FLAG' => 'CP', //CP = chemical receive
                'SUPP_ID_AUTO' => $request->input('SUPP_ID_AUTO'),
                'UPDATE_BY' => Auth::user()->id,
                'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s")
            ]);
        }
        return $itemStokId;

    }

    public  static function deleteChemicalPurchase($id){
        $deleteStock = DB::table('tmm_itemstock')->where('STOCK_NO',$id)->delete();
        if($deleteStock){
            $deleteChd = DB::table('tmm_receivechd')->where('RECEIVECHD_ID', $id)->delete();
            //return $deleteChd;
        }


        if($deleteChd){
            $deletePr = DB::table('tmm_receivemst')->where('RECEIVEMST_ID', $id)->delete();
            return $deletePr;
        }
    }
}
