<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


class Entrepreneur extends Model
{



     public static function getMonitorData(){
        return DB::table('tsm_millmonitore')
            ->select('tsm_millmonitore.*', 'ssc_lookupchd.LOOKUPCHD_NAME')
            ->leftjoin('ssc_lookupchd','tsm_millmonitore.agency_id', '=', 'ssc_lookupchd.LOOKUPCHD_ID')
            ->orderByRaw('ssc_lookupchd.LOOKUPCHD_ID ASC')
            ->get();
    }

     public static function insertMillerProfile($request){
         $reqTime = count($_POST['OWNER_NAME']);
         for($i=0; $i<$reqTime; $i++){
             $data = ([
                 'ENTREPRENEUR_ID' => $request->input('ENTREPRENEUR_ID'),
                 'REG_TYPE_ID' => $request->input('REG_TYPE_ID'),
                 'MILL_ID' => $request->input('MILL_ID'),
                 'OWNER_TYPE_ID' => $request->input('OWNER_TYPE_ID'),
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

                 'ENTRY_BY' => Auth::user()->id,
                 'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
             ]);
             $insert = DB::table('ssm_entrepreneur_info')->insert($data);

         }
         return $insert;
     }

     public static function showMonitorData($id){
         return DB::table('tsm_millmonitore')
             ->select('tsm_millmonitore.*', 'ssc_lookupchd.LOOKUPCHD_NAME')
             ->leftjoin('ssc_lookupchd','tsm_millmonitore.agency_id', '=', 'ssc_lookupchd.LOOKUPCHD_ID')
             ->orderByRaw('ssc_lookupchd.LOOKUPCHD_ID ASC')
             ->where('MILLMONITORE_ID', '=', $id)
             ->first();
     }
    public static function agencyName ()
    {
        return DB::table('ssc_lookupchd')->where('LOOKUPMST_ID', '=', 1)->get();
    }
     public static function editMonitorData($id){
         return DB::table('tsm_millmonitore')
             ->select('tsm_millmonitore.*', 'ssc_lookupchd.LOOKUPCHD_NAME')
             ->leftjoin('ssc_lookupchd','tsm_millmonitore.agency_id', '=', 'ssc_lookupchd.LOOKUPCHD_ID')
             ->orderByRaw('ssc_lookupchd.LOOKUPCHD_ID ASC')
             ->where('MILLMONITORE_ID', '=', $id)
             ->first();
     }

     public static function updateMonitorData($request,$id){
        $update = DB::table('tsm_millmonitore')->where('MILLMONITORE_ID', '=' , $id)->update([
            'AGENCY_ID' => $request->input('AGENCY_ID'),
            'MOMITOR_DATE' =>date('Y-m-d', strtotime($request->input('MOMITOR_DATE'))),
            'REMARKS' => $request->input('REMARKS'),
             'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s"),
             'UPDATE_BY' => Auth::user()->id
         ]);

       return $update;
     }

     public static function deleteMonitorData($id){
        return DB::table('tsm_millmonitore')->where('MILLMONITORE_ID', $id)->delete();
     }
    public static function getEntrepreneurData($millerInfoId){
        return DB::table('ssm_entrepreneur_info')
            ->where('MILL_ID','=',$millerInfoId)
            ->first();

    }

}
