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
            ->where('ssm_certificate_info.RENEWING_DATE','>',$date)
            ->orderBy('ssm_certificate_info.RENEWING_DATE','asc')
            ->get();
    }

    public static function millerDetails($millId){
        return DB::table('ssm_mill_info as mi')
            ->select('mi.*','lcp.LOOKUPCHD_NAME as ProcessType','zo.ZONE_NAME','lco.LOOKUPCHD_NAME as ownerType','ci.RENEWING_DATE')
            ->leftJoin('ssc_lookupchd as lcp','mi.PROCESS_TYPE_ID','=','lcp.LOOKUPCHD_ID')
            ->leftJoin('ssm_zonesetup as zo','mi.ZONE_ID','=','zo.ZONE_ID')
            ->leftJoin('ssc_lookupchd as lco','mi.OWNER_TYPE_ID','=','lco.LOOKUPCHD_ID')
            ->leftJoin('ssm_certificate_info as ci','mi.MILL_ID','=','ci.MILL_ID')
            ->where('mi.MILL_ID','=',$millId)
            ->orderBy('ci.RENEWING_DATE','asc')
            ->limit(1)
            ->first();
    }
}
