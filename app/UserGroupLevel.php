<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserGroupLevel extends Model
{
    public static function getActiveUserGroupLevel($id, $orgId){
        return DB::table('sa_ug_level')
            ->select('UG_LEVEL_ID', 'UGLEVE_NAME', 'POSITIONLEVEl')
            ->where('USERGRP_ID','=',$id)
            ->where('ORG_ID','=',$orgId)
            ->where('IS_ACTIVE','=','1')
            ->where('POSITIONLEVEl','>',$id)
            ->get();
    }

    public static function getData(){
        return DB::table('permissions')->get();
    }

    public static function getActiveUGL($id){
        return DB::table('sa_ug_level')
            ->select('UG_LEVEL_ID', 'UGLEVE_NAME')
            ->where('USERGRP_ID', '=', $id)
            ->where('IS_ACTIVE', '=', 1)
            ->get();
    }

    public static function insertData($data){
        return DB::table('sa_ug_level')->insert($data);
    }

    public static function viewData($id){
        return DB::table('sa_ug_level')->where('UG_LEVEL_ID', '=', $id)->first();
    }

    public static function editData($id){
        return DB::table('sa_ug_level')->where('UG_LEVEL_ID', '=', $id)->first();
    }

    public static function updateData($request,$id){
        return DB::table('sa_ug_level')->where('UG_LEVEL_ID', '=' , $id)->update([
            'UGLEVE_NAME' => $request->input('group_level_name'),
            'ORG_ID' => 1,
            //'IS_ACTIVE' => $request->input('active_status'),
            'IS_ACTIVE' => 1,
            'UPDATED_BY' => auth()->user()->id,
            'UPDATED_AT' => date("Y-m-d h:i:s"),
        ]);

    }

    public static function deleteData($id){
        return DB::table('sa_ug_level')->where('UG_LEVEL_ID', $id)->delete();
    }
}
