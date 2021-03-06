<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BstiTestResultRange extends Model
{
    public static function getBstiTestResultDataRange(){
        return DB::table('ssm_bsti_test_resutl_range')
            ->first();
    }

    public static function getBstiTestResultDataRangeForPassOrFail(){
        return DB::table('ssm_bsti_test_resutl_range')
            ->select('ssm_bsti_test_resutl_range.*')
            ->first();
    }
    public static function insertBstiTestRangeData($request){
        return DB::table('ssm_bsti_test_resutl_range')->insertGetId([
            'SODIUM_CHLORIDE_MIN' => $request->input('SODIUM_CHLORIDE_MIN'),
            'SODIUM_CHLORIDE_MAX' => $request->input('SODIUM_CHLORIDE_MAX'),
            'MOISTURIZER_MIN' => $request->input('MOISTURIZER_MIN'),
            'MOISTURIZER_MAX' => $request->input('MOISTURIZER_MAX'),
            'PPM_MIN' => $request->input('PPM_MIN'),
            'PPM_MAX' => $request->input('PPM_MAX'),
            'PH_MIN' => $request->input('PH_MIN'),
            'PH_MAX' => $request->input('PH_MAX'),
            'WIM_MIN' => $request->input('WIM_MIN'),
            'WIM_MAX' => $request->input('WIM_MAX'),
            'MSWSC_MIN' => $request->input('MSWSC_MIN'),
            'MSWSC_MAX' => $request->input('MSWSC_MAX'),
            'center_id' => Auth::user()->center_id,
            'ACTIVE_FLG' => 1,
            'ENTRY_BY' => Auth::user()->id,
            'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
        ]);
    }

    public static function editBstiTestResultDataRange($id){
        return DB::table('ssm_bsti_test_resutl_range')
            ->where('BSTITEST_RESULT_ID','=',$id)
            ->first();
    }

    public static function updateBstiTestDataRang($request,$id){
        $update = DB::table('ssm_bsti_test_resutl_range')->where('BSTITEST_RESULT_ID','=',$id)->update([
            'SODIUM_CHLORIDE_MIN' => $request->input('SODIUM_CHLORIDE_MIN'),
            'SODIUM_CHLORIDE_MAX' => $request->input('SODIUM_CHLORIDE_MAX'),
            'MOISTURIZER_MIN' => $request->input('MOISTURIZER_MIN'),
            'MOISTURIZER_MAX' => $request->input('MOISTURIZER_MAX'),
            'PPM_MIN' => $request->input('PPM_MIN'),
            'PPM_MAX' => $request->input('PPM_MAX'),
            'PH_MIN' => $request->input('PH_MIN'),
            'PH_MAX' => $request->input('PH_MAX'),
            'WIM_MIN' => $request->input('WIM_MIN'),
            'WIM_MAX' => $request->input('WIM_MAX'),
            'MSWSC_MIN' => $request->input('MSWSC_MIN'),
            'MSWSC_MAX' => $request->input('MSWSC_MAX'),
            'center_id' => Auth::user()->center_id,
            'ACTIVE_FLG' => 1,
            'ENTRY_BY' => Auth::user()->id,
            'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
        ]);

        return $update;
    }
}
