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
    public static function getTotalMiller($activStatus){
        $centerId = Auth::user()->center_id;
        if($activStatus==1){

        }elseif ($activStatus==0){

        }else{
            return DB::select(DB::raw("select mi.MILL_NAME, mi.ACTIVE_FLG
                 from ssm_mill_info mi
                 where mi.center_id=2"));
        }


    }
// miller end
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









} //end class
