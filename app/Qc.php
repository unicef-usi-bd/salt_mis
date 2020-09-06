<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\VarDumper\Cloner\Data;


class Qc extends Model
{
    public static function insertQcInfo($request){
        $millerId = $request->input('MILL_ID');
        $data = array(
            'LABORATORY_FLG' => $request->input('LABORATORY_FLG'),
            'OPERATION_PROCEDURE_FLG' => $request->input('OPERATION_PROCEDURE_FLG'),
            'MONITORING_FLG' => $request->input('MONITORING_FLG'),
            'LAB_MAN_FLG' => $request->input('LAB_MAN_FLG'),
            'LAB_PERSON' => $request->input('LAB_PERSON'),
            'REMARKS' => $request->input('REMARKS'),
            'center_id' => Auth::user()->center_id,
             'ENTRY_BY' => Auth::user()->id,
            'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
        );
        $qcInfo = self::insertWithMillerId($millerId, $data);
        return $qcInfo;
    }
    public static function qcInfo($millerId){
        return DB::table('tsm_qc_info')
            ->where('MILL_ID','=', $millerId)
            ->first();

    }

    public static function insertWithMillerId($millerId, $data){
        $data['MILL_ID'] = $millerId;
        return DB::table('tsm_qc_info')->insertGetId($data);
    }

    public static function updateQcInfo($request, $millerId){
        $data = array(
            'LABORATORY_FLG' => $request->input('LABORATORY_FLG'),
            'OPERATION_PROCEDURE_FLG' => $request->input('OPERATION_PROCEDURE_FLG'),
            'MONITORING_FLG' => $request->input('MONITORING_FLG'),
            'LAB_MAN_FLG' => $request->input('LAB_MAN_FLG'),
            'LAB_PERSON' => $request->input('LAB_PERSON'),
            'REMARKS' => $request->input('REMARKS'),
            'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s"),
            'UPDATE_BY' => Auth::user()->id
        );
        $update = DB::table('tsm_qc_info')
            ->where('MILL_ID', '=' , $millerId)
            ->update($data);

        if(!$update){
            self::insertWithMillerId($millerId, $data);
        }
        return true;
    }

    public static function updateQcInfoTemp($request, $millerId){
        $data = array(
            'MILL_ID' => $millerId,
            'LABORATORY_FLG' => $request->input('LABORATORY_FLG'),
            'OPERATION_PROCEDURE_FLG' => $request->input('OPERATION_PROCEDURE_FLG'),
            'LAB_MAN_FLG' => $request->input('LAB_MAN_FLG'),
            'MONITORING_FLG' => $request->input('MONITORING_FLG'),
            'LAB_PERSON' => $request->input('LAB_PERSON'),
            'REMARKS' => $request->input('REMARKS'),
            'center_id' => Auth::user()->center_id,
            'approval_status' => 0,
            'ENTRY_BY' => Auth::user()->id,
            'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
        );

        $qcInfo = DB::table('tem_tsm_qc_info')->where('MILL_ID', '=', $millerId)->first();
        if($qcInfo){
            $pKey = $qcInfo->QCINFO_ID_TEM;
            $updated = DB::table('tem_tsm_qc_info')->where('QCINFO_ID_TEM', '=' , $pKey)->update($data);
        } else{
            $updated = DB::table('tem_tsm_qc_info')->insert($data);
        }
        if($updated){
            $data = array(
                'approval_status' => 1
            );
            DB::table('tsm_qc_info')->where('MILL_ID', '=' , $millerId)->update($data);
        }
        return $updated;
    }


}
