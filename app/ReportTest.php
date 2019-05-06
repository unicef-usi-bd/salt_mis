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

    public static function monitorSupplierList(){
        $centerId = Auth::user()->center_id;

        return DB::raw(DB::select("select si.TRADING_NAME, si.TRADER_NAME, lc.LOOKUPCHD_NAME, it.QTY
                                          from ssm_supplier_info si
                                          left join ssc_lookupchd lc on lc.LOOKUPCHD_ID = si.SUPPLIER_TYPE_ID
                                          left join tmm_itemstock it on it.SUPP_ID_AUTO = si.SUPP_ID_AUTO
                                          where it.center_id = $centerId"));
    }

}
