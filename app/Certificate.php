<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


class Certificate extends Model
{


    public static function insertMillerCertificate($request){
         $reqTime = count($_POST['CERTIFICATE_TYPE_ID']);
         for($i=0; $i<$reqTime; $i++){
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

         }
         return $insert;
     }

    public static function millerCertificateInfoByMillId($millerId){
        $data = DB::table('ssm_certificate_info')
            ->select('ssm_certificate_info.RENEWING_DATE')
            ->where('ssm_certificate_info.MILL_ID','=', $millerId)
            ->orderBy('ssm_certificate_info.RENEWING_DATE','asc')
            ->first();
        return $data;
    }

    public static function getCertificateData($millerInfoId){
        return DB::table('ssm_certificate_info')
            ->select('ssm_certificate_info.*')
            //->leftJoin('ssc_lookupchd','ssm_certificate_info.ISSURE_ID','=','ssc_lookupchd.LOOKUPCHD_ID')
            ->where('MILL_ID','=',$millerInfoId)
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



    public static function certificateRenewalMessage($millsId){
        return DB::select(DB::raw("select c.CERTIFICATE_NAME,ci.MILL_ID,DATEDIFF(ci.RENEWING_DATE,NOW()) RENEW_DAY, ci.RENEWING_DATE, mi.MILL_NAME, mi.mill_logo
            from ssm_certificate_info ci
            left join smm_certificate c on ci.CERTIFICATE_TYPE_ID = c.CERTIFICATE_ID
            left join ssm_associationsetup ass on ass.MILL_ID = ci.MILL_ID
            left join ssm_mill_info mi on mi.MILL_ID = ci.MILL_ID
            where ci.MILL_ID = $millsId and ci.IS_EXPIRE = 1 and ci.CERTIFICATE_TYPE =1
            -- and ci.RENEWING_DATE 
            AND ci.RENEWING_DATE >=90 AND ci.RENEWING_DATE >=60 AND ci.RENEWING_DATE >=30
            order By ci.RENEWING_DATE asc;"));
    }


    public static function associatonCertificate(){
        $centerId = Auth::user()->center_id;
        return DB::select(DB::raw("select c.CERTIFICATE_NAME, DATEDIFF(ci.RENEWING_DATE,NOW()) RENEW_DAY, mi.MILL_NAME, mi.mill_logo,ci.RENEWING_DATE
            from ssm_certificate_info ci
            left join smm_certificate c on ci.CERTIFICATE_TYPE_ID = c.CERTIFICATE_ID
            left join ssm_associationsetup ass on ass.MILL_ID = ci.MILL_ID
            left join ssm_mill_info mi on mi.MILL_ID = ci.MILL_ID
            where ass.center_id = $centerId and ci.IS_EXPIRE = 1 and ci.CERTIFICATE_TYPE =1
            -- and ci.RENEWING_DATE 
            AND ci.RENEWING_DATE >=90 AND ci.RENEWING_DATE >=60 AND ci.RENEWING_DATE >=30
            order By ci.RENEWING_DATE asc"));
    }

} //end Class


