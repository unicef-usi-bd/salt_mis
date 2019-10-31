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
        return DB::table('ssm_mill_info')
            ->select('ssm_mill_info.MILL_NAME','ssm_mill_info.MILL_ID')
            ->where('ssm_mill_info.MILL_ID','=',$millId)
            ->first();
    }
}
