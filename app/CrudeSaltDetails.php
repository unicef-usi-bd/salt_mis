<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


class CrudeSaltDetails extends Model
{

    public static function getAllCrudDetailsData(){
        $centerId = Auth::user()->center_id;
        $crudSaltDetails = DB::table('ssm_crud_salt_details');
        $crudSaltDetails->select('ssm_crud_salt_details.*','smm_item.ITEM_NAME');
        $crudSaltDetails->leftJoin('smm_item', 'ssm_crud_salt_details.CRUDSALT_TYPE_ID', '=', 'smm_item.ITEM_NO');

        if($centerId){
            $crudSaltDetails->where('ssm_crud_salt_details.center_id', '=', $centerId);
        }

        return $crudSaltDetails->get();
    }

    public static function insertCrudSaltDetailData($data){
        return DB::table('ssm_crud_salt_details')->insert($data);
    }

     public static function viewCrudSaltDetailData($id){
         return DB::table('ssm_crud_salt_details')
             ->select('ssm_crud_salt_details.*','smm_item.ITEM_NAME')
             ->leftJoin('smm_item', 'ssm_crud_salt_details.CRUDSALT_TYPE_ID', '=', 'smm_item.ITEM_NO')
             ->where('ssm_crud_salt_details.CRUDSALTDETAIL_ID','=',$id)
             ->first();
     }

     public static function editCrudSaltDetailData($id){
         return DB::table('ssm_crud_salt_details')
             ->select('ssm_crud_salt_details.*','smm_item.ITEM_NAME')
             ->leftJoin('smm_item', 'ssm_crud_salt_details.CRUDSALT_TYPE_ID', '=', 'smm_item.ITEM_NO')
             ->where('ssm_crud_salt_details.CRUDSALTDETAIL_ID','=',$id)
             ->first();
     }

     public static function updateCrudSaltDetailData($request,$id){
        $update = DB::table('ssm_crud_salt_details')->where('CRUDSALTDETAIL_ID', '=' , $id)->update([
            'CRUDSALT_TYPE_ID' => $request->input('CRUDSALT_TYPE_ID'),
            'SODIUM_CHLORIDE' => $request->input('SODIUM_CHLORIDE'),
            'MOISTURIZER' => $request->input('MOISTURIZER'),
            'PPM' => $request->input('PPM'),
            'PH' => $request->input('PH'),
            'center_id' => Auth::user()->center_id,
            'ACTIVE_FLG' => $request->input('ACTIVE_FLG'),
            'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s"),
            'UPDATE_BY' => Auth::user()->id
         ]);

        return $update;
     }

     public static function deleteCrudSaltDetail($id){
        return DB::table('ssm_crud_salt_details')->where('CRUDSALTDETAIL_ID', $id)->delete();
     }

}
