<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


class Certificate extends Model
{

    public static function millerCertificateExpired($millerId){
        $expiredDate = DB::table('ssm_certificate_info as sci')
            ->where('sci.MILL_ID','=', $millerId)
            ->where('sci.CERTIFICATE_TYPE','=', 1)
            //->where('sci.IS_EXPIRE','=', 1)
            ->orderBy('sci.RENEWING_DATE','asc')
            ->pluck('sci.RENEWING_DATE')
            ->first();
        return $expiredDate;
    }

    public static function certificateInformation($millerId){
        return DB::table('ssm_certificate_info')
            ->where('MILL_ID','=', $millerId)
            ->get();
    }

    public static function getIssuerIs(){
        return DB::table('ssc_lookupchd')
            ->select('ssc_lookupchd.*')
            ->where('ssc_lookupchd.LOOKUPMST_ID','=',21)
            ->get();
    }

    public static function getAllCertificate($millerId){
        $data = DB::select(DB::raw("select sci.*,slc1.LOOKUPCHD_NAME as certificate_type,slc2.LOOKUPCHD_NAME as issuer_name from ssm_certificate_info sci
                left join ssc_lookupchd slc1 on slc1.LOOKUPCHD_ID = sci.CERTIFICATE_TYPE_ID
                left join ssc_lookupchd slc2 on slc2.LOOKUPCHD_ID = sci.ISSURE_ID
                where sci.MILL_ID = $millerId"));

        return $data;
    }
    public static function updateMillCertificateData($request,$id){
        $certificateId = DB::table('ssm_certificate_info')->where('MILL_ID', $id)->delete();

        if ($certificateId) {
            $reqTime = count($_POST['CERTIFICATE_TYPE_ID']);
            for($i=0; $i<$reqTime; $i++){
                 //file upload
                //$userImageName[$i] = '';
                if ($request->file('user_image')[$i] != null && $request->file('user_image')[$i]->isValid()) {
                    try {
                        $file = $request->file('user_image')[$i];
                        $tempName = strtolower(str_replace(' ', '', $request->input('user_image')[$i]));
                        $userImageName[$i] = $tempName . date("Y-m-d") . $i . '_' . time() . '.' . $file->getClientOriginalExtension();

                        $request->file('user_image')[$i]->move("image/user-image", $userImageName[$i]);

                    } catch (Illuminate\Filesystem\FileNotFoundException $e) {

                    }
                }
                //file upload END
                $data = ([
                    'MILL_ID' => $request->input('MILL_ID'),
                    'CERTIFICATE_TYPE_ID' => $request->input('CERTIFICATE_TYPE_ID')[$i],
                    'ISSURE_ID' => $request->input('ISSURE_ID')[$i],
                    'ISSUING_DATE' => date('Y-m-d',strtotime($request->input('ISSUING_DATE')[$i])),
                    'CERTIFICATE_NO' => $request->input('CERTIFICATE_NO')[$i],
                    'TRADE_LICENSE' => 'image/user-image/'.$userImageName[$i],
                    'RENEWING_DATE' =>date('Y-m-d',strtotime($request->input('RENEWING_DATE')[$i])),
                    'REMARKS' => $request->input('REMARKS')[$i],
                    'ENTRY_BY' => Auth::user()->id,
                    'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
                ]);
                $insert = DB::table('ssm_certificate_info')->insert($data);

            } //end for  loop
            return $insert;
        }

    }


    public static function certificateRenewalMessage($millerId){
        return DB::select(DB::raw("select lkp.LOOKUPCHD_NAME as CERTIFICATE_NAME, ci.MILL_ID,DATEDIFF(ci.RENEWING_DATE, NOW()) RENEW_DAY, ci.RENEWING_DATE, mi.MILL_NAME, mi.mill_logo
                from ssm_certificate_info ci
                left join ssc_lookupchd lkp on ci.CERTIFICATE_TYPE_ID = lkp.LOOKUPCHD_ID
                left join ssm_associationsetup ass on ass.MILL_ID = ci.MILL_ID
                left join ssm_mill_info mi on mi.MILL_ID = ci.MILL_ID
                where ci.MILL_ID = '$millerId' and ci.CERTIFICATE_TYPE =1
                order By ci.RENEWING_DATE asc"));
    }


    public static function associatonCertificate(){
        $centerId = Auth::user()->center_id;
        return DB::select(DB::raw("select lkp.LOOKUPCHD_NAME as CERTIFICATE_NAME, DATEDIFF(ci.RENEWING_DATE, NOW()) RENEW_DAY, mi.MILL_NAME, mi.mill_logo,ci.RENEWING_DATE
            from ssm_certificate_info ci
            left join ssc_lookupchd lkp on ci.CERTIFICATE_TYPE_ID = lkp.LOOKUPCHD_ID
            left join ssm_associationsetup ass on ass.MILL_ID = ci.MILL_ID
            left join ssm_mill_info mi on mi.MILL_ID = ci.MILL_ID
            where ass.center_id = $centerId and ci.IS_EXPIRE = 1 and ci.CERTIFICATE_TYPE =0
            AND ci.RENEWING_DATE >=90 AND ci.RENEWING_DATE >=60 AND ci.RENEWING_DATE >=30
            order By ci.RENEWING_DATE asc"));
    }

    public static function getCertificates($id){
        return DB::table('ssc_lookupchd as slc')
            ->select('slc.LOOKUPCHD_ID', 'LOOKUPCHD_NAME','DESCRIPTION','UD_ID', 'sc.CERTIFICATE_TYPE')
            ->leftJoin('smm_certificate as sc', 'slc.LOOKUPCHD_ID', '=', 'sc.CERTIFICATE_TYPE_ID')
            ->where('slc.LOOKUPMST_ID', '=', $id)
            ->where('slc.LOOKUPCHD_NAME','!=','Local')
            ->where('slc.ACTIVE_FLG', '=', 1)
            ->get();
    }

    public static function getCertificateByMillTypeId($certificateTypeId, $millTypeId){
        if($millTypeId == 21) {
            $condition = [19,20,21];
        }else if($millTypeId == 20){
            $condition = [20,21];
        }else{
            $condition = [19,21];
        }
        $data = DB::table('ssc_lookupchd as slc')
            ->select('slc.LOOKUPCHD_ID', 'LOOKUPCHD_NAME','DESCRIPTION','UD_ID', 'sc.CERTIFICATE_TYPE')
            ->leftJoin('smm_certificate as sc', 'slc.LOOKUPCHD_ID', '=', 'sc.CERTIFICATE_TYPE_ID')
            ->where('slc.LOOKUPMST_ID', '=', $certificateTypeId)
            ->where('slc.LOOKUPCHD_NAME','!=','Local')
            ->where('slc.ACTIVE_FLG', '=', 1)
            ->whereIn('sc.mill_type_id', $condition)
            ->whereNotNull('sc.mill_type_id');

        return $data->get();

    }

    public static function getMandatoryCertificatesRemain($certificateTypeId, $millTypeId, array $certificates = null){
        if($millTypeId == 21) {
            $condition = [19,20,21];
        }else if($millTypeId == 20){
            $condition = [20,21];
        }else{
            $condition = [19,21];
        }
        $data = DB::table('ssc_lookupchd as slc')
            ->select('slc.LOOKUPCHD_ID', 'LOOKUPCHD_NAME','DESCRIPTION','UD_ID', 'sc.CERTIFICATE_TYPE')
            ->leftJoin('smm_certificate as sc', 'slc.LOOKUPCHD_ID', '=', 'sc.CERTIFICATE_TYPE_ID')
            ->where('slc.LOOKUPMST_ID', '=', $certificateTypeId)
            ->where('sc.CERTIFICATE_TYPE', '=', 1) // Mandatory check
            ->where('slc.LOOKUPCHD_NAME','!=','Local')
            ->where('slc.ACTIVE_FLG', '=', 1) // Active check;
            ->whereIn('sc.mill_type_id', $condition)
            ->whereNotNull('sc.mill_type_id'); // Mill type null check

        if($certificates) $data->whereNotIn('slc.LOOKUPCHD_ID', $certificates); // find remain certificates
        //if($millTypeId!=21) $data->where('sc.mill_type_id', '=', $millTypeId); // both type id = 21
        return $data->pluck('LOOKUPCHD_NAME')->toArray();
    }

} //end Class


