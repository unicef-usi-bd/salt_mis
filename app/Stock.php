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
//            ->orWhere('tmm_itemstock.TRAN_TYPE','=','I')
//            ->orWhere('tmm_itemstock.TRAN_FLAG','=','WR')
            ->where('tmm_itemstock.center_id','=',$centerId)
            ->sum('tmm_itemstock.QTY');

    }

    public static function reduceSaltafterIodize($centerId){
        return DB::table('tmm_itemstock')
            ->select(('tmm_itemstock.QTY'))
            ->where('tmm_itemstock.TRAN_TYPE','=','W')
            ->where('tmm_itemstock.TRAN_FLAG','=','WR')
//            ->orWhere('tmm_itemstock.TRAN_TYPE','=','I')
//            ->orWhere('tmm_itemstock.TRAN_FLAG','=','WR')
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
//            ->where('tmm_itemstock.TRAN_FLAG','=','WR')
            ->Where('tmm_itemstock.TRAN_FLAG','=','SD')
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
            ->Where('tmm_itemstock.TRAN_FLAG','=','SD')
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

    public static function totalWashCrashProductionsMonthWise(){
        $date = date("Y-m-d", strtotime("- 30 days"));
        $centerId = Auth::user()->center_id;
        $countProduction = DB::table('tmm_itemstock');
        $countProduction->select('tmm_itemstock.QTY');
        $countProduction->where('TRAN_TYPE','=','W');
        $countProduction->where('TRAN_FLAG','=','WI');
        $countProduction->where('tmm_itemstock.TRAN_DATE','>',$date);
        if($centerId){
            $countProduction->where('center_id','=',$centerId);
        }

        return $countProduction->sum('tmm_itemstock.QTY');
    }

    public static function totalIodizeProductionsMonthWise(){
        $date = date("Y-m-d", strtotime("- 30 days"));
        $centerId = Auth::user()->center_id;
        $countProduction = DB::table('tmm_itemstock');
        $countProduction->select('tmm_itemstock.QTY');
        $countProduction->where('TRAN_TYPE','=','I');
        $countProduction->where('TRAN_FLAG','=','II');
        $countProduction->where('tmm_itemstock.TRAN_DATE','>',$date);
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
        if($centerId){
            $totalProductions->where('tmm_itemstock.center_id','=',$centerId);
        }
        $totalProductions->orwhere('tmm_itemstock.TRAN_FLAG','=','WI');
        $totalProductions->orwhere('tmm_itemstock.TRAN_FLAG','=','II');
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
        $date = date("Y-m-d", strtotime("- 30 days"));
        //$centerId = Auth::user()->center_id;
        return DB::select(DB::raw("SELECT MONTH(TRAN_DATE) month, ROUND(SUM( it.QTY)) subtotal
                                       FROM tmm_itemstock it
                                       WHERE it.center_id  and it.TRAN_FLAG = 'WI' or it.TRAN_FLAG = 'II'
                                       and YEAR(TRAN_DATE)
                                       and TRAN_DATE > $date
                                       GROUP BY month"));
        //$monthProduction = DB::table('tmm_itemstock')
    }

    public static function millerYearWiseProduction(){
        $centerId = Auth::user()->center_id;
         $yearWiseProduction = DB::select(DB::raw(" select round(sum(it.QTY)) qty, MONTH(it.TRAN_DATE) month
                                                    from tmm_itemstock it
                                                    where it.TRAN_FLAG in('WI','II')
                                                    and it.center_id = $centerId
                                                    and YEAR(it.TRAN_DATE)"))[0];
        return $yearWiseProduction;
    }

    public static function associationYearWiseProduction(){
        //$centerId = Auth::user()->center_id;
        $yearWiseProduction = DB::select(DB::raw(" select MONTH(TRAN_DATE) month,ROUND(SUM( it.QTY)) as qty from tmm_itemstock it
                                         WHERE it.center_id   and it.TRAN_FLAG = 'WI' or it.TRAN_FLAG = 'II'and YEAR(TRAN_DATE)"))[0];
        return $yearWiseProduction;
    }

    public static function adminYearWiseProduction(){
        //$centerId = Auth::user()->center_id;
        $yearWiseProduction = DB::select(DB::raw(" select MONTH(TRAN_DATE) month,ROUND(SUM( it.QTY)) as qty from tmm_itemstock it
                                         WHERE it.center_id   and it.TRAN_FLAG = 'WI' or it.TRAN_FLAG = 'II'and YEAR(TRAN_DATE)"))[0];
        return $yearWiseProduction;
    }

    public static function monthWiseAsociationProduction(){
        $date = date("Y-m-d", strtotime("- 30 days"));
        $centerId = Auth::user()->center_id;
        return DB::select(DB::raw("SELECT MONTH(TRAN_DATE) month, ROUND(SUM( it.QTY)) subtotal
                                       FROM tmm_itemstock it
                                       LEFT JOIN ssm_associationsetup ass ON ass.ASSOCIATION_ID = it.center_id
                                       WHERE it.center_id  and it.TRAN_FLAG = 'WI' or it.TRAN_FLAG = 'II' and ass.center_id = $centerId
                                       and YEAR(TRAN_DATE)
                                       and TRAN_DATE >= $date
                                       GROUP BY month"));
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
        if($centerId){
            return DB::select(DB::raw("SELECT MONTH(TRAN_DATE) month, ROUND(SUM( it.QTY)) subtotal
                                       FROM tmm_itemstock it
                                       WHERE it.center_id = $centerId
                                       and it.TRAN_FLAG = 'PR'
                                       and YEAR(TRAN_DATE)
                                       GROUP BY month"));
        }else{
            return DB::select(DB::raw("SELECT MONTH(TRAN_DATE) month, ROUND(SUM( it.QTY)) subtotal
                                       FROM tmm_itemstock it
                                       WHERE it.TRAN_FLAG = 'PR'
                                       and YEAR(TRAN_DATE)
                                       GROUP BY month"));
        }

        //$monthProduction = DB::table('tmm_itemstock')
    }

    public static function monthWiseProcurementadmin(){

        return DB::select(DB::raw("SELECT MONTH(TRAN_DATE) month, ROUND(SUM( it.QTY)) subtotal
                                       FROM tmm_itemstock it
                                       WHERE  it.TRAN_FLAG = 'PR'
                                       and YEAR(TRAN_DATE)
                                       GROUP BY month"));
        //$monthProduction = DB::table('tmm_itemstock')
    }
    /// ----------------------Procurement Graph

    /// ----------------------Production Graph
    public static function monthWiseMillProduction(){
        $date = date("Y-m-d", strtotime("- 30 days"));
        $centerId = Auth::user()->center_id;
        return DB::select(DB::raw("SELECT MONTH(TRAN_DATE) month, ROUND(SUM( it.QTY)) subtotal
                                       FROM tmm_itemstock it
                                       WHERE it.center_id = $centerId
                                       and (it.TRAN_FLAG = 'WI' or it.TRAN_FLAG = 'II')
                                       and YEAR(TRAN_DATE)
                                       AND TRAN_DATE > $date
                                       GROUP BY month"));
        //$monthProduction = DB::table('tmm_itemstock')
    }
    /// ----------------------Production Graph

    /// ----------------------Production Graph
    public static function millerProduction(){
        $centerId = Auth::user()->center_id;
        return DB::select(DB::raw("SELECT it.*
                                       FROM tmm_itemstock it
                                       WHERE it.center_id = $centerId
                                       and (it.TRAN_FLAG = 'WI' or it.TRAN_FLAG = 'II')"));
        //$monthProduction = DB::table('tmm_itemstock')
    }
    /// ----------------------Production Graph
    ///
    /// ----------------------Total stock for association
    public static function associationTotal(){
        $centerId = Auth::user()->center_id;
        return DB::select(DB::raw("  SELECT m.mill_name,
                  ROUND(SUM(CASE WHEN s.tran_flag IN ('WI','II','SD') THEN
                     s.QTY
                  END)) stock_total,
                  
                  ROUND(SUM(CASE WHEN s.tran_flag = 'WI' THEN
                     s.QTY
                  END))washcrash_stock,
                  ROUND(SUM(CASE WHEN s.tran_flag = 'II' THEN
                     s.QTY
                  END))iodize_stock,
                  
                  ROUND(SUM(CASE WHEN s.tran_flag = 'SD' AND tran_type = 'W' THEN
                    s.QTY
                  END))washcrash_sales,
                  ROUND(SUM(CASE WHEN s.tran_flag = 'SD' AND tran_type = 'I' THEN
                    s.QTY
                  END))iodize_sale,
                  
                  ROUND(SUM(CASE WHEN s.tran_flag = 'SD' THEN
                    s.QTY
                  END))Sales_total
                  
                  
                  FROM tmm_itemstock s, ssm_associationsetup a, ssm_mill_info m
                  WHERE a.ASSOCIATION_ID = s.center_id
                  AND a.center_id = m.center_id
                  AND a.center_id  = $centerId
                  GROUP BY a.ASSOCIATION_ID,m.mill_name"));
    }
    /// ----------------------Total stock for association

    public static function totalAssociationWashcrash(){
//        $centerId = Auth::user()->center_id;
//        return DB::select(DB::raw("SELECT a.ASSOCIATION_ID,(SELECT mill_name FROM ssm_mill_info WHERE mill_id = a.mill_id) mill_name,
//                  ROUND(SUM(CASE WHEN s.tran_flag = 'WI' THEN
//                     s.QTY
//                  END))iodize_stock
//                   FROM tmm_itemstock s, ssm_associationsetup a
//                  WHERE a.ASSOCIATION_ID = s.center_id
//                  AND a.center_id  = $centerId
//                  GROUP BY a.ASSOCIATION_ID"));

        $centerId = Auth::user()->center_id;
        $countProduction = DB::table('tmm_itemstock');
        $countProduction->select('tmm_itemstock.QTY');
        $countProduction->leftJoin('ssm_associationsetup','ssm_associationsetup.ASSOCIATION_ID','=','tmm_itemstock.center_id');
//        $countProduction->where('TRAN_TYPE','=','W');
        $countProduction->where('tmm_itemstock.TRAN_FLAG','=','WI');
        if($centerId){
            $countProduction->where('ssm_associationsetup.center_id','=',$centerId);
        }

        return $countProduction->sum('tmm_itemstock.QTY');
    }

    public static function totalAssociationIodize(){
//        $centerId = Auth::user()->center_id;
//        return DB::select(DB::raw(" SELECT a.ASSOCIATION_ID,(SELECT mill_name FROM ssm_mill_info WHERE mill_id = a.mill_id) mill_name,
//                  ROUND(SUM(CASE WHEN s.tran_flag = 'II' THEN
//                     s.QTY
//                  END))iodize_stock
//                   FROM tmm_itemstock s, ssm_associationsetup a
//                  WHERE a.ASSOCIATION_ID = s.center_id
//                  AND a.center_id  = $centerId
//                  GROUP BY a.ASSOCIATION_ID"));
        $centerId = Auth::user()->center_id;
        $countProduction = DB::table('tmm_itemstock');
        $countProduction->select('tmm_itemstock.QTY');
        $countProduction->leftJoin('ssm_associationsetup','ssm_associationsetup.ASSOCIATION_ID','=','tmm_itemstock.center_id');
//        $countProduction->where('TRAN_TYPE','=','W');
        $countProduction->where('tmm_itemstock.TRAN_FLAG','=','II');
        if($centerId){
            $countProduction->where('ssm_associationsetup.center_id','=',$centerId);
        }

        return $countProduction->sum('tmm_itemstock.QTY');
    }

    public static function totalAssociationproduction(){
        $centerId = Auth::user()->center_id;
        return DB::select(DB::raw("SELECT a.ASSOCIATION_ID, (SELECT mill_name FROM ssm_mill_info WHERE mill_id = a.mill_id) mill_name,
      ROUND(SUM(CASE WHEN s.tran_flag IN ('WI','II') THEN
         s.QTY
      END)) stock_total
       FROM tmm_itemstock s, ssm_associationsetup a
      WHERE a.ASSOCIATION_ID = s.center_id
      AND a.center_id  = $centerId
      GROUP BY a.ASSOCIATION_ID"));
    }

    public static function totalAssociationWashCrashSale(){
//        $centerId = Auth::user()->center_id;
//        return DB::select(DB::raw(" SELECT a.ASSOCIATION_ID,(SELECT mill_name FROM ssm_mill_info WHERE mill_id = a.mill_id) mill_name,
//                   ROUND(SUM(CASE WHEN s.tran_flag = 'SD' AND tran_type = 'W' THEN
//                    s.QTY
//                  END))washcrash_sales
//                   FROM tmm_itemstock s, ssm_associationsetup a
//                  WHERE a.ASSOCIATION_ID = s.center_id
//                 -- AND a.center_id = m.center_id
//                  AND a.center_id  = $centerId
//                  GROUP BY a.ASSOCIATION_ID"));
        $centerId = Auth::user()->center_id;
        $countSales = DB::table('tmm_itemstock');
        $countSales->select('tmm_itemstock.QTY');
        $countSales->leftJoin('ssm_associationsetup','ssm_associationsetup.ASSOCIATION_ID','=','tmm_itemstock.center_id');
        $countSales->where('TRAN_TYPE','=','W');
        $countSales->where('TRAN_FLAG','=','SD');
        if($centerId){
            $countSales->where('ssm_associationsetup.center_id','=',$centerId);
        }

        return $countSales->sum('tmm_itemstock.QTY');
    }

    public static function totalAssociationIodizeSale(){
//        $centerId = Auth::user()->center_id;
//        return DB::select(DB::raw(" SELECT a.ASSOCIATION_ID,(SELECT mill_name FROM ssm_mill_info WHERE mill_id = a.mill_id) mill_name,
//                  ROUND(SUM(CASE WHEN s.tran_flag = 'SD' AND tran_type = 'I' THEN
//                    s.QTY
//                  END))iodize_sale
//                   FROM tmm_itemstock s, ssm_associationsetup a
//                  WHERE a.ASSOCIATION_ID = s.center_id
//                 -- AND a.center_id = m.center_id
//                  AND a.center_id  = $centerId
//                  GROUP BY a.ASSOCIATION_ID"));

        $centerId = Auth::user()->center_id;
        $countSales = DB::table('tmm_itemstock');
        $countSales->select('tmm_itemstock.QTY');
        $countSales->leftJoin('ssm_associationsetup','ssm_associationsetup.ASSOCIATION_ID','=','tmm_itemstock.center_id');
        $countSales->where('TRAN_TYPE','=','I');
        $countSales->where('TRAN_FLAG','=','SD');
        if($centerId){
            $countSales->where('ssm_associationsetup.center_id','=',$centerId);
        }

        return $countSales->sum('tmm_itemstock.QTY');
    }

    public static function totalAssociationIodizeSaleMonthWise(){
        $date = date("Y-m-d", strtotime("- 30 days"));
        $centerId = Auth::user()->center_id;
        $countSales = DB::table('tmm_itemstock');
        $countSales->select('tmm_itemstock.QTY');
        $countSales->leftJoin('ssm_associationsetup','ssm_associationsetup.ASSOCIATION_ID','=','tmm_itemstock.center_id');
        $countSales->where('TRAN_TYPE','=','I');
        $countSales->where('TRAN_FLAG','=','SD');
        $countSales->where('tmm_itemstock.TRAN_DATE','>',$date);
        if($centerId){
            $countSales->where('ssm_associationsetup.center_id','=',$centerId);
        }

        return $countSales->sum('tmm_itemstock.QTY');
    }

    public static function totalAssociationWashCrashSaleMonthWise(){
        $date = date("Y-m-d", strtotime("- 30 days"));
        $centerId = Auth::user()->center_id;
        $countSales = DB::table('tmm_itemstock');
        $countSales->select('tmm_itemstock.QTY');
        $countSales->leftJoin('ssm_associationsetup','ssm_associationsetup.ASSOCIATION_ID','=','tmm_itemstock.center_id');
        $countSales->where('TRAN_TYPE','=','W');
        $countSales->where('TRAN_FLAG','=','SD');
        $countSales->where('tmm_itemstock.TRAN_DATE','>',$date);
        if($centerId){
            $countSales->where('ssm_associationsetup.center_id','=',$centerId);
        }

        return $countSales->sum('tmm_itemstock.QTY');
    }

    public static function totalSale(){
        $centerId = Auth::user()->center_id;
        return DB::select(DB::raw(" SELECT a.ASSOCIATION_ID,(SELECT mill_name FROM ssm_mill_info WHERE mill_id = a.mill_id) mill_name,
                 ROUND(SUM(CASE WHEN s.tran_flag = 'SD' THEN
                    s.QTY
                  END))Sales_total
                  FROM tmm_itemstock s, ssm_associationsetup a
                  WHERE a.ASSOCIATION_ID = s.center_id
                  -- AND a.center_id = m.center_id
                  AND a.center_id  = $centerId
                  GROUP BY a.ASSOCIATION_ID"));
    }

    public static function totalProductionList(){
//        $centerId = Auth::user()->center_id;
//        return DB::select(DB::raw("SELECT MONTH(TRAN_DATE) month, ROUND(SUM( s.QTY)) stock_total,s.TRAN_TYPE,s.TRAN_DATE
//                   FROM tmm_itemstock s, ssm_associationsetup a, ssm_mill_info m
//                  WHERE a.ASSOCIATION_ID = s.center_id
//                  AND a.center_id = m.center_id
//                  AND a.center_id  = $centerId
//                  and (s.TRAN_FLAG = 'WI' or s.TRAN_FLAG = 'II')
//                  GROUP BY a.ASSOCIATION_ID,m.mill_name,month,TRAN_TYPE,s.TRAN_DATE"));
        $centerId = Auth::user()->center_id;
        $totalProductions = DB::table('tmm_itemstock');
        $totalProductions->select('tmm_itemstock.*','smm_item.ITEM_NAME');
        $totalProductions->leftJoin('smm_item','smm_item.ITEM_NO','=','tmm_itemstock.ITEM_NO');
        $totalProductions->leftJoin('ssm_associationsetup','ssm_associationsetup.ASSOCIATION_ID','=','tmm_itemstock.center_id');
        //$totalProductions->leftJoin('ssc_lookupchd','ssc_lookupchd.LOOKUPCHD_ID','=','smm_item.ITEM_TYPE');
//        $totalProductions->where('tmm_itemstock.TRAN_TYPE','=','W');
//        $totalProductions->orwhere('tmm_itemstock.TRAN_TYPE','=','I');
        if($centerId){
            $totalProductions->where('tmm_itemstock.center_id','=',$centerId);
        }
        $totalProductions->orwhere('tmm_itemstock.TRAN_FLAG','=','WI');
        $totalProductions->orwhere('tmm_itemstock.TRAN_FLAG','=','II');
        return $totalProductions->get();
    }

    public static function totalSaleList(){
        $centerId = Auth::user()->center_id;
        $totalProductionSale = DB::table('tmm_itemstock');
        $totalProductionSale->select('tmm_itemstock.*');
        $totalProductionSale->leftJoin('ssm_associationsetup','ssm_associationsetup.ASSOCIATION_ID','=','tmm_itemstock.center_id');
        $totalProductionSale->where('tmm_itemstock.TRAN_FLAG','=','SD');
        if($centerId){
            $totalProductionSale->where('ssm_associationsetup.center_id','=',$centerId);
        }
        return $totalProductionSale->get();
    }

    public static function monthWiseAssociationProduction(){
        $centerId = Auth::user()->center_id;
        return DB::select(DB::raw("SELECT MONTH(TRAN_DATE) month, ROUND(SUM( s.QTY)) subtotal
                   FROM tmm_itemstock s, ssm_associationsetup a, ssm_mill_info m
                  WHERE a.ASSOCIATION_ID = s.center_id
                  AND a.center_id = m.center_id
                  AND a.center_id  = $centerId
                  and (s.TRAN_FLAG = 'WI' or s.TRAN_FLAG = 'II')
                  and YEAR(TRAN_DATE)
                  GROUP BY a.ASSOCIATION_ID,month"));
    }

    //For Service
    public static function totalIodizeProductionsService($child_id){

        $countProduction = DB::table('tmm_itemstock');
        $countProduction->select('tmm_itemstock.QTY');
        $countProduction->where('TRAN_TYPE','=','I');
        $countProduction->where('TRAN_FLAG','=','II');
        $countProduction->where('center_id','=',$child_id);


        return $countProduction->sum('tmm_itemstock.QTY');
    }

    public static function totalWashCrashProductionsService($child_id){
        $countProduction = DB::table('tmm_itemstock');
        $countProduction->select('tmm_itemstock.QTY');
        $countProduction->where('TRAN_TYPE','=','W');
        $countProduction->where('TRAN_FLAG','=','WI');
        $countProduction->where('center_id','=',$child_id);


        return $countProduction->sum('tmm_itemstock.QTY');
    }

    //month wise association graph
    public static function totalAssociationWashcrashMonthWise(){
        $date = date("Y-m-d", strtotime("- 30 days"));
        $centerId = Auth::user()->center_id;
        $countProduction = DB::table('tmm_itemstock');
        $countProduction->select('tmm_itemstock.QTY');
        $countProduction->leftJoin('ssm_associationsetup','ssm_associationsetup.ASSOCIATION_ID','=','tmm_itemstock.center_id');
//        $countProduction->where('TRAN_TYPE','=','W');
        $countProduction->where('tmm_itemstock.TRAN_FLAG','=','WI');
        $countProduction->where('tmm_itemstock.TRAN_DATE','>',$date);
        if($centerId){
            $countProduction->where('ssm_associationsetup.center_id','=',$centerId);
        }

        return $countProduction->sum('tmm_itemstock.QTY');
    }

    public static function totalAssociationIodizeMonthwise(){
        $date = date("Y-m-d", strtotime("- 30 days"));
        $centerId = Auth::user()->center_id;
        $countProduction = DB::table('tmm_itemstock');
        $countProduction->select('tmm_itemstock.QTY');
        $countProduction->leftJoin('ssm_associationsetup','ssm_associationsetup.ASSOCIATION_ID','=','tmm_itemstock.center_id');
//        $countProduction->where('TRAN_TYPE','=','W');
        $countProduction->where('tmm_itemstock.TRAN_FLAG','=','II');
        $countProduction->where('tmm_itemstock.TRAN_DATE','>',$date);
        if($centerId){
            $countProduction->where('ssm_associationsetup.center_id','=',$centerId);
        }

        return $countProduction->sum('tmm_itemstock.QTY');
    }

    public  static function totalWashCrashForDashboard(){
        $date = date("Y-m-d", strtotime("- 30 days"));
        $centerId = Auth::user()->center_id;
        $totalWc = DB::table('tmm_itemstock');
        $totalWc->select('tmm_itemstock.QTY');
        $totalWc->where('tmm_itemstock.TRAN_TYPE','=','W');
        $totalWc->where('tmm_itemstock.TRAN_FLAG','=','WI');
        $totalWc->where('tmm_itemstock.TRAN_DATE','>',$date);
        if($centerId){
            $totalWc->where('tmm_itemstock.center_id','=',$centerId);
        }
        return $totalWc->sum('tmm_itemstock.QTY');
    }

    public static function totalIodizeForDashboard(){
        $date = date("Y-m-d", strtotime("- 30 days"));
        $centerId = Auth::user()->center_id;
        $totalIo = DB::table('tmm_itemstock');
        $totalIo->select('tmm_itemstock.QTY');
        $totalIo->where('tmm_itemstock.TRAN_TYPE','=','I');
        $totalIo->where('tmm_itemstock.TRAN_FLAG','=','II');
        $totalIo->where('tmm_itemstock.TRAN_DATE','>',$date);
        if($centerId){
            $totalIo->where('tmm_itemstock.center_id','=',$centerId);
        }
        return $totalIo->sum('tmm_itemstock.QTY');
    }

    public  static function totalAssociationWashCrashForDashboard(){
        $date = date("Y-m-d", strtotime("- 30 days"));

        $totalWc = DB::table('tmm_itemstock');
        $totalWc->select('tmm_itemstock.QTY');
        $totalWc->where('tmm_itemstock.TRAN_TYPE','=','W');
        $totalWc->where('tmm_itemstock.TRAN_FLAG','=','WI');
        $totalWc->where('tmm_itemstock.TRAN_DATE','>',$date);

        return $totalWc->sum('tmm_itemstock.QTY');
    }

    public static function totalAssociationIodizeForDashboard(){
        $date = date("Y-m-d", strtotime("- 30 days"));

        $totalIo = DB::table('tmm_itemstock');
        $totalIo->select('tmm_itemstock.QTY');
        $totalIo->where('tmm_itemstock.TRAN_TYPE','=','I');
        $totalIo->where('tmm_itemstock.TRAN_FLAG','=','II');
        $totalIo->where('tmm_itemstock.TRAN_DATE','>',$date);

        return $totalIo->sum('tmm_itemstock.QTY');
    }
}

