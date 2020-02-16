<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


class Employee extends Model
{
    public static function employeeInformation($millerId){
        $data = DB::table('ssm_millemp_info')
            ->where('MILL_ID','=', $millerId)
            ->first();
        return $data;
    }

    public static function insertEmployeeInfo($request){
        $EmployeeInfoId = DB::table('ssm_millemp_info')->insertGetId([
            'MILL_ID' => $request->input('MILL_ID'),
            'TOTMALE_EMP' => $request->input('TOTMALE_EMP'),
            'TOTFEM_EMP' => $request->input('TOTFEM_EMP'),
            'FULLTIMEMALE_EMP' => $request->input('FULLTIMEMALE_EMP'),
            'FULLTIMEFEM_EMP' => $request->input('FULLTIMEFEM_EMP'),
            'PARTTIMEMALE_EMP' => $request->input('PARTTIMEMALE_EMP'),
            'PARTTIMEFEM_EMP' => $request->input('PARTTIMEFEM_EMP'),
            'TOTMALETECH_PER' => $request->input('TOTMALETECH_PER'),
            'TOTFEMTECH_PER' => $request->input('TOTFEMTECH_PER'),
            'REMARKS' => $request->input('REMARKS'),
            'FINAL_SUBMIT_FLG' => 1,
            'center_id' => Auth::user()->center_id,
            'ENTRY_BY' => Auth::user()->id,
            'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
        ]);
        return $EmployeeInfoId;
    }

    public static function updateEmployeeInfo($request, $id){
        $update = DB::table('ssm_millemp_info')->where('MILL_ID', '=' , $id)->update([
            'TOTMALE_EMP' => $request->input('TOTMALE_EMP'),
            'TOTFEM_EMP' => $request->input('TOTFEM_EMP'),
            'FULLTIMEMALE_EMP' => $request->input('FULLTIMEMALE_EMP'),
            'FULLTIMEFEM_EMP' => $request->input('FULLTIMEFEM_EMP'),
            'PARTTIMEMALE_EMP' => $request->input('PARTTIMEMALE_EMP'),
            'PARTTIMEFEM_EMP' => $request->input('PARTTIMEFEM_EMP'),
            'TOTMALETECH_PER' => $request->input('TOTMALETECH_PER'),
            'TOTFEMTECH_PER' => $request->input('TOTFEMTECH_PER'),
            'REMARKS' => $request->input('REMARKS'),
            'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s"),
            'UPDATE_BY' => Auth::user()->id
        ]);
        return $update;
    }

    public static function updateEmployeeInfoTemp($request, $millerId){
        $inserted = DB::table('tem_ssm_millemp_info')->insertGetId([
            'MILL_ID' => $millerId,
            'MILLEMP_ID' => $request->input('MILLEMP_ID'),
            'TOTMALE_EMP' => $request->input('TOTMALE_EMP'),
            'TOTFEM_EMP' => $request->input('TOTFEM_EMP'),
            'FULLTIMEMALE_EMP' => $request->input('FULLTIMEMALE_EMP'),
            'FULLTIMEFEM_EMP' => $request->input('FULLTIMEFEM_EMP'),
            'PARTTIMEMALE_EMP' => $request->input('PARTTIMEMALE_EMP'),
            'PARTTIMEFEM_EMP' => $request->input('PARTTIMEFEM_EMP'),
            'TOTMALETECH_PER' => $request->input('TOTMALETECH_PER'),
            'TOTFEMTECH_PER' => $request->input('TOTFEMTECH_PER'),
            'REMARKS' => $request->input('REMARKS'),
            'FINAL_SUBMIT_FLG' => 1,
            'approval_status' => 0,
            'center_id' => Auth::user()->center_id,
            'ENTRY_BY' => Auth::user()->id,
            'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
        ]);
        if($inserted){
            $data = array(
                'approval_status' => 1
            );
            DB::table('ssm_millemp_info')->where('MILL_ID', '=' , $millerId)->update($data);
        }
        return $inserted;
    }

}
