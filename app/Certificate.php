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

    public static function getCertificateData($millerInfoId){
        return DB::table('ssm_certificate_info')
            ->select('ssm_certificate_info.*')
            ->where('MILL_ID','=',$millerInfoId)
            ->get();

    }

    public static function getAllCertificate($millerId){
        return DB::select(DB::raw("select sci.*,slc1.LOOKUPCHD_NAME as certificate_type,slc2.LOOKUPCHD_NAME as issuer_name from ssm_certificate_info sci
left join ssc_lookupchd slc1 on slc1.LOOKUPCHD_ID = sci.CERTIFICATE_TYPE_ID
left join ssc_lookupchd slc2 on slc2.LOOKUPCHD_ID = sci.ISSURE_ID
where sci.MILL_ID = $millerId"));
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



    public static function certificateRenewalMessage($links){

//        $centerId = Auth::user()->center_id;
//
//        $mill_id =  DB::table('ssm_associationsetup')
//        ->select('ssm_associationsetup.MILL_ID')
//        ->where('ssm_associationsetup.ASSOCIATION_ID','=',$centerId)
//        ->get();
//        return $mill_id;
        //$mill_id = MillerInfo::millId();
        //$date = date("Y-m-d", strtotime("- 30 days"));

        return DB::select(DB::raw("SELECT MILL_ID, CERTIFICATE_TYPE_ID,RENEWING_DATE,  DATEDIFF(RENEWING_DATE, NOW()) RENEW_DAY,lc.LOOKUPCHD_NAME
            FROM ssm_certificate_info
            left join ssc_lookupchd lc on lc.LOOKUPCHD_ID = ssm_certificate_info.CERTIFICATE_TYPE_ID
            WHERE MILL_ID = $links
            AND CERTIFICATE_TYPE_ID IN (34,39) 
            and lc.LOOKUPCHD_ID IN (34,39)
            AND RENEWING_DATE >=90 AND RENEWING_DATE >=60 AND RENEWING_DATE >=30"));
            }

    public static function associatonCertificate(){
        $centerId = Auth::user()->center_id;

        return DB::select(DB::raw("SELECT c.MILL_ID, c.CERTIFICATE_TYPE_ID,c.RENEWING_DATE,  DATEDIFF(c.RENEWING_DATE, NOW()) RENEW_DAY,lc.LOOKUPCHD_NAME, ass.center_id, ass.ASSOCIATION_NAME
            FROM ssm_certificate_info c
            left join ssc_lookupchd lc on lc.LOOKUPCHD_ID = c.CERTIFICATE_TYPE_ID
            left join ssm_associationsetup ass on ass.MILL_ID = c.MILL_ID
            WHERE ass.center_id = $centerId
            AND CERTIFICATE_TYPE_ID IN (34,39) 
            and lc.LOOKUPCHD_ID IN (34,39)
            AND RENEWING_DATE >=90 AND RENEWING_DATE >=60 AND RENEWING_DATE >=30;"));
    }

} //end Class


