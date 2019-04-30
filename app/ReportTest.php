<?php

namespace App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class ReportTest extends Model
{
    public static function getPurchaseChemicalList($centerId){

        $chemicalItemList = DB::table("smm_item");
        $chemicalItemList->select('ssc_lookupchd.LOOKUPCHD_NAME', 'smm_item.ITEM_NO','smm_item.ITEM_NAME','tmm_itemstock.*' );
        $chemicalItemList->leftJoin('ssc_lookupchd','ssc_lookupchd.LOOKUPCHD_ID','=','smm_item.ITEM_TYPE');
        $chemicalItemList->leftJoin('tmm_itemstock','tmm_itemstock.ITEM_NO','=','smm_item.ITEM_NO');
        $chemicalItemList->Where('tmm_itemstock.TRAN_TYPE','=','CP');
        $chemicalItemList->Where('tmm_itemstock.TRAN_FLAG','=','PR');
        if($centerId){
            $chemicalItemList->Where('ts.center_id','=',$centerId);
        }
        return $chemicalItemList->get();
    }
}
