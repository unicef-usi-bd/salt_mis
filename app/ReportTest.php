<?php

namespace App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class ReportTest extends Model
{

    public static function getPurchaseChemicalItemList($centerId){
    $chemicalItemList = DB::table("smm_item");
    $chemicalItemList->select('ssc_lookupchd.LOOKUPCHD_NAME', 'smm_item.ITEM_NO','smm_item.ITEM_NAME','tmm_itemstock.*' );
    $chemicalItemList->leftJoin('ssc_lookupchd','ssc_lookupchd.LOOKUPCHD_ID','=','smm_item.ITEM_TYPE');
    $chemicalItemList->leftJoin('tmm_itemstock','tmm_itemstock.ITEM_NO','=','smm_item.ITEM_NO');
    $chemicalItemList->Where('tmm_itemstock.TRAN_TYPE','=','CP');
    $chemicalItemList->Where('tmm_itemstock.TRAN_FLAG','=','PR');

    if($centerId){
        $chemicalItemList->Where('tmm_itemstock.center_id','=',$centerId);
    }
    return $chemicalItemList->get();
}
    public static function getPurchaseChemicalList($centerId,$starDate,$endDate){
        $chemicalItemList = DB::table("smm_item");
        $chemicalItemList->select('ssc_lookupchd.LOOKUPCHD_NAME', 'smm_item.ITEM_NO','smm_item.ITEM_NAME','tmm_itemstock.*' );
        $chemicalItemList->leftJoin('ssc_lookupchd','ssc_lookupchd.LOOKUPCHD_ID','=','smm_item.ITEM_TYPE');
        $chemicalItemList->leftJoin('tmm_itemstock','tmm_itemstock.ITEM_NO','=','smm_item.ITEM_NO');
        $chemicalItemList->Where('tmm_itemstock.TRAN_TYPE','=','CP');
        $chemicalItemList->Where('tmm_itemstock.TRAN_FLAG','=','PR');

        if($centerId){
            $chemicalItemList->Where('tmm_itemstock.center_id','=',$centerId);
        }else if($starDate AND $endDate){
            $chemicalItemList->whereBetween('tmm_itemstock.TRAN_DATE',[$starDate, $endDate]);
        }
        return $chemicalItemList->get();
    }

   public static function adminChemicalStock($starDate,$endDate){
        return DB::select(DB::raw("SELECT b.LOOKUPCHD_NAME, b.ITEM_NO, b.ITEM_NAME, SUM(b.purchase) purchase, SUM(b.reduce) reduce, SUM(b.QTY) STOCK_QTY
                                        FROM
                                            (SELECT c.LOOKUPCHD_NAME, i.ITEM_NO, i.ITEM_NAME, s.QTY,
                                            CASE WHEN s.TRAN_FLAG = 'IC' AND s.TRAN_TYPE = 'C' THEN
                                                s.QTY
                                            END reduce,
                                        
                                            CASE WHEN s.TRAN_FLAG = 'PR' AND s.TRAN_TYPE = 'CP' THEN
                                                s.QTY
                                            END purchase,
                                            s.TRAN_DATE, s.center_id
                                            FROM smm_item i, tmm_itemstock s, ssc_lookupchd c
                                            WHERE i.ITEM_NO = s.ITEM_NO
                                            AND c.LOOKUPCHD_ID = i.ITEM_TYPE
                                            AND i.item_type = 25
                                            AND s.TRAN_FLAG NOT IN ('WR','II')
                                            AND s.TRAN_TYPE NOT IN ('W','I')) b
                                        WHERE DATE(b.TRAN_DATE) BETWEEN '$starDate' AND '$endDate'
                                        GROUP BY b.LOOKUPCHD_NAME, b.ITEM_NO, b.ITEM_NAME"));
   }

    public static function millerChemicalStock($centerId,$starDate,$endDate){
        return DB::select(DB::raw("SELECT b.LOOKUPCHD_NAME, b.ITEM_NO, b.ITEM_NAME, SUM(b.purchase) purchase, SUM(b.reduce) reduce, SUM(b.QTY) STOCK_QTY
                                        FROM
                                            (SELECT c.LOOKUPCHD_NAME, i.ITEM_NO, i.ITEM_NAME, s.QTY,
                                            CASE WHEN s.TRAN_FLAG = 'IC' AND s.TRAN_TYPE = 'C' THEN
                                                s.QTY
                                            END reduce,
                                        
                                            CASE WHEN s.TRAN_FLAG = 'PR' AND s.TRAN_TYPE = 'CP' THEN
                                                s.QTY
                                            END purchase,
                                            s.TRAN_DATE, s.center_id
                                            FROM smm_item i, tmm_itemstock s, ssc_lookupchd c
                                            WHERE i.ITEM_NO = s.ITEM_NO
                                            AND c.LOOKUPCHD_ID = i.ITEM_TYPE
                                            AND i.item_type = 25
                                            AND s.TRAN_FLAG NOT IN ('WR','II')
                                            AND s.TRAN_TYPE NOT IN ('W','I')) b
                                        WHERE DATE(b.TRAN_DATE) BETWEEN '$starDate' AND '$endDate'
                                        AND  b.center_id = $centerId
                                        GROUP BY b.LOOKUPCHD_NAME, b.ITEM_NO, b.ITEM_NAME"));
    }

    public static function monitorSupplierList($starDate,$endDate){
        $centerId = Auth::user()->center_id;

        return DB::select(DB::raw("select si.TRADING_NAME, si.TRADER_NAME, lc.LOOKUPCHD_NAME, it.QTY
                                          from ssm_supplier_info si
                                          left join ssc_lookupchd lc on lc.LOOKUPCHD_ID = si.SUPPLIER_TYPE_ID
                                          left join tmm_itemstock it on it.SUPP_ID_AUTO = si.SUPP_ID_AUTO
                                          WHERE DATE(it.TRAN_DATE) BETWEEN '$starDate' AND '$endDate'
                                          and it.center_id = $centerId"));

    }

    public static function purchaseChemicalSupplierList($centerId,$division){
        return DB::select(DB::raw("select ss.TRADING_NAME, ss.TRADER_NAME,ss.DIVISION_ID, sd.DIVISION_NAME, sdi.DISTRICT_NAME, tm.QTY
                                            from ssm_supplier_info ss
                                            left join ssc_divisions sd on sd.DIVISION_ID = ss.DIVISION_ID
                                            left join ssc_districts sdi on sdi.DISTRICT_ID = ss.DISTRICT_ID
                                            left join tmm_itemstock tm on tm.SUPP_ID_AUTO = ss.SUPP_ID_AUTO
                                            where ss.DIVISION_ID = $division
                                          and tm.center_id = $centerId"));
    }

    public static function getStockSaltForAdmin($starDate, $endDate){
        return DB::select(DB::raw("SELECT b.LOOKUPCHD_NAME, b.ITEM_NO, b.ITEM_NAME, SUM(b.purchase) purchase, SUM(b.reduce) reduce, SUM(b.QTY) STOCK_QTY
                                        FROM
                                         (SELECT c.LOOKUPCHD_NAME, i.ITEM_NO, i.ITEM_NAME, s.QTY,
                                            CASE WHEN s.TRAN_FLAG = 'WS' AND s.TRAN_TYPE = 'S' THEN
                                                s.QTY
                                            END reduce,
                                        
                                            CASE WHEN s.TRAN_FLAG = 'PR' AND s.TRAN_TYPE = 'SP' THEN
                                                s.QTY
                                            END purchase,
                                            s.TRAN_DATE, s.center_id
                                            FROM smm_item i, tmm_itemstock s, ssc_lookupchd c
                                            WHERE i.ITEM_NO = s.ITEM_NO
                                            AND c.LOOKUPCHD_ID = i.ITEM_TYPE
                                            AND i.item_type = 26
                                            AND s.TRAN_FLAG NOT IN ('WR','II')
                                            AND s.TRAN_TYPE NOT IN ('W','I')) b
                                            WHERE DATE(b.TRAN_DATE) BETWEEN '$starDate' AND '$endDate'
                                        GROUP BY b.LOOKUPCHD_NAME, b.ITEM_NO, b.ITEM_NAME"));
    }

}
