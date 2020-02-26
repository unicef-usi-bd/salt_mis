<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CertificateIssur extends Model
{
    public static function getData(){
     return DB::table('smm_certificate')
         ->select('smm_certificate.*','a.LOOKUPCHD_NAME as CERTIFICATE_NAME', 'b.LOOKUPCHD_NAME as ISSUER_NAME')
         ->leftJoin('ssc_lookupchd as a','smm_certificate.CERTIFICATE_TYPE_ID','=','a.LOOKUPCHD_ID')
         ->leftJoin('ssc_lookupchd as b','smm_certificate.ISSUR_ID','=','b.LOOKUPCHD_ID')
         ->get();
    }

    public static function checkDuplicates($certificateId, $issuerId, $id=null){
        if(empty($id)){
            $data = DB::table('smm_certificate')
                ->where('CERTIFICATE_TYPE_ID' ,'=', $certificateId)
                ->where('ISSUR_ID' ,'=', $issuerId)
                ->first();
        } else{
            $data = DB::table('smm_certificate')
                ->where('CERTIFICATE_TYPE_ID' ,'=', $certificateId)
                ->where('ISSUR_ID' ,'=', $issuerId)
                ->where('CERTIFICATE_ID' ,'!=', $id)
                ->first();
        }
        return $data;
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
            ->where('smm_certificate.CERTIFICATE_ID','=',$id)
            ->first();
    }

    public static function updateCertificateIssuer($request,$id){
        $update = DB::table('smm_certificate')->where('CERTIFICATE_ID', '=' , $id)->update([
            'CERTIFICATE_TYPE_ID' => $request->input('CERTIFICATE_TYPE_ID'),
            'ISSUR_ID' => $request->input('ISSUR_ID'),
            'CERTIFICATE_TYPE' => $request->input('CERTIFICATE_TYPE') ? : 0,
            'IS_EXPIRE' => $request->input('IS_EXPIRE') ? : 0,
            'ACTIVE_FLG' => $request->input('ACTIVE_FLG'),
            'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s"),
            'UPDATE_BY' => Auth::user()->id
        ]);

        return $update;
    }

    public static function deleteCertificateData($id){
        return DB::table('smm_certificate')->where('CERTIFICATE_ID', $id)->delete();
    }

    public static function getProviderByCertificateId($id){
        return DB::table('smm_certificate')
            ->select('smm_certificate.*','a.LOOKUPCHD_NAME as CERTIFICATE_NAME', 'b.LOOKUPCHD_NAME as ISSUER_NAME')
            ->leftJoin('ssc_lookupchd as a','smm_certificate.CERTIFICATE_TYPE_ID','=','a.LOOKUPCHD_ID')
            ->leftJoin('ssc_lookupchd as b','smm_certificate.ISSUR_ID','=','b.LOOKUPCHD_ID')
            ->where('smm_certificate.CERTIFICATE_TYPE_ID', '=', $id)
            ->get();
    }

    public static function getCertificate(){
        return DB::table('smm_certificate')
            ->select('smm_certificate.*')
            ->get();
    }

    public static function hasExpired($certificateId){
        $expiredInfo = DB::table('smm_certificate')->where('CERTIFICATE_TYPE_ID', '=', $certificateId)->first();
        if($expiredInfo) return $expiredInfo->IS_EXPIRE;
        return 0;
    }

    public static function hasMendatory($certificateId){
        $expiredInfo = DB::table('smm_certificate')->where('CERTIFICATE_TYPE_ID', '=', $certificateId)->first();
        if($expiredInfo) return $expiredInfo->CERTIFICATE_TYPE;
        return 0;
    }
}
