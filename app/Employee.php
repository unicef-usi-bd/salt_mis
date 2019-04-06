<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


class Employee extends Model
{


    public static function insertMillerEmployeeInfo($request){
        $EmployeeInfoId = DB::table('tsm_qc_info')->insertGetId([
            'MILL_ID' => $request->input('MILL_ID'),
            'LABORATORY_FLG' => $request->input('LABORATORY_FLG'),
            'SOP_DESC' => $request->input('SOP_DESC'),
            'IODINE_CHECK_FLG' => $request->input('IODINE_CHECK_FLG'),
            'MONITORING_FLG' => $request->input('MONITORING_FLG'),
            'LAB_MAN_FLG' => $request->input('LAB_MAN_FLG'),
            'LAB_PERSON' => $request->input('LAB_PERSON'),
            'REMARKS' => $request->input('REMARKS'),
             'ENTRY_BY' => Auth::user()->id,
            'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
        ]);

        return $EmployeeInfoId;
    }



}
