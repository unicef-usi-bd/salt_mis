<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class RequireChemicalChd extends Model
{
    public static function getWastagePercentage($recomType, $itemNo){
        return DB::table('smm_rmallocationchd')
            ->select('smm_rmallocationchd.USE_QTY','smm_rmallocationchd.CRUDE_SALT','smm_item.ITEM_NAME')
            ->leftJoin('smm_item','smm_rmallocationchd.ITEM_ID','=','smm_item.ITEM_NO')
            ->where('smm_rmallocationchd.RMALLOMST_ID','=',$recomType)
            ->where('smm_rmallocationchd.ITEM_ID','=',$itemNo)
            ->first();
    }

    public static function insertRequireChemicalPerKgchd($data){
        return DB::table('smm_rmallocationchd')->insert($data);
    }

    public static function showRequireChemicalPerKgchd($id){
      return DB::table('smm_rmallocationchd')
          ->select('smm_rmallocationchd.*','smm_item.ITEM_NAME')
          ->leftJoin('smm_item','smm_rmallocationchd.ITEM_ID','=','smm_item.ITEM_NO')
          ->where('RMALLOCHD_ID','=',$id)
          ->first();
    }

    public static function editRequirChemicalPerKgchd($id){
        return DB::table('smm_rmallocationchd')
            ->select('smm_rmallocationchd.*','smm_item.ITEM_NAME')
            ->leftJoin('smm_item','smm_rmallocationchd.ITEM_ID','=','smm_item.ITEM_NO')
            ->where('RMALLOCHD_ID','=',$id)
            ->first();
     
    }

    public static function updateRequireChemicalPerKgchd($request,$id){
       $update = DB::table('smm_rmallocationchd')->where('RMALLOCHD_ID','=',$id)->update([
//           'RMALLOMST_ID' => $request->input('RMALLOMST_ID'),
           'ITEM_ID' => $request->input('ITEM_ID'),
           'USE_QTY' => $request->input('USE_QTY'),
           'CRUDE_SALT' => $request->input('CRUDE_SALT'),
           'ACTIVE_FLG' => $request->input('ACTIVE_FLG'),
           'UPDATE_BY' => Auth::user()->id,
           'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s")
       ]);

       return $update;
    }

    public static function deleteRequireChemicalPerKgchd($id){
        return DB::table('smm_rmallocationchd')->where('RMALLOCHD_ID', $id)->delete();
    }
}
