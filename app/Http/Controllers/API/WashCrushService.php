<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class WashCrushService extends Controller
{
    public function getWashCrushBatchData(Request $request){
        $entryBy = $request->input('entryBy');

        $batchList = DB::table('tmm_washcrashmst')
            ->select('tmm_washcrashmst.*')
            ->where('tmm_washcrashmst.ENTRY_BY','=',$entryBy)
            ->get();

        if (!empty($batchList)){
            return response()->json([
                'status' => true,
                'batchList' => $batchList
            ]);
        }else{
            return response()->json([
                'status' => false,
                'batchList' => 'Batch List Not Found'
            ]);
        }
    }
}
