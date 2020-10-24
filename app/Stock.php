<?php

namespace App;

use function foo\func;
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

    public static function getTotalReduceChemical($chemicalId, $centerId){
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
    public static function totalWashCrashProductions($centerId = null){
        if(empty($centerId)) $centerId = Auth::user()->center_id;
        $countProduction = DB::table('tmm_itemstock as stock')
            ->select('stock.QTY')
            ->leftJoin('ssm_associationsetup as association','stock.center_id','=','association.ASSOCIATION_ID')
            ->leftJoin('ssm_mill_info as smi','association.MILL_ID','=','smi.MILL_ID')
            ->where('smi.ACTIVE_FLG','=','1')
            ->where('TRAN_TYPE','=','W')
            ->where('TRAN_FLAG','=','WI')
            ->whereNull('stock.stock_adjustment_id')
            ->whereNotNull('stock.TRAN_NO');

        if($centerId) $countProduction->where('stock.center_id','=',$centerId);

        return $countProduction->sum('stock.QTY');
    }

    public static function totalIodizeProductions($centerId=null){
        if(empty($centerId)) $centerId = Auth::user()->center_id;
        $countProduction = DB::table('tmm_itemstock as stock')
            ->select('stock.QTY')
            ->leftJoin('ssm_associationsetup as association','stock.center_id','=','association.ASSOCIATION_ID')
            ->leftJoin('ssm_mill_info as smi','association.MILL_ID','=','smi.MILL_ID')
            ->where('smi.ACTIVE_FLG','=','1')
            ->where('TRAN_TYPE','=','I')
            ->where('TRAN_FLAG','=','II')
            ->whereNull('stock.stock_adjustment_id')
            ->whereNotNull('stock.TRAN_NO');
        if($centerId) $countProduction->where('stock.center_id','=', $centerId);

        return $countProduction->sum('stock.QTY');
    }

    public static function totalWashCrashProductionsMonthWise(){
        $date = date("Y-m-d", strtotime("- 30 days"));
        $centerId = Auth::user()->center_id;
        $countProduction = DB::table('tmm_itemstock as stock')
            ->select('stock.QTY')
            ->where('stock.TRAN_TYPE','=','W')
            ->where('stock.TRAN_FLAG','=','WI')
            ->where('stock.TRAN_DATE','>',$date)
            ->whereNull('stock.stock_adjustment_id')
            ->whereNotNull('stock.TRAN_NO');
        if($centerId){
            $countProduction->where('stock.center_id','=',$centerId);
        }
        return $countProduction->sum('stock.QTY');
    }

    public static function totalIodizeProductionsMonthWise(){
        $date = date("Y-m-d", strtotime("- 30 days"));
        $centerId = Auth::user()->center_id;
        $countProduction = DB::table('tmm_itemstock as stock')
            ->select('stock.QTY')
            ->where('stock.TRAN_TYPE','=','I')
            ->where('stock.TRAN_FLAG','=','II')
            ->where('stock.TRAN_DATE','>',$date)
            ->whereNull('stock.stock_adjustment_id')
            ->whereNotNull('stock.TRAN_NO');
        if($centerId){
            $countProduction->where('stock.center_id','=',$centerId);
        }
        return $countProduction->sum('stock.QTY');
    }
    /// ----------------------Production

    ///-----------------------Dashboard wise production
    public static function totalProduction(){
        $centerId = Auth::user()->center_id;
        $totalProductions = DB::table('tmm_itemstock as stock')
            ->select('stock.*','smm_item.ITEM_NAME')
            ->leftJoin('ssm_associationsetup as association','stock.center_id','=','association.ASSOCIATION_ID')
            ->leftJoin('ssm_mill_info as smi','association.MILL_ID','=','smi.MILL_ID')
            ->where('smi.ACTIVE_FLG','=','1')
            ->leftJoin('smm_item','smm_item.ITEM_NO','=','stock.ITEM_NO')
            ->whereNull('stock.stock_adjustment_id')
            ->whereNotNull('stock.TRAN_NO');
        if($centerId){
            $totalProductions->where(function($query) use ($centerId){
                $query->where('stock.center_id','=',$centerId)->orwhere('stock.TRAN_FLAG','=','WI')->orwhere('stock.TRAN_FLAG','=','II');
            });
        }
        $totalProductions->where(function ($query){
            $query->where('stock.TRAN_FLAG','=','WI')->orwhere('stock.TRAN_FLAG','=','II');
        });

        return $totalProductions->get();
    }
    ///-----------------------Dashboard wise production

    /// ----------------------Total Stock
    public static function totalStocks(){
        $centerId = Auth::user()->center_id;
        $totalStock = DB::table('tmm_itemstock as stock')
            ->select('stock.QTY')
            ->leftJoin('ssm_associationsetup as association','stock.center_id','=','association.ASSOCIATION_ID')
            ->leftJoin('ssm_mill_info as smi','association.MILL_ID','=','smi.MILL_ID')
            ->where('smi.ACTIVE_FLG','=','1');
        if($centerId) $totalStock->where('stock.center_id','=',$centerId);
        return $totalStock->sum('stock.QTY');
    }
    /// ----------------------Total Stock

    /// ----------------------Production Graph
    public static function monthWiseProduction(){
        $date = date("Y-m-d", strtotime("- 30 days"));
        //$centerId = Auth::user()->center_id;
        return DB::select(DB::raw("SELECT MONTH(TRAN_DATE) month, ROUND(SUM( it.QTY), 2) subtotal
                            FROM tmm_itemstock it
                            left join ssm_associationsetup association on it.center_id = association.ASSOCIATION_ID
                            left join ssm_mill_info smi on association.MILL_ID = smi.MILL_ID
                            WHERE it.center_id and smi.ACTIVE_FLG=1 and it.TRAN_FLAG in ('WI','II')
                            and YEAR(TRAN_DATE)
                            and TRAN_DATE > $date
                            GROUP BY month"));
    }

    public static function millerYearWiseProduction(){
        $centerId = Auth::user()->center_id;
         $yearWiseProduction = DB::select(DB::raw("select round(sum(it.QTY)) qty, MONTH(it.TRAN_DATE) month
                                from tmm_itemstock it
                                left join ssm_associationsetup association on it.center_id = association.ASSOCIATION_ID
                                left join ssm_mill_info smi on association.MILL_ID = smi.MILL_ID
                                where smi.ACTIVE_FLG=1 and it.TRAN_FLAG in('WI','II')
                                AND it.stock_adjustment_id is null and it.TRAN_NO is not null
                                and it.center_id = $centerId
                                and YEAR(it.TRAN_DATE)"))[0];
        return $yearWiseProduction;
    }

    public static function associationYearWiseProduction(){
        //$centerId = Auth::user()->center_id;
        $yearWiseProduction = DB::select(DB::raw("select MONTH(TRAN_DATE) month, ROUND(SUM( it.QTY), 2) as qty
                                from tmm_itemstock it
                                left join ssm_associationsetup association on it.center_id = association.ASSOCIATION_ID
                                left join ssm_mill_info smi on association.MILL_ID = smi.MILL_ID
                                WHERE it.center_id and smi.ACTIVE_FLG=1 and it.TRAN_FLAG in('WI','II')
                                AND it.stock_adjustment_id is null and it.TRAN_NO is not null
                                and YEAR(TRAN_DATE)"))[0];

        return $yearWiseProduction;
    }

    public static function adminYearWiseProduction(){
        //$centerId = Auth::user()->center_id;
        $yearWiseProduction = DB::select(DB::raw("select MONTH(TRAN_DATE) month, ROUND(SUM( it.QTY), 2) as qty from tmm_itemstock it
                                left join ssm_associationsetup association on it.center_id = association.ASSOCIATION_ID
                                left join ssm_mill_info smi on association.MILL_ID = smi.MILL_ID
                                WHERE it.center_id and smi.ACTIVE_FLG=1
                                AND it.stock_adjustment_id is null and it.TRAN_NO is not null
                                and it.TRAN_FLAG in ('WI','II')and YEAR(TRAN_DATE)"))[0];
        return $yearWiseProduction;
    }

    public static function monthWiseAsociationProduction(){
        $date = date("Y-m-d", strtotime("- 30 days"));
        $centerId = Auth::user()->center_id;
        return DB::select(DB::raw("SELECT MONTH(TRAN_DATE) month, ROUND(SUM( it.QTY)) subtotal
                                       FROM tmm_itemstock it
                                       LEFT JOIN ssm_associationsetup ass ON ass.ASSOCIATION_ID = it.center_id
                                       LEFT JOIN ssm_mill_info smi ON ass.MILL_ID = smi.MILL_ID
                                       WHERE it.center_id  and it.TRAN_FLAG = 'WI' or it.TRAN_FLAG = 'II' and ass.center_id = $centerId and smi.ACTIVE_FLG=1
                                       and YEAR(TRAN_DATE)
                                       and TRAN_DATE >= $date
                                       GROUP BY month"));
    }
    /// ----------------------Production Graph

    ///------------------Procurement List
    public static function procurementList (){
        $date = date("Y-m-d", strtotime("- 30 days"));
        $centerId = Auth::user()->center_id;
        $procurements = DB::table('tmm_itemstock as stock')
            ->select('stock.*', 'items.ITEM_NAME')
            ->leftJoin('ssm_associationsetup as association','stock.center_id','=','association.ASSOCIATION_ID')
            ->leftJoin('ssm_mill_info as smi','association.MILL_ID','=','smi.MILL_ID')
            ->where('smi.ACTIVE_FLG','=','1')
            ->leftJoin('smm_item as items', 'stock.ITEM_NO', '=', 'items.ITEM_NO')
            ->where('stock.TRAN_FLAG', '=', 'PR')
            ->where('stock.TRAN_DATE', '>', $date);
        if($centerId) $procurements->where('stock.center_id','=',$centerId);

        return $procurements->get();
    }
    ///------------------Procurement List


    /// ----------------------Procurement Graph
    public static function monthWiseProcurement(){
        $centerId = Auth::user()->center_id;
        $condition = '';
        if($centerId) $condition = "and it.center_id = $centerId";

        return DB::select(DB::raw("SELECT MONTH(TRAN_DATE) month, ROUND(SUM( it.QTY)) subtotal
                                       FROM tmm_itemstock it
                                       left join ssm_associationsetup association on it.center_id = association.ASSOCIATION_ID
                                       left join ssm_mill_info smi on association.MILL_ID = smi.MILL_ID
                                       WHERE smi.ACTIVE_FLG=1 and it.TRAN_FLAG = 'PR'
                                       and YEAR(it.TRAN_DATE) $condition GROUP BY month"));
    }

    public static function monthWiseProcurementadmin(){
        return DB::select(DB::raw("SELECT MONTH(TRAN_DATE) month, ROUND(SUM( it.QTY)) subtotal
                                       FROM tmm_itemstock it
                                       WHERE  it.TRAN_FLAG = 'PR'
                                       and YEAR(TRAN_DATE)
                                       GROUP BY month"));
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
                                       AND it.stock_adjustment_id is null and it.TRAN_NO is not null
                                       GROUP BY month"));
        //$monthProduction = DB::table('tmm_itemstock')
    }
    /// ----------------------Production Graph

    /// ----------------------Production Graph
    public static function millerProduction(){
        $centerId = Auth::user()->center_id;
        $productions = DB::table('tmm_itemstock as stock')
            ->leftJoin('ssm_associationsetup as association','stock.center_id','=','association.ASSOCIATION_ID')
            ->leftJoin('ssm_mill_info as smi','association.MILL_ID','=','smi.MILL_ID')
            ->where('smi.ACTIVE_FLG','=','1')
            ->where('stock.center_id', '=', $centerId)
            ->whereIn('stock.TRAN_FLAG', ['WI', 'II'])
            ->whereNull('stock.stock_adjustment_id')
            ->whereNotNull('stock.TRAN_NO')
            ->get();
        return $productions;
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
        $centerId = Auth::user()->center_id;
        $countProduction = DB::table('tmm_itemstock as stock')
                            ->select('stock.QTY')
                            ->leftJoin('ssm_associationsetup as asstp','asstp.ASSOCIATION_ID','=','stock.center_id')
                            ->leftJoin('ssm_mill_info as smi','asstp.MILL_ID','=','smi.MILL_ID')
                            ->where('smi.ACTIVE_FLG','=','1')
                            ->where('stock.TRAN_FLAG','=','WI')
                            ->whereNull('stock.stock_adjustment_id')
                            ->whereNotNull('stock.tran_no');
        if($centerId) $countProduction->where('asstp.center_id','=',$centerId);

        return $countProduction->sum('stock.QTY');
    }

    public static function totalAssociationIodize(){
        $centerId = Auth::user()->center_id;
        $countProduction = DB::table('tmm_itemstock as stock')
            ->select('stock.QTY')
            ->leftJoin('ssm_associationsetup as asstp','asstp.ASSOCIATION_ID','=','stock.center_id')
            ->leftJoin('ssm_mill_info as smi','asstp.MILL_ID','=','smi.MILL_ID')
            ->where('smi.ACTIVE_FLG','=','1')
            ->where('stock.TRAN_FLAG','=','II')
            ->whereNull('stock.stock_adjustment_id')
            ->whereNotNull('stock.tran_no');

        if($centerId) $countProduction->where('asstp.center_id','=',$centerId);

        return $countProduction->sum('stock.QTY');
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
        $centerId = Auth::user()->center_id;
        $countSales = DB::table('tmm_itemstock as stock')
            ->select('stock.QTY')
            ->leftJoin('ssm_associationsetup as asstp','asstp.ASSOCIATION_ID','=','stock.center_id')
            ->leftJoin('ssm_mill_info as smi','asstp.MILL_ID','=','smi.MILL_ID')
            ->where('smi.ACTIVE_FLG','=','1')
            ->where('stock.TRAN_TYPE','=','W')
            ->where('stock.TRAN_FLAG','=','SD');

        if($centerId) $countSales->where('asstp.center_id','=',$centerId);

        return $countSales->sum('stock.QTY');
    }

    public static function totalAssociationIodizeSale(){
        $centerId = Auth::user()->center_id;
        $countSales = DB::table('tmm_itemstock as stock')
            ->select('stock.QTY')
            ->leftJoin('ssm_associationsetup as ascstp','ascstp.ASSOCIATION_ID','=','stock.center_id')
            ->leftJoin('ssm_mill_info as smi','ascstp.MILL_ID','=','smi.MILL_ID')
            ->where('smi.ACTIVE_FLG','=','1')
            ->where('stock.TRAN_TYPE','=','I')
            ->where('stock.TRAN_FLAG','=','SD');
        if($centerId) $countSales->where('ascstp.center_id','=',$centerId);

        return $countSales->sum('stock.QTY');
    }

    public static function totalAssociationIodizeSaleMonthWise(){
        $date = date("Y-m-d", strtotime("- 30 days"));
        $centerId = Auth::user()->center_id;
        $countSales = DB::table('tmm_itemstock as stock')
            ->select('stock.QTY')
            ->leftJoin('ssm_associationsetup as asstp','asstp.ASSOCIATION_ID','=','stock.center_id')
            ->leftJoin('ssm_mill_info as smi','asstp.MILL_ID','=','smi.MILL_ID')
            ->where('smi.ACTIVE_FLG','=','1')->where('TRAN_TYPE','=','I')
            ->where('stock.TRAN_FLAG','=','SD')
            ->where('stock.TRAN_DATE','>',$date);
        if($centerId){
            $countSales->where('asstp.center_id','=',$centerId);
        }

        return $countSales->sum('stock.QTY');
    }

    public static function totalAssociationWashCrashSaleMonthWise(){
        $date = date("Y-m-d", strtotime("- 30 days"));
        $centerId = Auth::user()->center_id;
        $countSales = DB::table('tmm_itemstock as stock')
            ->select('stock.QTY')
            ->leftJoin('ssm_associationsetup as asstp','asstp.ASSOCIATION_ID','=','stock.center_id')
            ->leftJoin('ssm_mill_info as smi','asstp.MILL_ID','=','smi.MILL_ID')
            ->where('smi.ACTIVE_FLG','=','1')
            ->where('stock.TRAN_TYPE','=','W')
            ->where('stock.TRAN_FLAG','=','SD')
            ->where('stock.TRAN_DATE','>',$date);

        if($centerId) $countSales->where('asstp.center_id','=',$centerId);

        return $countSales->sum('stock.QTY');
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
                  AND it.stock_adjustment_id is null and it.TRAN_NO is not null
                  AND a.center_id  = $centerId
                  GROUP BY a.ASSOCIATION_ID"));
    }

    public static function totalProductionList(){
        $centerId = Auth::user()->center_id;
        $totalProductions = DB::table('tmm_itemstock as stock')
            ->select('stock.*','smm_item.ITEM_NAME')
            ->leftJoin('smm_item','smm_item.ITEM_NO','=','stock.ITEM_NO')
            ->leftJoin('ssm_associationsetup as asstp','asstp.ASSOCIATION_ID','=','stock.center_id')
            ->leftJoin('ssm_mill_info as smi','asstp.MILL_ID','=','smi.MILL_ID')
            ->where('smi.ACTIVE_FLG','=','1')
            ->whereNull('stock.stock_adjustment_id')
            ->whereNotNull('stock.tran_no');
        if($centerId) {
            $totalProductions->where(function ($query) use ($centerId) {
                $query->where('stock.center_id','=',$centerId)->orwhere('stock.TRAN_FLAG','=','WI')->orWhere('stock.TRAN_FLAG','=','II');
            });
        } else{
            $totalProductions->orwhere(function($query){
                $query->where('stock.TRAN_FLAG','=','WI')->orWhere('stock.TRAN_FLAG','=','II');
            });
        }
        return $totalProductions->get();
    }

    public static function totalSaleList(){
        $centerId = Auth::user()->center_id;
        $totalProductionSale = DB::table('tmm_itemstock as stock')
            ->select('stock.*')
            ->leftJoin('ssm_associationsetup as asstp','asstp.ASSOCIATION_ID','=','stock.center_id')
            ->leftJoin('ssm_mill_info as smi','asstp.MILL_ID','=','smi.MILL_ID')
            ->where('smi.ACTIVE_FLG','=','1')
            ->where('stock.TRAN_FLAG','=','SD')
            ->whereNull('stock.stock_adjustment_id')
            ->whereNotNull('stock.tran_no');
        if($centerId) $totalProductionSale->where('asstp.center_id','=',$centerId);
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
                  AND it.stock_adjustment_id is null and it.TRAN_NO is not null
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
        $countProduction->where('tmm_itemstock.TRAN_DATE','>',$date)
            ->whereNull('tmm_itemstock.stock_adjustment_id')
            ->whereNotNull('tmm_itemstock.TRAN_NO');
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
        $countProduction->where('tmm_itemstock.TRAN_DATE','>',$date)
            ->whereNull('tmm_itemstock.stock_adjustment_id')
            ->whereNotNull('tmm_itemstock.TRAN_NO');
        if($centerId){
            $countProduction->where('ssm_associationsetup.center_id','=',$centerId);
        }

        return $countProduction->sum('tmm_itemstock.QTY');
    }

    public  static function totalWashCrashForDashboard(){
        $date = date("Y-m-d", strtotime("- 30 days"));
        $centerId = Auth::user()->center_id;
        $totalWc = DB::table('tmm_itemstock as stock')
            ->select('stock.QTY')
            ->leftJoin('ssm_associationsetup as association','stock.center_id','=','association.ASSOCIATION_ID')
            ->leftJoin('ssm_mill_info as smi','association.MILL_ID','=','smi.MILL_ID')
            ->where('smi.ACTIVE_FLG','=','1')
            ->where('stock.TRAN_TYPE','=','W')
            ->where('stock.TRAN_FLAG','=','WI')
            ->where('stock.TRAN_DATE','>',$date)
            ->whereNull('stock.stock_adjustment_id')
            ->whereNotNull('stock.TRAN_NO');
        if($centerId) $totalWc->where('stock.center_id','=',$centerId);
        return $totalWc->sum('stock.QTY');
    }

    public static function totalIodizeForDashboard(){
        $date = date("Y-m-d", strtotime("- 30 days"));
        $centerId = Auth::user()->center_id;
        $totalIo = DB::table('tmm_itemstock as stock')
            ->select('stock.QTY')
            ->leftJoin('ssm_associationsetup as association','stock.center_id','=','association.ASSOCIATION_ID')
            ->leftJoin('ssm_mill_info as smi','association.MILL_ID','=','smi.MILL_ID')
            ->where('smi.ACTIVE_FLG','=','1')
            ->where('stock.TRAN_TYPE','=','I')
            ->where('stock.TRAN_FLAG','=','II')
            ->where('stock.TRAN_DATE','>',$date)
            ->whereNull('stock.stock_adjustment_id')
            ->whereNotNull('stock.TRAN_NO');
        if($centerId) $totalIo->where('stock.center_id','=',$centerId);
        return $totalIo->sum('stock.QTY');
    }

    public  static function totalAssociationWashCrashForDashboard(){
        $date = date("Y-m-d", strtotime("- 30 days"));
        $totalWc = DB::table('tmm_itemstock as stock')
            ->select('stock.QTY')
            ->leftJoin('ssm_associationsetup as association','stock.center_id','=','association.ASSOCIATION_ID')
            ->leftJoin('ssm_mill_info as smi','association.MILL_ID','=','smi.MILL_ID')
            ->where('smi.ACTIVE_FLG','=','1')
            ->where('stock.TRAN_FLAG','=','WI')
            ->whereNull('stock.stock_adjustment_id')
            ->whereNotNull('stock.TRAN_NO')
            ->where('stock.TRAN_DATE','>',$date);

        return $totalWc->sum('stock.QTY');
    }

    public static function totalAssociationIodizeForDashboard(){
        $date = date("Y-m-d", strtotime("- 30 days"));
        $totalIo = DB::table('tmm_itemstock as stock')
            ->select('stock.QTY')
            ->leftJoin('ssm_associationsetup as association','stock.center_id','=','association.ASSOCIATION_ID')
            ->leftJoin('ssm_mill_info as smi','association.MILL_ID','=','smi.MILL_ID')
            ->where('smi.ACTIVE_FLG','=','1')
            ->where('stock.TRAN_TYPE','=','I')
            ->where('stock.TRAN_FLAG','=','II')
            ->whereNull('stock.stock_adjustment_id')
            ->whereNotNull('stock.TRAN_NO')
            ->where('stock.TRAN_DATE','>',$date);

        return $totalIo->sum('stock.QTY');
    }

//    wash and crush stock for sale
    public static function stockWashAndCrushForSales($centerId){
        $washingStock = self::getTotalWashingSalt($centerId);
        $usedWashingSalt = self::getTotalReduceWashingSalt($centerId);
        $washingStock = $washingStock - abs($usedWashingSalt);
        $saleWashing = self::getTotalReduceWashingSaltAfterSale($centerId);
        if($saleWashing){
            $washingStock = $washingStock - abs($saleWashing);
        }
        return $washingStock;
    }

//    Iodize stock for sale
    public static function stockIodizeForSales($centerId){
        $iodizeStock = self::getTotalIodizeSaltForSale($centerId);
        $iodizeSale = abs(self::getTotalReduceIodizeSaltForSale($centerId));
        if($iodizeSale) $iodizeStock = $iodizeStock - $iodizeSale;
        return $iodizeStock;
    }
//    Stock Wise Sales individual miller
    public static function millerSales($centerId=null){
        $sales = DB::table('tmm_itemstock as stock')
            ->select('stock.*')
            ->leftJoin('ssm_associationsetup as association','stock.center_id','=','association.ASSOCIATION_ID')
            ->leftJoin('ssm_mill_info as smi','association.MILL_ID','=','smi.MILL_ID')
            ->where('smi.ACTIVE_FLG','=','1')
            ->where('stock.TRAN_FLAG','=','SD')
            ->whereNull('stock.stock_adjustment_id')
            ->whereNotNull('stock.TRAN_NO');
        if($centerId) $sales->where('stock.center_id','=',$centerId);

        return $sales;
    }

//    Get Current WC stock by center Id
    public static function currentWashingCrashSaltByCenterId($centerId){
        $increasedWashingSalt = self::getTotalWashingSalt($centerId);
        $reducedWashingSalt = self::getTotalReduceWashingSalt($centerId);
        $WashingTotalUseInIodize = $increasedWashingSalt - abs($reducedWashingSalt);

        $afterSaleWashing = self::getTotalReduceWashingSaltAfterSale($centerId);

        if($afterSaleWashing){
            $washingStock = $WashingTotalUseInIodize - abs($afterSaleWashing);
        }else{
            $washingStock = $WashingTotalUseInIodize;
        }
        $washingStock = number_format($washingStock, 2);

        return $washingStock;
    }

//    Get Current Iodize stock by center Id
    public static function currentIodizeStockByCenterId($centerId){
        $beforeIodizeSaleStock = self::getTotalIodizeSaltForSale($centerId);
        $iodizeSale = abs(self::getTotalReduceIodizeSaltForSale($centerId));
        //dd($beforeIodizeSaleStock);exit();

        if($iodizeSale){
            $iodizeStock = $beforeIodizeSaleStock - $iodizeSale;
        }else{
            $iodizeStock = $beforeIodizeSaleStock;

        }
        $iodizeStock = number_format($iodizeStock, 2);
        return $iodizeStock;
    }

    public static function getStockIdByTranChildId($id,$type){
        if($type == '7') {
            $tran_type = 'W';
        } else{
            $tran_type = 'I';
        }
        $stockId = DB::table('tmm_itemstock as s')
            ->select('s.STOCK_NO','s.TRAN_TYPE','s.TRAN_NO')
            ->where('s.TRAN_TYPE',$tran_type)
            ->where('s.TRAN_NO',$id)
            ->first();
        return $stockId;
    }
}

