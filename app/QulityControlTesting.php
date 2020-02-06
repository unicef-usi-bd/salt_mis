<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class QulityControlTesting extends Model
{
    public static function getQualityControlData(){
        return DB::table('tmm_qualitycontrol')
            ->select('tmm_qualitycontrol.*','a.LOOKUPCHD_NAME as qc','b.LOOKUPCHD_NAME as agency','tmm_iodizedmst.BATCH_NO')
            ->leftJoin('ssc_lookupchd as a','tmm_qualitycontrol.QC_BY','=','a.LOOKUPCHD_ID')
            ->leftJoin('ssc_lookupchd as b','tmm_qualitycontrol.AGENCY_ID','=','b.LOOKUPCHD_ID')
            ->leftJoin('tmm_iodizedmst','tmm_qualitycontrol.BATCH_NO','=','tmm_iodizedmst.IODIZEDMST_ID')
            ->where('tmm_qualitycontrol.center_id','=',Auth::user()->center_id)
            ->get();
    }

    public static function getQualityControlBatchList(){
        return DB::table('tmm_qualitycontrol')
            ->select('tmm_qualitycontrol.BATCH_NO','tmm_qualitycontrol.center_id')
            ->where('tmm_qualitycontrol.center_id','=',Auth::user()->center_id)
            ->get();
    }

    public static function insertQualityControlTestingData($data){
       return DB::table('tmm_qualitycontrol')->insert($data);
    }

    public static function showQualityConteolTestingDatya($id){

        return DB::table('tmm_qualitycontrol')
            ->select('tmm_qualitycontrol.*','a.LOOKUPCHD_NAME as qc','b.LOOKUPCHD_NAME as agency','tmm_iodizedmst.BATCH_NO')
            ->leftJoin('ssc_lookupchd as a','tmm_qualitycontrol.QC_BY','=','a.LOOKUPCHD_ID')
            ->leftJoin('ssc_lookupchd as b','tmm_qualitycontrol.AGENCY_ID','=','b.LOOKUPCHD_ID')
            ->leftJoin('tmm_iodizedmst','tmm_qualitycontrol.BATCH_NO','=','tmm_iodizedmst.IODIZEDMST_ID')
            ->where('tmm_qualitycontrol.QUALITYCONTROL_ID','=',$id)
            ->first();

    }

    public static function editQualityConteolTestingDatya($id){
        $query = DB::table('tmm_qualitycontrol')
            ->select('tmm_qualitycontrol.*','a.LOOKUPCHD_NAME as qc','b.LOOKUPCHD_NAME as agency','tmm_iodizedmst.BATCH_NO as BatchNumber')
            ->leftJoin('ssc_lookupchd as a','tmm_qualitycontrol.QC_BY','=','a.LOOKUPCHD_ID')
            ->leftJoin('ssc_lookupchd as b','tmm_qualitycontrol.AGENCY_ID','=','b.LOOKUPCHD_ID')
            ->leftJoin('tmm_iodizedmst','tmm_qualitycontrol.BATCH_NO','=','tmm_iodizedmst.IODIZEDMST_ID')
            ->where('tmm_qualitycontrol.QUALITYCONTROL_ID','=',$id)
            ->first();
        return $query;

    }

    public static function updateQualityControlTestingData($request, $id, $image){
        $data = array(
            'QC_DATE' =>date('Y-m-d', strtotime(Input::get('QC_DATE'))),
            'QC_BY' =>$request->input('QC_BY'),
            'AGENCY_ID' =>$request->input('AGENCY_ID'),
            'BATCH_NO' =>$request->input('BATCH_NO'),
            'QC_TESTNAME' =>$request->input('QC_TESTNAME'),
            'REMARKS' => $request->input('REMARKS'),
            'SODIUM_CHLORIDE' =>$request->input('SODIUM_CHLORIDE'),
            'MOISTURIZER' =>$request->input('MOISTURIZER'),
            'IODINE_CONTENT' =>$request->input('IODINE_CONTENT'),
            'PH' =>$request->input('PH'),
            'center_id' => Auth::user()->center_id,
            'UPDATE_BY' => Auth::user()->id,
            'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s")
        );

        if(!empty($image)) $data['QUALITY_CONTROL_IMAGE'] = 'image/qualitycontrol/'.$qulityControlImge;

        $update = DB::table('tmm_qualitycontrol')->where('QUALITYCONTROL_ID','=', $id)->update($data);

        return $update;
    }

    public static function deleteQualityControlTestingData($id){
        return DB::table('tmm_qualitycontrol')->where('QUALITYCONTROL_ID', $id)->delete();
    }

    public static function iodizeBatchNo (){
        $centerId = Auth::user()->center_id;
      return DB::select(DB::raw("SELECT IODIZEDMST_ID, BATCH_NO, tmm_iodizedmst.BATCH_DATE
            from tmm_iodizedmst
            left join ssm_associationsetup ao on ao.MILL_ID = tmm_iodizedmst.center_id
             -- where BATCH_DATE >= DATE_SUB(NOW(), INTERVAL 30 DAY)
            where BATCH_DATE BETWEEN BATCH_DATE and DATE_ADD(NOW(), INTERVAL 30 DAY)
            and tmm_iodizedmst.center_id = $centerId"));
    }
}
