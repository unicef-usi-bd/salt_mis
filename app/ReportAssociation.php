<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


class ReportAssociation extends Model
{

// purchase salt
 public static function getPurchaseSaltItem(){
     $centerId = Auth::user()->center_id;
     return DB::select(DB::raw("select lc.LOOKUPCHD_NAME,st.ITEM_NAME
          from smm_item st
          left join ssc_lookupchd lc on lc.LOOKUPCHD_ID = st.ITEM_TYPE
          where st.ACTIVE_FLG and st.item_type=26 "));

 }
    public static function getPurchaseSaltTotal(){
        $centerId = Auth::user()->center_id;
        return DB::select(DB::raw("select lc.LOOKUPCHD_NAME,it.ITEM_NAME, its.QTY,its.center_id 
            from tmm_itemstock its
            left join smm_item it on its.ITEM_NO = it.ITEM_NO
            left join ssc_lookupchd lc on it.ITEM_TYPE = lc.LOOKUPCHD_ID
            where its.TRAN_FLAG = 'PR' and its.TRAN_TYPE = 'SP' and its.center_id in (select ass.ASSOCIATION_ID 
            from ssm_associationsetup ass
            where ass.PARENT_ID = '$centerId') "));
    }
    public static function getPurchaseSaltTotalStock($starDate,$endDate){
        $centerId = Auth::user()->center_id;
        return DB::select(DB::raw("SELECT b.LOOKUPCHD_NAME,
               b.ITEM_NO,
               b.ITEM_NAME,
               SUM(b.purchase) purchase,
               SUM(b.reduce) reduce,
               SUM(b.QTY) STOCK_QTY
          FROM (SELECT c.LOOKUPCHD_NAME,
                       i.ITEM_NO,
                       i.ITEM_NAME,
                       s.QTY,
                       CASE
                          WHEN s.TRAN_FLAG = 'WS' AND s.TRAN_TYPE = 'S' THEN s.QTY
                       END
                          reduce,
                       CASE
                          WHEN s.TRAN_FLAG = 'PR' AND s.TRAN_TYPE = 'SP' THEN s.QTY
                       END
                          purchase,
                       s.TRAN_DATE,
                       s.center_id
                  FROM smm_item i, tmm_itemstock s, ssc_lookupchd c
                 WHERE     i.ITEM_NO = s.ITEM_NO
                       AND c.LOOKUPCHD_ID = i.ITEM_TYPE
                       AND i.item_type = 26
                       AND s.TRAN_FLAG NOT IN ('WI', 'SD')
                       AND s.TRAN_TYPE NOT IN ('S', 'C')) b
         
         WHERE b.center_id in (select ass.ASSOCIATION_ID
                    from ssm_associationsetup ass
                   where ass.PARENT_ID = '$centerId')
                  AND  DATE(b.TRAN_DATE) BETWEEN '$starDate' AND '$endDate'
        GROUP BY b.LOOKUPCHD_NAME, b.ITEM_NO, b.ITEM_NAME "));
    }
    // purchase salt End
// purchase chemical
    public static function getPurchaseChemicalItem(){
        $centerId = Auth::user()->center_id;
        return DB::select(DB::raw("select lc.LOOKUPCHD_NAME, st.ITEM_NAME 
          from smm_item st
          left join ssc_lookupchd lc on lc.LOOKUPCHD_ID = st.ITEM_TYPE
          where st.ACTIVE_FLG and st.item_type=25 "));

    }
    public static function getPurchaseChemicalTotal(){
        $centerId = Auth::user()->center_id;
        return DB::select(DB::raw("select lc.LOOKUPCHD_NAME,it.ITEM_NAME, its.QTY,its.center_id 
            from tmm_itemstock its
            left join smm_item it on its.ITEM_NO = it.ITEM_NO
            left join ssc_lookupchd lc on it.ITEM_TYPE = lc.LOOKUPCHD_ID
            where its.TRAN_FLAG = 'PR' and its.TRAN_TYPE = 'CP' and its.center_id in (select ass.ASSOCIATION_ID 
            from ssm_associationsetup ass
            where ass.PARENT_ID = '$centerId' )"));

    }
    public static function getPurchaseChemicalTotalStock($starDate,$endDate){
        $centerId = Auth::user()->center_id;
        return DB::select(DB::raw("SELECT b.LOOKUPCHD_NAME,
               b.ITEM_NO,
               b.ITEM_NAME,
               SUM(b.purchase) purchase,
               SUM(b.reduce) reduce,
               SUM(b.QTY) STOCK_QTY
          FROM (SELECT c.LOOKUPCHD_NAME,
                       i.ITEM_NO,
                       i.ITEM_NAME,
                       s.QTY,
                       CASE
                          WHEN s.TRAN_FLAG = 'IC' AND s.TRAN_TYPE = 'C' THEN s.QTY
                       END
                          reduce,
                       CASE
                          WHEN s.TRAN_FLAG = 'PR' AND s.TRAN_TYPE = 'CP' THEN s.QTY
                       END
                          purchase,
                       s.TRAN_DATE,
                       s.center_id
                  FROM smm_item i, tmm_itemstock s, ssc_lookupchd c
                 WHERE     i.ITEM_NO = s.ITEM_NO
                       AND c.LOOKUPCHD_ID = i.ITEM_TYPE
                       AND i.item_type = 25
                       AND s.TRAN_FLAG NOT IN ('WR', 'II')
                       AND s.TRAN_TYPE NOT IN ('W', 'I')) b
         
         WHERE b.center_id in (select ass.ASSOCIATION_ID
                    from ssm_associationsetup ass
                   where ass.PARENT_ID = '$centerId')
                   AND  DATE(b.TRAN_DATE) BETWEEN '$starDate' AND '$endDate'
        GROUP BY b.LOOKUPCHD_NAME, b.ITEM_NO, b.ITEM_NAME "));

    }
// purchase chemical End
// miller
    public static function getMillerList($activStatus){
        $centerId = Auth::user()->center_id;
        $miller = DB::table('ssm_mill_info');
        $miller->select('ssm_mill_info.*','ssc_lookupchd.LOOKUPCHD_NAME');
        $miller->leftJoin('ssc_lookupchd','ssm_mill_info.MILL_TYPE_ID','=','ssc_lookupchd.UD_ID');
        if($centerId){
            $miller->where('ssm_mill_info.center_id','=',$centerId);
        }
        if($activStatus == 1){
            $miller->where('ssm_mill_info.ACTIVE_FLG','=',1);
        }
        if($activStatus == 0){
            $miller->where('ssm_mill_info.ACTIVE_FLG','=',0);
        }
        return $miller->get();
    }
    public static function getMillerType(){
        $centerId = Auth::user()->center_id;
        $miller = DB::table('ssm_mill_info');
        $miller->select('ssm_mill_info.*','ssc_lookupchd.LOOKUPCHD_NAME');
        $miller->leftJoin('ssc_lookupchd','ssm_mill_info.MILL_TYPE_ID','=','ssc_lookupchd.UD_ID');
        if($centerId){
            $miller->where('ssm_mill_info.center_id','=',$centerId);
        }
        return $miller->get();
    }
    public static function getMonitorMiller(){
        $centerId = Auth::user()->center_id;
        return DB::select(DB::raw("select mi.MILL_NAME,(lc.LOOKUPCHD_NAME)MONITOR_BY,mm.MOMITOR_DATE
              from tsm_millmonitore mm     
              left join ssm_mill_info  mi on mm.MILL_ID = mi.MILL_ID
              left join ssc_lookupchd lc on mm.AGENCY_ID = lc.LOOKUPCHD_ID
              where mm.center_id = '$centerId' "));

    }
// miller end

// hr
    public static function getMillerListForHr(){
        $centerId = Auth::user()->center_id;
        return DB::select(DB::raw(" select mi.MILL_NAME,me.TOTMALE_EMP,me.TOTFEM_EMP, me.FULLTIMEMALE_EMP,me.FULLTIMEFEM_EMP,
              me.PARTTIMEMALE_EMP,me.PARTTIMEFEM_EMP, me.TOTMALETECH_PER,me.TOTFEMTECH_PER
              from ssm_mill_info  mi
              left join ssm_millemp_info me on mi.MILL_ID = me.MILL_ID
              where mi.center_id = '$centerId' "));

    }
    public static function getQcMillerList(){
        $centerId = Auth::user()->center_id;
        return DB::select(DB::raw("select mi.mill_name,ql.BATCH_NO, lc.LOOKUPCHD_NAME as QC_BY, lch.LOOKUPCHD_NAME as AGENCY_NAME, ql.QC_TESTNAME
          from tmm_qualitycontrol ql
              left join ssm_associationsetup ass on ql.center_id = ass.ASSOCIATION_ID
              left join ssm_mill_info mi on ass.MILL_ID = mi.MILL_ID
              left join ssc_lookupchd lc on lc.LOOKUPCHD_ID = ql.QC_BY
              left join ssc_lookupchd lch on lch.LOOKUPCHD_ID = ql.AGENCY_ID
              where ql.center_id = '$centerId' "));

    }
    public static function getLicenseMillerList($issueby){
        $centerId = Auth::user()->center_id;
        return DB::select(DB::raw("select mi.MILL_NAME,ci.CERTIFICATE_TYPE_ID, lc.LOOKUPCHD_NAME as CERT_NAME, ci.ISSURE_ID, lch.LOOKUPCHD_NAME as ISSUER, ci.ISSUING_DATE, ci.RENEWING_DATE
          from ssm_certificate_info ci
          left join ssm_mill_info mi on mi.MILL_ID = ci.MILL_ID
          left join ssc_lookupchd lc on lc.LOOKUPCHD_ID = ci.CERTIFICATE_TYPE_ID
          left join ssc_lookupchd lch on lch.LOOKUPCHD_ID = ci.ISSURE_ID
          where ci.center_id = '$centerId' and ci.ISSURE_ID = '$issueby' "));

    }
    public static function getSaleItemList(){
        $centerId = Auth::user()->center_id;
        return DB::select(DB::raw("select sc.SALESCHD_ID,sc.SALESMST_ID,sc.ITEM_ID,it.ITEM_NAME,it.ITEM_TYPE,lc.LOOKUPCHD_NAME as IT_TYPE,sc.QTY,sc.UNIT_PRICE 
             from tmm_saleschd sc
             left join smm_item it on sc.ITEM_ID = it.ITEM_NO
             left join ssc_lookupchd lc on it.ITEM_TYPE = lc.LOOKUPCHD_ID
             where sc.center_id in (select ass.ASSOCIATION_ID
             from ssm_associationsetup ass
             where ass.PARENT_ID = '$centerId' ) "));

    }
    public static function getSaleItemStock(){
        $centerId = Auth::user()->center_id;
        return DB::select(DB::raw("select sc.SALESCHD_ID,sc.SALESMST_ID,sc.ITEM_ID,it.ITEM_NAME,it.ITEM_TYPE,lc.LOOKUPCHD_NAME as IT_TYPE,sc.QTY,sc.UNIT_PRICE 
             from tmm_saleschd sc
             left join smm_item it on sc.ITEM_ID = it.ITEM_NO
             left join ssc_lookupchd lc on it.ITEM_TYPE = lc.LOOKUPCHD_ID
             where sc.center_id in (select ass.ASSOCIATION_ID
             from ssm_associationsetup ass
             where ass.PARENT_ID = '$centerId' ) "));

    }









} //end class
