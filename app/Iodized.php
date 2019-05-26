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
            ->select('tmm_iodizedmst.*','smm_item.ITEM_NAME','tmm_iodizedchd.WASH_CRASH_QTY','tmm_iodizedchd.REQ_QTY','tmm_iodizedchd.WASTAGE')
            ->leftJoin('smm_item','tmm_iodizedmst.PRODUCT_ID', '=','smm_item.ITEM_NO')
            ->leftJoin('tmm_iodizedchd','tmm_iodizedmst.IODIZEDMST_ID', '=','tmm_iodizedchd.IODIZEDMST_ID')
            ->where('tmm_iodizedmst.center_id','=',Auth::user()->center_id)
//            ->where('tmm_receivemst.RECEIVE_TYPE','=','CR')
            ->get();
    }

    public static function insertIodizeData($request,$centerId,$entryBy){
        $washAndCrushQty = intval($request->input('WASH_CRASH_QTY'));
        $iodizeWastage = ($washAndCrushQty *intval($request->input('WASTAGE')) / 100);
        $iodizeStock = $washAndCrushQty - $iodizeWastage;

        $iodizeMstId = DB::table('tmm_iodizedmst')->insertGetId([
            'BATCH_NO' => $request->input('BATCH_NO'),
            'BATCH_DATE' => date('Y-m-d', strtotime(Input::get('BATCH_DATE'))),
            'PRODUCT_ID' => $request->input('PRODUCT_ID'),
            //'SUPP_ID_AUTO' => $supplierId,
            //'RECEIVE_TYPE' => 'CR',//chemical receive
            'REMARKS' => $request->input('REMARKS'),
            'center_id' => $centerId,
            'ENTRY_BY' => $entryBy,
            'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
        ]);
        if ($iodizeMstId){
            $iodizeChdId = DB::table('tmm_iodizedchd')->insertGetId([
                'IODIZEDMST_ID' => $iodizeMstId,
                'ITEM_ID' => $request->input('PRODUCT_ID'),
                'REQ_QTY' => $request->input('REQ_QTY'),
                'WASTAGE' => $request->input('WASTAGE'),
                'WASH_CRASH_QTY' => $iodizeStock,
                'ITEM_TYPE' => 'I',//I=Iodized
                'center_id' => $centerId,
                'ENTRY_BY' => $entryBy,
                'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
            ]);
        }
        if($iodizeChdId){
            $reduceWashingStokId = DB::table('tmm_itemstock')->insertGetId([
                'TRAN_DATE' => date('Y-m-d', strtotime(Input::get('TRAN_DATE'))),
                'TRAN_TYPE' => 'W', //W=Washing
                'TRAN_NO' => $iodizeMstId,
                'ITEM_NO' => $request->input('PRODUCT_ID'),
                'QTY' => '-'.$request->input('WASH_CRASH_QTY'),
                'TRAN_FLAG' => 'WR', // WR = Washing Reduce
                'center_id' => $centerId,
                //'SUPP_ID_AUTO' => $request->input('SUPP_ID_AUTO'),
                'ENTRY_BY' => $entryBy,
                'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
            ]);
        }
        if($reduceWashingStokId){
            $reduceChemicalId =  DB::table('tmm_itemstock')->insertGetId([
                'TRAN_DATE' => date('Y-m-d', strtotime(Input::get('TRAN_DATE'))),
                'TRAN_TYPE' => 'C', //C=Chemical
                'TRAN_NO' => $iodizeMstId,
                'ITEM_NO' => $request->input('PRODUCT_ID'),
                'QTY' => '-'.$request->input('REQ_QTY'),
                'TRAN_FLAG' => 'IC', // IC = Idonaize Chemical
                'center_id' => $centerId,
                //'SUPP_ID_AUTO' => $request->input('SUPP_ID_AUTO'),
                'ENTRY_BY' => $entryBy,
                'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
            ]);
        }
        if ($reduceChemicalId){
            $itemStokId = DB::table('tmm_itemstock')->insertGetId([
                'TRAN_DATE' => date('Y-m-d', strtotime(Input::get('TRAN_DATE'))),
                'TRAN_TYPE' => 'I', //I=Iodized
                'TRAN_NO' => $iodizeMstId,
                'ITEM_NO' => $request->input('PRODUCT_ID'),
//                'QTY' => $request->input('WASH_CRASH_QTY'),
                'QTY' => $iodizeStock,
                'TRAN_FLAG' => 'II', // II = Idonize Increase
                'center_id' => $centerId,
                //'SUPP_ID_AUTO' => $request->input('SUPP_ID_AUTO'),
                'ENTRY_BY' => $entryBy,
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
            ->select('tmm_iodizedmst.*','smm_item.ITEM_NO','smm_item.ITEM_NAME','tmm_iodizedchd.*','tmm_iodizedchd.REQ_QTY')
            ->leftJoin('smm_item','tmm_iodizedmst.PRODUCT_ID', '=','smm_item.ITEM_NO')
            ->leftJoin('tmm_iodizedchd','tmm_iodizedmst.IODIZEDMST_ID', '=','tmm_iodizedchd.IODIZEDMST_ID')
            ->where('tmm_iodizedmst.IODIZEDMST_ID','=',$id)
            ->first();
    }

    public static function updateIodizeData($request,$id,$iodizeStock){
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
            $iodizeChdId = DB::table('tmm_iodizedchd')->where('tmm_iodizedchd.IODIZEDMST_ID',$id)->update([
                //'IODIZEDMST_ID' => $iodizeMstId,
                'ITEM_ID' => $request->input('PRODUCT_ID'),
                'REQ_QTY' => $request->input('REQ_QTY'),
                'WASTAGE' => $request->input('WASTAGE'),
                'WASH_CRASH_QTY' => $iodizeStock,
                'ITEM_TYPE' => 'I',//I=Iodized
                'UPDATE_BY' => Auth::user()->id,
                'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s")
            ]);

            $updateReduceIodizeWashingStokId = DB::table('tmm_itemstock')->where('tmm_itemstock.TRAN_NO','=',$id)
                ->where('tmm_itemstock.TRAN_TYPE', '=' , 'W')
                ->where('tmm_itemstock.TRAN_FLAG', '=' , 'WR')
                ->update([
                'TRAN_DATE' => date('Y-m-d', strtotime(Input::get('TRAN_DATE'))),
                'TRAN_TYPE' => 'W', //W=Washing
                'TRAN_NO' => $iodizeMstId,
                'ITEM_NO' => $request->input('PRODUCT_ID'),
                'QTY' => '-'.$request->input('WASH_CRASH_QTY'),
                'TRAN_FLAG' => 'WR', // WR = Washing Reduce
                'UPDATE_BY' => Auth::user()->id,
                'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s")
            ]);
            $updateIdonaizeChemical = DB::table('tmm_itemstock')->where('tmm_itemstock.TRAN_NO','=',$id)
                ->where('tmm_itemstock.TRAN_TYPE', '=' , 'C')
                ->where('tmm_itemstock.TRAN_FLAG', '=' , 'IC')
                ->update([
                'TRAN_DATE' => date('Y-m-d', strtotime(Input::get('TRAN_DATE'))),
                'TRAN_TYPE' => 'C', //C=Chemical
                'TRAN_NO' => $iodizeMstId,
                'ITEM_NO' => $request->input('PRODUCT_ID'),
                'QTY' => '-'.$request->input('REQ_QTY'),
                'TRAN_FLAG' => 'IC', // IC = Idonaize Chemical
                'UPDATE_BY' => Auth::user()->id,
                'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s")
            ]);
            $updateIdonaizeChemical = DB::table('tmm_itemstock')->where('tmm_itemstock.TRAN_NO','=',$id)
                ->where('tmm_itemstock.TRAN_TYPE', '=' , 'I')
                ->where('tmm_itemstock.TRAN_FLAG', '=' , 'II')
                ->update([
                'TRAN_DATE' => date('Y-m-d', strtotime(Input::get('TRAN_DATE'))),
                'TRAN_TYPE' => 'I', //I=Iodized
                'TRAN_NO' => $iodizeMstId,
                'ITEM_NO' => $request->input('PRODUCT_ID'),
                'QTY' => $request->input('WASH_CRASH_QTY'),
                'TRAN_FLAG' => 'II', // II = Idonize Increase
                'UPDATE_BY' => Auth::user()->id,
                'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s")
            ]);

        return $iodizeMstId;
    }

    public  static function deleteIodizeData($id){
        $deleteStock = DB::table('tmm_itemstock')->where('TRAN_NO',$id)->delete();
        if($deleteStock){
            $deleteChd = DB::table('tmm_iodizedchd')->where('IODIZEDMST_ID', $id)->delete();
            $deletePr = DB::table('tmm_iodizedmst')->where('IODIZEDMST_ID', $id)->delete();
            return $deletePr;
        }

    }
}
