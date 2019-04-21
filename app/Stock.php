<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class Stock extends Model
{
    public static function getTotalReduceSalt($saltId,$centerId){
        return DB::table('tmm_itemstock')
            ->select(('tmm_itemstock.QTY'))
            ->where('tmm_itemstock.ITEM_NO','=',$saltId)
            ->where('tmm_itemstock.TRAN_TYPE','=','S')
            ->where('tmm_itemstock.TRAN_FLAG','=','WS')
            ->where('tmm_itemstock.center_id','=',$centerId)
            ->sum('tmm_itemstock.QTY');

    }
    public static function getSaltStock($saltId,$centerId){
        return DB::table('tmm_itemstock')
            ->select(('tmm_itemstock.QTY'))
            ->where('tmm_itemstock.ITEM_NO','=',$saltId)
            ->where('tmm_itemstock.TRAN_TYPE','=','SP')
            ->where('tmm_itemstock.TRAN_FLAG','=','PR')
            ->where('tmm_itemstock.center_id','=',$centerId)
            ->sum('tmm_itemstock.QTY');
    }

    public static function getTotalReduceChemical($chemicalId,$centerId){
        return DB::table('tmm_itemstock')
            ->select('tmm_itemstock.QTY')
            ->where('tmm_itemstock.ITEM_NO','=',$chemicalId)
            ->where('TRAN_TYPE','=','C')
            ->where('TRAN_FLAG','=','IC')
            ->where('tmm_itemstock.center_id','=',$centerId)
            ->sum('tmm_itemstock.QTY');
    }

    public static function getChemicalStock($chemicalId,$centerId){
        return DB::table('tmm_itemstock')
            ->select('tmm_itemstock.QTY')
            ->where('tmm_itemstock.ITEM_NO','=',$chemicalId)
            ->where('TRAN_TYPE','=','CP')
            ->where('TRAN_FLAG','=','PR')
            ->where('tmm_itemstock.center_id','=',$centerId)
            ->sum('tmm_itemstock.QTY');
    }

    public static function getTotalWashingSalt($centerId){
        return DB::table('tmm_itemstock')
            ->select(('tmm_itemstock.QTY'))
            ->where('tmm_itemstock.TRAN_TYPE','=','W')
            ->where('tmm_itemstock.TRAN_FLAG','=','WI')
            ->where('tmm_itemstock.center_id','=',$centerId)
            ->sum('tmm_itemstock.QTY');
    }

    public static function getTotalReduceWashingSalt($centerId){
        return DB::table('tmm_itemstock')
            ->select(('tmm_itemstock.QTY'))
            ->where('tmm_itemstock.TRAN_TYPE','=','W')
            ->where('tmm_itemstock.TRAN_FLAG','=','WR')
            ->where('tmm_itemstock.center_id','=',$centerId)
            ->sum('tmm_itemstock.QTY');
    }









    // For sale

    public static function getTotalWashingSaltForSale($centerId){
        return DB::table('tmm_itemstock')
            ->select(('tmm_itemstock.QTY'))
            ->where('tmm_itemstock.TRAN_TYPE','=','W')
            ->where('tmm_itemstock.TRAN_FLAG','=','WI')
//            ->where('tmm_itemstock.ITEM_NO','=',$itemId)
            ->where('tmm_itemstock.center_id','=',$centerId)
            ->sum('tmm_itemstock.QTY');
    }


    public static function getTotalReduceWashingSaltAfterSale($centerId){
        return DB::table('tmm_itemstock')
            ->select(('tmm_itemstock.QTY'))
            ->where('tmm_itemstock.center_id','=',$centerId)
            ->where('tmm_itemstock.TRAN_TYPE','=','W')
            ->where('tmm_itemstock.TRAN_FLAG','=','WR')
            ->orWhere('tmm_itemstock.TRAN_FLAG','=','SD')
            ->sum('tmm_itemstock.QTY');
    }

    public static function getTotalIodizeSaltForSale($centerId){
        return DB::table('tmm_itemstock')
            ->select(('tmm_itemstock.QTY'))
            ->where('tmm_itemstock.TRAN_TYPE','=','I')
            ->where('tmm_itemstock.TRAN_FLAG','=','II')
            ->where('tmm_itemstock.center_id','=',$centerId)
            ->sum('tmm_itemstock.QTY');
    }

    public static function getTotalReduceIodizeSaltForSale($centerId){
        return DB::table('tmm_itemstock')
            ->select(('tmm_itemstock.QTY'))
            ->where('tmm_itemstock.center_id','=',$centerId)
            ->where('tmm_itemstock.TRAN_TYPE','=','I')
            ->orWhere('tmm_itemstock.TRAN_FLAG','=','SD')
           // ->where('tmm_itemstock.ITEM_NO','=',$itemId)
            ->sum('tmm_itemstock.QTY');
    }
}
