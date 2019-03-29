<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LookupGroupData extends Model
{



    public static function insertSSCLookGroupData($data){
        return DB::table('ssc_lookupchd')->insert($data);
    }

    public static function getActiveGroupDataByLookupGroup($id){
        return DB::table('lookup_group_data')
            ->select('lookup_group_data_id', 'group_data_name','group_data_abbr','description')
            ->where('lookup_group_id', '=', $id)
            ->where('active_status', '=', 1)
            ->get();
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
            'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s"),
            'UPDATE_BY' => Auth::user()->id
        ]);
    }

    public static function deleteSSCLookGroupData($id){
        return DB::table('ssc_lookupchd')->where('LOOKUPCHD_ID', $id)->delete();
    }
}
