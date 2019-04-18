<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AssociationSetup extends Model
{

    public  static function getAssociationData(){
        return DB::table('ssm_associationsetup')->get();
    }

    public static function getAssociationCenterData(){
        return DB::table('ssm_associationsetup')
            ->select('ssm_associationsetup.*')
            ->where('ssm_associationsetup.PARENT_ID','!=',0)
            ->get();
    }


    public  static function insertAssociationData($data){
        return DB::table('ssm_associationsetup')->insert($data);

    }

    public  static function editAssociationData($id){
        $editData = DB::table('ssm_associationsetup')
            ->where('ASSOCIATION_ID', '=', $id)
            ->first();
        return $editData;
    }

    public  static function updateAssociationData($id, Request $request){
        $update = DB::table('ssm_associationsetup')
            ->where('ASSOCIATION_ID', $id)
            ->update([
                'PARENT_ID' => $request->input('PARENT_ID'),
                'ASSOCIATION_NAME' => $request->input('ASSOCIATION_NAME'),
                'PARENT_ID' => $request->input('PARENT_ID'),
                'ACTIVE_FLG' => $request->input('ACTIVE_FLG'),
                'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s"),
                'UPDATE_BY' => Auth::user()->id
            ]);
        return $update;
    }

    public  static function deleteAssociationData($id){
        return DB::table('ssm_associationsetup')->where('ASSOCIATION_ID', $id)->delete();
    }
}
