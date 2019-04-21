<?php

namespace App\Http\Controllers\API;

use App\Stock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ServiceIodizeController extends Controller
{
    public function getIodizeBatchData(Request $request){
        $iodonizeMillerId = $request->input('millerId');

        $batch = 'I' . '-' . $iodonizeMillerId . '-' . date("y") . '-' . date("m") . '-' . date("d") . '-' .  date("H") . '-' . date("i");

        if (!empty($iodonizeMillerId)){
            return response()->json([
                'batch' => $batch
            ]);
        }else{
            return response()->json([]);
        }
    }

    public function getWashCrushStock(Request $request){
        $centerId = $request->input('centerId');
        $totalWashing = Stock::getTotalWashingSalt($centerId);

        if (!empty($totalWashing)){
            return response()->json([
                'totalWashing' => $totalWashing
            ]);
        }else{
            return response()->json([]);
        }
    }

    public function getChemicalStock(Request $request){
        $chemicalId = $request->input('chemicalId');
        $centerId = $request->input('centerId');
        $chemicalStock = Stock::getChemicalStock($chemicalId,$centerId);
        $totalReduceChemical = Stock::getTotalReduceChemical($chemicalId,$centerId);

        $totalChemicalStock = $chemicalStock - abs($totalReduceChemical);

        if (!empty($chemicalStock)){
            return response()->json([
                'totalChemicalStock' => $totalChemicalStock
            ]);
        }else{
            return response()->json([]);
        }
    }
}
