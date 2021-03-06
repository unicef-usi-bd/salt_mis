<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


class MillerInfo extends Model
{

     public static function insertMillerInfo($request, $mill_logo){ // tested

         $millInfoId = DB::table('ssm_mill_info')->insertGetId([
             'REG_TYPE_ID' => $request->input('REG_TYPE_ID'),
             'OWNER_TYPE_ID' => $request->input('OWNER_TYPE_ID'),
             'MILL_NAME' => $request->input('MILL_NAME'),
             'mill_logo' => $mill_logo,
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
             'approval_status' => 0,
             'ENTRY_BY' => Auth::user()->id,
             'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
         ]);

         if($millInfoId){
             DB::table('ssm_associationsetup')->insertGetId([
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

     public static function millerInformation($id){ // tested
         $data =  DB::table('ssm_mill_info')
             ->where('MILL_ID','=', $id)
             ->first();
         return $data;
     }

    public static function updateMillerInfoTemp($request, $millerId, $mill_logo){ // tested
        $data = array(
            'MILL_ID' => $millerId,
            'REG_TYPE_ID' => $request->input('REG_TYPE_ID'),
            'OWNER_TYPE_ID' => $request->input('OWNER_TYPE_ID'),
            'MILL_NAME' => $request->input('MILL_NAME'),
            'mill_logo' => $mill_logo,
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
            'approval_status' => 0,
            'ENTRY_BY' => Auth::user()->id,
            'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
        );

        $millInfo = DB::table('tem_ssm_mill_info')->where('MILL_ID', '=', $millerId)->first();
        if($millInfo){
            $pKey = $millInfo->MILL_ID_TEM;
            $updated = DB::table('tem_ssm_mill_info')->where('MILL_ID_TEM', '=' , $pKey)->update($data);
        } else{
            $updated = DB::table('tem_ssm_mill_info')->insert($data);
        }

        if($updated){
            $status = array(
                'approval_status' => 1
            );
            DB::table('ssm_mill_info')->where('MILL_ID', '=' , $millerId)->update($status);
        }
        return true;
    }

    public static function getMillData($millerInfoId){
        return DB::table('ssm_mill_info')
            ->select('ssm_mill_info.*','ssc_districts.DISTRICT_ID','ssc_districts.DISTRICT_NAME','ssc_upazilas.UPAZILA_ID','ssc_upazilas.UPAZILA_NAME','ssc_lookupchd.*')
            ->leftJoin('ssc_districts','ssm_mill_info.DISTRICT_ID','=','ssc_districts.DISTRICT_ID')
            ->leftJoin('ssc_upazilas','ssm_mill_info.UPAZILA_ID','=','ssc_upazilas.UPAZILA_ID')
            ->leftJoin('ssc_lookupchd','ssm_mill_info.OWNER_TYPE_ID','=','ssc_lookupchd.LOOKUPCHD_ID')
            ->where('MILL_ID','=',$millerInfoId)
            ->first();
    }

    public static function updateMillerInfo($request, $id, $mill_logo){ // tested
            $update = DB::table('ssm_mill_info')->where('MILL_ID', '=' , $id)->update([
                'MILL_NAME' => $request->input('MILL_NAME'),
                'mill_logo' => $mill_logo,
                'PROCESS_TYPE_ID' => $request->input('PROCESS_TYPE_ID'),
                'OWNER_TYPE_ID' => $request->input('OWNER_TYPE_ID'),
                'MILL_TYPE_ID' => $request->input('MILL_TYPE_ID'),
                'CAPACITY_ID' => $request->input('CAPACITY_ID'),
                'ZONE_ID' => $request->input('ZONE_ID'),
                //'MILLERS_ID' => $request->input('MILLERS_ID'),
                'DIVISION_ID' => $request->input('DIVISION_ID'),
                'DISTRICT_ID' => $request->input('DISTRICT_ID'),
                'UPAZILA_ID' => $request->input('UPAZILA_ID'),
                'UNION_ID' => $request->input('UNION_ID'),
                'ACTIVE_FLG' => $request->input('ACTIVE_FLG'),
                'approval_status' => 0,
                'REMARKS' => $request->input('REMARKS'),
                'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s"),
                'UPDATE_BY' => Auth::user()->id
            ]);

            $association = DB::table('ssm_associationsetup')->where('MILL_ID', '=', $id)->first();
            if($association){
                $data = array(
                    'ASSOCIATION_NAME' => $request->input('MILL_NAME')
                );
                DB::table('ssm_associationsetup')->where('ASSOCIATION_ID', '=', $association->ASSOCIATION_ID)->update($data);
            }
            return $update;
    }

    public static function approveByassociation($request,$id,$mill_logo){
//        if ($associationId){
        $update = DB::table('ssm_mill_info')->where('MILL_ID', '=' , $id)->update([
            'MILL_NAME' => $request->input('MILL_NAME'),
            'mill_logo' => $mill_logo,
            'PROCESS_TYPE_ID' => $request->input('PROCESS_TYPE_ID'),
            'OWNER_TYPE_ID' => $request->input('OWNER_TYPE_ID'),
            //'MILL_TYPE_ID' => $request->input('MILL_TYPE_ID'),
            'CAPACITY_ID' => $request->input('CAPACITY_ID'),
            //'ZONE_ID' => $request->input('ZONE_ID'),
            //'MILLERS_ID' => $request->input('MILLERS_ID'),

            'DIVISION_ID' => $request->input('DIVISION_ID'),
            'DISTRICT_ID' => $request->input('DISTRICT_ID'),
            'UPAZILA_ID' => $request->input('UPAZILA_ID'),
            'UNION_ID' => $request->input('UNION_ID'),
            'ACTIVE_FLG' => $request->input('ACTIVE_FLG'),
            'approval_status' => 'a',
            'REMARKS' => $request->input('REMARKS'),
            'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s"),
            'UPDATE_BY' => Auth::user()->id
        ]);

        return $update;
//        }
    }

    public static function getAllMillDataList(){

        $data = DB::table('ssm_mill_info as smi')
            ->select('ssm_entrepreneur_info.*', 'ssm_certificate_info.*', 'tsm_qc_info.*', 'ssm_millemp_info.*', 'ssc_lookupchd.*', 'smi.*')
            ->leftJoin('ssm_entrepreneur_info','smi.MILL_ID','=','ssm_entrepreneur_info.MILL_ID')
            ->leftJoin('ssm_certificate_info','smi.MILL_ID','=','ssm_certificate_info.MILL_ID')
            ->leftJoin('tsm_qc_info','smi.MILL_ID','=','tsm_qc_info.MILL_ID')
            ->leftJoin('ssm_millemp_info','smi.MILL_ID','=','ssm_millemp_info.MILL_ID')
            ->leftJoin('ssc_lookupchd','smi.OWNER_TYPE_ID','=','ssc_lookupchd.LOOKUPCHD_ID')
            ->where('smi.center_id','=', Auth::user()->center_id)
            ->where('smi.FINAL_SUBMIT_FLG','=', 1)
            ->groupBy('smi.MILL_ID')
            ->orderBy('smi.MILL_ID', 'DESC')
            ->get();



        foreach ($data as $mill){
            $mill->owners = DB::table('ssm_entrepreneur_info')->where('MILL_ID', '=', $mill->MILL_ID)->pluck('OWNER_NAME')->toArray();
        }
        return $data;


    }
    public static function millerUpdateStatus($millerId){
        $hasUpdate = DB::table('ssm_mill_info')
            ->select('approval_status')
            ->where('MILL_ID','=', $millerId)
            ->where('approval_status','=',1)
            ->first();
        return $hasUpdate;
    }

    public static function getApprovalAllMillDataList(){

        return DB::table('tem_ssm_mill_info')
            ->select('tem_ssm_mill_info.*','tem_ssm_mill_info.ACTIVE_FLG','tem_ssm_entrepreneur_info.*','tem_ssm_certificate_info.*','tem_tsm_qc_info.*','tem_ssm_millemp_info.*','ssc_lookupchd.*')
//            ->select('ssm_mill_info.*','ssm_entrepreneur_info.*','ssm_certificate_info.*','tsm_qc_info.*','ssm_millemp_info.*','ssc_lookupchd.*')
            ->leftJoin('tem_ssm_entrepreneur_info','tem_ssm_mill_info.MILL_ID','=','tem_ssm_entrepreneur_info.MILL_ID')
            ->leftJoin('tem_ssm_certificate_info','tem_ssm_mill_info.MILL_ID','=','tem_ssm_certificate_info.MILL_ID')
            ->leftJoin('tem_tsm_qc_info','tem_ssm_mill_info.MILL_ID','=','tem_tsm_qc_info.MILL_ID')
            ->leftJoin('tem_ssm_millemp_info','tem_ssm_mill_info.MILL_ID','=','tem_ssm_millemp_info.MILL_ID')
            ->leftJoin('ssc_lookupchd','tem_ssm_mill_info.OWNER_TYPE_ID','=','ssc_lookupchd.LOOKUPCHD_ID')
            ->groupBy('tem_ssm_mill_info.MILL_ID_TEM')
            ->orderBy('tem_ssm_mill_info.MILL_ID_TEM', 'DESC')
            ->get();

    }

    public static function selfMillerAuthenticated(){
        $centerId = Auth::user()->center_id;
         return DB::table('ssm_associationsetup')
             ->select('MILL_ID')
             ->where('ASSOCIATION_ID','=', $centerId)
             ->first();
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
        return  DB::table('ssm_mill_info')
            ->select('ssm_mill_info.*','reg.LOOKUPCHD_NAME as reg_type','owner.LOOKUPCHD_NAME as owner_type','process.LOOKUPCHD_NAME as process_name','mill.LOOKUPCHD_NAME as mill_name','capacity.LOOKUPCHD_NAME as capacity_type')
            ->leftJoin('ssc_lookupchd as process','ssm_mill_info.PROCESS_TYPE_ID','=','process.LOOKUPCHD_ID')
            ->leftJoin('ssc_lookupchd as mill','ssm_mill_info.MILL_TYPE_ID','=','mill.UD_ID')
            ->leftJoin('ssc_lookupchd as capacity','ssm_mill_info.CAPACITY_ID','=','capacity.LOOKUPCHD_ID')
            ->leftJoin('ssc_lookupchd as owner','ssm_mill_info.OWNER_TYPE_ID','=','owner.LOOKUPCHD_ID')
            ->leftJoin('ssc_lookupchd as reg','ssm_mill_info.REG_TYPE_ID','=','reg.LOOKUPCHD_ID')
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
        $centerId = null;
        $associationInfo = DB::table('ssm_associationsetup')->where('MILL_ID', $id);
        if($associationInfo->first()) $centerId = $associationInfo->pluck('ASSOCIATION_ID')->first();

//        Specific Miller Profile related table by Miller Id Start
//        Active Profile
        $millerInfo = DB::table('ssm_mill_info')->where('MILL_ID', $id);
        if($millerInfo->first()) $millerInfo->delete();

        $entrepreneurInfo = DB::table('ssm_entrepreneur_info')->where('MILL_ID', $id);
        if($entrepreneurInfo->get()) $entrepreneurInfo->delete();

        $certificateInfo = DB::table('ssm_certificate_info')->where('MILL_ID', $id);
        if($certificateInfo->get()) $certificateInfo->delete();

        $qcInfo = DB::table('tsm_qc_info')->where('MILL_ID', $id);
        if($qcInfo->first()) $qcInfo->delete();

        $empInfo = DB::table('ssm_millemp_info')->where('MILL_ID', $id);
        if($empInfo->first()) $empInfo->delete();

//        Temporary profile
        $millerInfo = DB::table('tem_ssm_mill_info')->where('MILL_ID', $id);
        if($millerInfo->first()) $millerInfo->delete();

        $entrepreneurInfo = DB::table('tem_ssm_entrepreneur_info')->where('MILL_ID', $id);
        if($entrepreneurInfo->get()) $entrepreneurInfo->delete();

        $certificateInfo = DB::table('tem_ssm_certificate_info')->where('MILL_ID', $id);
        if($certificateInfo->get()) $certificateInfo->delete();

        $qcInfo = DB::table('tem_tsm_qc_info')->where('MILL_ID', $id);
        if($qcInfo->first()) $qcInfo->delete();

        $empInfo = DB::table('tem_ssm_millemp_info')->where('MILL_ID', $id);
        if($empInfo->first()) $empInfo->delete();
//        Specific Miller Profile related table by Miller Id Start

//        Specific Miller Profile transaction related table  by miller Id Start
        if(!empty($centerId)) {
            $receivedChdInfo = DB::table('tmm_receivechd')->where('center_id', $centerId);
            if ($receivedChdInfo->get()) $receivedChdInfo->delete();

            $receivedMstInfo = DB::table('tmm_receivemst')->where('center_id', $centerId);
            if ($receivedMstInfo->get()) $receivedMstInfo->delete();

            $washCrashChdInfo = DB::table('tmm_washcrashchd')->where('center_id', $centerId);
            if ($washCrashChdInfo->get()) $washCrashChdInfo->delete();

            $washCrashMstInfo = DB::table('tmm_washcrashmst')->where('center_id', $centerId);
            if ($washCrashMstInfo->get()) $washCrashMstInfo->delete();

            $iodizedChdInfo = DB::table('tmm_iodizedchd')->where('center_id', $centerId);
            if ($iodizedChdInfo->get()) $iodizedChdInfo->delete();

            $iodizedMstInfo = DB::table('tmm_iodizedmst')->where('center_id', $centerId);
            if ($iodizedMstInfo->get()) $iodizedMstInfo->delete();

            $salesChdInfo = DB::table('tmm_saleschd')->where('center_id', $centerId);
            if ($salesChdInfo->get()) $salesChdInfo->delete();

            $salesMstInfo = DB::table('tmm_salesmst')->where('center_id', $centerId);
            if ($salesMstInfo->get()) $salesMstInfo->delete();

            $qualityInfo = DB::table('tmm_qualitycontrol')->where('center_id', $centerId);
            if ($qualityInfo->get()) $qualityInfo->delete();

            $stockAdjustInfo = DB::table('stock_adjustment')->where('center_id', $centerId);
            if ($stockAdjustInfo->get()) $stockAdjustInfo->delete();

            $itemStockInfo = DB::table('tmm_itemstock')->where('center_id', $centerId);
            if ($itemStockInfo->get()) $itemStockInfo->delete();

            if ($associationInfo->get()) $associationInfo->delete();
        }
        return true;
//        Specific Miller Profile transaction related table  by miller Id End
    }

    public  static function getMillerToMerge(){
    $centerId = Auth::user()->center_id;
    return DB::table('ssm_mill_info')
        ->select('ssm_mill_info.*')
        //->leftJoin('ssm_millemp_info','ssm_mill_info.MILL_ID','=','ssm_millemp_info.MILL_ID')
        ->orderBy('ssm_mill_info.MILL_ID', 'DESC')
        ->where('ssm_mill_info.REG_TYPE_ID','=', 10)
        ->where('ssm_mill_info.ACTIVE_FLG','=', 1)
        ->where('ssm_mill_info.center_id','=', $centerId)
        ->where('ssm_mill_info.FINAL_SUBMIT_FLG','=', 1)
        ->get();
}
//    public  static function getMillerToMerge(){
//        $centerId = Auth::user()->center_id;
//        return DB::table('ssm_mill_info')
//            ->select('ssm_mill_info.*','ssm_millemp_info.*')
//            ->leftJoin('ssm_millemp_info','ssm_mill_info.MILL_ID','=','ssm_millemp_info.MILL_ID')
//            ->orderBy('ssm_mill_info.MILL_ID', 'DESC')
//            ->where('ssm_mill_info.REG_TYPE_ID','=', 10)
//            ->where('ssm_mill_info.ACTIVE_FLG','=', 1)
//            ->where('ssm_mill_info.center_id','=', $centerId)
//            ->where('ssm_millemp_info.FINAL_SUBMIT_FLG','=', 1)
//            ->get();
//    }
    public static function deactivateMillTable($id){
        $update = DB::table('ssm_mill_info')->where('MILL_ID', '=' , $id)->update([
            'ACTIVE_FLG' => 0,
        ]);
        return $update;
    }
    // merge mill and deactivate mill accounts
//    public static function deactivateMillEmpTable($id){
//        $update = DB::table('ssm_millemp_info')->where('MILL_ID', '=' , $id)->update([
//            'FINAL_SUBMIT_FLG' => 0,
//        ]);
//        return $update;
//    }

    // for login web service

    public static function millInformation($request, $id){

         $getMillInfo =  DB::table('ssm_mill_info')
                         ->select('ssm_mill_info.MILL_ID','ssm_mill_info.UD_MILL_ID','ssm_mill_info.MILL_NAME','ssm_mill_info.PROCESS_TYPE_ID','ssm_mill_info.MILL_TYPE_ID','ssm_mill_info.CAPACITY_ID','ssm_mill_info.ZONE_ID','ssm_mill_info.MILLERS_ID','ssm_mill_info.DIVISION_ID','ssm_mill_info.DISTRICT_ID','ssm_mill_info.UPAZILA_ID','ssm_mill_info.UNION_ID','ssm_mill_info.ACTIVE_FLG','ssm_mill_info.DESCRIPTION','ssm_mill_info.REMARKS','ssm_mill_info.ENTRY_BY','ssm_mill_info.ENTRY_TIMESTAMP','ssm_mill_info.UPDATE_BY','ssm_mill_info.UPDATE_TIMESTAMP','ssm_mill_info.BRANCH_NO','ssm_mill_info.COMPANY_NO','ssm_mill_info.REG_TYPE_ID','ssm_mill_info.OWNER_TYPE_ID','ssm_mill_info.center_id as parent_id','ssm_associationsetup.ASSOCIATION_ID as child_id','ssm_entrepreneur_info.MOBILE_1','ssm_entrepreneur_info.MOBILE_2','ssm_entrepreneur_info.EMAIL')
                         ->leftJoin('ssm_entrepreneur_info','ssm_mill_info.MILL_ID','=','ssm_entrepreneur_info.MILL_ID')
                         ->leftJoin('ssm_associationsetup','ssm_mill_info.MILL_ID','=','ssm_associationsetup.MILL_ID')
                         ->where('ssm_mill_info.MILL_ID','=', $id)
                         ->first();
         return $getMillInfo;
    }
    ///-----------------------Counting Miller
    public static function totalMill(){

        $centerId = Auth::user()->center_id;
        $obj = DB::table('ssm_mill_info as smi');
        if($centerId) $obj->where('smi.center_id', '=', $centerId);
        $obj->where('smi.FINAL_SUBMIT_FLG', '=', 1);
        return $obj->count();
    }

    public static function totalActiveMill(){
        $centerId = Auth::user()->center_id;
        $obj = DB::table('ssm_mill_info as smi');
        if($centerId) $obj->where('smi.center_id', '=', $centerId);
        $obj->where('smi.FINAL_SUBMIT_FLG', '=', 1);
        $obj->where('smi.ACTIVE_FLG', '=', 1);
        return $obj->count();

    }

    public static function totalInactiveMill(){
        $centerId = Auth::user()->center_id;
        $obj = DB::table('ssm_mill_info as smi');
        if($centerId) $obj->where('smi.center_id', '=', $centerId);
        $obj->where('smi.FINAL_SUBMIT_FLG', '=', 1);
        $obj->where('smi.ACTIVE_FLG', '=', 0);
        return $obj->count();
    }
    ///-----------------------Counting Miller

    public static function millId(){
        $centerId = Auth::user()->center_id;
        return DB::table('ssm_associationsetup')
            ->select('ssm_associationsetup.MILL_ID')
            ->where('ssm_associationsetup.ASSOCIATION_ID','=',$centerId)
            ->first();

    }

    public static function millInfo(){
        return DB::table('ssm_mill_info')
            ->select('ssm_mill_info.*')
            ->get();
    }

    public static function millerInfoByCenterId($centerId=null){
        if(empty($centerId)) $centerId = Auth::user()->center_id;
        $data = DB::table('ssm_associationsetup')
                ->select('ssm_associationsetup.MILL_ID')
                ->where('ASSOCIATION_ID','=',$centerId)
                ->first();
        return $data;
    }

}
