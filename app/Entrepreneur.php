<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


class Entrepreneur extends Model
{

    public static function insertMillerProfile($request){
         $reqTime = count($_POST['OWNER_NAME']);
         for($i=0; $i<$reqTime; $i++){
             $data = ([
                 'ENTREPRENEUR_ID' => $request->input('ENTREPRENEUR_ID'),
                 'REG_TYPE_ID' => $request->input('REG_TYPE_ID'),
                 'MILL_ID' => $request->input('MILL_ID'),
                 'OWNER_TYPE_ID' => $request->input('OWNER_TYPE_ID'),
                 'OWNER_NAME' => $request->input('OWNER_NAME')[$i],
                 'DIVISION_ID' => $request->input('DIVISION_ID')[$i],
                 'DISTRICT_ID' => $request->input('DISTRICT_ID')[$i],
                 'UPAZILA_ID' => $request->input('UPAZILA_ID')[$i],
                 'UNION_ID' => $request->input('UNION_ID')[$i],
                 'NID' => $request->input('NID')[$i],
                 'MOBILE_1' => $request->input('MOBILE_1')[$i],
                 'MOBILE_2' => $request->input('MOBILE_2')[$i],
                 'EMAIL' => $request->input('EMAIL')[$i],
                 'REMARKS' => $request->input('REMARKS')[$i],
                 'ACTIVE_FLG' => 1,

                 'ENTRY_BY' => Auth::user()->id,
                 'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
             ]);
             $insert = DB::table('ssm_entrepreneur_info')->insert($data);

         }
         return $insert;
     }

    public static function getEntrepreneurData($millerInfoId){
        return DB::table('ssm_entrepreneur_info')
            ->select('ssm_entrepreneur_info.*','ssc_districts.*','ssc_upazilas.*','ssc_unions.*')
            ->leftJoin('ssc_districts','ssm_entrepreneur_info.DISTRICT_ID','=','ssc_districts.DISTRICT_ID')
            ->leftJoin('ssc_upazilas','ssm_entrepreneur_info.UPAZILA_ID','=','ssc_upazilas.UPAZILA_ID')
            ->leftJoin('ssc_unions','ssm_entrepreneur_info.UNION_ID','=','ssc_unions.UNION_ID')
            ->where('MILL_ID','=',$millerInfoId)
            ->first();

    }

}