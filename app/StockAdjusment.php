<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Auth;

class StockAdjusment extends Model
{
    public static function getData(){
        return DB::table('stock_adjustment')
            ->select('stock_adjustment.*')
            ->get();
    }

    public static function washCrushForStock($stock_adjustment_id, $amount){
        $data = array(
            'TRAN_DATE' => date('Y-m-d'),
            'TRAN_TYPE' => 'W', //W  = Washing
//            'TRAN_NO' => $washingCrushingMstId,
            'ITEM_NO' => $amount > 0 ? '2' : '7', // black salt = 2 and wash&crush = 7
            'QTY' => $amount,
            'TRAN_FLAG' => $amount > 0 ? 'WI' : 'SD', //WR = Wash Increase
            //'SUPP_ID_AUTO' => $request->input('SUPP_ID_AUTO'),
            'stock_adjustment_id' => $stock_adjustment_id,
            'center_id' => Auth::user()->center_id,
            'ENTRY_BY' => Auth::user()->id,
            'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s"));
        return DB::table('tmm_itemstock')->insert($data);
    }

    public static function iodizedForStock($stock_adjustment_id, $amount){
        $data = array(
            'TRAN_DATE' => date('Y-m-d'),
            'TRAN_TYPE' => 'I', // I=Iodized
//            'TRAN_NO' => $washingCrushingMstId,
            'ITEM_NO' => $amount > 0 ? '6' : '8', // black salt = 2 and wash&crush = 7
            'QTY' => $amount,
            'TRAN_FLAG' => $amount > 0 ? 'II' : 'SD', //II = Iodize Increase
            //'SUPP_ID_AUTO' => $request->input('SUPP_ID_AUTO'),
            'stock_adjustment_id' => $stock_adjustment_id,
            'center_id' => Auth::user()->center_id,
            'ENTRY_BY' => Auth::user()->id,
            'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s"));
        return DB::table('tmm_itemstock')->insert($data);
    }

    public static function insertStockAdjustment($data){
        return DB::table('stock_adjustment')->insertGetId($data);
    }

    public static function editStockAdjustment($id){
        return DB::table('stock_adjustment')
            ->select('stock_adjustment.*')
            ->where('stock_adjustment.stock_id','=',$id)
            ->first();
    }

    public static function updateStockAdjust($data, $id){
        $update = DB::table('stock_adjustment')->where('stock_id','=',$id)->update($data);
        return $update;
    }

    public static function getPrimaryIdByStockAdjustmentId($id){
        return DB::table('tmm_itemstock')->where('stock_adjustment_id', $id)->pluck('STOCK_NO')->toarray();
    }

    public static function deleteStockAdjust($id){
        $arrayStockId = self::getPrimaryIdByStockAdjustmentId($id);
        if($arrayStockId) DB::table('tmm_itemstock')->whereIn('STOCK_NO', $arrayStockId)->delete();
        $delete = DB::table('stock_adjustment')->where('stock_id', $id)->delete();
        return $delete;
    }
}
