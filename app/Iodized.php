<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class Iodized extends Model
{
    public static function getIodizeBatchId(){
        return DB::table('tmm_iodizedmst')
            ->select('tmm_iodizedmst.*')
            ->get();
    }
    public static function getIodizeData(){
        return DB::table('tmm_iodizedmst')
            ->select('tmm_iodizedmst.*','smm_item.ITEM_NAME','tmm_iodizedchd.WASH_CRASH_QTY','tmm_iodizedchd.REQ_QTY')
            ->leftJoin('smm_item','tmm_iodizedmst.PRODUCT_ID', '=','smm_item.ITEM_NO')
            ->leftJoin('tmm_iodizedchd','tmm_iodizedmst.IODIZEDMST_ID', '=','tmm_iodizedchd.IODIZEDMST_ID')
//            ->where('tmm_receivemst.RECEIVE_TYPE','=','CR')
            ->get();
    }

    public static function insertIodizeData($request){
        $iodizeMstId = DB::table('tmm_iodizedmst')->insertGetId([
            'BATCH_NO' => $request->input('BATCH_NO'),
            'BATCH_DATE' => date('Y-m-d', strtotime(Input::get('BATCH_DATE'))),
            'PRODUCT_ID' => $request->input('PRODUCT_ID'),
            //'SUPP_ID_AUTO' => $supplierId,
            //'RECEIVE_TYPE' => 'CR',//chemical receive
            'REMARKS' => $request->input('REMARKS'),
            'ENTRY_BY' => Auth::user()->id,
            'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
        ]);
        if ($iodizeMstId){
            $iodizeChdId = DB::table('tmm_iodizedchd')->insertGetId([
                'IODIZEDMST_ID' => $iodizeMstId,
                'ITEM_ID' => $request->input('PRODUCT_ID'),
                'REQ_QTY' => $request->input('REQ_QTY'),
                'WASTAGE' => $request->input('WASTAGE'),
                'WASH_CRASH_QTY' => $request->input('WASH_CRASH_QTY'),
                'ITEM_TYPE' => 'I',//I=Iodized
                'ENTRY_BY' => Auth::user()->id,
                'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
            ]);
        }
        if($iodizeChdId){
            $reduceIodizeStokId = DB::table('tmm_itemstock')->insertGetId([
                'TRAN_DATE' => date('Y-m-d', strtotime(Input::get('TRAN_DATE'))),
                'TRAN_TYPE' => 'C', //I=Iodized
                'TRAN_NO' => $iodizeMstId,
                'ITEM_NO' => $request->input('PRODUCT_ID'),
                'QTY' => '-'.$request->input('REQ_QTY'),
                'TRAN_FLAG' => 'CR', // CR = chemical Reduce
                //'SUPP_ID_AUTO' => $request->input('SUPP_ID_AUTO'),
                'ENTRY_BY' => Auth::user()->id,
                'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
            ]);
        }
        if ($reduceIodizeStokId){
            $itemStokId = DB::table('tmm_itemstock')->insertGetId([
                'TRAN_DATE' => date('Y-m-d', strtotime(Input::get('TRAN_DATE'))),
                'TRAN_TYPE' => 'I', //I=Iodized
                'TRAN_NO' => $iodizeMstId,
                'ITEM_NO' => $request->input('PRODUCT_ID'),
                'QTY' => $request->input('REQ_QTY'),
                'TRAN_FLAG' => 'CP', // CP = chemical Purchase
                //'SUPP_ID_AUTO' => $request->input('SUPP_ID_AUTO'),
                'ENTRY_BY' => Auth::user()->id,
                'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
            ]);
        }


        return $itemStokId;
    }

    public static function showIodizeData($id){
        return DB::table('tmm_iodizedmst')
            ->select('tmm_iodizedmst.*','smm_item.ITEM_NAME','tmm_iodizedchd.WASH_CRASH_QTY','tmm_iodizedchd.REQ_QTY')
            ->leftJoin('smm_item','tmm_iodizedmst.PRODUCT_ID', '=','smm_item.ITEM_NO')
            ->leftJoin('tmm_iodizedchd','tmm_iodizedmst.IODIZEDMST_ID', '=','tmm_iodizedchd.IODIZEDMST_ID')
            ->where('tmm_iodizedmst.IODIZEDMST_ID','=',$id)
            ->first();
    }

    public static function editIodizeData($id){
        return DB::table('tmm_iodizedmst')
            ->select('tmm_iodizedmst.*','smm_item.ITEM_NAME','tmm_iodizedchd.*','tmm_iodizedchd.REQ_QTY')
            ->leftJoin('smm_item','tmm_iodizedmst.PRODUCT_ID', '=','smm_item.ITEM_NO')
            ->leftJoin('tmm_iodizedchd','tmm_iodizedmst.IODIZEDMST_ID', '=','tmm_iodizedchd.IODIZEDMST_ID')
            ->where('tmm_iodizedmst.IODIZEDMST_ID','=',$id)
            ->first();
    }

    public static function updateIodizeData($request,$id){
        $iodizeMstId = DB::table('tmm_iodizedmst')->where('IODIZEDMST_ID',$id)->update([
            'BATCH_NO' => $request->input('BATCH_NO'),
            'BATCH_DATE' => date('Y-m-d', strtotime(Input::get('BATCH_DATE'))),
            'PRODUCT_ID' => $request->input('PRODUCT_ID'),
            //'SUPP_ID_AUTO' => $supplierId,
            //'RECEIVE_TYPE' => 'CR',//chemical receive
            'REMARKS' => $request->input('REMARKS'),
            'UPDATE_BY' => Auth::user()->id,
            'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s")
        ]);
        if ($iodizeMstId){
            $iodizeChdId = DB::table('tmm_iodizedchd')->where('tmm_iodizedchd.IODIZEDMST_ID',$id)->update([
                //'IODIZEDMST_ID' => $iodizeMstId,
                'ITEM_ID' => $request->input('PRODUCT_ID'),
                'REQ_QTY' => $request->input('REQ_QTY'),
                'WASTAGE' => $request->input('WASTAGE'),
                'WASH_CRASH_QTY' => $request->input('WASH_CRASH_QTY'),
                'ITEM_TYPE' => 'I',//I=Iodized
                'UPDATE_BY' => Auth::user()->id,
                'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s")
            ]);
        }
        if($iodizeChdId){
            $reduceIodizeStokId = DB::table('tmm_itemstock')->where('tmm_itemstock.TRAN_NO',$id)->update([
                'TRAN_DATE' => date('Y-m-d', strtotime(Input::get('TRAN_DATE'))),
                'TRAN_TYPE' => 'C', //I=Iodized
                //'TRAN_NO' => $iodizeMstId,
                'ITEM_NO' => $request->input('PRODUCT_ID'),
                'QTY' => '-'.$request->input('REQ_QTY'),
                'TRAN_FLAG' => 'CR', // CR = chemical Reduce
                //'SUPP_ID_AUTO' => $request->input('SUPP_ID_AUTO'),
                'UPDATE_BY' => Auth::user()->id,
                'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s")
            ]);
        }
        if ($reduceIodizeStokId){
            $itemStokId = DB::table('tmm_itemstock')->where('tmm_itemstock.TRAN_NO',$id)->update([
                'TRAN_DATE' => date('Y-m-d', strtotime(Input::get('TRAN_DATE'))),
                'TRAN_TYPE' => 'I', //I=Iodized
                //'TRAN_NO' => $iodizeMstId,
                'ITEM_NO' => $request->input('PRODUCT_ID'),
                'QTY' => $request->input('REQ_QTY'),
                'TRAN_FLAG' => 'CP', // CP = chemical Purchase
                //'SUPP_ID_AUTO' => $request->input('SUPP_ID_AUTO'),
                'UPDATE_BY' => Auth::user()->id,
                'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s")
            ]);
        }


        return $itemStokId;
    }

    public  static function deleteIodizeData($id){
        $deleteStock = DB::table('tmm_itemstock')->where('TRAN_NO',$id)->delete();
        if($deleteStock){
            $deleteChd = DB::table('tmm_iodizedchd')->where('IODIZEDMST_ID', $id)->delete();
            //return $deleteChd;
        }


        if($deleteChd){
            $deletePr = DB::table('tmm_iodizedmst')->where('IODIZEDMST_ID', $id)->delete();
            return $deletePr;
        }
    }
}