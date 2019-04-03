<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RequireChemicalPerKg extends Model
{
    public static function getALLRequiredPerKg(){
        return DB::table('smm_require_chemical')
            ->select('smm_require_chemical.*','smm_item.ITEM_NAME')
            ->leftJoin('smm_item', 'smm_require_chemical.ITEM_NO', '=', 'smm_item.ITEM_NO')
            ->get();
    }

    public static function insertRequiredPerKgData($data){
        return DB::table('smm_require_chemical')->insert($data);
    }

    public static function viewRequiredPerKgData($id){
        return DB::table('smm_require_chemical')
            ->select('smm_require_chemical.*','smm_item.ITEM_NAME')
            ->leftJoin('smm_item', 'smm_require_chemical.ITEM_NO', '=', 'smm_item.ITEM_NO')
            ->where('smm_require_chemical.REQUIRE_CHEMICAL_ID','=',$id)
            ->first();
    }

    public static function editRequiredPerKgData($id){
        return DB::table('smm_require_chemical')
            ->select('smm_require_chemical.*','smm_item.ITEM_NAME')
            ->leftJoin('smm_item', 'smm_require_chemical.ITEM_NO', '=', 'smm_item.ITEM_NO')
            ->where('smm_require_chemical.REQUIRE_CHEMICAL_ID','=',$id)
            ->first();
    }

    public static function updateRequiredPerKgData($request,$id){
        $update = DB::table('smm_require_chemical')->where('REQUIRE_CHEMICAL_ID', '=' , $id)->update([
            'SALT_AMOUNT' => $request->input('SALT_AMOUNT'),
            'CHEMICAL_AMOUNT' => $request->input('CHEMICAL_AMOUNT'),
            'ITEM_NO' => $request->input('ITEM_NO'),
            'WASTAGE_AMOUNT' => $request->input('WASTAGE_AMOUNT'),
            'ACTIVE_FLG' => $request->input('ACTIVE_FLG'),
            'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s"),
            'UPDATE_BY' => Auth::user()->id
        ]);

        return $update;
    }

    public static function deleteRequiredPerKgData($id){
        return DB::table('smm_require_chemical')->where('REQUIRE_CHEMICAL_ID', $id)->delete();
    }
}
