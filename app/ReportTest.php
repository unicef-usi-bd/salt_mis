<?php

namespace App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class ReportTest extends Model
{
    public static function getAdminPurchaseChemicalList($starDate,$endDate){

        return DB::select(DB::raw("select ssc_lookupchd.LOOKUPCHD_NAME, smm_item.ITEM_NO, smm_item.ITEM_NAME, tmm_itemstock.*
                                        from smm_item
                                        left join ssc_lookupchd on ssc_lookupchd.LOOKUPCHD_ID = smm_item.ITEM_TYPE
                                        left join tmm_itemstock on tmm_itemstock.ITEM_NO = smm_item.ITEM_NO
                                        where tmm_itemstock.TRAN_TYPE = 'CP'
                                        and tmm_itemstock.TRAN_FLAG = 'PR'
                                        and tmm_itemstock.TRAN_DATE between cast('$starDate' as DATE) and cast('$endDate' as DATE)
                                        "));

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
