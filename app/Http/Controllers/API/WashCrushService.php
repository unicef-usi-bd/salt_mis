<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\WashingAndCrushingController;
use App\Stock;
use App\WashingAndCrushing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;

class WashCrushService extends Controller
{

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
    public function getWashCrushBatchData(Request $request){
        $centerId = (int) $request->input('millerId');
        $batch = WashingAndCrushingController::generateBatchNumberForWashAndCrush($centerId);
        return response()->json(['batch' => $batch]);

    }
    public static function getWashingAndCrushingData($centerId){
        return DB::table('tmm_washcrashmst')
            ->select('tmm_washcrashmst.*','smm_item.ITEM_NAME','tmm_washcrashchd.REQ_QTY','tmm_washcrashchd.WASTAGE')
            ->leftJoin('smm_item','tmm_washcrashmst.PRODUCT_ID','=','smm_item.ITEM_NO')
            ->leftJoin('tmm_washcrashchd','tmm_washcrashmst.WASHCRASHMST_ID','=','tmm_washcrashchd.WASHCRASHMST_ID')
            ->where('tmm_washcrashmst.center_id','=',$centerId)
            ->get();
    }

    public function storeWashCrashData(Request $request){
        $centerId = $request->input('centerId');
        //$centerId = Auth::user()->center_id;
        $entryBy = $request->input('entryBy');

//        $this->pr($centerId);
        $washingAndCrashing = WashingAndCrushing::insertWashingAndCrushingData($request,$entryBy,$centerId);

        return response()->json($request->input());

        if (!empty($washingAndCrashing)){
            return response()->json([
                'washingAndCrashing' => 'Success'
            ]);
        }else{
            return response()->json([]);
        }
    }
}
