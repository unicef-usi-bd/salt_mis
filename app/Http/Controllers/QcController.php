<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\CertificateIssur;
use App\LookupGroupData;
use App\Qc;
use App\MillerInfo;
use App\Entrepreneur;
use App\SupplierProfile;
use Illuminate\Http\Request;
use App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\LookupGroup;
use UxWeb\SweetAlert\SweetAlert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class QcController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
//            'MILL_ID' => 'required',
//            'LABORATORY_FLG' => 'required',
//            'LAB_MAN_FLG' => 'required',
//            'OPERATION_PROCEDURE_FLG' => 'required',
//            'MONITORING_FLG' => 'required',
        );
        $error = array(
//            'MILL_ID.required' => 'Miller Information not available. <span class="text-primary">You need to provide miller information</span>.',
//            'LABORATORY_FLG.required' => 'Laboratory field is required.',
//            'LAB_MAN_FLG.required' => 'Lab man check field is required.',
//            'OPERATION_PROCEDURE_FLG.required' => 'Operation procedure check field is required.',
//            'MONITORING_FLG.required' => 'Monitoring field is required.'
        );

        $validator = Validator::make(Input::all(), $rules, $error);

        if ($validator->fails()) return response()->json(['errors'=>$validator->errors()->first()]);

        $millerId = $request->input('MILL_ID');

        $inserted = Qc::insertQcInfo($request);

        if($inserted){
            return response()->json(['success'=>'QC Information has been saved successfully', 'insertId' => $millerId]);
        } else{
            return response()->json(['errors'=>'QC Information save failed']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
//            'LABORATORY_FLG' => 'required',
//            'LAB_MAN_FLG' => 'required',
//            'OPERATION_PROCEDURE_FLG' => 'required',
//            'MONITORING_FLG' => 'required',
        );

        $error = array(
//            'LABORATORY_FLG.required' => 'Laboratory field is required.',
//            'LAB_MAN_FLG.required' => 'Lab man check field is required.',
//            'OPERATION_PROCEDURE_FLG.required' => 'Operation procedure check field is required.',
//            'MONITORING_FLG.required' => 'Monitoring field is required.'
        );

        $validator = Validator::make(Input::all(), $rules, $error);

        if ($validator->fails()) return response()->json(['errors'=>$validator->errors()->first()]);

        $selfMillerInfo = MillerInfo::selfMillerAuthenticated();

        if($selfMillerInfo->MILL_ID){
            $updated = Qc::updateQcInfoTemp($request, $id);
        } else {
            $updated = Qc::updateQcInfo($request, $id);
        }

        if($updated){
            return response()->json(['success'=>'QC Information has been updated successfully.']);
        } else{
            return response()->json(['errors'=>'QC Information update failed.']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Monitoring::deleteMonitorData($id);
        if($delete){
            echo json_encode([
                'type' => 'tr',
                'id' => $id,
                'flag' => true,
                'message' => 'Monitor Data Successfully Deleted.',
            ]);
        } else{
            echo json_encode([
                'message' => 'Error Founded Here!',
            ]);
        }
    }

}
