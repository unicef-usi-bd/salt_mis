<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Validator;
use DB;
use Session;

class ServiceController extends Controller
{
    public function getMonitorData(Request $request)
    {
        $monitorData = DB::select(DB::raw("SELECT * FROM tsm_millmonitore"));
        if (!empty($monitorData)) {
            return response()->json([
                'status' => true,
                'monitoring_data' => $monitorData
            ]);
        } else {
            $monitorData = array();
            return response()->json([
                'monitoring_data' => $monitorData
            ]);
        }

    }

    public function userLogin(Request $request)
    {

        $user_name = $request->user_name;
        $password  = $request->password;

        $checkResult = DB::table('users')
            ->where('username', '=', $user_name)
            ->first();
        if($checkResult){
            $result = Hash::check($password, $checkResult->password);
            if ($result){
                echo "successful";
            }else{
                return response()->json([
                    'status' => false,
                    'message'=> 'Please, check your password!'
                ]);
            }
        }else{
            return response()->json([
                'status' => false,
                'message'=> 'Please, check your user name!'
            ]);
        }





    }


} // class end


?>