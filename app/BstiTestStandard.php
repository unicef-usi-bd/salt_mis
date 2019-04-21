<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BstiTestStandard extends Model
{
    public static function getBstiTestData(){
        return DB::table('ssm_bsti_test')
            ->first();
    }

    public static function getBstiChemicalData(){
        return DB::table('ssm_bsti_test')
            ->select('ssm_bsti_test.*')
            ->first();
    }

    public static function insertBstiTestData($request){
        return DB::table('ssm_bsti_test')->insertGetId([
            'SODIUM_CHLORIDE' => $request->input('SODIUM_CHLORIDE'),
            'MOISTURIZER' => $request->input('MOISTURIZER'),
            'PPM' => $request->input('PPM'),
            'PH' => $request->input('PH'),
            'center_id' => Auth::user()->center_id,
            'ACTIVE_FLG' => 1,
            'ENTRY_BY' => Auth::user()->id
        ]);
    }

    public static function editBstiTestData($id){
        return DB::table('ssm_bsti_test')
            ->where('BSTITEST_ID','=',$id)
            ->first();
    }

    public static function updateBstiTestData($request,$id){
        $update = DB::table('ssm_bsti_test')->where('BSTITEST_ID', '=' , $id)->update([
            'SODIUM_CHLORIDE' => $request->input('SODIUM_CHLORIDE'),
            'MOISTURIZER' => $request->input('MOISTURIZER'),
            'PPM' => $request->input('PPM'),
            'PH' => $request->input('PH'),
            'center_id' => Auth::user()->center_id,
            'ACTIVE_FLG' => 1,
            'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s"),
            'UPDATE_BY' => Auth::user()->id
        ]);

        return $update;
    }
}
