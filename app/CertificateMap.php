<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Auth;

class CertificateMap extends Model
{
    public static function getData(){
        return DB::select(DB::raw("select scmi.*,slc.LOOKUPCHD_NAME as certificate,slc1.LOOKUPCHD_NAME as issuer from ssm_certificate_map_info scmi
                                    left join ssc_lookupchd slc on scmi.CERTIFICATE_TYPE_ID = slc.LOOKUPCHD_ID
                                    left join ssc_lookupchd slc1 on scmi.ISSURE_ID = slc1.LOOKUPCHD_ID"));
    }

    public static function insertData($data){
        return DB::table('ssm_certificate_map_info')->insert($data);
    }

    public static function editData($id){
        return DB::table('ssm_certificate_map_info')
            ->select('ssm_certificate_map_info.*')
            ->where('ssm_certificate_map_info.CERTIFICATE_MAP_ID','=',$id)
            ->first();
    }

    public static function updateData($request,$id){
        $update = DB::table('ssm_certificate_map_info')->where('CERTIFICATE_MAP_ID', '=' , $id)->update([
            'CERTIFICATE_TYPE_ID' => $request->input('CERTIFICATE_TYPE_ID'),
            'ISSURE_ID' => $request->input('ISSURE_ID'),
            'center_id' => Auth::user()->center_id,
            'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s"),
            'UPDATE_BY' => Auth::user()->id
        ]);

        return $update;
    }

    public static function deleteData($id){
        return DB::table('ssm_certificate_map_info')->where('CERTIFICATE_MAP_ID', $id)->delete();
    }

    public static function getIssuerNameByCertificateId($certificateTypeId){
        return DB::select(DB::raw("select scmi.*,slc1.LOOKUPCHD_NAME from ssm_certificate_map_info scmi
                                    left join ssc_lookupchd slc1 on scmi.ISSURE_ID = slc1.LOOKUPCHD_ID
                                    where scmi.CERTIFICATE_TYPE_ID = $certificateTypeId"));
    }
}
