<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


class MillerInfo extends Model
{

     public static function insertMillerInfoData($request){
         $millInfoId = DB::table('ssm_mill_info')->insertGetId([
             'REG_TYPE_ID' => $request->input('REG_TYPE_ID'),
             'OWNER_TYPE_ID' => $request->input('OWNER_TYPE_ID'),

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
             'center_id' => Auth::user()->center_id,
             'REMARKS' => $request->input('REMARKS'),
             'ENTRY_BY' => Auth::user()->id,
             'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
         ]);
        //return $millInfoId;
     //}
    //public static function insertIntoAssociation($request){
         if($millInfoId){
         $association =  DB::table('ssm_associationsetup')->insertGetId([
             'MILL_ID' => $millInfoId,
             'ASSOCIATION_NAME'=> $request->input('MILL_NAME'),
             'PARENT_ID' => Auth::user()->center_id,
             'ACTIVE_FLG' => $request->input('ACTIVE_FLG'),
             'center_id' => Auth::user()->center_id,
             'ENTRY_BY' => Auth::user()->id,
             'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
         ]);

         }
         return $millInfoId;
     }
    public static function getMillData($millerInfoId){
        return DB::table('ssm_mill_info')
            ->select('ssm_mill_info.*','ssc_districts.*','ssc_upazilas.*','ssc_unions.*')
            ->leftJoin('ssc_districts','ssm_mill_info.DISTRICT_ID','=','ssc_districts.DISTRICT_ID')
            ->leftJoin('ssc_upazilas','ssm_mill_info.UPAZILA_ID','=','ssc_upazilas.UPAZILA_ID')
            ->leftJoin('ssc_unions','ssm_mill_info.UNION_ID','=','ssc_unions.UNION_ID')
            ->where('MILL_ID','=',$millerInfoId)
            ->first();

    }

    public static function updateMillData($request,$id){
        $update = DB::table('ssm_mill_info')->where('MILL_ID', '=' , $id)->update([
            'MILL_NAME' => $request->input('MILL_NAME'),
            'PROCESS_TYPE_ID' => $request->input('PROCESS_TYPE_ID'),
            //'MILL_TYPE_ID' => $request->input('MILL_TYPE_ID'),
            'CAPACITY_ID' => $request->input('CAPACITY_ID'),
            //'ZONE_ID' => $request->input('ZONE_ID'),
            //'MILLERS_ID' => $request->input('MILLERS_ID'),
            'DIVISION_ID' => $request->input('DIVISION_ID'),
            'DISTRICT_ID' => $request->input('DISTRICT_ID'),
            'UPAZILA_ID' => $request->input('UPAZILA_ID'),
            'UNION_ID' => $request->input('UNION_ID'),
            'ACTIVE_FLG' => $request->input('ACTIVE_FLG'),
            'REMARKS' => $request->input('REMARKS'),
            'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s"),
            'UPDATE_BY' => Auth::user()->id
        ]);

        return $update;
    }

    public static function getAllMillDataList(){
        return DB::table('ssm_mill_info')
            ->select('ssm_mill_info.*','ssm_entrepreneur_info.*','ssm_certificate_info.*','tsm_qc_info.*','ssm_millemp_info.*','ssc_lookupchd.*')
            ->leftJoin('ssm_entrepreneur_info','ssm_mill_info.MILL_ID','=','ssm_entrepreneur_info.MILL_ID')
            ->leftJoin('ssm_certificate_info','ssm_mill_info.MILL_ID','=','ssm_certificate_info.MILL_ID')
            ->leftJoin('tsm_qc_info','ssm_mill_info.MILL_ID','=','tsm_qc_info.MILL_ID')
            ->leftJoin('ssm_millemp_info','ssm_mill_info.MILL_ID','=','ssm_millemp_info.MILL_ID')
            ->leftJoin('ssc_lookupchd','ssm_entrepreneur_info.OWNER_TYPE_ID','=','ssc_lookupchd.LOOKUPCHD_ID')
            ->orderBy('ssm_mill_info.MILL_ID', 'DESC')
            ->where('ssm_mill_info.center_id','=',Auth::user()->center_id)
            ->where('ssm_millemp_info.FINAL_SUBMIT_FLG','=', 1)
            ->get();

    }

    //    for view modal
    public static function showMillereProfile($id){
        return DB::table('ssm_mill_info')
            ->select('ssm_mill_info.*','ssm_entrepreneur_info.*','ssm_certificate_info.*','tsm_qc_info.*','ssm_millemp_info.*','ssm_zonesetup.*','ssc_divisions.*','ssc_districts.*','ssc_upazilas.*','ssc_unions.*')
            ->leftJoin('ssm_entrepreneur_info','ssm_mill_info.MILL_ID','=','ssm_entrepreneur_info.MILL_ID')
            ->leftJoin('ssm_certificate_info','ssm_mill_info.MILL_ID','=','ssm_certificate_info.MILL_ID')
            ->leftJoin('tsm_qc_info','ssm_mill_info.MILL_ID','=','tsm_qc_info.MILL_ID')
            ->leftJoin('ssm_millemp_info','ssm_mill_info.MILL_ID','=','ssm_millemp_info.MILL_ID')
            ->leftJoin('ssm_zonesetup','ssm_mill_info.ZONE_ID','=','ssm_zonesetup.ZONE_CODE')
            ->leftJoin('ssc_divisions','ssm_mill_info.DIVISION_ID','=','ssc_divisions.DIVISION_ID')
            ->leftJoin('ssc_districts','ssm_mill_info.DISTRICT_ID','=','ssc_districts.DISTRICT_ID')
            ->leftJoin('ssc_upazilas','ssm_mill_info.UPAZILA_ID','=','ssc_upazilas.UPAZILA_ID')
            ->leftJoin('ssc_unions','ssm_mill_info.UNION_ID','=','ssc_unions.UNION_ID')
            ->where('ssm_mill_info.MILL_ID','=',$id)
            ->first();

    }
    public static function getAllMillLookUpData($id){
        return DB::table('ssm_mill_info')
            ->select('ssm_mill_info.*','process.LOOKUPCHD_NAME as process_name','mill.LOOKUPCHD_NAME as mill_name','capacity.LOOKUPCHD_NAME as capacity_type')
            ->leftJoin('ssc_lookupchd as process','ssm_mill_info.PROCESS_TYPE_ID','=','process.LOOKUPCHD_ID')
            ->leftJoin('ssc_lookupchd as mill','ssm_mill_info.MILL_TYPE_ID','=','mill.UD_ID')
            ->leftJoin('ssc_lookupchd as capacity','ssm_mill_info.CAPACITY_ID','=','capacity.LOOKUPCHD_ID')
            ->where('ssm_mill_info.MILL_ID','=',$id)
            ->first();

    }
    public static function getAllEntrepLookUpData($id){
        return DB::table('ssm_entrepreneur_info')
            ->select('ssm_entrepreneur_info.*','regi.LOOKUPCHD_NAME as registration_type','owner.LOOKUPCHD_NAME as owner_type')
            ->leftJoin('ssc_lookupchd as regi','ssm_entrepreneur_info.REG_TYPE_ID','=','regi.LOOKUPCHD_ID')
            ->leftJoin('ssc_lookupchd as owner','ssm_entrepreneur_info.OWNER_TYPE_ID','=','owner.LOOKUPCHD_ID')
            ->where('ssm_entrepreneur_info.MILL_ID','=',$id)
            ->first();

    }
    public static function getAllCertificateLookUpData($id){
        return DB::table('ssm_certificate_info')
            ->select('ssm_certificate_info.*','certificate.LOOKUPCHD_NAME as certificate_type','issue.LOOKUPCHD_NAME as issure_name')
            ->leftJoin('ssc_lookupchd as certificate','ssm_certificate_info.CERTIFICATE_TYPE_ID','=','certificate.LOOKUPCHD_ID')
            ->leftJoin('ssc_lookupchd as issue','ssm_certificate_info.ISSURE_ID','=','issue.LOOKUPCHD_ID')
            ->where('ssm_certificate_info.MILL_ID','=',$id)
            ->first();

    }
    public static  function allRemarks($id){
        return DB::table('ssm_mill_info')
            ->select('ssm_mill_info.*','ssm_entrepreneur_info.REMARKS as entrep_remarks','ssm_certificate_info.REMARKS as certificate_remarks','tsm_qc_info.REMARKS as qc_remarks','ssm_millemp_info.REMARKS as employee_remarks')
            ->leftJoin('ssm_entrepreneur_info','ssm_mill_info.MILL_ID','=','ssm_entrepreneur_info.MILL_ID')
            ->leftJoin('ssm_certificate_info','ssm_mill_info.MILL_ID','=','ssm_certificate_info.MILL_ID')
            ->leftJoin('tsm_qc_info','ssm_mill_info.MILL_ID','=','tsm_qc_info.MILL_ID')
            ->leftJoin('ssm_millemp_info','ssm_mill_info.MILL_ID','=','ssm_millemp_info.MILL_ID')
            ->where('ssm_mill_info.MILL_ID','=',$id)
            ->first();
    }
    //    for view modal
    public static function deleteMillerProfile($id){
         $empInfo = DB::table('ssm_millemp_info')->where('MILL_ID', $id)->delete();
         if($empInfo){
             $qcInfoId = DB::table('tsm_qc_info')->where('MILL_ID', $id)->delete();
         }
        if($qcInfoId){
            $certificateInfo = DB::table('ssm_certificate_info')->where('MILL_ID', $id)->delete();
        }
         if($certificateInfo){
             $enterId = DB::table('ssm_entrepreneur_info')->where('MILL_ID', $id)->delete();
         }
         if($enterId){
             $millInfoId = DB::table('ssm_mill_info')->where('MILL_ID', $id)->delete();
         }
         return $millInfoId;
    }

    public  static function getMillerToMerge(){
        return DB::table('ssm_mill_info')
            ->select('ssm_mill_info.*','ssm_millemp_info.*')
            ->leftJoin('ssm_millemp_info','ssm_mill_info.MILL_ID','=','ssm_millemp_info.MILL_ID')
            ->orderBy('ssm_mill_info.MILL_ID', 'DESC')
            ->where('ssm_mill_info.REG_TYPE_ID','=', 10)
            ->where('ssm_mill_info.ACTIVE_FLG','=', 1)
            ->where('ssm_millemp_info.FINAL_SUBMIT_FLG','=', 1)
            ->get();
    }
    public static function deactivateMillTable($request,$id){
        $update = DB::table('ssm_mill_info')->where('MILL_ID', '=' , $id)->update([
            'ACTIVE_FLG' => 0,
        ]);
        return $update;
    }
    public static function deactivateMillEmpTable($request,$id){
        $update = DB::table('ssm_millemp_info')->where('MILL_ID', '=' , $id)->update([
            'FINAL_SUBMIT_FLG' => 0,
        ]);
        return $update;
    }

    // for login web service
    public static function millInformation($request,$id){

         $getMillInfo =  DB::table('ssm_mill_info')
                         ->select('ssm_mill_info.*','ssm_entrepreneur_info.MOBILE_1','ssm_entrepreneur_info.MOBILE_2','ssm_entrepreneur_info.EMAIL')
                         ->leftJoin('ssm_entrepreneur_info','ssm_mill_info.MILL_ID','=','ssm_entrepreneur_info.MILL_ID')
                         ->where('ssm_mill_info.MILL_ID','=', $id)
                         ->first();
         return $getMillInfo;
    }
    ///-----------------------Counting Miller
    public  static function countMillersUnderAdmin(){
        return DB::table('ssm_mill_info')
            ->select('ssm_mill_info.MILL_ID')
            ->leftJoin('ssm_millemp_info','ssm_mill_info.MILL_ID','=','ssm_millemp_info.MILL_ID')
            ->get();
    }
    public  static function countActiveMillersUnderAdmin(){
        return DB::table('ssm_mill_info')
            ->select('ssm_mill_info.MILL_ID')
            ->leftJoin('ssm_millemp_info','ssm_mill_info.MILL_ID','=','ssm_millemp_info.MILL_ID')
            ->where('ssm_mill_info.ACTIVE_FLG','=', 1)
            ->where('ssm_millemp_info.FINAL_SUBMIT_FLG','=', 1)
            ->get();
    }
    public  static function countDeactiveMillersUnderAdmin(){
        return DB::table('ssm_mill_info')
            ->select('ssm_mill_info.MILL_ID')
            ->leftJoin('ssm_millemp_info','ssm_mill_info.MILL_ID','=','ssm_millemp_info.MILL_ID')
            ->where('ssm_mill_info.ACTIVE_FLG','=', 0)
            ->where('ssm_millemp_info.FINAL_SUBMIT_FLG','=', 0)
            ->get();
    }
    ///-----------------------Counting Miller


}
