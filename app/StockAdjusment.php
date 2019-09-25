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

    public static function insertStockAdjestment($data){
        return DB::table('stock_adjustment')->insert($data);
    }

    public static function editStockAdjustment($id){
        return DB::table('stock_adjustment')
            ->select('stock_adjustment.*')
            ->where('stock_adjustment.stock_id','=',$id)
            ->first();
    }

    public static function updateStockAdjust($request,$id){
        $update = DB::table('stock_adjustment')->where('stock_id','=',$id)->update([
            'wc_stock' => $request->input('wc_stock'),
            'iodize_stock' => $request->input('iodize_stock'),
            'center_id' => Auth::user()->center_id,
            'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s"),
            'UPDATE_BY' => Auth::user()->id
        ]);

        return $update;
    }

    public static function deleteStokAdjust($id){
        return DB::table('stock_adjustment')->where('stock_id',$id)->delete();
    }
}
