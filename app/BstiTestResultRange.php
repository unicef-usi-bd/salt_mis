<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BstiTestResultRange extends Model
{
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
            'center_id' => Auth::user()->center_id,
            'ACTIVE_FLG' => 1,
            'ENTRY_BY' => Auth::user()->id,
            'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
        ]);
    }
}
