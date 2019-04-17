<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


class Report extends Model
{
    public static function  itemList(){
        return DB::table('smm_item')
            ->select('*')
            ->where('ACTIVE_FLG','=',1)
            ->get();
    }




}
