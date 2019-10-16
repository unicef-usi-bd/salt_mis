<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CertificateIssur extends Model
{
    public static function getData(){
     return DB::table('smm_certificate')
         ->select('smm_certificate.*','ssc_lookupchd.LOOKUPCHD_NAME')
         ->leftJoin('ssc_lookupchd','smm_certificate.ISSUR_ID','=','ssc_lookupchd.LOOKUPCHD_ID')
         ->get();
    }

    public static function getIssuer(){
        return DB::table('ssc_lookupchd')
            ->select('ssc_lookupchd.*')
            ->where('ssc_lookupchd.LOOKUPMST_ID' ,'=',21)
            ->get();
    }

    public static function insertItemData($data){
        return DB::table('smm_certificate')->insert($data);
    }

    public static function viewData($id){
        return DB::table('smm_certificate')
            ->select('smm_certificate.*','ssc_lookupchd.LOOKUPCHD_NAME')
            ->leftJoin('ssc_lookupchd','smm_certificate.ISSUR_ID','=','ssc_lookupchd.LOOKUPCHD_ID')
            ->where('smm_certificate.CERTIFICATE_ID','=',$id)
            ->first();
    }

    public static function editData($id){
        return DB::table('smm_certificate')
            ->select('smm_certificate.*','ssc_lookupchd.LOOKUPCHD_NAME')
            ->leftJoin('ssc_lookupchd','smm_certificate.ISSUR_ID','=','ssc_lookupchd.LOOKUPCHD_ID')
            ->where('smm_certificate.CERTIFICATE_ID','=',$id)
            ->first();
    }

    public static function getIssuerId($id){
        return DB::table('ssc_lookupchd')
            ->select('ssc_lookupchd.*','smm_certificate.*')
            ->leftJoin('smm_certificate','ssc_lookupchd.LOOKUPCHD_ID','=','smm_certificate.ISSUR_ID')
            ->where('ssc_lookupchd.LOOKUPMST_ID' ,'=',21)
            ->where('smm_certificate.CERTIFICATE_ID','=',$id)
            ->get();
    }

    public static function updateCertificateIssuer($request,$id){
        $update = DB::table('smm_certificate')->where('CERTIFICATE_ID', '=' , $id)->update([
            'CERTIFICATE_NAME' => $request->input('CERTIFICATE_NAME'),
            'ISSUR_ID' => $request->input('ISSUR_ID'),
            'CERTIFICATE_TYPE' => $request->input('CERTIFICATE_TYPE')?:0,
            'IS_EXPIRE' => $request->input('IS_EXPIRE')?:0,
            'ACTIVE_FLG' => $request->input('ACTIVE_FLG'),
            'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s"),
            'UPDATE_BY' => Auth::user()->id
        ]);

        return $update;
    }

    public static function deleteCertificateData($id){
        return DB::table('smm_certificate')->where('CERTIFICATE_ID', $id)->delete();
    }

    public static function getCertificate(){
        return DB::table('smm_certificate')
            ->select('smm_certificate.*')
            //->leftJoin('ssm_certificate_info','smm_certificate.CERTIFICATE_ID','=','ssm_certificate_info.CERTIFICATE_TYPE_ID')
            ->get();
    }

    public static function getIssuerByAjax(){
        return DB::table('ssc_lookupchd')
            ->select('ssc_lookupchd.*')
            ->where('ssc_lookupchd.LOOKUPMST_ID', '=', 21)
            ->orderBy('ssc_lookupchd.LOOKUPCHD_ID','ASC')
            ->get();
    }

    public static function getCertificateInfoByID($id){
        return DB::table('smm_certificate')
            ->select('smm_certificate.*')
            ->where('smm_certificate.CERTIFICATE_ID', '=', $id)
            ->first();
    }
}
