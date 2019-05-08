<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


class Report extends Model
{
    public static function  itemList(){
        return DB::table('smm_item')
            ->select('*')
            ->where('ACTIVE_FLG','=',1)
            ->get();
    }

 public static function getAssociationList (){
     return DB::table('ssm_associationsetup')
         ->select('ssm_associationsetup.*','ssm_zonesetup.ZONE_NAME')
         ->leftJoin('ssm_zonesetup','ssm_associationsetup.ZONE_ID','=','ssm_zonesetup.ZONE_ID')
         ->where('ssm_associationsetup.PARENT_ID','!=',0)
         ->get();
 }

    public static function getAssociationListForUnicef (){
        return DB::table('ssm_associationsetup')
            ->select('ssm_associationsetup.*','ssm_zonesetup.ZONE_NAME')
            ->leftJoin('ssm_zonesetup','ssm_associationsetup.ZONE_ID','=','ssm_zonesetup.ZONE_ID')
            ->where('ssm_associationsetup.PARENT_ID','!=',0)
            ->get();
    }

    public static function getAssociationListPdf (){
        return DB::table('ssm_associationsetup')
            ->select('ssm_associationsetup.*','ssm_zonesetup.ZONE_NAME')
            ->leftJoin('ssm_zonesetup','ssm_associationsetup.ZONE_ID','=','ssm_zonesetup.ZONE_ID')
            ->where('ssm_associationsetup.PARENT_ID','!=',0)
            ->get();
    }



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
        if($activStatus == 2){
            $miller->where('ssm_mill_info.ACTIVE_FLG','=',0);
        }
        return $miller->get();
 }

    public static function getMonitorAssociationList(){
     return DB::select(DB::raw("select ass.ASSOCIATION_NAME, count(mi.center_id)Total_mill
                from ssm_associationsetup ass
                left join ssm_mill_info mi on mi.ZONE_ID = ass.ZONE_ID 
                where ass.PARENT_ID = 1 group by ass.ASSOCIATION_NAME"));
    }



    public static function getSupplirerList(){
    $centerId = Auth::user()->center_id;
     $supplierList = DB::table('ssm_supplier_info as ss');
     $supplierList->select('ss.TRADING_NAME','ssc_divisions.DIVISION_NAME','tmm_itemstock.QTY');
     $supplierList->leftJoin('ssc_divisions','ss.DIVISION_ID','=','ssc_divisions.DIVISION_ID');
     $supplierList->leftJoin('ssc_districts','ss.DISTRICT_ID','=','ssc_districts.DISTRICT_ID');
     $supplierList->leftJoin('tmm_itemstock','ss.SUPP_ID_AUTO','=','tmm_itemstock.SUPP_ID_AUTO');
        if($centerId){
            $supplierList->where('tmm_itemstock.center_id','=',$centerId);
        }
        return $supplierList->get();
    }

    public static function getPurchaseSalteList($centerId){

        $purchaseSaltList = DB::table('ssc_lookupchd');
        $purchaseSaltList->select('ssc_lookupchd.LOOKUPCHD_NAME','smm_item.*','tmm_itemstock.*');
        $purchaseSaltList->leftJoin('smm_item','ssc_lookupchd.LOOKUPCHD_ID','=','smm_item.ITEM_TYPE');
        $purchaseSaltList->leftJoin('tmm_itemstock','smm_item.ITEM_NO','=','tmm_itemstock.ITEM_NO');
        $purchaseSaltList->where('tmm_itemstock.TRAN_FLAG','=','PR');
        $purchaseSaltList->where('tmm_itemstock.TRAN_TYPE','=','SP');
        if($centerId){
            $purchaseSaltList->where('tmm_itemstock.center_id','=',$centerId);
        }
        return $purchaseSaltList->get();
    }

    public static function getPurchaseSalteLists($centerId,$itemType,$starDate,$endDate){

        $purchaseSaltList = DB::table('ssc_lookupchd');
        $purchaseSaltList->select('ssc_lookupchd.LOOKUPCHD_NAME','smm_item.*','tmm_itemstock.*');
        $purchaseSaltList->leftJoin('smm_item','ssc_lookupchd.LOOKUPCHD_ID','=','smm_item.ITEM_TYPE');
        $purchaseSaltList->leftJoin('tmm_itemstock','smm_item.ITEM_NO','=','tmm_itemstock.ITEM_NO');
        $purchaseSaltList->where('tmm_itemstock.TRAN_FLAG','=','PR');
        $purchaseSaltList->where('tmm_itemstock.TRAN_TYPE','=','SP');
        if($centerId){
            $purchaseSaltList->where('tmm_itemstock.center_id','=',$centerId);
        }
        if ($itemType != 0){
            $purchaseSaltList->where('smm_item.ITEM_NO','=',$itemType);
        }else if($starDate AND $endDate){
            $purchaseSaltList->whereBetween('tmm_itemstock.TRAN_DATE',[$starDate, $endDate]);
        }
        return $purchaseSaltList->get();
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

    public static function getProcessStock(){
        return DB::select(DB::raw("select w.BATCH_NO, st.QTY,
      case when st.TRAN_TYPE = 'W' then
        'Wash Crash'
      end Process_Type
      from tmm_itemstock st 
      left join tmm_washcrashmst w on w.WASHCRASHMST_ID = st.TRAN_NO
      -- left join tmm_iodizedmst i on i.IODIZEDMST_ID = st.TRAN_NO
      where st.TRAN_TYPE = 'W' and st.center_id and st.TRAN_FLAG = 'WI'
      union
      select i.BATCH_NO, st.QTY,
      case when st.TRAN_TYPE = 'I' then
        'Iodize'
      end Process_Type
      from tmm_itemstock st 
      -- left join tmm_washcrashmst w on w.WASHCRASHMST_ID = st.TRAN_NO
      left join tmm_iodizedmst i on i.IODIZEDMST_ID = st.TRAN_NO
      where st.TRAN_TYPE = 'I' and st.center_id and st.TRAN_FLAG = 'I'"));
    }

    public static function getSalesItemMiller(){
        $centerId = Auth::user()->center_id;
        return DB::select(DB::raw("select lc.LOOKUPCHD_ID,lc.LOOKUPCHD_NAME, st.ITEM_NO,st.ITEM_NAME
            from ssc_lookupchd lc
            left join smm_item st on lc.LOOKUPCHD_ID = st.ITEM_TYPE
            left join tmm_itemstock its on its.ITEM_NO = st.ITEM_NO
            where its.center_id = $centerId 
            and (its.TRAN_TYPE = 'I' or its.TRAN_TYPE = 'W' ) 
            and its.TRAN_FLAG = 'SD' "));
    }

    public static function getSalesItem(){
        return DB::select(DB::raw("select lc.LOOKUPCHD_ID,lc.LOOKUPCHD_NAME, st.ITEM_NO,st.ITEM_NAME
            from ssc_lookupchd lc
            left join smm_item st on lc.LOOKUPCHD_ID = st.ITEM_TYPE
            left join tmm_itemstock its on its.ITEM_NO = st.ITEM_NO
            where  (its.TRAN_TYPE = 'I' or its.TRAN_TYPE = 'W' ) 
            and its.TRAN_FLAG = 'SD' "));
    }

    public static function getListofMillerLicense($centerId,$zone,$issuerId){

        $listMillerLicense = DB::table('tsm_qc_info as qc');
        $listMillerLicense->select('qc.*','ci.*','lc.LOOKUPCHD_NAME as license_type','lch.LOOKUPCHD_NAME as issuer_name','im.*','ass.ASSOCIATION_NAME');
        $listMillerLicense->leftJoin('ssm_certificate_info as ci','ci.MILL_ID','=','qc.MILL_ID');
        $listMillerLicense->leftJoin('ssc_lookupchd as lc','lc.LOOKUPCHD_ID','=','ci.CERTIFICATE_TYPE_ID');
        $listMillerLicense->leftJoin('ssc_lookupchd as lch','lch.LOOKUPCHD_ID','=','ci.ISSURE_ID');
        $listMillerLicense->leftJoin('ssm_mill_info as im','im.MILL_ID','=','ci.MILL_ID');
        $listMillerLicense->leftJoin('ssm_associationsetup as ass','ass.ZONE_ID','=','im.ZONE_ID');
        if($centerId){
            $listMillerLicense->where('qc.center_id','=',$centerId);
        }
        if($zone != 0){
            $listMillerLicense->where('ass.ZONE_ID','=',$zone);
        }
        if($issuerId){
            $listMillerLicense->where('ci.ISSURE_ID','=',$issuerId);
        }
        return $listMillerLicense->get();
    }

    public static function getQcReport($centerId,$zone){
        $qcReports = DB::table('tmm_qualitycontrol as ql');
        $qcReports->select('ql.*','lc.LOOKUPCHD_NAME as quality_control_by','lch.LOOKUPCHD_NAME as agency_name','mi.*');
        $qcReports->leftJoin('ssc_lookupchd as lc','ql.QC_BY','=','lc.LOOKUPCHD_ID');
        $qcReports->leftJoin('ssc_lookupchd as lch','ql.AGENCY_ID','=','lch.LOOKUPCHD_ID');
        $qcReports->leftJoin('ssm_mill_info as mi','ql.center_id','=','mi.center_id');
        $qcReports->leftJoin('ssm_associationsetup as ass','ass.ZONE_ID','=','mi.ZONE_ID');
        if($centerId){
            $qcReports->where('ql.center_id','=',$centerId);
        }
        if($zone != 0){
            $qcReports->where('ass.ZONE_ID','=',$zone);
        }

        return $qcReports->get();
    }

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

}
