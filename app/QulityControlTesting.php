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
        return DB::table('tmm_qualitycontrol')
            ->select('tmm_qualitycontrol.*','a.LOOKUPCHD_NAME as qc','b.LOOKUPCHD_NAME as agency','tmm_iodizedmst.BATCH_NO')
            ->leftJoin('ssc_lookupchd as a','tmm_qualitycontrol.QC_BY','=','a.LOOKUPCHD_ID')
            ->leftJoin('ssc_lookupchd as b','tmm_qualitycontrol.AGENCY_ID','=','b.LOOKUPCHD_ID')
            ->leftJoin('tmm_iodizedmst','tmm_qualitycontrol.BATCH_NO','=','tmm_iodizedmst.IODIZEDMST_ID')
            ->where('tmm_qualitycontrol.QUALITYCONTROL_ID','=',$id)
            ->first();
    }

    public static function updateQualityControlTestingData($request,$id){
//        $data = array([
//            'QC_DATE' =>date('Y-m-d', strtotime(Input::get('QC_DATE'))),
//            'QC_BY' =>$request->input('QC_BY'),
//            'AGENCY_ID' =>$request->input('AGENCY_ID'),
//            'BATCH_NO' =>$request->input('BATCH_NO'),
//            'QC_TESTNAME' =>$request->input('QC_TESTNAME'),
//            'QUALITY_CONTROL_IMAGE' => 'image/testimage/'.$qulityControlImge,
//            'REMARKS' => $request->input('REMARKS'),
//            'SODIUM_CHLORIDE' =>$request->input('SODIUM_CHLORIDE'),
//            'MOISTURIZER' =>$request->input('MOISTURIZER'),
//            'IODINE_CONTENT' =>$request->input('IODINE_CONTENT'),
//            'PH' =>$request->input('PH'),
//            'ENTRY_BY' => Auth::user()->id,
//            'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
//        ]);


        $update = DB::table('tmm_qualitycontrol')->where('tmm_qualitycontrol.QUALITYCONTROL_ID', $id)->update([
            'QC_DATE' =>date('Y-m-d', strtotime(Input::get('QC_DATE'))),
            'QC_BY' =>$request->input('QC_BY'),
            'AGENCY_ID' =>$request->input('AGENCY_ID'),
            'BATCH_NO' =>$request->input('BATCH_NO'),
            'QC_TESTNAME' =>$request->input('QC_TESTNAME'),
            //'QUALITY_CONTROL_IMAGE' => 'image/testimage/'.$qulityControlImge,
            'REMARKS' => $request->input('REMARKS'),
            'SODIUM_CHLORIDE' =>$request->input('SODIUM_CHLORIDE'),
            'MOISTURIZER' =>$request->input('MOISTURIZER'),
            'IODINE_CONTENT' =>$request->input('IODINE_CONTENT'),
            'PH' =>$request->input('PH'),
            'UPDATE_BY' => Auth::user()->id,
            'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s")
        ]);

        return $update;
    }

    public static function deleteQualityControlTestingData($id){
        return DB::table('tmm_qualitycontrol')->where('QUALITYCONTROL_ID', $id)->delete();
    }
}
