<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\IodizedController;
use App\Stock;
use App\Iodized;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;

class ServiceIodizeController extends Controller
{
    public function getWashCrushStock(Request $request){
        $centerId = $request->input('centerId');
        $totalWashing = Stock::getTotalWashingSalt($centerId);
        //$this->pr($totalWashing);
        $reduceSalt = Stock::reduceSaltafterIodize($centerId);

        $totalReduce = $totalWashing - abs($reduceSalt);

        //$this->pr($totalReduce);

        if (!empty($totalWashing)){
            return response()->json([
                'totalWashing' => $totalReduce
            ]);
        }else{
            return response()->json([]);
        }
    }

    public function getIodizeBatchData(Request $request){
        $centerId = (int) $request->input('millerId');
        $batch = IodizedController::generateBatchNumberForIodize($centerId);
        return response()->json(['batch' => $batch]);
    }
    public function getIodizeData($centerId){
        return DB::table('tmm_iodizedmst')
            ->select('tmm_iodizedmst.*','smm_item.ITEM_NAME','tmm_iodizedchd.WASH_CRASH_QTY','tmm_iodizedchd.REQ_QTY','tmm_iodizedchd.WASTAGE')
            ->leftJoin('smm_item','tmm_iodizedmst.PRODUCT_ID', '=','smm_item.ITEM_NO')
            ->leftJoin('tmm_iodizedchd','tmm_iodizedmst.IODIZEDMST_ID', '=','tmm_iodizedchd.IODIZEDMST_ID')
            ->where('tmm_iodizedmst.center_id','=',$centerId)
            ->get();
    }
    public function getWashCrushStockNew(Request $request){
        $centerId = $request->input('centerId');
        $incresedWashingSalt = Stock::getTotalWashingSalt($centerId);
        $reducedWashinfSalt = Stock::getTotalReduceWashingSalt($centerId);
        $WashingTotalUseInIodize = $incresedWashingSalt - abs($reducedWashinfSalt);

        $afterSaleWashing = Stock::getTotalReduceWashingSaltAfterSale($centerId);

        if($afterSaleWashing){
            $totalWashing = $WashingTotalUseInIodize - abs($afterSaleWashing);
        }else{
            $totalWashing = $WashingTotalUseInIodize;
        }

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

    public function storeIodizeData(Request $request){
        $centerId = $request->input('centerId');
        $entryBy = $request->input('entryBy');

        //$this->pr($entryBy);
        $iodizeInsert = Iodized::insertIodizeData($request,$centerId,$entryBy);

        if (!empty($iodizeInsert)){
            return response()->json([
                'iodizeInsert' => 'Success'
            ]);
        }else{
            return response()->json([]);
        }
    }
}
