<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class Iodized extends Model
{

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
                'ITEM_TYPE' => 'I',//I=Iodized
                'ENTRY_BY' => Auth::user()->id,
                'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
            ]);
        }
        if($iodizeChdId){
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
}
