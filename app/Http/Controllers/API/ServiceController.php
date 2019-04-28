<?php

namespace App\Http\Controllers\API;
use App\Item;
use App\MillerInfo;
use App\RequireChemicalMst;
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

        //$this->pr($millId);
        if($checkResult){
            $result = Hash::check($password, $checkResult->password);
            if ($result){
                $center_id = DB::table('users')
                    ->select('users.center_id')
                    ->where('username', '=', $user_name)
                    ->where('password', '=', $checkResult->password)
                    ->first();
                $child_id = $center_id->center_id;
                //$this->pr($center_id);
                $millInfo = DB::table('ssm_associationsetup')
                    ->select('ssm_associationsetup.MILL_ID')
                    ->where('ASSOCIATION_ID', '=', $center_id->center_id)
                    ->first();
                $millId = $millInfo->MILL_ID;

                $millerInfo = MillerInfo::millInformation($request, $millId); //$this->pr($millId);
                $crudeSaltTypes = Item::itemTypeWiseItemList($this->crudSaltId);
                $chemicleType = Item::itemTypeWiseItemList($this->chemicalId);
                $requireChemicalIodizedSalt = DB::table('smm_rmallocationchd')
                    ->select('smm_item.ITEM_NAME','smm_rmallocationchd.*')
                    ->leftJoin('smm_item','smm_rmallocationchd.ITEM_ID','=','smm_item.ITEM_NO')
                    ->where('smm_rmallocationchd.RMALLOMST_ID','=',24)
                    ->get();
                //$this->pr($requireChemicalIodizedSalt);
                return response()->json([

                    'message'=> 'Information are given below',
                    //'child_id'=>$child_id,
                    'crude_salt_types' => $crudeSaltTypes,
                    'chemical_types' => $chemicleType,
                    'mill_information' => $millerInfo,
                    'require_iodized_salt' => $requireChemicalIodizedSalt
                ]);
            }else{
                return response()->json([

                    'message'=> 'Please, check your password!'
                ]);
            }
        }else{
            return response()->json([

                'message'=> 'Please, check your user name!'
            ]);
        }





    }


} // class end


?>