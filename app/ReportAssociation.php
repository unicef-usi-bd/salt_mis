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
    public static function getPurchaseSaltTotal($itemTypeAssoc){
        $centerId = Auth::user()->center_id;
        if ($itemTypeAssoc==0){
            return DB::select(DB::raw("select lc.LOOKUPCHD_NAME,it.ITEM_NAME, its.QTY,its.center_id,its.TRAN_DATE,ai.ASSOCIATION_NAME
            from tmm_itemstock its
            left join smm_item it on its.ITEM_NO = it.ITEM_NO
            left join ssm_associationsetup ai  on its.center_id = ai.ASSOCIATION_ID
            left join ssc_lookupchd lc on it.ITEM_TYPE = lc.LOOKUPCHD_ID
            where its.TRAN_FLAG = 'PR' and its.TRAN_TYPE = 'SP' and its.center_id in (select ass.ASSOCIATION_ID
            from ssm_associationsetup ass
            where ass.PARENT_ID = '$centerId')
            "));
        }else{
            return DB::select(DB::raw("select lc.LOOKUPCHD_NAME,it.ITEM_NAME, its.QTY,its.center_id,its.TRAN_DATE,ai.ASSOCIATION_NAME
            from tmm_itemstock its
            left join smm_item it on its.ITEM_NO = it.ITEM_NO
            left join ssm_associationsetup ai  on its.center_id = ai.ASSOCIATION_ID
            left join ssc_lookupchd lc on it.ITEM_TYPE = lc.LOOKUPCHD_ID
            where its.TRAN_FLAG = 'PR' and its.TRAN_TYPE = 'SP' and its.center_id in (select ass.ASSOCIATION_ID
            from ssm_associationsetup ass
            where ass.PARENT_ID = '$centerId')

             and
            its.ITEM_NO = '$itemTypeAssoc' "));
        }

    }
    public static function getPurchaseSaltTotalStock(){
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
                       -- AND s.TRAN_TYPE NOT IN ('S', 'C')
                       ) b

         WHERE b.center_id in (select ass.ASSOCIATION_ID
                    from ssm_associationsetup ass
                   where ass.PARENT_ID = '$centerId')

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
    public static function getPurchaseChemicalTotal($starDate,$endDate,$millTypeAdmin){
        $centerId = Auth::user()->center_id;
        if($millTypeAdmin==0){
            return DB::select(DB::raw("select lc.LOOKUPCHD_NAME,it.ITEM_NAME, its.QTY,its.center_id
            from tmm_itemstock its
            left join smm_item it on its.ITEM_NO = it.ITEM_NO
            left join ssm_associationsetup ai on ai.ASSOCIATION_ID = its.center_id
            left join ssc_lookupchd lc on it.ITEM_TYPE = lc.LOOKUPCHD_ID
            where its.TRAN_FLAG = 'PR' and its.TRAN_TYPE = 'CP'  and its.center_id in (select ass.ASSOCIATION_ID
            from ssm_associationsetup ass
            where ass.PARENT_ID = '$centerId'  )
            and  its.TRAN_DATE BETWEEN '$starDate' AND '$endDate'"));
        }else{
            return DB::select(DB::raw("select lc.LOOKUPCHD_NAME,it.ITEM_NAME, its.QTY,its.center_id
            from tmm_itemstock its
            left join smm_item it on its.ITEM_NO = it.ITEM_NO
            left join ssm_associationsetup ai on ai.ASSOCIATION_ID = its.center_id
            left join ssc_lookupchd lc on it.ITEM_TYPE = lc.LOOKUPCHD_ID
            where its.TRAN_FLAG = 'PR' and its.TRAN_TYPE = 'CP' and ai.MILL_ID = $millTypeAdmin and its.center_id in (select ass.ASSOCIATION_ID
            from ssm_associationsetup ass
            where ass.PARENT_ID = '$centerId'  )
            and  its.TRAN_DATE BETWEEN '$starDate' AND '$endDate'"));
        }


    }
    public static function getPurchaseChemicalTotalStock($millTypeAdmin){
        $centerId = Auth::user()->center_id;
        if($millTypeAdmin==0){
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
                       AND s.ITEM_NO in(5,6)
                       AND s.TRAN_FLAG NOT IN ('WR', 'II')
                       AND s.TRAN_TYPE NOT IN ('W', 'I')) b

         WHERE b.center_id in (select ass.ASSOCIATION_ID
                    from ssm_associationsetup ass
                   where ass.PARENT_ID = '$centerId'
                   )

        GROUP BY b.LOOKUPCHD_NAME, b.ITEM_NO, b.ITEM_NAME ; "));
        }else{
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
                       AND s.ITEM_NO IN (5,6)
                       AND s.TRAN_FLAG NOT IN ('WR', 'II')
                       AND s.TRAN_TYPE NOT IN ('W', 'I')) b

         WHERE b.center_id in (select ass.ASSOCIATION_ID
                    from ssm_associationsetup ass
                   where ass.PARENT_ID = '$centerId'
                   and ass.MILL_ID = $millTypeAdmin)

        GROUP BY b.LOOKUPCHD_NAME, b.ITEM_NO, b.ITEM_NAME ; "));
        }


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
        $miller->leftJoin('ssc_lookupchd','ssm_mill_info.MILL_TYPE_ID','=','ssc_lookupchd.LOOKUPCHD_ID');
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
        return DB::select(DB::raw("select mi.MILL_NAME,me.TOTMALE_EMP,me.TOTFEM_EMP, me.FULLTIMEMALE_EMP,me.FULLTIMEFEM_EMP,
              me.PARTTIMEMALE_EMP,me.PARTTIMEFEM_EMP, me.TOTMALETECH_PER,me.TOTFEMTECH_PER
              from ssm_mill_info  mi
              left join ssm_millemp_info me on mi.MILL_ID = me.MILL_ID
              where mi.center_id = '$centerId' group by mi.MILL_ID"));

    }
    public static function getQcMillerList(){
        $centerId = Auth::user()->center_id;
//        return DB::select(DB::raw("select mi.mill_name,i.BATCH_NO, lc.LOOKUPCHD_NAME as QC_BY, lch.LOOKUPCHD_NAME as AGENCY_NAME, ql.QC_TESTNAME
//          from tmm_qualitycontrol ql
//              left join ssm_associationsetup ass on ql.center_id = ass.ASSOCIATION_ID
//              left join ssm_mill_info mi on ass.MILL_ID = mi.MILL_ID
//              left join ssc_lookupchd lc on lc.LOOKUPCHD_ID = ql.QC_BY
//              left join ssc_lookupchd lch on lch.LOOKUPCHD_ID = ql.AGENCY_ID
//              left join tmm_iodizedmst i on i.IODIZEDMST_ID = ql.BATCH_NO
//              where ql.center_id in (select ass.ASSOCIATION_ID
//             from ssm_associationsetup ass
//             where ass.PARENT_ID = '$centerId' ) "));
        return DB::select(DB::raw(" select DISTINCT *, lc.LOOKUPCHD_NAME quality_control_by, lch.LOOKUPCHD_NAME agency_name,
(select ASSOCIATION_NAME from ssm_associationsetup where ASSOCIATION_ID = ql.center_id) MILL_NAME
from tmm_qualitycontrol ql
left join ssc_lookupchd lc on lc.LOOKUPCHD_ID = ql.QC_BY
left join ssc_lookupchd lch on lch.LOOKUPCHD_ID = ql.AGENCY_ID
left join tmm_iodizedmst i on i.IODIZEDMST_ID = ql.BATCH_NO
left join ssm_mill_info mi on mi.center_id = ql.center_id
left join ssm_associationsetup ass on ass.ASSOCIATION_ID = ql.center_id
where ql.center_id in(select ass.ASSOCIATION_ID
             from ssm_associationsetup ass
             where ass.PARENT_ID = $centerId)"));

    }
    public static function getLicenseMillerList($issueby,$renawlDate,$failDate){
        $centerId = Auth::user()->center_id;
        return DB::select(DB::raw("select mi.MILL_NAME,ci.CERTIFICATE_TYPE_ID, lc.LOOKUPCHD_NAME as CERT_NAME, ci.ISSURE_ID, lch.LOOKUPCHD_NAME as ISSUER, ci.ISSUING_DATE, ci.RENEWING_DATE
          from ssm_certificate_info ci
          left join ssm_mill_info mi on mi.MILL_ID = ci.MILL_ID
          left join ssc_lookupchd lc on lc.LOOKUPCHD_ID = ci.CERTIFICATE_TYPE_ID
          left join ssc_lookupchd lch on lch.LOOKUPCHD_ID = ci.ISSURE_ID
          where ci.center_id = '$centerId' and ci.ISSURE_ID = '$issueby'
          and ci.RENEWING_DATE = '$renawlDate' and ci.RENEWING_DATE = '$failDate' "));

    }
    public static function getSaleItemList(){
        $centerId = Auth::user()->center_id;
        return DB::select(DB::raw("select sc.SALESCHD_ID,sc.SALESMST_ID,sc.ITEM_ID,it.ITEM_NAME,it.ITEM_TYPE,lc.LOOKUPCHD_NAME as IT_TYPE,sc.QTY,sc.UNIT_PRICE
             from tmm_saleschd sc
             left join smm_item it on sc.ITEM_ID = it.ITEM_NO
             left join ssc_lookupchd lc on it.ITEM_TYPE = lc.LOOKUPCHD_ID
             where sc.center_id in (select ass.ASSOCIATION_ID
             from ssm_associationsetup ass
             where ass.PARENT_ID = '$centerId' ) group by it.ITEM_NAME "));

    }
    public static function getSaleItemStock($centerId,$starDate,$endDate){

//        return DB::select(DB::raw("select sc.SALESCHD_ID,sc.SALESMST_ID,sc.ITEM_ID,it.ITEM_NAME,it.ITEM_TYPE,lc.LOOKUPCHD_NAME as IT_TYPE,sc.QTY,sc.UNIT_PRICE
//             from tmm_saleschd sc
//             left join smm_item it on sc.ITEM_ID = it.ITEM_NO
//             left join ssc_lookupchd lc on it.ITEM_TYPE = lc.LOOKUPCHD_ID
//             where sc.center_id in (select ass.ASSOCIATION_ID
//             from ssm_associationsetup ass
//             where ass.PARENT_ID = '$centerId' )
//             "));
        return DB::select(DB::raw("select w.BATCH_NO, sum(st.QTY) QTY,ai.ASSOCIATION_NAME,lc.LOOKUPCHD_NAME,
      case when st.TRAN_TYPE = 'W' then
        'Wash Crash'
      end Process_Type
      from tmm_itemstock st
      left join tmm_washcrashmst w on w.WASHCRASHMST_ID = st.TRAN_NO
      left join ssm_associationsetup ai on ai.ASSOCIATION_ID = st.center_id
       left join ssc_lookupchd lc on lc.LOOKUPCHD_ID = 29
      -- left join tmm_iodizedmst i on i.IODIZEDMST_ID = st.TRAN_NO
      where st.TRAN_TYPE = 'W' and ai.center_id = $centerId and st.TRAN_FLAG IN ('WR','SD','WI')
      -- and Date(st.TRAN_DATE) BETWEEN '$starDate' AND '$endDate'
      union
      select i.BATCH_NO, sum(st.QTY) QTY,ai.ASSOCIATION_NAME,lc.LOOKUPCHD_NAME,
      case when st.TRAN_TYPE = 'I' then
        'Iodize'
      end Process_Type
      from tmm_itemstock st
      -- left join tmm_washcrashmst w on w.WASHCRASHMST_ID = st.TRAN_NO
      left join tmm_iodizedmst i on i.IODIZEDMST_ID = st.TRAN_NO
      left join ssm_associationsetup ai on ai.ASSOCIATION_ID = st.center_id
       left join ssc_lookupchd lc on lc.LOOKUPCHD_ID = 29
      where st.TRAN_TYPE = 'I' and ai.center_id = $centerId and st.TRAN_FLAG IN ('II','SD')
      -- and Date(st.TRAN_DATE) BETWEEN '$starDate' AND '$endDate'"));

    }

    public static function getListOfMiller(){
        $centerId = Auth::user()->center_id;
        return DB::select(DB::raw(" select mi.MILL_NAME
           from ssm_mill_info mi
           where mi.center_id = '$centerId' "));

    }
    public static function assocProcessStock($starDate, $endDate){
        $centerId = Auth::user()->center_id;
        $processStock = DB::select(DB::raw("SELECT  (SELECT COUNT(DISTINCT ist.center_id) FROM tmm_itemstock ist WHERE ist.TRAN_FLAG='II' ) AS MILL_NO
                                            ,st.TRAN_TYPE,COUNT(STOCK_NO) BATCH_NO,SUM(st.QTY) QTY
                                             FROM tmm_itemstock st
                                             LEFT JOIN ssm_associationsetup ai ON st.center_id=ai.ASSOCIATION_ID
                                             WHERE st.TRAN_TYPE='W'
                                              AND ai.center_id= $centerId
                                             AND st.TRAN_FLAG IN('WR','SD','WI')
                                               AND DATE(st.TRAN_DATE) BETWEEN '$starDate' AND '$endDate'   
                                               UNION ALL       
                                               SELECT 
                                            (SELECT COUNT(DISTINCT ist.center_id) FROM tmm_itemstock ist WHERE ist.TRAN_FLAG='II' ) AS MILL_NO
                                            ,st.TRAN_TYPE,COUNT(STOCK_NO) BATCH_NO,SUM(st.QTY) QTY
                                             FROM tmm_itemstock st
                                             LEFT JOIN ssm_associationsetup ai ON st.center_id=ai.ASSOCIATION_ID
                                             WHERE st.TRAN_TYPE='I'
                                              AND ai.center_id= $centerId
                                             AND st.TRAN_FLAG IN('II','SD')
                                               AND DATE(st.TRAN_DATE) BETWEEN '$starDate' AND '$endDate'
                                               "));
        return $processStock;

    }

    public static function getAssocSale($processType, $divisionId, $districtId){
        /*$centerId = Auth::user()->center_id;
        if($processType == 0){
            return DB::select(DB::raw("SELECT a.DISTRICT_ID, a.DIVISION_ID, a.ITEM_TYPE,
        a.ITEM_TYPE_NAME,a.ITEM_NO, a.ITEM_NAME, a.DISTRICT_NAME, a.DIVISION_NAME,
        SUM(a.QTY) QTY,
        (SELECT COUNT(MILL_ID) FROM ssm_mill_info  WHERE DISTRICT_ID = a.DISTRICT_ID AND DIVISION_ID = a.DIVISION_ID AND center_id = $centerId ) cnt_miller
        FROM
            (
            SELECT s.DISTRICT_ID, s.DIVISION_ID, i.ITEM_TYPE,i.ITEM_NO, i.ITEM_NAME,
              (SELECT LOOKUPCHD_NAME FROM ssc_lookupchd WHERE LOOKUPCHD_ID = i.ITEM_TYPE) ITEM_TYPE_NAME,
              (SELECT DISTRICT_NAME FROM ssc_districts WHERE DISTRICT_ID = s.DISTRICT_ID) DISTRICT_NAME,
              (SELECT DIVISION_NAME FROM ssc_divisions WHERE DIVISION_ID = s.DIVISION_ID) DIVISION_NAME,
            t.QTY
            FROM ssm_mill_info s, ssm_associationsetup a, tmm_itemstock t, smm_item i
            WHERE s.mill_id = a.mill_id
            AND a.ASSOCIATION_ID = t.center_id
            AND i.ITEM_NO = t.ITEM_NO
            and s.DISTRICT_ID = $districtId
            and s.DIVISION_ID = $divisionId
            -- and s.ACTIVE_FLG = 1
            AND t.TRAN_TYPE = 'W'
            and t.TRAN_FLAG = 'SD'
             ) a
        GROUP BY a.DISTRICT_ID, a.DIVISION_ID, A.ITEM_TYPE,
        a.ITEM_TYPE_NAME,a.ITEM_NO, a.ITEM_NAME, a.DISTRICT_NAME, a.DIVISION_NAME"));
        }elseif($processType == 1){
            return DB::select(DB::raw(" SELECT a.DISTRICT_ID, a.DIVISION_ID, a.ITEM_TYPE,
        a.ITEM_TYPE_NAME,a.ITEM_NO, a.ITEM_NAME, a.DISTRICT_NAME, a.DIVISION_NAME,
        SUM(a.QTY) QTY,
        (SELECT COUNT(MILL_ID) FROM ssm_mill_info  WHERE DISTRICT_ID = a.DISTRICT_ID AND DIVISION_ID = a.DIVISION_ID AND center_id = $centerId ) cnt_miller
        FROM
            (
            SELECT s.DISTRICT_ID, s.DIVISION_ID, i.ITEM_TYPE,i.ITEM_NO, i.ITEM_NAME,
              (SELECT LOOKUPCHD_NAME FROM ssc_lookupchd WHERE LOOKUPCHD_ID = i.ITEM_TYPE) ITEM_TYPE_NAME,
              (SELECT DISTRICT_NAME FROM ssc_districts WHERE DISTRICT_ID = s.DISTRICT_ID) DISTRICT_NAME,
              (SELECT DIVISION_NAME FROM ssc_divisions WHERE DIVISION_ID = s.DIVISION_ID) DIVISION_NAME,
            t.QTY
            FROM ssm_mill_info s, ssm_associationsetup a, tmm_itemstock t, smm_item i
            WHERE s.mill_id = a.mill_id
            AND a.ASSOCIATION_ID = t.center_id
            AND i.ITEM_NO = t.ITEM_NO
            and s.DISTRICT_ID = $districtId
            and s.DIVISION_ID = $divisionId
            -- and s.ACTIVE_FLG = 1
            AND t.TRAN_TYPE = 'I'
            and t.TRAN_FLAG = 'SD'

             ) a
        GROUP BY a.DISTRICT_ID, a.DIVISION_ID, A.ITEM_TYPE,
        a.ITEM_TYPE_NAME,a.ITEM_NO, a.ITEM_NAME, a.DISTRICT_NAME, a.DIVISION_NAME "));
        }else{
            return DB::select(DB::raw("SELECT a.DISTRICT_ID, a.DIVISION_ID, a.ITEM_TYPE,
        a.ITEM_TYPE_NAME,a.ITEM_NO, a.ITEM_NAME, a.DISTRICT_NAME, a.DIVISION_NAME,
        SUM(a.QTY) QTY,
        (SELECT COUNT(MILL_ID) FROM ssm_mill_info  WHERE DISTRICT_ID = a.DISTRICT_ID AND DIVISION_ID = a.DIVISION_ID AND center_id = $centerId ) cnt_miller
        FROM
            (
            SELECT s.DISTRICT_ID, s.DIVISION_ID, i.ITEM_TYPE,i.ITEM_NO, i.ITEM_NAME,
              (SELECT LOOKUPCHD_NAME FROM ssc_lookupchd WHERE LOOKUPCHD_ID = i.ITEM_TYPE) ITEM_TYPE_NAME,
              (SELECT DISTRICT_NAME FROM ssc_districts WHERE DISTRICT_ID = s.DISTRICT_ID) DISTRICT_NAME,
              (SELECT DIVISION_NAME FROM ssc_divisions WHERE DIVISION_ID = s.DIVISION_ID) DIVISION_NAME,
            t.QTY
            FROM ssm_mill_info s, ssm_associationsetup a, tmm_itemstock t, smm_item i
            WHERE s.mill_id = a.mill_id
            AND a.ASSOCIATION_ID = t.center_id
            AND i.ITEM_NO = t.ITEM_NO
            and s.DISTRICT_ID = $districtId
            and s.DIVISION_ID = $divisionId
            -- and s.ACTIVE_FLG = 1
            AND t.TRAN_TYPE in ('I','W')
            and t.TRAN_FLAG = 'SD'
             ) a
        GROUP BY a.DISTRICT_ID, a.DIVISION_ID, A.ITEM_TYPE,
        a.ITEM_TYPE_NAME,a.ITEM_NO, a.ITEM_NAME, a.DISTRICT_NAME, a.DIVISION_NAME"));
        }*/

        $conditions = '';
        if ($processType) $conditions .= " and i.ITEM_NO = $processType";
        if ($divisionId) $conditions .= " and s.DIVISION_ID = $divisionId";
        if ($districtId) $conditions .= " and s.DISTRICT_ID = $districtId";
        $data = DB::select(DB::raw("SELECT a.CUSTOMER_ID ,a.TRADING_NAME,a.TRADER_NAME,a.DISTRICT_ID, a.DIVISION_ID, a.ITEM_TYPE,
        a.ITEM_TYPE_NAME,a.ITEM_NAME, a.DISTRICT_NAME, a.DIVISION_NAME, a.seller_type,
        SUM(a.QTY) QTY
        FROM
            (SELECT s.CUSTOMER_ID, s.TRADING_NAME,s.TRADER_NAME,s.DISTRICT_ID, s.DIVISION_ID, i.ITEM_TYPE,i.ITEM_NAME,
            (SELECT LOOKUPCHD_NAME FROM ssc_lookupchd WHERE LOOKUPCHD_ID = i.ITEM_TYPE) ITEM_TYPE_NAME,
            (SELECT DISTRICT_NAME FROM ssc_districts WHERE DISTRICT_ID = s.DISTRICT_ID) DISTRICT_NAME,
            (SELECT DIVISION_NAME FROM ssc_divisions WHERE DIVISION_ID = s.DIVISION_ID) DIVISION_NAME,
            (SELECT LOOKUPCHD_NAME FROM ssc_lookupchd  WHERE LOOKUPCHD_ID = s.SELLER_TYPE_ID) seller_type,
            t.QTY
            FROM ssm_customer_info s, tmm_salesmst m, tmm_itemstock t, smm_item i
            WHERE s.CUSTOMER_ID = m.CUSTOMER_ID
            AND m.SALESMST_ID = t.TRAN_NO
            AND i.ITEM_NO = t.ITEM_NO
            AND t.TRAN_FLAG = 'SD' $conditions) a
        GROUP BY a.CUSTOMER_ID ,a.TRADING_NAME,a.DISTRICT_ID, a.DIVISION_ID, a.ITEM_TYPE,
        a.ITEM_TYPE_NAME,a.TRADER_NAME,a.ITEM_NAME, a.DISTRICT_NAME, a.DIVISION_NAME, a.seller_type"));
        return $data;

    }









} //end class
