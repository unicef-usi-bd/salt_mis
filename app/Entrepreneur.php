<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


class Entrepreneur extends Model
{
    public static function insertEntrepreneurInfo($request){ // tested
         $reqTime = count($_POST['OWNER_NAME']);
         for($i=0; $i<$reqTime; $i++){
             $data = ([
                 'ENTREPRENEUR_ID' => $request->input('ENTREPRENEUR_ID'),
                 //'REG_TYPE_ID' => $request->input('REG_TYPE_ID'),
                 'MILL_ID' => $request->input('MILL_ID'),
                 //'OWNER_TYPE_ID' => $request->input('OWNER_TYPE_ID'),
                 'OWNER_NAME' => $request->input('OWNER_NAME')[$i],
                 'DIVISION_ID' => $request->input('DIVISION_ID')[$i],
                 'DISTRICT_ID' => $request->input('DISTRICT_ID')[$i],
                 'UPAZILA_ID' => $request->input('UPAZILA_ID')[$i],
                 'UNION_ID' => $request->input('UNION_ID')[$i],
                 'NID' => $request->input('NID')[$i],
                 'MOBILE_1' => $request->input('MOBILE_1')[$i],
                 'MOBILE_2' => $request->input('MOBILE_2')[$i],
                 'EMAIL' => $request->input('EMAIL')[$i],
                 'REMARKS' => $request->input('REMARKS')[$i],
                 'ACTIVE_FLG' => 1,
                 'center_id' => Auth::user()->center_id,
                 'ENTRY_BY' => Auth::user()->id,
                 'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
             ]);
             $insert = DB::table('ssm_entrepreneur_info')->insert($data);
         }
         return $insert;
     }

    public static function updateEntrepreneurInfo($request, $millerId){ // tested
         $data = array();
         DB::table('ssm_entrepreneur_info')->where('MILL_ID', $millerId)->delete();
        $reqTime = count($request->input('OWNER_NAME'));
        for($i=0; $i<$reqTime; $i++){
            $data[] = array(
                'MILL_ID' => $millerId,
                'OWNER_NAME' => $request->input('OWNER_NAME')[$i],
                'DIVISION_ID' => $request->input('DIVISION_ID')[$i],
                'DISTRICT_ID' => $request->input('DISTRICT_ID')[$i],
                'UPAZILA_ID' => $request->input('UPAZILA_ID')[$i],
                'UNION_ID' => $request->input('UNION_ID')[$i],
                'NID' => $request->input('NID')[$i],
                'MOBILE_1' => $request->input('MOBILE_1')[$i],
                'MOBILE_2' => $request->input('MOBILE_2')[$i],
                'EMAIL' => $request->input('EMAIL')[$i],
                'REMARKS' => $request->input('REMARKS')[$i],
                'ACTIVE_FLG' => 1,
                'center_id' => Auth::user()->center_id,
                'ENTRY_BY' => Auth::user()->id,
                'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
            );
        }
         $updated = DB::table('ssm_entrepreneur_info')->insert($data);
         return $updated;
     }

     public static function entrepreneurInformation($millerId){
         return DB::table('ssm_entrepreneur_info')
             ->where('MILL_ID','=', $millerId)
             ->get();
     }

    public static function updateEntrepreneurInfoTemp($request, $millerId){
         $data = array();
        $reqTime = count($_POST['OWNER_NAME']);
        for($i=0; $i<$reqTime; $i++){
            $data[] = array(
                'ENTREPRENEUR_ID' => $request->input('ENTREPRENEUR_ID'),
                //'REG_TYPE_ID' => $request->input('REG_TYPE_ID'),
                'MILL_ID' => $millerId,
                'OWNER_NAME' => $request->input('OWNER_NAME')[$i],
                'DIVISION_ID' => $request->input('DIVISION_ID')[$i],
                'DISTRICT_ID' => $request->input('DISTRICT_ID')[$i],
                'UPAZILA_ID' => $request->input('UPAZILA_ID')[$i],
                'UNION_ID' => $request->input('UNION_ID')[$i],
                'NID' => $request->input('NID')[$i],
                'MOBILE_1' => $request->input('MOBILE_1')[$i],
                'MOBILE_2' => $request->input('MOBILE_2')[$i],
                'EMAIL' => $request->input('EMAIL')[$i],
                'REMARKS' => $request->input('REMARKS')[$i],
                'ACTIVE_FLG' => 1,
                'approval_status' => 0,
                'center_id' => Auth::user()->center_id,
                'ENTRY_BY' => Auth::user()->id,
                'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
            );
        }
        $inserted = DB::table('tem_ssm_entrepreneur_info')->insert($data);
        if($inserted){
            $status = array(
                'approval_status' => 1
            );
            DB::table('ssm_entrepreneur_info')->where('MILL_ID', '=' , $millerId)->update($status);
        }
        return $inserted;
    }

    public static function getEntrepreneurData($millerInfoId){
        return DB::table('ssm_entrepreneur_info')
            ->select('ssm_entrepreneur_info.*','ssc_districts.*','ssc_upazilas.*','ssc_unions.*')
            ->leftJoin('ssc_districts','ssm_entrepreneur_info.DISTRICT_ID','=','ssc_districts.DISTRICT_ID')
            ->leftJoin('ssc_upazilas','ssm_entrepreneur_info.UPAZILA_ID','=','ssc_upazilas.UPAZILA_ID')
            ->leftJoin('ssc_unions','ssm_entrepreneur_info.UNION_ID','=','ssc_unions.UNION_ID')
            ->where('MILL_ID','=',$millerInfoId)
            ->first();

    }
    public static function getEntrepreneurRowData($millerInfoId){
        return DB::table('ssm_entrepreneur_info')
            ->select('ssm_entrepreneur_info.*','ssc_districts.*','ssc_upazilas.*','ssc_unions.*')
            ->leftJoin('ssc_districts','ssm_entrepreneur_info.DISTRICT_ID','=','ssc_districts.DISTRICT_ID')
            ->leftJoin('ssc_upazilas','ssm_entrepreneur_info.UPAZILA_ID','=','ssc_upazilas.UPAZILA_ID')
            ->leftJoin('ssc_unions','ssm_entrepreneur_info.UNION_ID','=','ssc_unions.UNION_ID')
            ->where('MILL_ID','=',$millerInfoId)
            ->get();

    }

    public static function showEntrepreneurProfile($id){
        return DB::table('ssm_mill_info')
            ->select('ssm_mill_info.*','ssm_entrepreneur_info.*','ssc_divisions.*','ssc_districts.*','ssc_upazilas.*','ssc_unions.*','ssc_lookupchd.*')
            ->leftJoin('ssm_entrepreneur_info','ssm_mill_info.MILL_ID','=','ssm_entrepreneur_info.MILL_ID')
            ->leftJoin('ssc_divisions','ssm_entrepreneur_info.DIVISION_ID','=','ssc_divisions.DIVISION_ID')
            ->leftJoin('ssc_districts','ssm_entrepreneur_info.DISTRICT_ID','=','ssc_districts.DISTRICT_ID')
            ->leftJoin('ssc_upazilas','ssm_entrepreneur_info.UPAZILA_ID','=','ssc_upazilas.UPAZILA_ID')
            ->leftJoin('ssc_unions','ssm_entrepreneur_info.UNION_ID','=','ssc_unions.UNION_ID')
            ->leftJoin('ssc_lookupchd','ssm_entrepreneur_info.REG_TYPE_ID','=','ssc_lookupchd.LOOKUPCHD_ID')
            ->where('ssm_mill_info.MILL_ID','=',$id)
            ->first();
    }

}
