<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class WashCrushService extends Controller
{
    public function getWashCrushBatchData(Request $request){
        $millerId = $request->input('millerId');

        $batch = 'WC' . '-' . $millerId . '-' . date("y") . '-' . date("m") . '-' . date("d") . '-' .  date("H") . '-' . date("i");

        if (!empty($millerId)){
            return response()->json([
                'batch' => $batch
            ]);
        }else{
            return response()->json([]);
        }
    }
}
