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
        $centerId = Auth::user()->center_id;
//        $associationMiller = DB::table('ssm_associationsetup');
//        $associationMiller ->select('ssm_associationsetup.*','count(ssm_mill_info.MILL_NAME) as miller_number');
//        $associationMiller->leftJoin('ssm_mill_info','ssm_associationsetup.MILL_ID','=','ssm_mill_info.MILL_ID');
//        $associationMiller->where('ssm_associationsetup.PARENT_ID','!=',0);
//       if($centerId){
//           $associationMiller->where('ssm_mill_info.center_id','=',$centerId);
//       }
//
//    return $associationMiller->get();

    return DB::select(DB::raw(" select ass.ASSOCIATION_NAME, count(mi.MILL_NAME)Mill_Number 
                      from ssm_associationsetup ass
                      left join ssm_mill_info mi on mi.MILL_ID = ass.MILL_ID
                      where ass.PARENT_ID != 0 and ass.center_id= $centerId"));
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



}
