<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LookupGroupData extends Model
{
    public static function getActiveGroupDataByLookupGroup($id){
        return DB::table('ssc_lookupchd')
            ->select('LOOKUPCHD_ID', 'LOOKUPCHD_NAME','DESCRIPTION','UD_ID')
            ->where('LOOKUPMST_ID', '=', $id)
            ->where('LOOKUPCHD_NAME','!=','Local')
            ->where('ACTIVE_FLG', '=', 1)
            ->get();
    }

    public static function getImported(){
     return DB::select(DB::raw("select * 
            from ssc_lookupchd lc
            where lc.LOOKUPCHD_NAME like '%Local'"));
    }

//    public static function getAgencyData(){
//        return DB::table('ssc_lookupchd')
//            ->select('LOOKUPCHD_ID','LOOKUPCHD_NAME')
//            ->where('')
//}

    public static function insertSSCLookGroupData($data){
        return DB::table('ssc_lookupchd')->insert($data);
    }

    public static function viewSSCLookGroupData($id){
        return DB::table('ssc_lookupchd')->where('LOOKUPCHD_ID', '=', $id)->first();
    }

    public static function editSSCLookGroupData($id){
        return  DB::table('ssc_lookupchd')->where('LOOKUPCHD_ID', '=', $id)->first();
    }

    public static function updateSSCLookGroupData($request,$id){
        return DB::table('ssc_lookupchd')->where('LOOKUPCHD_ID', '=' , $id)->update([
            'LOOKUPCHD_NAME' => $request->input('LOOKUPCHD_NAME'),
            'UD_ID' => $request->input('UD_ID'),
            'DESCRIPTION' => $request->input('DESCRIPTION'),
            'ACTIVE_FLG' => $request->input('ACTIVE_FLG'),
            'center_id' => Auth::user()->center_id,
            'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s"),
            'UPDATE_BY' => Auth::user()->id
        ]);
    }

    public static function deleteSSCLookGroupData($id){
        return DB::table('ssc_lookupchd')->where('LOOKUPCHD_ID', $id)->delete();
    }

}
