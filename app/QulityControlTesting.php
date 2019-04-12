<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class QulityControlTesting extends Model
{
    public static function insertQualityControlTestingData($data){
       return DB::table('tmm_qualitycontrol')->insert($data);
    }

    public static function showQualityConteolTestingDatya($id){

    }

    public static function editQualityConteolTestingDatya($id){

    }
}
