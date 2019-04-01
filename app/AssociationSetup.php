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


    public  static function insertAssociationData($data){
        return DB::table('ssm_associationsetup')->insert($data);

    }

    public  static function editAssociationData($id){
        $editData = DB::table('ssm_associationsetup')
            ->where('ASSOCIATION_ID', '=', $id)
            ->first();
        return $editData;
    }

//    public  static function updateAssociationData($id, Request $request){
//        $update = DB::table('ssm_associationsetup')
//            ->where('ASSOCIATION_ID', $id)
//            ->update([
//                'cost_center_type' => $request->input('cost_center_type'),
//                'cost_center_status_type' => $request->input('cost_center_status_type'),
//                'cost_center_name' => $request->input('cost_center_name'),
//                'bank_id' => $request->input('bank_id'),
//                'branch_id' => $request->input('branch_id'),
//                'account_no' => $request->input('account_no'),
//                'route_no' => $request->input('route_no'),
//                'active_status' => $request->input('active_status'),
//                'update_by' => Auth::user()->id,
//                'update_at' => date("Y-m-d h:i:s")
//            ]);
//        return $update;
//    }

    public  static function deleteAssociationData($id){
        return DB::table('ssm_associationsetup')->where('ASSOCIATION_ID', $id)->delete();
    }
}
