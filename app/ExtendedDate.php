<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExtendedDate extends Model
{
    public static function  millerName(){
        $date = date('Y-m-d');
        return DB::table('ssm_mill_info')
            ->select('ssm_mill_info.MILL_NAME','ssm_mill_info.MILL_ID','ssm_certificate_info.RENEWING_DATE')
            ->leftjoin('ssm_certificate_info','ssm_mill_info.MILL_ID','=','ssm_certificate_info.MILL_ID')
            ->where('ssm_certificate_info.RENEWING_DATE','<',$date)
            ->groupBy('ssm_certificate_info.MILL_ID')
            ->orderBy('ssm_certificate_info.RENEWING_DATE','asc')
            ->get();
    }

    public static function millerDetails($millId){
        return DB::table('ssm_mill_info as mi')
            ->select('mi.*','lcp.LOOKUPCHD_NAME as ProcessType','zo.ZONE_NAME','lco.LOOKUPCHD_NAME as ownerType','ci.RENEWING_DATE','lcm.LOOKUPCHD_NAME as millerType','dv.DIVISION_NAME','di.DISTRICT_NAME','up.UPAZILA_NAME','em.*')
            ->leftJoin('ssc_lookupchd as lcp','mi.PROCESS_TYPE_ID','=','lcp.LOOKUPCHD_ID')
            ->leftJoin('ssm_zonesetup as zo','mi.ZONE_ID','=','zo.ZONE_ID')
            ->leftJoin('ssc_lookupchd as lco','mi.OWNER_TYPE_ID','=','lco.LOOKUPCHD_ID')
            ->leftjoin('ssc_lookupchd as lcm','mi.MILL_TYPE_ID','=','lcm.UD_ID')
            ->leftJoin('ssm_certificate_info as ci','mi.MILL_ID','=','ci.MILL_ID')
            ->leftJoin('ssc_divisions as dv','mi.DIVISION_ID','=','dv.DIVISION_ID')
            ->leftJoin('ssc_districts as di','mi.DISTRICT_ID','=','di.DISTRICT_ID')
            ->leftJoin('ssc_upazilas as up','mi.UPAZILA_ID','=','up.UPAZILA_ID')
            ->leftJoin('ssm_millemp_info as em','mi.MILL_ID','=','em.MILL_ID')
            ->where('mi.MILL_ID','=',$millId)
            ->orderBy('ci.RENEWING_DATE','asc')
            ->limit(1)
            ->first();
    }

    public static function millerEnteprunerDetails($millId){
        return DB::table('ssm_entrepreneur_info as et')
            ->select('et.*','mi.MILL_ID')
            ->leftJoin('ssm_mill_info as mi','et.MILL_ID','=','mi.MILL_ID')
            ->where('et.MILL_ID','=',$millId)
            ->get();
    }

    public static function millerCertificateInfo($millId){
        $date = date('Y-m-d');
        return DB::table('ssm_certificate_info as ci')
            ->select('ci.*','mi.MILL_ID','cf.CERTIFICATE_NAME','lc.LOOKUPCHD_NAME as issureName')
            ->leftJoin('smm_certificate as cf','ci.CERTIFICATE_TYPE_ID','=','cf.CERTIFICATE_ID')
            ->leftJoin('ssc_lookupchd as lc','ci.ISSURE_ID','=','lc.LOOKUPCHD_ID')
            ->leftJoin('ssm_mill_info as mi','mi.MILL_ID','=','ci.MILL_ID')
            ->where('ci.MILL_ID','=',$millId)
            ->where('ci.RENEWING_DATE','<',$date)
            ->get();
    }
}
