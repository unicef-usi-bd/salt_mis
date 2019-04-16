<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class SalesDistribution extends Model
{
    public static function getTradingName(){
        return DB::table('ssm_customer_info')
            ->select('ssm_customer_info.*')
            ->get();
    }
}
