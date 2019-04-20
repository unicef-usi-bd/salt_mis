<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\LookupGroupData;

class LookupGroup extends Model
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

    public static function getSSCLookupData(){
        return DB::select( DB::raw("select lg.*,(select COUNT(*) from ssc_lookupchd lgd 
                        where lgd.LOOKUPMST_ID=lg.LOOKUPMST_ID)
                        as checkDelete from ssc_lookupmst lg"));
    }

     public static function insertIntoSSCLookupMst($data){
         return DB::table('ssc_lookupmst')->insert($data);
     }

     public static function viewSSCLookupMst($id){
         return DB::table('ssc_lookupmst')->where('LOOKUPMST_ID', '=', $id)->first();
     }

     public static function editSSCLookupMst($id){
         return DB::table('ssc_lookupmst')->where('LOOKUPMST_ID', '=', $id)->first();
     }

     public static function updateSSCLookupMst($request,$id){
        $update = DB::table('ssc_lookupmst')->where('LOOKUPMST_ID', '=' , $id)->update([
             'LOOKUPMST_NAME' => $request->input('LOOKUPMST_NAME'),
             'UD_SL' => $request->input('UD_SL'),
             'DESCRIPTION' => $request->input('DESCRIPTION'),
             'ACTIVE_FLG' => $request->input('ACTIVE_FLG'),
             'center_id' => Auth::user()->center_id,
             'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s"),
             'UPDATE_BY' => Auth::user()->id
         ]);

        return $update;
     }

     public static function deleteSSCLookupMst($id){
        return DB::table('ssc_lookupmst')->where('LOOKUPMST_ID', $id)->delete();
     }

}
