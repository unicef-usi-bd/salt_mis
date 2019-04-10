<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class Stock extends Model
{
    public static function getTotalReduceSalt(){
        return DB::table('tmm_itemstock')
            ->select(('tmm_itemstock.QTY'))
            ->where('TRAN_TYPE','=','S')
            ->where('TRAN_FLAG','=','WS')
            ->sum('tmm_itemstock.QTY');

    }
    public static function getSaltStock(){
        return DB::table('tmm_itemstock')
            ->select(('tmm_itemstock.QTY'))
            ->where('TRAN_TYPE','=','S')
            ->where('TRAN_FLAG','=','SP')
            ->sum('tmm_itemstock.QTY');
    }
}
