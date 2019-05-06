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
        from tmm_itemstock it
        left join smm_item st on it.ITEM_NO = st.ITEM_NO
        left join ssc_lookupchd lc on st.ITEM_TYPE = lc.LOOKUPCHD_ID
        where it.TRAN_TYPE = 'SP' and it.TRAN_FLAG = 'PR' and it.center_id = '$centerId' "));

 }
    public static function getPurchaseSaltTotal(){
        $centerId = Auth::user()->center_id;
        return DB::select(DB::raw("select lc.LOOKUPCHD_NAME,st.ITEM_NAME,it.QTY
        from tmm_itemstock it
        left join smm_item st on it.ITEM_NO = st.ITEM_NO
        left join ssc_lookupchd lc on st.ITEM_TYPE = lc.LOOKUPCHD_ID
        where it.TRAN_TYPE = 'SP' and it.TRAN_FLAG = 'PR' and it.center_id = '$centerId' "));
    }
    public static function getPurchaseSaltTotalStock(){
        $centerId = Auth::user()->center_id;
        return DB::select(DB::raw("select lc.LOOKUPCHD_NAME,st.ITEM_NAME,it.QTY
        from tmm_itemstock it
        left join smm_item st on it.ITEM_NO = st.ITEM_NO
        left join ssc_lookupchd lc on st.ITEM_TYPE = lc.LOOKUPCHD_ID
        where it.TRAN_TYPE = 'SP' and it.TRAN_FLAG = 'PR' and it.center_id = '$centerId' "));
    }
    // purchase salt End
// purchase chemical
    public static function getPurchaseChemicalItem(){
        $centerId = Auth::user()->center_id;
        return DB::select(DB::raw("select lc.LOOKUPCHD_NAME, st.ITEM_NAME 
          from smm_item st
          left join ssc_lookupchd lc on lc.LOOKUPCHD_ID = st.ITEM_TYPE
          where st.ACTIVE_FLG and st.item_type=25; "));

    }
    public static function getPurchaseChemicalTotal(){
        $centerId = Auth::user()->center_id;
        return DB::select(DB::raw("select lc.LOOKUPCHD_NAME,it.ITEM_NAME, its.QTY 
              from tmm_itemstock its
              left join smm_item it on its.ITEM_NO = it.ITEM_NO
              left join ssc_lookupchd lc on it.ITEM_TYPE = lc.LOOKUPCHD_ID
              where its.TRAN_FLAG = 'PR' and its.TRAN_TYPE = 'CP' and its.center_id = '$centerId' "));

    }
    public static function getPurchaseChemicalTotalStock(){
        $centerId = Auth::user()->center_id;
        return DB::select(DB::raw("select lc.LOOKUPCHD_NAME,it.ITEM_NAME, its.QTY 
              from tmm_itemstock its
              left join smm_item it on its.ITEM_NO = it.ITEM_NO
              left join ssc_lookupchd lc on it.ITEM_TYPE = lc.LOOKUPCHD_ID
              where its.TRAN_FLAG = 'PR' and its.TRAN_TYPE = 'CP' and its.center_id = '$centerId' "));

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
    public static function getMillerType($activStatus){
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
          where mi.center_id = 3"));

    }










} //end class
