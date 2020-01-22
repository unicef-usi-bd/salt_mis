<?php

namespace App\Http\Controllers\API;

use App\Stock;
use App\WashingAndCrushing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
    public function getWashCrushBatchDataNew(Request $request){
        $millerId = $request->input('millerId');
        $millInfo = DB::table('ssm_associationsetup')
            ->select('ssm_associationsetup.ASSOCIATION_ID')
            ->where('MILL_ID', '=', $millerId)
            ->first();
        $centerId = $millInfo->ASSOCIATION_ID;

        $iodizeIndex = $this->getWashingAndCrushingData($centerId);
        $num = count($iodizeIndex);
        $batch = 'WC' . '-' . $millerId . '-' . date("y") . '-' . date("m") . '-' . date("d") . '-' .  date("H") . '-' . date("i"). '-' . sprintf("%'.04d", ++$num);

        if (!empty($millerId)){
            return response()->json([
                'batch' => $batch
            ]);
        }else{
            return response()->json([]);
        }
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

        if (!empty($washingAndCrashing)){
            return response()->json([
                'washingAndCrashing' => 'Success'
            ]);
        }else{
            return response()->json([]);
        }
    }
}
