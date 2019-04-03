<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    public static function getItemData(){
        return DB::table('smm_item')
            ->select('smm_item.*','ssc_lookupchd.LOOKUPCHD_NAME')
            ->leftJoin('ssc_lookupchd', 'smm_item.ITEM_TYPE', '=', 'ssc_lookupchd.lookupchd_ID')
            ->get();
    }

    public static function insertItemData($data){
        return DB::table('smm_item')->insert($data);
    }

    public static function viewItemData($id){
        return DB::table('smm_item')
            ->select('smm_item.*','ssc_lookupchd.LOOKUPCHD_NAME')
            ->leftJoin('ssc_lookupchd', 'smm_item.ITEM_TYPE', '=', 'ssc_lookupchd.lookupchd_ID')
            ->where('smm_item.ITEM_NO','=',$id)
            ->first();
    }

    public static function editItemData($id){
        return DB::table('smm_item')
            ->select('smm_item.*','ssc_lookupchd.LOOKUPCHD_NAME')
            ->leftJoin('ssc_lookupchd', 'smm_item.ITEM_TYPE', '=', 'ssc_lookupchd.lookupchd_ID')
            ->where('smm_item.ITEM_NO','=',$id)
            ->first();
    }

    public static function updateItemData($request,$id){
        $update = DB::table('smm_item')->where('ITEM_NO', '=' , $id)->update([
            'ITEM_TYPE' => $request->input('ITEM_TYPE'),
            'ITEM_NAME' => $request->input('ITEM_NAME'),
            'ACTIVE_FLG' => $request->input('ACTIVE_FLG'),
            'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s"),
            'UPDATE_BY' => Auth::user()->id
        ]);

        return $update;
    }

    public static function deleteItemData($id){
        return DB::table('smm_item')->where('ITEM_NO', $id)->delete();
    }
}
