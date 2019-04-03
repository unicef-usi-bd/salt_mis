<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


class SupplierProfile extends Model
{
     protected $fillable = [
        'group_name',
        'group_abbr',
        'sys_code',
        'description',
        'remarks',
        'user_define_sl',
        'active_status'
    ];

    public static function getDivision(){
        return DB::table('ssc_divisions')
            ->select('*')
            ->get();
    }
    public static function getZone(){
        return DB::table('ssm_zonesetup')
            ->select('*')
            ->get();
    }

    public static function supplierProfile(){
        return DB::table('ssm_supplier_info')
            ->select('*')
            ->get();
    }
    public static function getDistrictByAjax($id){
        return DB::table('ssc_districts')
            ->select('DISTRICT_ID', 'DISTRICT_NAME')
            ->where('DIVISION_ID', '=', $id)
            ->orderBy('DISTRICT_ID','ASC')
            ->get();
    }

    public static function getUpazilaByAjax($id){
        return DB::table('ssc_upazilas')
            ->select('UPAZILA_ID', 'UPAZILA_NAME')
            ->where('DISTRICT_ID', '=', $id)
            ->orderBy('UPAZILA_ID','ASC')
            ->get();
    }
    public static function getUnionByAjax($id){
        return DB::table('ssc_unions')
            ->select('UNION_ID', 'UNION_NAME')
            ->where('UPAZILA_ID', '=', $id)
            ->orderBy('UNION_ID','ASC')
            ->get();
    }

     public static function insertIntoSupplierProfile($data){
         return DB::table('ssm_supplier_info')->insert($data);
     }

     public static function showSupplierProfile($id){
         return DB::table('ssm_supplier_info')
             ->select('ssm_supplier_info.*', 'ssc_divisions.DIVISION_NAME','ssc_districts.DISTRICT_NAME','ssc_upazilas.UPAZILA_NAME','ssc_unions.UNION_NAME')
             ->leftjoin('ssc_divisions','ssm_supplier_info.DIVISION_ID', '=', 'ssc_divisions.DIVISION_ID')
             ->leftjoin('ssc_districts','ssm_supplier_info.DISTRICT_ID', '=', 'ssc_districts.DISTRICT_ID')
             ->leftjoin('ssc_upazilas','ssm_supplier_info.UPAZILA_ID', '=', 'ssc_upazilas.UPAZILA_ID')
             ->leftjoin('ssc_unions','ssm_supplier_info.UNION_ID', '=', 'ssc_unions.UNION_ID')
             ->where('SUPP_ID_AUTO', '=', $id)
             ->first();
     }

     public static function editSupplierProfile($id){
         return DB::table('ssm_supplier_info')
             ->select('ssm_supplier_info.*', 'ssc_divisions.DIVISION_NAME','ssc_districts.DISTRICT_NAME','ssc_upazilas.UPAZILA_NAME','ssc_unions.UNION_NAME')
             ->leftjoin('ssc_divisions','ssm_supplier_info.DIVISION_ID', '=', 'ssc_divisions.DIVISION_ID')
             ->leftjoin('ssc_districts','ssm_supplier_info.DISTRICT_ID', '=', 'ssc_districts.DISTRICT_ID')
             ->leftjoin('ssc_upazilas','ssm_supplier_info.UPAZILA_ID', '=', 'ssc_upazilas.UPAZILA_ID')
             ->leftjoin('ssc_unions','ssm_supplier_info.UNION_ID', '=', 'ssc_unions.UNION_ID')
             ->where('SUPP_ID_AUTO', '=', $id)
             ->first();
     }

     public static function updateSupplierProfileData($request,$id){
        $update = DB::table('ssm_supplier_info')->where('SUPP_ID_AUTO', '=' , $id)->update([
            'TRADING_NAME' => $request->input('TRADING_NAME'),
            'TRADER_NAME' => $request->input('TRADER_NAME'),
            //'SUPPLIER_ID' => $request->input('SUPPLIER_ID'),
            'LICENCE_NO' => $request->input('LICENCE_NO'),
            'DIVISION_ID' => $request->input('DIVISION_ID'),
            'DISTRICT_ID' => $request->input('DISTRICT_ID'),
            'UPAZILA_ID' => $request->input('UPAZILA_ID'),
            'UNION_ID' => $request->input('UNION_ID'),
            'BAZAR_NAME' => $request->input('BAZAR_NAME'),
            'PHONE' => $request->input('PHONE'),
            'EMAIL' => $request->input('EMAIL'),
            'REMARKS' => $request->input('REMARKS'),
            'ENTRY_BY' => Auth::user()->id,
            'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s"),
             'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s"),
             'UPDATE_BY' => Auth::user()->id
         ]);

       return $update;
     }

     public static function deleteSupplierProfile($id){
        return DB::table('ssm_supplier_info')->where('SUPP_ID_AUTO', $id)->delete();
     }

}
