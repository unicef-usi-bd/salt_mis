<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WashingAndCrushing extends Model
{
    public static function insertWashingAndCrushingData($request,$itemTypeId){
        $washingCrushingMstId = DB::table('tmm_washcrashmst')->insertGetId([
            'BATCH_DATE' => date('Y-m-d', strtotime(Input::get('BATCH_DATE'))),
            'BATCH_NO' => $request->input('BATCH_NO'),
            'PRODUCT_ID' => $itemTypeId,
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
                'TRAN_NO' => $washingCrushingChdId,
                'ITEM_NO' => $request->input('ITEM_ID'),
                'QTY' => '-'.$request->input('REQ_QTY'),
                'TRAN_FLAG' => 'SP', //SP = Salt Purchase
                'SUPP_ID_AUTO' => $request->input('SUPP_ID_AUTO')
            ]);


            if($reduceRawSaltStock){
                $itemStokId = DB::table('tmm_itemstock')->insertGetId([
                    'TRAN_NO' => $chemicalPurchaseChdId,
                    'ITEM_NO' => $request->input('ITEM_ID'),
                    'QTY' => $request->input('REQ_QTY'),
                    'TRAN_FLAG' => 'CP', //chemical receive
                    'SUPP_ID_AUTO' => $request->input('SUPP_ID_AUTO')
                ]);
            }



        }
        return $itemStokId;

    }
}
