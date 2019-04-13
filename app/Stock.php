<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class Stock extends Model
{
    public static function getTotalReduceSalt($saltId){
        return DB::table('tmm_itemstock')
            ->select(('tmm_itemstock.QTY'))
            ->where('tmm_itemstock.ITEM_NO','=',$saltId)
            ->where('tmm_itemstock.TRAN_TYPE','=','S')
            ->where('tmm_itemstock.TRAN_FLAG','=','WS')
            ->sum('tmm_itemstock.QTY');

    }
    public static function getSaltStock($saltId){
        return DB::table('tmm_itemstock')
            ->select(('tmm_itemstock.QTY'))
            ->where('tmm_itemstock.ITEM_NO','=',$saltId)
            ->where('tmm_itemstock.TRAN_TYPE','=','SP')
            ->where('tmm_itemstock.TRAN_FLAG','=','PR')
            ->sum('tmm_itemstock.QTY');
    }

    public static function getTotalReduceChemical(){
        return DB::table('tmm_itemstock')
            ->select('tmm_itemstock.QTY')
            ->where('TRAN_TYPE','=','C')
            ->where('TRAN_FLAG','=','CR')
            ->sum('tmm_itemstock.QTY');
    }

    public static function getChemicalStock(){
        return DB::table('tmm_itemstock')
            ->select('tmm_itemstock.QTY')
            ->where('TRAN_TYPE','=','C')
            ->where('TRAN_FLAG','=','CP')
            ->sum('tmm_itemstock.QTY');
    }
}
