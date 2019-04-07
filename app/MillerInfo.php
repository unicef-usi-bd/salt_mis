<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


class MillerInfo extends Model
{

     public static function insertMillerInfoData($request){
         $millInfoId = DB::table('ssm_mill_info')->insertGetId([
             'MILL_NAME' => $request->input('MILL_NAME'),
             'PROCESS_TYPE_ID' => $request->input('PROCESS_TYPE_ID'),
             'MILL_TYPE_ID' => $request->input('MILL_TYPE_ID'),
             'CAPACITY_ID' => $request->input('CAPACITY_ID'),
             'ZONE_ID' => $request->input('ZONE_ID'),
             'MILLERS_ID' => $request->input('MILLERS_ID'),
             'DIVISION_ID' => $request->input('DIVISION_ID'),
             'DISTRICT_ID' => $request->input('DISTRICT_ID'),
             'UPAZILA_ID' => $request->input('UPAZILA_ID'),
             'UNION_ID' => $request->input('UNION_ID'),
             'ACTIVE_FLG' => $request->input('ACTIVE_FLG'),
             'REMARKS' => $request->input('REMARKS'),
             'ENTRY_BY' => Auth::user()->id,
             'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
         ]);

         return $millInfoId;
     }
    public static function getMillData($millerInfoId){
        return DB::table('ssm_mill_info')
            ->where('MILL_ID','=',$millerInfoId)
            ->first();

    }
//    public static function getAllData($millerInfoId){
//        return DB::table('ssm_mill_info')
//            ->select('ssm_mill_info.*','ssm_entrepreneur_info.MILL_ID','ssm_certificate_info.MILL_ID','tsm_qc_info.MILL_ID','ssm_millemp_info.MILL_ID')
//            ->leftJoin('ssm_entrepreneur_info','ssm_mill_info.MILL_ID','=','ssm_entrepreneur_info.MILL_ID')
//            ->leftJoin('ssm_certificate_info','ssm_mill_info.MILL_ID','=','ssm_certificate_info.MILL_ID')
//            ->leftJoin('tsm_qc_info','ssm_mill_info.MILL_ID','=','tsm_qc_info.MILL_ID')
//            ->leftJoin('ssm_millemp_info','ssm_mill_info.MILL_ID','=','ssm_millemp_info.MILL_ID')
//            ->where('MILL_ID','=',$millerInfoId)
//            ->first();
//
//    }



}
