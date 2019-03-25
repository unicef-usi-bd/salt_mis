<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class UserGroup extends Model
{

    public static function getData(){
        return DB::table('sa_user_group')->get();
    }

    public static function getActiveData(){
        return DB::table('sa_user_group')
            ->select('USERGRP_ID', 'USERGRP_NAME')
            ->where('IS_ACTIVE', '=', 1)
            ->get();
    }

    public static function getOrgActiveData($orgId){
        return DB::table('sa_user_group')
            ->select('USERGRP_ID', 'USERGRP_NAME')
            ->where('ORG_ID','=', $orgId)
            ->where('IS_ACTIVE', '=', 1)
            ->get();
    }

    public static function insertData($data){
        return DB::table('sa_user_group')->insert($data);
    }

    public static function findByName($string){
        return DB::table('roles')->where('name', '=', $string)->first();
    }

    public static function viewData($id){
        return DB::table('roles')->where('id', '=', $id)->first();
    }

    public static function editData($id){
        return DB::table('sa_user_group')->where('USERGRP_ID', '=', $id)->first();
    }

    public static function updateData($request,$id){
        return DB::table('sa_user_group')->where('USERGRP_ID', '=' , $id)->update([
            'USERGRP_NAME' => $request->input('group_name'),
            'ORG_ID' => 1,
            //'IS_ACTIVE' => $request->input('active_status'),
            'IS_ACTIVE' => 1,
            'UPDATED_BY' => auth()->user()->id,
            'UPDATED_AT' => date("Y-m-d h:i:s"),
        ]);

    }
    public static function deleteData($id){
        return DB::table('sa_user_group')->where('USERGRP_ID', $id)->delete();
    }
}
