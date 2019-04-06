<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


class Employee extends Model
{


    public static function insertMillerEmployeeInfo($request){
        $EmployeeInfoId = DB::table('ssm_millemp_info')->insertGetId([
            'MILL_ID' => $request->input('MILL_ID'),
            'TOTMALE_EMP' => $request->input('TOTMALE_EMP'),
            'TOTFEM_EMP' => $request->input('TOTFEM_EMP'),
            'FULLTIMEMALE_EMP' => $request->input('FULLTIMEMALE_EMP'),
            'FULLTIMEFEM_EMP' => $request->input('FULLTIMEFEM_EMP'),
            'PARTTIMEMALE_EMP' => $request->input('PARTTIMEMALE_EMP'),
            'LAB_PERSON' => $request->input('LAB_PERSON'),
            'REMARKS' => $request->input('REMARKS'),
             'ENTRY_BY' => Auth::user()->id,
            'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
        ]);

        return $EmployeeInfoId;
    }



}
