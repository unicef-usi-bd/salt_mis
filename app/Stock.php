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

    ///-----------------------Production
    public static function totalWashCrashProductions(){
        $centerId = Auth::user()->center_id;
        $countProduction = DB::table('tmm_itemstock');
        $countProduction->select('tmm_itemstock.QTY');
        $countProduction->where('TRAN_TYPE','=','W');
        $countProduction->where('TRAN_FLAG','=','WI');
        if($centerId){
            $countProduction->where('center_id','=',$centerId);
        }

        return $countProduction->sum('tmm_itemstock.QTY');
    }

    public static function totalIodizeProductions(){
        $centerId = Auth::user()->center_id;
        $countProduction = DB::table('tmm_itemstock');
        $countProduction->select('tmm_itemstock.QTY');
        $countProduction->where('TRAN_TYPE','=','I');
        $countProduction->where('TRAN_FLAG','=','II');
        if($centerId){
            $countProduction->where('center_id','=',$centerId);
        }

        return $countProduction->sum('tmm_itemstock.QTY');
    }
    /// ----------------------Production

    ///-----------------------Dashboard wise production
    public static function totalProduction(){
        $centerId = Auth::user()->center_id;
        $totalProductions = DB::table('tmm_itemstock');
        $totalProductions->select('tmm_itemstock.*','smm_item.ITEM_NAME');
        $totalProductions->leftJoin('smm_item','smm_item.ITEM_NO','=','tmm_itemstock.ITEM_NO');
        //$totalProductions->leftJoin('ssc_lookupchd','ssc_lookupchd.LOOKUPCHD_ID','=','smm_item.ITEM_TYPE');
//        $totalProductions->where('tmm_itemstock.TRAN_TYPE','=','W');
//        $totalProductions->orwhere('tmm_itemstock.TRAN_TYPE','=','I');
        $totalProductions->orwhere('tmm_itemstock.TRAN_FLAG','=','WI');
        $totalProductions->orwhere('tmm_itemstock.TRAN_FLAG','=','II');
        if($centerId){
            $totalProductions->where('tmm_itemstock.center_id','=',$centerId);
        }
        return $totalProductions->get();
    }
    ///-----------------------Dashboard wise production

    /// ----------------------Total Stock
    public static function totalStocks(){
        $centerId = Auth::user()->center_id;
        $totalStock = DB::table('tmm_itemstock');
        $totalStock->select('tmm_itemstock.QTY');
        //$totalStock->where('tmm_itemstock.TRAN_TYPE','=','W');
        //$totalStock->orwhere('tmm_itemstock.TRAN_FLAG','=','WI');
        if($centerId){
            $totalStock->where('tmm_itemstock.center_id','=',$centerId);
        }
        return $totalStock->sum('tmm_itemstock.QTY');
    }
    /// ----------------------Total Stock

    /// ----------------------Production Graph
    public static function monthWiseProduction(){
        //$centerId = Auth::user()->center_id;
        return DB::select(DB::raw("SELECT MONTH(TRAN_DATE) month, ROUND(SUM( it.QTY)) subtotal
                                       FROM tmm_itemstock it
                                       WHERE it.center_id  and it.TRAN_FLAG = 'WI' or it.TRAN_FLAG = 'II'
                                       and YEAR(TRAN_DATE)
                                       GROUP BY month"));
        //$monthProduction = DB::table('tmm_itemstock')
    }
    /// ----------------------Production Graph

    ///------------------Procurement List
    public static function procurementList (){
        $centerId = Auth::user()->center_id;
        $procurementLists = DB::table('ssc_lookupchd');
        $procurementLists->select('ssc_lookupchd.*','smm_item.ITEM_NAME','tmm_itemstock.ENTRY_TIMESTAMP','tmm_itemstock.QTY');
        $procurementLists->leftJoin('smm_item','ssc_lookupchd.LOOKUPCHD_ID','=','smm_item.ITEM_TYPE');
        $procurementLists->leftJoin('tmm_itemstock','smm_item.ITEM_NO','=','tmm_itemstock.ITEM_NO');
        $procurementLists->where('tmm_itemstock.TRAN_FLAG','=','PR');
        if($centerId){
            $procurementLists->where('tmm_itemstock.center_id','=',$centerId);
        }

        return $procurementLists->get();
    }
    ///------------------Procurement List


    /// ----------------------Procurement Graph
    public static function monthWiseProcurement(){
        $centerId = Auth::user()->center_id;
        return DB::select(DB::raw("SELECT MONTH(TRAN_DATE) month, ROUND(SUM( it.QTY)) subtotal
                                       FROM tmm_itemstock it
                                       WHERE it.center_id = $centerId
                                       and it.TRAN_FLAG = 'PR'
                                       and YEAR(TRAN_DATE)
                                       GROUP BY month"));
        //$monthProduction = DB::table('tmm_itemstock')
    }
    /// ----------------------Procurement Graph

    /// ----------------------Production Graph
    public static function monthWiseMillProduction(){
        $centerId = Auth::user()->center_id;
        return DB::select(DB::raw("SELECT MONTH(TRAN_DATE) month, ROUND(SUM( it.QTY)) subtotal
                                       FROM tmm_itemstock it
                                       WHERE it.center_id = $centerId
                                       and it.TRAN_FLAG = 'WI' or it.TRAN_FLAG = 'II'
                                       and YEAR(TRAN_DATE)
                                       GROUP BY month"));
        //$monthProduction = DB::table('tmm_itemstock')
    }
    /// ----------------------Production Graph

}

