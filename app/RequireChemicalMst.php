<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class RequireChemicalMst extends Model
{
    public static function getRequireChemicalData(){
     return DB::table('smm_rmallocationmst')
         ->select('smm_rmallocationmst.*','smm_item.ITEM_NAME')
         ->leftJoin('smm_item','smm_rmallocationmst.PRODUCT_ID','=','smm_item.ITEM_NO')
         ->get();

    }

    public static function insertRequireChemicalPerKg($data){
        return DB::table('smm_rmallocationmst')->insert($data);
    }

    public static function showRequireChemicalPerKg($id){
        return DB::table('smm_rmallocationmst')
            ->select('smm_rmallocationmst.*','smm_item.ITEM_NAME')
            ->leftJoin('smm_item','smm_rmallocationmst.PRODUCT_ID','=','smm_item.ITEM_NO')
            ->where('RMALLOMST_ID', '=', $id)
            ->first();
    }

    public static function editRequireChemicalPerKg($id){
        return DB::table('smm_rmallocationmst')
            ->select('smm_rmallocationmst.*','smm_item.ITEM_NO','smm_item.ITEM_NAME')
            ->leftJoin('smm_item','smm_rmallocationmst.PRODUCT_ID','=','smm_item.ITEM_NO')
            ->where('RMALLOMST_ID', '=', $id)
            ->first();
    }

    public static function updateRequireChemicalPerKg($request,$id){
        $update = DB::table('smm_rmallocationmst')->where('RMALLOMST_ID','=',$id)->update([
            'PRODUCT_ID' => $request->input('PRODUCT_ID'),
            'ACTIVE_FLG' => $request->input('ACTIVE_FLG'),
            'UPDATE_BY' => Auth::user()->id,
            'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s")
        ]);

        return $update;
    }

    public static function deleteRequireChemicalPerKg($id){
        return DB::table('smm_rmallocationmst')->where('RMALLOMST_ID','=' ,$id)->delete();
    }

}
