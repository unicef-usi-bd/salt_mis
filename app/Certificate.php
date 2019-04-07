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
            ->where('MILL_ID','=',$millerInfoId)
            ->first();

    }

}
