<?php

namespace App\Http\Controllers\API;

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
}
