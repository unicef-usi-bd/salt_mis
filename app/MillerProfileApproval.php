<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class MillerProfileApproval extends Model
{
    public static function previousMillerInformation($id){
        return DB::table('ssm_mill_info')
            ->select('ssm_mill_info.*','ssm_zonesetup.*','ssc_divisions.*','ssc_districts.*','ssc_upazilas.*','reg.LOOKUPCHD_NAME as reg_type','owner.LOOKUPCHD_NAME as owner_type','process.LOOKUPCHD_NAME as process_name','mill.LOOKUPCHD_NAME as mill_name')
            ->leftJoin('ssm_zonesetup','ssm_mill_info.ZONE_ID','=','ssm_zonesetup.ZONE_CODE')
            ->leftJoin('ssc_divisions','ssm_mill_info.DIVISION_ID','=','ssc_divisions.DIVISION_ID')
            ->leftJoin('ssc_districts','ssm_mill_info.DISTRICT_ID','=','ssc_districts.DISTRICT_ID')
            ->leftJoin('ssc_upazilas','ssm_mill_info.UPAZILA_ID','=','ssc_upazilas.UPAZILA_ID')
            ->leftJoin('ssc_lookupchd as process','ssm_mill_info.PROCESS_TYPE_ID','=','process.LOOKUPCHD_ID')
            ->leftJoin('ssc_lookupchd as mill','ssm_mill_info.MILL_TYPE_ID','=','mill.UD_ID')
            ->leftJoin('ssc_lookupchd as owner','ssm_mill_info.OWNER_TYPE_ID','=','owner.LOOKUPCHD_ID')
            ->leftJoin('ssc_lookupchd as reg','ssm_mill_info.REG_TYPE_ID','=','reg.LOOKUPCHD_ID')
            ->where('ssm_mill_info.MILL_ID','=',$id)
            ->first();

    }

    public static function presentMillerInformation($id){
        return DB::table('tem_ssm_mill_info')
            ->select('tem_ssm_mill_info.*','ssm_zonesetup.*','ssc_divisions.*','ssc_districts.*','ssc_upazilas.*','reg.LOOKUPCHD_NAME as reg_type','owner.LOOKUPCHD_NAME as owner_type','process.LOOKUPCHD_NAME as process_name','mill.LOOKUPCHD_NAME as mill_name')
            ->leftJoin('ssm_zonesetup','tem_ssm_mill_info.ZONE_ID','=','ssm_zonesetup.ZONE_CODE')
            ->leftJoin('ssc_divisions','tem_ssm_mill_info.DIVISION_ID','=','ssc_divisions.DIVISION_ID')
            ->leftJoin('ssc_districts','tem_ssm_mill_info.DISTRICT_ID','=','ssc_districts.DISTRICT_ID')
            ->leftJoin('ssc_upazilas','tem_ssm_mill_info.UPAZILA_ID','=','ssc_upazilas.UPAZILA_ID')
            ->leftJoin('ssc_lookupchd as process','tem_ssm_mill_info.PROCESS_TYPE_ID','=','process.LOOKUPCHD_ID')
            ->leftJoin('ssc_lookupchd as mill','tem_ssm_mill_info.MILL_TYPE_ID','=','mill.UD_ID')
            ->leftJoin('ssc_lookupchd as owner','tem_ssm_mill_info.OWNER_TYPE_ID','=','owner.LOOKUPCHD_ID')
            ->leftJoin('ssc_lookupchd as reg','tem_ssm_mill_info.REG_TYPE_ID','=','reg.LOOKUPCHD_ID')
            ->where('tem_ssm_mill_info.MILL_ID','=',$id)
            ->first();

    }

    public static function previousEntrepreneurInformation($id){
        return DB::table('ssm_entrepreneur_info')
            ->select('ssm_entrepreneur_info.*','ssc_divisions.*','ssc_districts.*','ssc_upazilas.*')
            ->leftJoin('ssc_divisions','ssm_entrepreneur_info.DIVISION_ID','=','ssc_divisions.DIVISION_ID')
            ->leftJoin('ssc_districts','ssm_entrepreneur_info.DISTRICT_ID','=','ssc_districts.DISTRICT_ID')
            ->leftJoin('ssc_upazilas','ssm_entrepreneur_info.UPAZILA_ID','=','ssc_upazilas.UPAZILA_ID')
            ->where('ssm_entrepreneur_info.MILL_ID','=',$id)
            ->get();
    }

    public static function presentEntrepreneurInformation($id){
        return DB::table('tem_ssm_entrepreneur_info')
            ->select('tem_ssm_entrepreneur_info.*','ssc_divisions.*','ssc_districts.*','ssc_upazilas.*')
            ->leftJoin('ssc_divisions','tem_ssm_entrepreneur_info.DIVISION_ID','=','ssc_divisions.DIVISION_ID')
            ->leftJoin('ssc_districts','tem_ssm_entrepreneur_info.DISTRICT_ID','=','ssc_districts.DISTRICT_ID')
            ->leftJoin('ssc_upazilas','tem_ssm_entrepreneur_info.UPAZILA_ID','=','ssc_upazilas.UPAZILA_ID')
            ->where('tem_ssm_entrepreneur_info.MILL_ID','=',$id)
            ->get();
    }

    public static function previousCertificateInformation($id){
        return DB::table('ssm_certificate_info')
            ->select('ssm_certificate_info.*','ssc_districts.*','smm_certificate.*','issuer.LOOKUPCHD_NAME as issuer_name')
            ->leftJoin('ssc_districts','ssm_certificate_info.DISTRICT_ID','=','ssc_districts.DISTRICT_ID')
            ->leftJoin('smm_certificate','ssm_certificate_info.CERTIFICATE_TYPE_ID','=','smm_certificate.CERTIFICATE_ID')
            ->leftJoin('ssc_lookupchd as issuer','ssm_certificate_info.ISSURE_ID','=','issuer.LOOKUPCHD_ID')
            ->where('ssm_certificate_info.MILL_ID','=',$id)
            ->get();
    }

    public static function presentCertificateInformation($id){
        return DB::table('tem_ssm_certificate_info')
            ->select('tem_ssm_certificate_info.*','ssc_districts.*','smm_certificate.*','issuer.LOOKUPCHD_NAME as issuer_name')
            ->leftJoin('ssc_districts','tem_ssm_certificate_info.DISTRICT_ID','=','ssc_districts.DISTRICT_ID')
            ->leftJoin('smm_certificate','tem_ssm_certificate_info.CERTIFICATE_TYPE_ID','=','smm_certificate.CERTIFICATE_ID')
            ->leftJoin('ssc_lookupchd as issuer','tem_ssm_certificate_info.ISSURE_ID','=','issuer.LOOKUPCHD_ID')
            ->where('tem_ssm_certificate_info.MILL_ID','=',$id)
            ->get();
    }

    public static function previousQcInformation($id){
        return DB::table('tsm_qc_info')
            ->select('tsm_qc_info.*')
            ->where('tsm_qc_info.MILL_ID','=',$id)
            ->first();
    }

    public static function presentQcInformation($id){
        return DB::table('tem_tsm_qc_info')
            ->select('tem_tsm_qc_info.*')
            ->where('tem_tsm_qc_info.MILL_ID','=',$id)
            ->first();
    }

    public static function previousEmployeeInformation($id){
        return DB::table('ssm_millemp_info')
            ->select('ssm_millemp_info.*')
            ->where('ssm_millemp_info.MILL_ID','=',$id)
            ->first();
    }

    public static function presentEmployeeInformation($id){
        return DB::table('tem_ssm_millemp_info')
            ->select('tem_ssm_millemp_info.*')
            ->where('tem_ssm_millemp_info.MILL_ID','=',$id)
            ->first();
    }
}
