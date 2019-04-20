<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


class Monitoring extends Model
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

    public static function getMonitorData(){
        return DB::table('tsm_millmonitore')
            ->select('tsm_millmonitore.*', 'ssc_lookupchd.LOOKUPCHD_NAME')
            ->leftjoin('ssc_lookupchd','tsm_millmonitore.agency_id', '=', 'ssc_lookupchd.LOOKUPCHD_ID')
            ->where('tsm_millmonitore.center_id','=',Auth::user()->center_id)
            ->orderByRaw('ssc_lookupchd.LOOKUPCHD_ID ASC')
            ->get();
    }

     public static function insertIntoMonitor($data){
         return DB::table('tsm_millmonitore')->insert($data);
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
            'center_id' => Auth::user()->center_id,
            'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s"),
            'UPDATE_BY' => Auth::user()->id
         ]);

       return $update;
     }

     public static function deleteMonitorData($id){
        return DB::table('tsm_millmonitore')->where('MILLMONITORE_ID', $id)->delete();
     }

}
