<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserGroupLevel extends Model
{
    public static function getActiveUserGroupLevel($id, $orgId){
        return DB::table('sa_ug_level as sul')
            ->select('sul.UG_LEVEL_ID', 'sul.UGLEVE_NAME', 'sul.POSITIONLEVEl')
            ->where('sul.USERGRP_ID','=',$id)
            ->where('sul.ORG_ID','=',$orgId)
            ->where('sul.IS_ACTIVE','=','1')
            ->where('sul.POSITIONLEVEl','>',$id)
            ->get();
    }

    public static function getData(){
        return DB::table('permissions')->get();
    }

    public static function getActiveUGL($id){
        $userId = Auth::user()->id;
        $data = DB::table('sa_ug_level')
            ->select('UG_LEVEL_ID', 'UGLEVE_NAME')
            ->where('USERGRP_ID', '=', $id)
            ->where('IS_ACTIVE', '=', 1);
        if($userId!=1) $data = $data->where('UGLEVE_NAME', '!=', 'Super Admin');
        return $data->get();
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
            'IS_ACTIVE' => $request->input('active_status'),
            'POSITIONLEVEl' => $request->input('POSITIONLEVEl'),
            'UPDATED_BY' => auth()->user()->id,
            'UPDATED_AT' => date("Y-m-d h:i:s"),
        ]);

    }

    public static function deleteData($id){
        return DB::table('sa_ug_level')->where('UG_LEVEL_ID', $id)->delete();
    }
}
