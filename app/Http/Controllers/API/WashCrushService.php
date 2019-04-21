<?php

namespace App\Http\Controllers\API;

use App\Stock;
use App\WashingAndCrushing;
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

    public function getCrudeSaltStock(Request $request){

        $saltId = $request->input('saltId');
        $centerId = $request->input('centerId');
        $saltStock = Stock::getSaltStock($saltId,$centerId);
        $totalReduceSalt = Stock::getTotalReduceSalt($saltId,$centerId);
        $saltStock = $saltStock - abs($totalReduceSalt);

        if (!empty($saltStock)){
            return response()->json([
                'saltStock' => $saltStock
            ]);
        }else{
            return response()->json([]);
        }
    }

    public function storeWashCrashData(Request $request){
        $centerId = $request->input('centerId');
        $entryBy = $request->input('entryBy');

        //$this->pr($entryBy);
        $washingAndCrashing = WashingAndCrushing::insertWashingAndCrushingData($request,$entryBy,$centerId);

        if (!empty($washingAndCrashing)){
            return response()->json([
                'washingAndCrashing' => 'Success'
            ]);
        }else{
            return response()->json([]);
        }
    }
}
