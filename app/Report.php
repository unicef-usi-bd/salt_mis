<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


class Report extends Model
{
    public static function itemList()
    {
        return DB::table('smm_item')
            ->select('*')
            ->where('ACTIVE_FLG', '=', 1)
            ->get();
    }

    public static function getClintNameList()
    {
        $centerId = Auth::user()->center_id;
        return DB::table('ssm_customer_info')
            ->select('ssm_customer_info.*')
            ->where('ssm_customer_info.center_id', '=', $centerId)
            ->get();
    }

    public static function getFinishSaltItem()
    {
//        return DB::select(DB::raw("select i.ITEM_TYPE, i.ITEM_NAME,l.LOOKUPCHD_NAME
//       from smm_item i
//       left join ssc_lookupchd l on l.LOOKUPCHD_ID = i.ITEM_TYPE
//       where i.ITEM_TYPE = 29
//       group by i.ITEM_TYPE,i.ITEM_NAME"));
        return DB::select(DB::raw("select i.ITEM_NO,i.ITEM_NAME
        from smm_item i
        where i.ITEM_NO in (7,8)"));
    }

    public static function getAssociationList()
    {
        return DB::table('ssm_associationsetup')
            ->select('ssm_associationsetup.*', 'ssm_zonesetup.ZONE_NAME')
            ->leftJoin('ssm_zonesetup', 'ssm_associationsetup.ZONE_ID', '=', 'ssm_zonesetup.ZONE_ID')
            ->where('ssm_associationsetup.PARENT_ID', '=', 1)
            ->get();
    }

    public static function getAssociationListForUnicef()
    {
        return DB::table('ssm_associationsetup')
            ->select('ssm_associationsetup.*', 'ssm_zonesetup.ZONE_NAME')
            ->leftJoin('ssm_zonesetup', 'ssm_associationsetup.ZONE_ID', '=', 'ssm_zonesetup.ZONE_ID')
            ->where('ssm_associationsetup.PARENT_ID', '!=', 0)
            ->get();
    }

    public static function getAssociationListPdf()
    {
        return DB::table('ssm_associationsetup')
            ->select('ssm_associationsetup.*', 'ssm_zonesetup.ZONE_NAME')
            ->leftJoin('ssm_zonesetup', 'ssm_associationsetup.ZONE_ID', '=', 'ssm_zonesetup.ZONE_ID')
            ->where('ssm_associationsetup.PARENT_ID', '!=', 0)
            ->get();
    }


    public static function getMillerList($activStatus)
    {
        $centerId = Auth::user()->center_id;
        $miller = DB::table('ssm_mill_info');
        $miller->select('ssm_mill_info.*', 'ssc_lookupchd.LOOKUPCHD_NAME');
        $miller->leftJoin('ssc_lookupchd', 'ssm_mill_info.MILL_TYPE_ID', '=', 'ssc_lookupchd.LOOKUPCHD_ID');
        if ($centerId) {
            $miller->where('ssm_mill_info.center_id', '=', $centerId);
        }
        if ($activStatus == 1) {
            $miller->where('ssm_mill_info.ACTIVE_FLG', '=', 1);
        }
        if ($activStatus == 2) {
            $miller->where('ssm_mill_info.ACTIVE_FLG', '=', 0);
        }
        return $miller->get();
    }

    public static function getMonitorAssociationList()
    {
        return DB::select(DB::raw("select association2.ASSOCIATION_NAME, COUNT(smi.MILL_ID) as Total_mill from ssm_mill_info smi
                                        left join ssm_associationsetup as association on smi.center_id=association.ASSOCIATION_ID
                                        left join ssm_associationsetup as association2 on association2.PARENT_ID = 1
                                        group by association.PARENT_ID ;"));
    }


    public static function getSupplirerList()
    {
        $centerId = Auth::user()->center_id;
        $supplierList = DB::table('ssm_supplier_info as ss');
        $supplierList->select('ss.TRADING_NAME', 'ssc_divisions.DIVISION_NAME', 'tmm_itemstock.QTY');
        $supplierList->leftJoin('ssc_divisions', 'ss.DIVISION_ID', '=', 'ssc_divisions.DIVISION_ID');
        $supplierList->leftJoin('ssc_districts', 'ss.DISTRICT_ID', '=', 'ssc_districts.DISTRICT_ID');
        $supplierList->leftJoin('tmm_itemstock', 'ss.SUPP_ID_AUTO', '=', 'tmm_itemstock.SUPP_ID_AUTO');
        if ($centerId) {
            $supplierList->where('tmm_itemstock.center_id', '=', $centerId);
        }
        return $supplierList->get();
    }

    public static function getPurchaseSalteList($centerId)
    {

        $purchaseSaltList = DB::table('ssc_lookupchd')
            ->select('ssc_lookupchd.LOOKUPCHD_NAME', 'smm_item.*', 'tmm_itemstock.*')
            ->leftJoin('smm_item', 'ssc_lookupchd.LOOKUPCHD_ID', '=', 'smm_item.ITEM_TYPE')
            ->leftJoin('tmm_itemstock', 'smm_item.ITEM_NO', '=', 'tmm_itemstock.ITEM_NO')
            ->where('tmm_itemstock.TRAN_FLAG', '=', 'PR')
            ->where('tmm_itemstock.TRAN_TYPE', '=', 'SP')
            ->groupBy('tmm_itemstock.ITEM_NO');
        if ($centerId) $purchaseSaltList->where('tmm_itemstock.center_id', '=', $centerId);
        return $purchaseSaltList->get();
    }

    public static function getPurchaseSalteLists($centerId, $itemType, $starDate, $endDate)
    {

        $purchaseSaltList = DB::table('ssc_lookupchd');
        $purchaseSaltList->select('ssc_lookupchd.LOOKUPCHD_NAME', 'smm_item.*', 'tmm_itemstock.*');
        $purchaseSaltList->leftJoin('smm_item', 'ssc_lookupchd.LOOKUPCHD_ID', '=', 'smm_item.ITEM_TYPE');
        $purchaseSaltList->leftJoin('tmm_itemstock', 'smm_item.ITEM_NO', '=', 'tmm_itemstock.ITEM_NO');
        $purchaseSaltList->where('tmm_itemstock.TRAN_FLAG', '=', 'PR');
        $purchaseSaltList->where('tmm_itemstock.TRAN_TYPE', '=', 'SP');
        if ($centerId) {
            $purchaseSaltList->where('tmm_itemstock.center_id', '=', $centerId);
        }
        if ($itemType != 0) {
            $purchaseSaltList->where('smm_item.ITEM_NO', '=', $itemType);
        } else if ($starDate and $endDate) {
            $purchaseSaltList->whereBetween('tmm_itemstock.TRAN_DATE', [$starDate, $endDate]);
        }
        return $purchaseSaltList->get();
    }

    public static function getItemStock($centerId, $itemType)
    {
        $purchaseLists = DB::table('tmm_itemstock as stock')
            ->select(DB::raw("SUM(stock.QTY) as QTY"), 'items.ITEM_NAME')
            ->leftJoin('smm_item as items', 'stock.ITEM_NO', '=', 'items.ITEM_NO')
            ->leftJoin('ssc_lookupchd as slc', 'items.ITEM_TYPE', '=', 'slc.LOOKUPCHD_ID')
            ->where('stock.TRAN_FLAG', '=', 'PR')
            ->where('stock.TRAN_TYPE', '=', 'SP');
        if ($centerId) $purchaseLists->where('stock.center_id', '=', $centerId);
        if (!empty($itemType) && $itemType != 0) $purchaseLists->where('stock.ITEM_NO', '=', $itemType);
        $data = $purchaseLists->groupBy('stock.ITEM_NO')->get();
        return $data;
    }

    public static function getStockSaltForAdmin()
    {
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
                                        GROUP BY b.LOOKUPCHD_NAME, b.ITEM_NO, b.ITEM_NAME"));
    }

    public static function getStockSaltForMiller($centerId, $starDate, $endDate, $itemType)
    {
        if ($itemType == 0) {
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
                                            -- WHERE DATE(b.TRAN_DATE) BETWEEN '$starDate' AND '$endDate'
                                            -- AND  b.center_id = $centerId
                                             WHERE b.center_id = $centerId
                                        GROUP BY b.LOOKUPCHD_NAME, b.ITEM_NO, b.ITEM_NAME"));
        } else {
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
                                            AND  b.center_id = $centerId
                                            AND  b.ITEM_NO = $itemType
                                        GROUP BY b.LOOKUPCHD_NAME, b.ITEM_NO, b.ITEM_NAME"));
        }
//        return DB::select(DB::raw("select w.BATCH_NO, st.QTY,
//      case when st.TRAN_TYPE = 'W' then
//        'Wash Crash'
//      end Process_Type
//      from tmm_itemstock st
//      left join tmm_washcrashmst w on w.WASHCRASHMST_ID = st.TRAN_NO
//      -- left join tmm_iodizedmst i on i.IODIZEDMST_ID = st.TRAN_NO
//      where st.TRAN_TYPE = 'W' and st.center_id = $centerId and st.TRAN_FLAG = 'WI'
//      and Date(st.TRAN_DATE) BETWEEN '$starDate' AND '$endDate'
//      union
//      select i.BATCH_NO, st.QTY,
//      case when st.TRAN_TYPE = 'I' then
//        'Iodize'
//      end Process_Type
//      from tmm_itemstock st
//      -- left join tmm_washcrashmst w on w.WASHCRASHMST_ID = st.TRAN_NO
//      left join tmm_iodizedmst i on i.IODIZEDMST_ID = st.TRAN_NO
//      where st.TRAN_TYPE = 'I' and st.center_id  and st.TRAN_FLAG = 'II'
//      -- and Date(st.TRAN_DATE) BETWEEN '$starDate' AND '$endDate'"));
    }

    public static function getProcessStock($centerId, $starDate, $endDate)
    {
        return DB::select(DB::raw("select w.BATCH_NO, sum(st.QTY) QTY,ai.ASSOCIATION_NAME,
      case when st.TRAN_TYPE = 'W' then
        'Wash Crash'
      end Process_Type
      from tmm_itemstock st
      left join tmm_washcrashmst w on w.WASHCRASHMST_ID = st.TRAN_NO
      left join ssm_associationsetup ai on ai.ASSOCIATION_ID = st.center_id
      -- left join tmm_iodizedmst i on i.IODIZEDMST_ID = st.TRAN_NO
      where st.TRAN_TYPE = 'W' and st.center_id = $centerId and st.TRAN_FLAG IN ('WR','SD','WI')
       and Date(st.TRAN_DATE) BETWEEN '$starDate' AND '$endDate'
      union
      select i.BATCH_NO, sum(st.QTY) QTY,ai.ASSOCIATION_NAME,
      case when st.TRAN_TYPE = 'I' then
        'Iodize'
      end Process_Type
      from tmm_itemstock st
      -- left join tmm_washcrashmst w on w.WASHCRASHMST_ID = st.TRAN_NO
      left join tmm_iodizedmst i on i.IODIZEDMST_ID = st.TRAN_NO
      left join ssm_associationsetup ai on ai.ASSOCIATION_ID = st.center_id
      where st.TRAN_TYPE = 'I' and st.center_id = $centerId  and st.TRAN_FLAG IN ('II','SD')
       and Date(st.TRAN_DATE) BETWEEN '$starDate' AND '$endDate'"));
    }

    public static function getSalesItemMiller()
    {
        $centerId = Auth::user()->center_id;
        return DB::select(DB::raw("select lc.LOOKUPCHD_ID,lc.LOOKUPCHD_NAME, st.ITEM_NO,st.ITEM_NAME
            from ssc_lookupchd lc
            left join smm_item st on lc.LOOKUPCHD_ID = st.ITEM_TYPE
            left join tmm_itemstock its on its.ITEM_NO = st.ITEM_NO
            where its.center_id = $centerId
            and (its.TRAN_TYPE = 'I' or its.TRAN_TYPE = 'W' )
            and its.TRAN_FLAG = 'SD' "));
    }

    public static function getSalesItem()
    {
        return DB::select(DB::raw("select lc.LOOKUPCHD_ID,lc.LOOKUPCHD_NAME, st.ITEM_NO,st.ITEM_NAME
            from ssc_lookupchd lc
            left join smm_item st on lc.LOOKUPCHD_ID = st.ITEM_TYPE
            left join tmm_itemstock its on its.ITEM_NO = st.ITEM_NO
            where  (its.TRAN_TYPE = 'I' or its.TRAN_TYPE = 'W' )
            and its.TRAN_FLAG = 'SD' group by st.ITEM_NO"));
    }

    public static function getListofMillerLicense($centerId, $zone, $issuerId, $renawlDate, $failDate)
    {

        $listMillerLicense = DB::table('tsm_qc_info as qc');
        $listMillerLicense->select('qc.*', 'ci.*', 'lc.LOOKUPCHD_NAME as license_type', 'lch.LOOKUPCHD_NAME as issuer_name', 'im.*', 'ass.ASSOCIATION_NAME');
        $listMillerLicense->leftJoin('ssm_certificate_info as ci', 'ci.MILL_ID', '=', 'qc.MILL_ID');
        $listMillerLicense->leftJoin('ssc_lookupchd as lc', 'lc.LOOKUPCHD_ID', '=', 'ci.CERTIFICATE_TYPE_ID');
        $listMillerLicense->leftJoin('ssc_lookupchd as lch', 'lch.LOOKUPCHD_ID', '=', 'ci.ISSURE_ID');
        $listMillerLicense->leftJoin('ssm_mill_info as im', 'im.MILL_ID', '=', 'ci.MILL_ID');
        $listMillerLicense->leftJoin('ssm_associationsetup as ass', 'ass.ZONE_ID', '=', 'im.ZONE_ID');
        if ($centerId) {
            $listMillerLicense->where('qc.center_id', '=', $centerId);
        }
        if ($zone != 0) {
            $listMillerLicense->where('ass.ZONE_ID', '=', $zone);
        }
        if ($issuerId) {
            $listMillerLicense->where('ci.ISSURE_ID', '=', $issuerId);
        }
        if ($renawlDate) {
            $listMillerLicense->where('ci.RENEWING_DATE', '=', $renawlDate);
        }

        return $listMillerLicense->get();
    }

    public static function getQcReport($centerId, $zone)
    {
        $qcReports = DB::table('tmm_qualitycontrol as ql');
        $qcReports->select('ql.*', 'lc.LOOKUPCHD_NAME as quality_control_by', 'lch.LOOKUPCHD_NAME as agency_name', 'mi.MILL_NAME', 'i.BATCH_NO', 'QUALITY_CONTROL_IMAGE as file_path');
        $qcReports->leftJoin('ssc_lookupchd as lc', 'ql.QC_BY', '=', 'lc.LOOKUPCHD_ID');
        $qcReports->leftJoin('ssc_lookupchd as lch', 'ql.AGENCY_ID', '=', 'lch.LOOKUPCHD_ID');
        $qcReports->leftJoin('ssm_mill_info as mi', 'ql.center_id', '=', 'mi.center_id');
        $qcReports->leftJoin('ssm_associationsetup as ass', 'ass.ZONE_ID', '=', 'mi.ZONE_ID');
        $qcReports->leftJoin('tmm_iodizedmst as i', 'ql.BATCH_NO', '=', 'i.IODIZEDMST_ID');
        if ($centerId) {
            $qcReports->where('ql.center_id', '=', $centerId);
        }
        if ($zone != 0) {
            $qcReports->where('ass.ZONE_ID', '=', $zone);
        }

        return $qcReports->get();
    }

    public static function getPurchaseChemicalItemList($centerId)
    {
        $chemicalItemList = DB::table("smm_item");
        $chemicalItemList->select('ssc_lookupchd.LOOKUPCHD_NAME', 'smm_item.ITEM_NO', 'smm_item.ITEM_NAME', 'tmm_itemstock.*');
        $chemicalItemList->leftJoin('ssc_lookupchd', 'ssc_lookupchd.LOOKUPCHD_ID', '=', 'smm_item.ITEM_TYPE');
        $chemicalItemList->leftJoin('tmm_itemstock', 'tmm_itemstock.ITEM_NO', '=', 'smm_item.ITEM_NO');
        $chemicalItemList->Where('tmm_itemstock.TRAN_TYPE', '=', 'CP');
        $chemicalItemList->Where('tmm_itemstock.TRAN_FLAG', '=', 'PR');

        if ($centerId) {
            $chemicalItemList->Where('tmm_itemstock.center_id', '=', $centerId);
        }
        return $chemicalItemList->get();
    }

    public static function getPurchaseChemicalList($centerId, $starDate, $endDate, $itemTypeId)
    {
        $chemicalItemList = DB::table("tmm_itemstock");
        $chemicalItemList->select('tmm_itemstock.*', 'smm_item.ITEM_NO', 'smm_item.ITEM_NAME');
        $chemicalItemList->leftJoin('smm_item', 'tmm_itemstock.ITEM_NO', '=', 'smm_item.ITEM_NO');
        //$chemicalItemList->leftJoin('ssm_associationsetup','tmm_itemstock.center_id','=','ssm_associationsetup.ASSOCIATION_ID');
        $chemicalItemList->Where('tmm_itemstock.TRAN_TYPE', '=', 'CP');
        $chemicalItemList->Where('tmm_itemstock.TRAN_FLAG', '=', 'PR');

        if ($centerId) {
            $chemicalItemList->Where('tmm_itemstock.center_id', '=', $centerId);
        }
        if ($itemTypeId != 0) {
            $chemicalItemList->where('smm_item.ITEM_NO', '=', $itemTypeId);
        } else {
            $chemicalItemList->whereBetween('tmm_itemstock.TRAN_DATE', [$starDate, $endDate]);
        }
        return $chemicalItemList->get();
    }

    public static function adminChemicalStock($millTypeAdmin)
    {
        if ($millTypeAdmin == 0) {
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
                   )

        GROUP BY b.LOOKUPCHD_NAME, b.ITEM_NO, b.ITEM_NAME ;"));
        } else {
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
                   where  ass.MILL_ID = $millTypeAdmin)

        GROUP BY b.LOOKUPCHD_NAME, b.ITEM_NO, b.ITEM_NAME ;"));
        }

    }

    public static function millerChemicalStock($centerId, $starDate, $endDate)
    {
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

    public static function monitorSupplierList($starDate, $endDate)
    {
        $centerId = Auth::user()->center_id;

        return DB::select(DB::raw("select si.TRADING_NAME, si.TRADER_NAME, lc.LOOKUPCHD_NAME, it.QTY
                                          from ssm_supplier_info si
                                          left join ssc_lookupchd lc on lc.LOOKUPCHD_ID = si.SUPPLIER_TYPE_ID
                                          left join tmm_itemstock it on it.SUPP_ID_AUTO = si.SUPP_ID_AUTO
                                          WHERE DATE(it.TRAN_DATE) BETWEEN '$starDate' AND '$endDate'
                                          and it.center_id = $centerId and lc.LOOKUPCHD_ID = 42"));

    }

    public static function monitorSaltSupplierList($starDate, $endDate)
    {
        $centerId = Auth::user()->center_id;
        return DB::select(DB::raw("select si.TRADING_NAME, si.TRADER_NAME, lc.LOOKUPCHD_NAME, it.QTY
	  from ssm_supplier_info si
	  left join ssc_lookupchd lc on lc.LOOKUPCHD_ID = si.SUPPLIER_TYPE_ID
	  left join tmm_itemstock it on it.SUPP_ID_AUTO = si.SUPP_ID_AUTO
      WHERE DATE(it.TRAN_DATE) BETWEEN '$starDate' AND '$endDate'
	  AND it.center_id =$centerId and lc.LOOKUPCHD_ID = 41"));
    }

    public static function millerProcessList($centerId, $processType, $starDate, $endDate)
    {
        if ($processType == 0) {
            return DB::select(DB::raw("select w.BATCH_NO, st.QTY,
                                          case when st.TRAN_TYPE = 'W' then
                                            'Wash Crash'
                                          end Process_Type
                                          from tmm_itemstock st
                                          left join tmm_washcrashmst w on w.WASHCRASHMST_ID = st.TRAN_NO
                                          -- left join tmm_iodizedmst i on i.IODIZEDMST_ID = st.TRAN_NO
                                          where st.TRAN_TYPE = 'W' and st.center_id and st.TRAN_FLAG = 'WI' and st.TRAN_NO is not null
                                          and st.center_id = $centerId
                                          and DATE(st.TRAN_DATE) BETWEEN '$starDate' AND '$endDate'
                                          UNION
                                          select i.BATCH_NO, st.QTY,
                                          case when st.TRAN_TYPE = 'I' then
                                            'Iodize'
                                          end Process_Type
                                          from tmm_itemstock st
                                          -- left join tmm_washcrashmst w on w.WASHCRASHMST_ID = st.TRAN_NO
                                          left join tmm_iodizedmst i on i.IODIZEDMST_ID = st.TRAN_NO
                                          where st.TRAN_TYPE = 'I' and st.center_id and st.TRAN_FLAG = 'II' and st.TRAN_NO is not null
                                          and st.center_id = $centerId
                                          and DATE(st.TRAN_DATE) BETWEEN '$starDate' AND '$endDate'"));
        } elseif ($processType == 1) {
            return DB::select(DB::raw("select w.BATCH_NO, st.QTY,
                                          case when st.TRAN_TYPE = 'W' then
                                            'Wash Crash'
                                          end Process_Type
                                          from tmm_itemstock st
                                          left join tmm_washcrashmst w on w.WASHCRASHMST_ID = st.TRAN_NO
                                          -- left join tmm_iodizedmst i on i.IODIZEDMST_ID = st.TRAN_NO
                                          where st.TRAN_TYPE = 'W' and st.center_id and st.TRAN_FLAG = 'WI' and st.TRAN_NO is not null
                                          and st.center_id = $centerId
                                          and DATE(st.TRAN_DATE) BETWEEN '$starDate' AND '$endDate'"));
        } else {
            return DB::select(DB::raw("select i.BATCH_NO, st.QTY,
                                          case when st.TRAN_TYPE = 'I' then
                                            'Iodize'
                                          end Process_Type
                                          from tmm_itemstock st
                                          -- left join tmm_washcrashmst w on w.WASHCRASHMST_ID = st.TRAN_NO
                                          left join tmm_iodizedmst i on i.IODIZEDMST_ID = st.TRAN_NO
                                          where st.TRAN_TYPE = 'I' and st.center_id and st.TRAN_FLAG = 'II' and st.TRAN_NO is not null
                                          and st.center_id = $centerId
                                          and DATE(st.TRAN_DATE) BETWEEN '$starDate' AND '$endDate'"));
        }

    }

    public static function getListOfSupplierForMiller($centerId, $divisionId, $districtId, $itemType)
    {
        $condition = '';
        if (!empty($divisionId)) $condition = " and s.DIVISION_ID = $divisionId";
        if (!empty($districtId)) $condition .= " and s.DISTRICT_ID = $districtId";
        $data = DB::select(DB::raw("SELECT a.TRADING_NAME, a.supplier_type, a.DISTRICT_ID, a.DIVISION_ID, a.SUPPLIER_TYPE_ID, a.DISTRICT_NAME, a.DIVISION_NAME, SUM(a.QTY) QTY
                 FROM
                (SELECT s.TRADING_NAME,DISTRICT_ID, DIVISION_ID, s.SUPPLIER_TYPE_ID,
                (SELECT DISTRICT_NAME FROM ssc_districts WHERE DISTRICT_ID = s.DISTRICT_ID) DISTRICT_NAME,
                (SELECT DIVISION_NAME FROM ssc_divisions WHERE DIVISION_ID = s.DIVISION_ID) DIVISION_NAME,
                (SELECT LOOKUPCHD_NAME FROM ssc_lookupchd WHERE LOOKUPCHD_ID = s.SUPPLIER_TYPE_ID) supplier_type,
                (SELECT COALESCE(sum(t.QTY), 0) FROM tmm_itemstock t WHERE s.SUPP_ID_AUTO = t.SUPP_ID_AUTO
                AND t.TRAN_FLAG = 'PR' AND t.center_id = $centerId) QTY
                FROM ssm_supplier_info s where (s.center_id = $centerId) AND s.SUPPLIER_TYPE_ID=$itemType $condition
                ) a
                GROUP BY a.TRADING_NAME, a.supplier_type, a.DISTRICT_ID, a.DIVISION_ID, a.SUPPLIER_TYPE_ID, a.DISTRICT_NAME, a.DIVISION_NAME"));
        return $data;
    }

    public static function getListOfSupplierWithNmaeForMiller($centerId, $divisionId, $districtId, $itemType)
    {
        $condition = '';
        if (!empty($divisionId)) $condition = " and s.DIVISION_ID = $divisionId";
        if (!empty($districtId)) $condition .= " and s.DISTRICT_ID = $districtId";
        $data = DB::select(DB::raw("SELECT a.TRADING_NAME, a.supplier_type, a.DISTRICT_ID, a.DIVISION_ID, a.SUPPLIER_TYPE_ID, a.DISTRICT_NAME, a.DIVISION_NAME, SUM(a.QTY) QTY
                 FROM
                (SELECT s.TRADING_NAME,DISTRICT_ID, DIVISION_ID, s.SUPPLIER_TYPE_ID,
                (SELECT DISTRICT_NAME FROM ssc_districts WHERE DISTRICT_ID = s.DISTRICT_ID) DISTRICT_NAME,
                (SELECT DIVISION_NAME FROM ssc_divisions WHERE DIVISION_ID = s.DIVISION_ID) DIVISION_NAME,
                (SELECT LOOKUPCHD_NAME FROM ssc_lookupchd WHERE LOOKUPCHD_ID = s.SUPPLIER_TYPE_ID) supplier_type,
                (SELECT COALESCE(sum(t.QTY), 0) FROM tmm_itemstock t WHERE s.SUPP_ID_AUTO = t.SUPP_ID_AUTO
                AND t.TRAN_FLAG = 'PR' and t.TRAN_TYPE = 'CP' AND t.center_id = $centerId) QTY
                FROM ssm_supplier_info s where (s.center_id = $centerId or s.TRADING_NAME='BSCIC') AND s.SUPPLIER_TYPE_ID=$itemType $condition
                ) a
                GROUP BY a.TRADING_NAME, a.supplier_type, a.DISTRICT_ID, a.DIVISION_ID, a.SUPPLIER_TYPE_ID, a.DISTRICT_NAME, a.DIVISION_NAME"));
        return $data;
    }

    public static function getListofClint($centerId, $divisionId, $districtId)
    {
        $conditions = '';
        if ($divisionId) $conditions .= "and sci.DIVISION_ID = $divisionId";
        if ($districtId) $conditions .= " and sci.DISTRICT_ID = $districtId";

        $data = DB::select(DB::raw("select sci.TRADING_NAME, sci.DISTRICT_ID, sci.DIVISION_ID,dis.DISTRICT_NAME, divs.DIVISION_NAME, lc.LOOKUPCHD_NAME as seller_type, abs(tis.QTY) QTY,
                (case when (tis.TRAN_TYPE = 'W') THEN 'Wash & Crash' ELSE 'Iodized' END) as ITEM_NAME
                from ssm_customer_info sci
                left join tmm_salesmst tsm on sci.CUSTOMER_ID = tsm.CUSTOMER_ID
                left join tmm_itemstock tis on tsm.SALESMST_ID = tis.TRAN_NO
                left join ssc_divisions divs on sci.DIVISION_ID = divs.DIVISION_ID
                left join ssc_districts dis on sci.DISTRICT_ID = dis.DISTRICT_ID
                left join ssc_lookupchd lc on sci.SELLER_TYPE_ID=lc.LOOKUPCHD_ID
                where sci.center_id=$centerId and tis.stock_adjustment_id is null and tis.TRAN_FLAG = 'SD' $conditions"));
        return $data;
    }

    public static function getSaleClintList($centerId, $customerId, $itemTypeId)
    {
        $conditions = '';
        if ($customerId) $conditions .= "and s.CUSTOMER_ID = $customerId";
        if ($itemTypeId) $conditions .= " and i.ITEM_NO = $itemTypeId";
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
            AND t.TRAN_FLAG = 'SD' and s.center_id = $centerId $conditions) a
        GROUP BY a.CUSTOMER_ID ,a.TRADING_NAME,a.DISTRICT_ID, a.DIVISION_ID, a.ITEM_TYPE,
        a.ITEM_TYPE_NAME,a.TRADER_NAME,a.ITEM_NAME, a.DISTRICT_NAME, a.DIVISION_NAME, a.seller_type"));
        return $data;

    }

    public static function monitorClintMiller($centerId)
    {
        return DB::select(DB::raw(" SELECT i.item_no, i.QTY, ci.TRADER_NAME,lc.LOOKUPCHD_NAME
                FROM tmm_itemstock i, tmm_salesmst sm
                left join ssm_customer_info ci on ci.CUSTOMER_ID = sm.CUSTOMER_ID
                left join ssc_lookupchd lc on lc.LOOKUPCHD_ID = ci.SELLER_TYPE_ID
                where i.center_id = $centerId and i.TRAN_FLAG = 'SD'
                GROUP BY i.item_no, ci.TRADER_NAME,lc.LOOKUPCHD_NAME"));
    }

    public static function itemStockMiller($centerId)
    {
        /*$data = DB::select(DB::raw("select stock.BATCH_NO, abs(sum(stock.QTY)) QTY,
                (select abs(sum(stock_cs.QTY)) from tmm_itemstock stock_cs where stock_cs.ITEM_NO=stock.ITEM_NO and stock_cs.center_id=$centerId and stock_cs.TRAN_FLAG=case when stock.TRAN_TYPE = 'CP' then 'IC' when stock.TRAN_TYPE = 'SP' then 'WS'end) SOLD_QTY, ai.ASSOCIATION_NAME,
                case when stock.TRAN_TYPE = 'CP' then 'Chemical' when stock.TRAN_TYPE = 'SP' then 'Crud Salt'end LOOKUPCHD_NAME,
                 si.ITEM_NAME Process_Type
                from tmm_itemstock stock
                left join smm_item si on stock.ITEM_NO = si.ITEM_NO
                left join tmm_washcrashmst w on w.WASHCRASHMST_ID = stock.TRAN_NO
                left join ssm_associationsetup ai on ai.ASSOCIATION_ID = stock.center_id
                where stock.TRAN_FLAG='PR' and stock.center_id=$centerId group by stock.TRAN_TYPE, stock.ITEM_NO
                  union
                  select w.BATCH_NO, abs(sum(st.QTY)-(select sum(ti.WASH_CRASH_QTY *100)/(100-ti.WASTAGE) from tmm_iodizedchd ti where ti.center_id=$centerId)) QTY, (select abs(sum(wstock.QTY)) from tmm_itemstock wstock where wstock.center_id=$centerId and wstock.TRAN_TYPE = 'W' and wstock.TRAN_FLAG = 'SD') SOLD_QTY, ai.ASSOCIATION_NAME,lc.LOOKUPCHD_NAME,
                  case when st.TRAN_TYPE = 'W' then
                    'Wash Crash'
                  end Process_Type
                  from tmm_itemstock st
                  left join tmm_washcrashmst w on w.WASHCRASHMST_ID = st.TRAN_NO
                  left join ssm_associationsetup ai on ai.ASSOCIATION_ID = st.center_id
                   left join ssc_lookupchd lc on lc.LOOKUPCHD_ID = 29
                  -- left join tmm_iodizedmst i on i.IODIZEDMST_ID = st.TRAN_NO
                  where st.TRAN_TYPE = 'W' and st.center_id = $centerId and st.TRAN_FLAG = 'WI'
                  union
                  select i.BATCH_NO, abs(sum(st.QTY)) QTY,(select abs(sum(istock.QTY)) from tmm_itemstock istock where istock.center_id=$centerId and istock.TRAN_TYPE = 'I' and istock.TRAN_FLAG = 'SD') SOLD_QTY, ai.ASSOCIATION_NAME,lc.LOOKUPCHD_NAME,
                  case when st.TRAN_TYPE = 'I' then
                    'Iodize'
                  end Process_Type
                  from tmm_itemstock st
                  -- left join tmm_washcrashmst w on w.WASHCRASHMST_ID = st.TRAN_NO
                  left join tmm_iodizedmst i on i.IODIZEDMST_ID = st.TRAN_NO
                  left join ssm_associationsetup ai on ai.ASSOCIATION_ID = st.center_id
                   left join ssc_lookupchd lc on lc.LOOKUPCHD_ID = 29
                  where st.TRAN_TYPE = 'I' and st.center_id = $centerId  and st.TRAN_FLAG = 'II'
                  "));*/

//        Update Query 100820201239
        $data = DB::select(DB::raw("
                  select w.BATCH_NO, abs(sum(st.QTY)-(select sum(ti.WASH_CRASH_QTY *100)/(100-ti.WASTAGE) from tmm_iodizedchd ti where ti.center_id=$centerId)) QTY, (select abs(sum(wstock.QTY)) from tmm_itemstock wstock where wstock.center_id=$centerId and wstock.TRAN_TYPE = 'W' and wstock.TRAN_FLAG = 'SD') SOLD_QTY, ai.ASSOCIATION_NAME,lc.LOOKUPCHD_NAME,
                  case when st.TRAN_TYPE = 'W' then
                    'Wash Crash'
                  end Process_Type
                  from tmm_itemstock st
                  left join tmm_washcrashmst w on w.WASHCRASHMST_ID = st.TRAN_NO
                  left join ssm_associationsetup ai on ai.ASSOCIATION_ID = st.center_id
                   left join ssc_lookupchd lc on lc.LOOKUPCHD_ID = 29
                  -- left join tmm_iodizedmst i on i.IODIZEDMST_ID = st.TRAN_NO
                  where st.TRAN_TYPE = 'W' and st.center_id = $centerId and st.TRAN_FLAG = 'WI'
                  union
                  select i.BATCH_NO, abs(sum(st.QTY)) QTY,(select abs(sum(istock.QTY)) from tmm_itemstock istock where istock.center_id=$centerId and istock.TRAN_TYPE = 'I' and istock.TRAN_FLAG = 'SD') SOLD_QTY, ai.ASSOCIATION_NAME,lc.LOOKUPCHD_NAME,
                  case when st.TRAN_TYPE = 'I' then
                    'Iodize'
                  end Process_Type
                  from tmm_itemstock st
                  -- left join tmm_washcrashmst w on w.WASHCRASHMST_ID = st.TRAN_NO
                  left join tmm_iodizedmst i on i.IODIZEDMST_ID = st.TRAN_NO
                  left join ssm_associationsetup ai on ai.ASSOCIATION_ID = st.center_id
                   left join ssc_lookupchd lc on lc.LOOKUPCHD_ID = 29
                  where st.TRAN_TYPE = 'I' and st.center_id = $centerId  and st.TRAN_FLAG = 'II'
                  "));

        return $data;
    }

    public static function hrMillerEmployee($millerId)
    {
        return DB::select(DB::raw("select sum(mi.TOTMALE_EMP + mi.TOTFEM_EMP)Total_Employee,sum(mi.FULLTIMEMALE_EMP + mi.FULLTIMEFEM_EMP)Full_time_total_employee,
                sum(mi.PARTTIMEMALE_EMP + mi.PARTTIMEFEM_EMP)Parttime_total_employee, sum(mi.TOTMALETECH_PER + mi.TOTFEMTECH_PER)total_tech_employee
                from ssm_millemp_info mi
                where mi.MILL_ID = $millerId"));
    }

    public static function adminHrmillerEmployee()
    {
        return DB::select(DB::raw(" select me.MILL_NAME, sum(mi.TOTMALE_EMP + mi.TOTFEM_EMP)Total_Employee,sum(mi.FULLTIMEMALE_EMP + mi.FULLTIMEFEM_EMP)Full_time_total_employee,
        sum(mi.PARTTIMEMALE_EMP + mi.PARTTIMEFEM_EMP)Parttime_total_employee, sum(mi.TOTMALETECH_PER + mi.TOTFEMTECH_PER)total_tech_employee
       from ssm_mill_info me
       left join ssm_millemp_info mi on mi.MILL_ID = me.MILL_ID
       group by me.MILL_NAME"));
    }

    public static function associationListForAdmin()
    {
        return DB::select(DB::raw("SELECT b.center_id, b.ASSOCIATION_NAME, SUM(b.tot_purchase) tot_purchase,
        SUM(b.tot_chmical_pr) tot_chmical_pr, SUM(b.tot_sales) tot_sales
        FROM
            (SELECT a.center_id, (SELECT ASSOCIATION_NAME FROM ssm_associationsetup WHERE ASSOCIATION_ID = a.center_id) ASSOCIATION_NAME,
            CASE WHEN TRAN_FLAG = 'PR' AND TRAN_TYPE = 'SP' THEN
                s.qty
            END tot_purchase,

            CASE WHEN TRAN_FLAG = 'PR' AND TRAN_TYPE = 'CP' THEN
                s.qty
            END tot_chmical_pr,

            CASE WHEN TRAN_FLAG = 'SD' THEN
                s.qty
            END tot_sales

            FROM tmm_itemstock s, ssm_associationsetup a
            WHERE a.ASSOCIATION_ID = s.center_id) b
        GROUP BY b.center_id, b.ASSOCIATION_NAME	"));
    }

    public static function totalSaleAdmin($processType)
    {
        $conditions = '';
        if ($processType) $conditions .= " and i.ITEM_NO = $processType";
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

    public static function getListofMillerAdmin($zone)
    {
        if ($zone == 0) {
            return DB::select(DB::raw("SELECT b.*
         FROM
        (SELECT (SELECT ASSOCIATION_NAME FROM ssm_associationsetup WHERE ASSOCIATION_ID = a.PARENT_ID) ASSOCIATION_NAME,
        (SELECT `ASSOCIATION_ID` FROM ssm_associationsetup WHERE ASSOCIATION_ID = a.PARENT_ID) ASSOCIATION_ID,
         m.MILL_NAME, (d.TOTMALE_EMP + d.TOTFEM_EMP) tot_emp,
        (FULLTIMEMALE_EMP+FULLTIMEFEM_EMP) fulltime_emp,
        (PARTTIMEMALE_EMP+PARTTIMEFEM_EMP) parttime_enp,
        (TOTMALETECH_PER+TOTFEMTECH_PER) tot_tech_person
        FROM ssm_mill_info m, ssm_millemp_info d, ssm_associationsetup a
        WHERE m.MILL_ID = d.MILL_ID
        AND m.MILL_ID = a.MILL_ID) b group by b.MILL_NAME"));
        } else {
            return DB::select(DB::raw("SELECT b.*
         FROM
        (SELECT (SELECT ASSOCIATION_NAME FROM ssm_associationsetup WHERE ASSOCIATION_ID = a.PARENT_ID) ASSOCIATION_NAME,
        (SELECT `ASSOCIATION_ID` FROM ssm_associationsetup WHERE ASSOCIATION_ID = a.PARENT_ID) ASSOCIATION_ID,
         m.MILL_NAME, (d.TOTMALE_EMP + d.TOTFEM_EMP) tot_emp,
        (FULLTIMEMALE_EMP+FULLTIMEFEM_EMP) fulltime_emp,
        (PARTTIMEMALE_EMP+PARTTIMEFEM_EMP) parttime_enp,
        (TOTMALETECH_PER+TOTFEMTECH_PER) tot_tech_person
        FROM ssm_mill_info m, ssm_millemp_info d, ssm_associationsetup a
        WHERE m.MILL_ID = d.MILL_ID
        AND m.MILL_ID = a.MILL_ID) b
       where z.ZONE_ID = $zone group by b.MILL_NAME"));
        }

    }

    public static function getQcReportMiller($centerId)
    {
//        $qcReports = DB::table('tmm_qualitycontrol as ql');
//        $qcReports->select('ql.*','lc.LOOKUPCHD_NAME as quality_control_by','lch.LOOKUPCHD_NAME as agency_name','mi.MILL_NAME','i.BATCH_NO');
//        $qcReports->leftJoin('ssc_lookupchd as lc','ql.QC_BY','=','lc.LOOKUPCHD_ID');
//        $qcReports->leftJoin('ssc_lookupchd as lch','ql.AGENCY_ID','=','lch.LOOKUPCHD_ID');
//        $qcReports->leftJoin('ssm_mill_info as mi','ql.center_id','=','mi.center_id');
//        $qcReports->leftJoin('ssm_associationsetup as ass','ass.ZONE_ID','=','mi.ZONE_ID');
//        $qcReports->leftJoin('tmm_iodizedmst as i','ql.BATCH_NO','=','i.IODIZEDMST_ID');
//        if($centerId){
//            $qcReports->where('ql.center_id','=',$centerId);
//        }
//
//        return $qcReports->get();
        return DB::select(DB::raw("select DISTINCT *, lc.LOOKUPCHD_NAME quality_control_by, lch.LOOKUPCHD_NAME agency_name,
(select ASSOCIATION_NAME from ssm_associationsetup where ASSOCIATION_ID = ql.center_id) MILL_NAME
from tmm_qualitycontrol ql
left join ssc_lookupchd lc on lc.LOOKUPCHD_ID = ql.QC_BY
left join ssc_lookupchd lch on lch.LOOKUPCHD_ID = ql.AGENCY_ID
left join tmm_iodizedmst i on i.IODIZEDMST_ID = ql.BATCH_NO
left join ssm_mill_info mi on mi.center_id = ql.center_id
where ql.center_id =$centerId"));
    }

    public static function getProcessStockAdmin($starDate, $endDate)
    {
        $processStock = DB::table('tmm_itemstock as stock')
            ->select(DB::raw("SUM(stock.QTY) as QTY"), 'stock.TRAN_TYPE', 'LOOKUPCHD_NAME')
            ->leftJoin('smm_item as items', 'stock.ITEM_NO', '=', 'items.ITEM_NO')
            ->leftJoin('ssc_lookupchd as slc', 'items.ITEM_TYPE', '=', 'slc.LOOKUPCHD_ID')
            ->whereIn('stock.TRAN_FLAG', ['WI', 'II'])
            ->whereBetween('stock.TRAN_DATE', [$starDate, $endDate])
            ->groupBy('TRAN_FLAG')
            ->get();
        return $processStock;
    }

}
