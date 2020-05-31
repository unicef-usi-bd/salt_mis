<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProfileCompletePercentage extends Model
{
    public static function profileCompleted($id)
    {
        $profile = array('millInfo'=> 20);
        $profile['entrepreneurs'] = self::entrepreneurs($id);
        $profile['certificates'] = self::certificates($id);
        $profile['qc'] = self::qc($id);
        $profile['employee'] = self::employee($id);
        $profile = (object) $profile;
        return $profile;
    }

    private static function entrepreneurs($id)
    {
        $created = DB::table('ssm_entrepreneur_info')->where('MILL_ID', $id)->first();
        if($created) return 20;
        return false;
    }

    private static function certificates($id)
    {
        $created = DB::table('ssm_certificate_info')->where('MILL_ID', $id)->first();
        if($created) return 20;
        return false;
    }

    private static function qc($id)
    {
        $created = DB::table('tsm_qc_info')->where('MILL_ID', $id)->first();
        if($created) return 20;
        return false;
    }


    private static function employee($id)
    {
        $created = DB::table('ssm_millemp_info')->where('MILL_ID', $id)->first();
        if($created) return 20;
        return false;
    }


}
