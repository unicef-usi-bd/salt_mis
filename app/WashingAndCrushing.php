<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class WashingAndCrushing extends Model
{
    public static function insertWashingAndCrushingData($request){
        $washingCrushingMstId = DB::table('tmm_washcrashmst')->insertGetId([
            'BATCH_DATE' => date('Y-m-d', strtotime(Input::get('BATCH_DATE'))),
            'BATCH_NO' => $request->input('BATCH_NO'),
            'PRODUCT_ID' => $request->input('PRODUCT_ID'),
            'REMARKS' => $request->input('REMARKS'),
            'ENTRY_BY' => Auth::user()->id,
            'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
        ]);
        if ($washingCrushingMstId){
            $washingCrushingChdId = DB::table('tmm_washcrashchd')->insertGetId([
                'WASHCRASHMST_ID' => $washingCrushingMstId,
                'ITEM_ID' => $request->input('ITEM_ID'),
                'REQ_QTY' => $request->input('REQ_QTY'),
                'WASTAGE' => $request->input('WASTAGE'),
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
}
