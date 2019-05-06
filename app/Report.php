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

    public static function getPurchaseSalteList($centerId,$itemType){

        $purchaseSaltList = DB::table('ssc_lookupchd');
        $purchaseSaltList->select('ssc_lookupchd.LOOKUPCHD_NAME','smm_item.*','tmm_itemstock.*');
        $purchaseSaltList->leftJoin('smm_item','ssc_lookupchd.LOOKUPCHD_ID','=','smm_item.ITEM_TYPE');
        $purchaseSaltList->leftJoin('tmm_itemstock','smm_item.ITEM_NO','=','tmm_itemstock.ITEM_NO');
        $purchaseSaltList->where('tmm_itemstock.TRAN_FLAG','=','PR');
        $purchaseSaltList->where('tmm_itemstock.TRAN_TYPE','=','SP');
        if($centerId){
            $purchaseSaltList->where('tmm_itemstock.center_id','=',$centerId);
        }
        if ($itemType == 2){
            $purchaseSaltList->where('smm_item.ITEM_NO','=',2);
        }
        if ($itemType == 3){
            $purchaseSaltList->where('smm_item.ITEM_NO','=',3);
        }
        if ($itemType == 4){
            $purchaseSaltList->where('smm_item.ITEM_NO','=',4);
        }

        return $purchaseSaltList->get();
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

    public static function getListofMillerLicense(){
        return DB::select(DB::raw(" select ci.CERTIFICATE_TYPE_ID, lc.LOOKUPCHD_NAME, ci.ISSURE_ID, lch.LOOKUPCHD_NAME, ci.ISSUING_DATE, ci.RENEWING_DATE,im.MILL_NAME, ass.ASSOCIATION_NAME, im.ACTIVE_FLG
          from tsm_qc_info qc
          left join ssm_certificate_info ci on ci.MILL_ID = qc.MILL_ID
          left join ssc_lookupchd lc on lc.LOOKUPCHD_ID = ci.CERTIFICATE_TYPE_ID
          left join ssc_lookupchd lch on lch.LOOKUPCHD_ID = ci.ISSURE_ID
          left join ssm_mill_info im on im.MILL_ID = ci.MILL_ID
          left join ssm_associationsetup ass on ass.ZONE_ID = im.ZONE_ID"));
    }

}
