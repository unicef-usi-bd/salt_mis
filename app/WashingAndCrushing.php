<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class WashingAndCrushing extends Model
{

    public static function getCenterWiseMiller(){
        return DB::table('tmm_washcrashmst')
            ->select('tmm_washcrashmst.*')
            ->leftJoin('smm_item','tmm_washcrashmst.PRODUCT_ID','=','smm_item.ITEM_NO')
            ->leftJoin('tmm_washcrashchd','tmm_washcrashmst.WASHCRASHMST_ID','=','tmm_washcrashchd.WASHCRASHMST_ID')
            ->where()
            ->get();
    }

    public static function getWashingAndCrushingData(){
        return DB::table('tmm_washcrashmst')
            ->select('tmm_washcrashmst.*','smm_item.ITEM_NAME','tmm_washcrashchd.REQ_QTY','tmm_washcrashchd.WASTAGE')
            ->leftJoin('smm_item','tmm_washcrashmst.PRODUCT_ID','=','smm_item.ITEM_NO')
            ->leftJoin('tmm_washcrashchd','tmm_washcrashmst.WASHCRASHMST_ID','=','tmm_washcrashchd.WASHCRASHMST_ID')
            ->where('tmm_washcrashmst.center_id','=',Auth::user()->center_id)
            ->get();
    }

    public static function insertWashingAndCrushingData($request){
        $washingCrushingMstId = DB::table('tmm_washcrashmst')->insertGetId([
            'BATCH_DATE' => date('Y-m-d', strtotime(Input::get('BATCH_DATE'))),
            'BATCH_NO' => $request->input('BATCH_NO'),
            'PRODUCT_ID' => $request->input('PRODUCT_ID'),
            'REMARKS' => $request->input('REMARKS'),
            'center_id' => Auth::user()->center_id,
            'ENTRY_BY' => Auth::user()->id,
            'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
        ]);
        if ($washingCrushingMstId){
            $washingCrushingChdId = DB::table('tmm_washcrashchd')->insertGetId([
                'WASHCRASHMST_ID' => $washingCrushingMstId,
                'ITEM_ID' => $request->input('PRODUCT_ID'),
                'REQ_QTY' => $request->input('REQ_QTY'),
                'WASTAGE' => $request->input('WASTAGE'),
                'center_id' => Auth::user()->center_id,
                'ENTRY_BY' => Auth::user()->id,
                'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
            ]);
        }
        if($washingCrushingChdId){

            $reduceRawSaltStock = DB::table('tmm_itemstock')->insertGetId([
                'TRAN_DATE' => date('Y-m-d', strtotime(Input::get('BATCH_DATE'))),
                'TRAN_TYPE' => 'S', //S  = Salt
                'TRAN_NO' => $washingCrushingMstId,
                'ITEM_NO' => $request->input('PRODUCT_ID'),
                'QTY' => '-'.$request->input('REQ_QTY'),
                'TRAN_FLAG' => 'WS', //WS = Wash Salt
                'center_id' => Auth::user()->center_id,
                //'SUPP_ID_AUTO' => $request->input('SUPP_ID_AUTO'),
                'ENTRY_BY' => Auth::user()->id,
                'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
            ]);


            if($reduceRawSaltStock){
                $itemStokId = DB::table('tmm_itemstock')->insertGetId([
                    'TRAN_DATE' => date('Y-m-d', strtotime(Input::get('BATCH_DATE'))),
                    'TRAN_TYPE' => 'W', //W  = Washing
                    'TRAN_NO' => $washingCrushingMstId,
                    'ITEM_NO' => $request->input('PRODUCT_ID'),
                    'QTY' => $request->input('REQ_QTY'),
                    'TRAN_FLAG' => 'WI', //WR = Wash Increase
                    //'SUPP_ID_AUTO' => $request->input('SUPP_ID_AUTO'),
                    'ENTRY_BY' => Auth::user()->id,
                    'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
                ]);
            }
        }
        return $itemStokId;

    }

    public static function viewWashingAndCrushingData($id){
        return DB::table('tmm_washcrashmst')
            ->select('tmm_washcrashmst.*','smm_item.ITEM_NAME','tmm_washcrashchd.REQ_QTY','tmm_washcrashchd.WASTAGE')
            ->leftJoin('smm_item','tmm_washcrashmst.PRODUCT_ID','=','smm_item.ITEM_NO')
            ->leftJoin('tmm_washcrashchd','tmm_washcrashmst.WASHCRASHMST_ID','=','tmm_washcrashchd.WASHCRASHMST_ID')
            ->where('tmm_washcrashmst.WASHCRASHMST_ID','=',$id)
            ->first();
    }

    public static function editWashingAndCrushingData($id){
        return DB::table('tmm_washcrashmst')
            ->select('tmm_washcrashmst.*','smm_item.ITEM_NO','smm_item.ITEM_NAME','tmm_washcrashchd.ITEM_ID','tmm_washcrashchd.REQ_QTY','tmm_washcrashchd.WASTAGE')
            ->leftJoin('smm_item','tmm_washcrashmst.PRODUCT_ID','=','smm_item.ITEM_NO')
            ->leftJoin('tmm_washcrashchd','tmm_washcrashmst.WASHCRASHMST_ID','=','tmm_washcrashchd.WASHCRASHMST_ID')
            ->where('tmm_washcrashmst.WASHCRASHMST_ID','=',$id)
            ->first();
    }

    public static function updateWashingAndCrushingData($request,$id){
             $washCrushMst = DB::table('tmm_washcrashmst')->where('tmm_washcrashmst.WASHCRASHMST_ID', '=' , $id)->update([
                 'BATCH_DATE' => date('Y-m-d', strtotime(Input::get('BATCH_DATE'))),
                 'BATCH_NO' => $request->input('BATCH_NO'),
                 'PRODUCT_ID' => $request->input('PRODUCT_ID'),
                 'REMARKS' => $request->input('REMARKS'),
                 'center_id' => Auth::user()->center_id,
                 'ENTRY_BY' => Auth::user()->id,
                 'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
             ]);
            $washingCrushingChd = DB::table('tmm_washcrashchd')->where('tmm_washcrashchd.WASHCRASHMST_ID', '=' , $id)->update([
                'ITEM_ID' => $request->input('ITEM_ID'),
                'REQ_QTY' => $request->input('REQ_QTY'),
                'WASTAGE' => $request->input('WASTAGE'),
                'center_id' => Auth::user()->center_id,
                'UPDATE_BY' => Auth::user()->id,
                'UPDATE_TIMESTAMP' => date("Y-m-d h:i")
            ]);

            $washSaltReduceUpdate = DB::table('tmm_itemstock')->where('tmm_itemstock.TRAN_NO', '=' , $id)
                ->where('tmm_itemstock.TRAN_TYPE', '=' , 'S')
                ->where('tmm_itemstock.TRAN_FLAG', '=' , 'WS')
                ->update([
                'TRAN_DATE' => date('Y-m-d', strtotime(Input::get('BATCH_DATE'))),
                'TRAN_TYPE' => 'S', //S  = Salt
                'ITEM_NO' => $request->input('PRODUCT_ID'),
                'QTY' => '-'.$request->input('REQ_QTY'),
                'TRAN_FLAG' => 'WS', //WS = Wash Salt
                'center_id' => Auth::user()->center_id,
                'UPDATE_BY' => Auth::user()->id,
                'UPDATE_TIMESTAMP' => date("Y-m-d h:i")
            ]);
            $fianUpdate = DB::table('tmm_itemstock')->where('tmm_itemstock.TRAN_NO', '=' , $id)
                ->where('tmm_itemstock.TRAN_TYPE', '=' , 'W')
                ->where('tmm_itemstock.TRAN_FLAG', '=' , 'WI')
                ->update([
                    'TRAN_DATE' => date('Y-m-d', strtotime(Input::get('BATCH_DATE'))),
                    'TRAN_TYPE' => 'W', //S  = Salt
                    'ITEM_NO' => $request->input('PRODUCT_ID'),
                    'QTY' => $request->input('REQ_QTY'),
                    'TRAN_FLAG' => 'WI', //WS = Wash Salt
                    'center_id' => Auth::user()->center_id,
                    'UPDATE_BY' => Auth::user()->id,
                    'UPDATE_TIMESTAMP' => date("Y-m-d h:i")
                ]);


        return $washCrushMst;
    }


    public static function deleteWashingAndCrushingData($id){
        $deleteStock = DB::table('tmm_itemstock')->where('TRAN_NO',$id)->delete();
        if($deleteStock){
            $deleteChd = DB::table('tmm_washcrashchd')->where('WASHCRASHMST_ID', $id)->delete();
        }
        if($deleteChd){
            $deletePr = DB::table('tmm_washcrashmst')->where('WASHCRASHMST_ID', $id)->delete();
            return $deletePr;
        }
    }
}
