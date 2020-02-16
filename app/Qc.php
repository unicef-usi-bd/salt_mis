<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


class Qc extends Model
{
    public static function insertQcInfo($request){
        $QcInfoId = DB::table('tsm_qc_info')->insertGetId([
            'MILL_ID' => $request->input('MILL_ID'),
            'LABORATORY_FLG' => $request->input('LABORATORY_FLG'),
            'SOP_DESC' => $request->input('SOP_DESC'),
            'IODINE_CHECK_FLG' => $request->input('IODINE_CHECK_FLG'),
            'MONITORING_FLG' => $request->input('MONITORING_FLG'),
            'LAB_MAN_FLG' => $request->input('LAB_MAN_FLG'),
            'LAB_PERSON' => $request->input('LAB_PERSON'),
            'REMARKS' => $request->input('REMARKS'),
            'center_id' => Auth::user()->center_id,
             'ENTRY_BY' => Auth::user()->id,
            'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
        ]);

        return $QcInfoId;
    }
    public static function qcInfo($millerId){
        return DB::table('tsm_qc_info')
            ->where('MILL_ID','=', $millerId)
            ->first();

    }

    public static function updateQcInfo($request, $millerId){
        $update = DB::table('tsm_qc_info')->where('MILL_ID', '=' , $millerId)->update([
            'LABORATORY_FLG' => $request->input('LABORATORY_FLG'),
            'SOP_DESC' => $request->input('SOP_DESC'),
            'IODINE_CHECK_FLG' => $request->input('IODINE_CHECK_FLG'),
            'MONITORING_FLG' => $request->input('MONITORING_FLG'),
            'LAB_MAN_FLG' => $request->input('LAB_MAN_FLG'),
            'LAB_PERSON' => $request->input('LAB_PERSON'),
            'REMARKS' => $request->input('REMARKS'),
            'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s"),
            'UPDATE_BY' => Auth::user()->id
        ]);
        return $update;
    }

    public static function updateQcInfoTemp($request, $millerId){
        $inserted = DB::table('tem_tsm_qc_info')->insertGetId([
            'MILL_ID' => $millerId,
            'LABORATORY_FLG' => $request->input('LABORATORY_FLG'),
            'IODINE_CHECK_FLG' => $request->input('IODINE_CHECK_FLG'),
            'LAB_MAN_FLG' => $request->input('LAB_MAN_FLG'),
            'MONITORING_FLG' => $request->input('MONITORING_FLG'),
            'SOP_DESC' => $request->input('SOP_DESC'),
            'LAB_PERSON' => $request->input('LAB_PERSON'),
            'REMARKS' => $request->input('REMARKS'),
            'center_id' => Auth::user()->center_id,
            'approval_status' => 0,
            'ENTRY_BY' => Auth::user()->id,
            'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
        ]);
        if($inserted){
            $data = array(
                'approval_status' => 1
            );
            DB::table('tsm_qc_info')->where('MILL_ID', '=' , $millerId)->update($data);
        }
        return $inserted;
    }


}
