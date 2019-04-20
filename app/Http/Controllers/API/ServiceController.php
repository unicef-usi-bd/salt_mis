<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;
use Session;

class ServiceController extends Controller{
    public function getMonitorData(Request $request){
//        $monitorData = DB::select(DB::raw("SELECT * FROM tsm_millmonitore"));
//        if (!empty($monitorData)){
//            return response()->json([
//                'status' => true,
//                'monitoring_data' => $monitorData
//            ]);
//        }else{
//            $monitorData = array();
//            return response()->json([
//                'monitoring_data' => $monitorData
//            ]);
//        }
        return "Ok";
    }




} // class end




?>