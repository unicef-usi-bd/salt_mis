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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'MILL_ID' => 'required',
            'LABORATORY_FLG' => 'required',
            'IODINE_CHECK_FLG' => 'required',
            'LAB_MAN_FLG' => 'required',
            'MONITORING_FLG' => 'required',
        );
        $error = array(
            'MILL_ID.required' => 'Miller Information not available. <span class="text-primary">You need to provide miller information</span>.',
            'LABORATORY_FLG.required' => 'Laboratory field is required.',
            'IODINE_CHECK_FLG.required' => 'Iodine check field is required.',
            'LAB_MAN_FLG.required' => 'Lab man check field is required.',
            'MONITORING_FLG.required' => 'Monitoring field is required.'
        );

        $validator = Validator::make(Input::all(), $rules, $error);

        if ($validator->fails()) return response()->json(['errors'=>$validator->errors()->first()]);

        $millerId = $request->input('MILL_ID');

        $insertedId = Qc::insertMillerQc($request);

        if($insertedId){
            return response()->json(['success'=>'QC Information has been saved successfully', 'insertId' => $millerId]);
        } else{
            return response()->json(['errors'=>'QC Information save failed']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//         $viewMonitoring = Monitoring::showMonitorData($id);
//        return view('setup.monitoring.modals.viewMonitoring',compact( 'heading','previllage','viewMonitoring'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
     {
//         $editMonitoring = Monitoring::editMonitorData($id);
//         $agencyName = Monitoring::agencyName();
//        return view('setup.monitoring.modals.editMonitoring' , compact('editMonitoring','agencyName'));

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
        //print_r($request->input());exit();

        $rules = array(
            'AGENCY_ID' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {
//        $updateMonitoringData = Monitoring::updateMonitorData($request, $id);
//            if($updateMonitoringData){
//                return redirect('/monitoring')->with('success', 'Monitoring Data Updated !');
//            }
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

    public function createQc($millerInfoId){
        $getDivision = SupplierProfile::getDivision();
        $getZone = SupplierProfile::getZone();
        $getDistrict = SupplierProfile::getDistrict();
        $getUpazilla = SupplierProfile::getUpazilla();
        $registrationType = LookupGroupData::getActiveGroupDataByLookupGroup($this->registrationTypeId);
        $ownerType = LookupGroupData::getActiveGroupDataByLookupGroup($this->ownerTypeId);

        $processType = LookupGroupData::getActiveGroupDataByLookupGroup($this->processTypeId);
        $millType = LookupGroupData::getActiveGroupDataByLookupGroup($this->millTypeId);
        $capacity = LookupGroupData::getActiveGroupDataByLookupGroup($this->capacityId);
        $certificate = LookupGroupData::getActiveGroupDataByLookupGroup($this->certificateTypeId);
        $issueBy = LookupGroupData::getActiveGroupDataByLookupGroup($this->issureTypeId);
        $editMillData = MillerInfo::getMillData($millerInfoId);
        $editEntrepData = Entrepreneur::getEntrepreneurData($millerInfoId);
        $getEntrepreneurRowData = Entrepreneur::getEntrepreneurRowData($millerInfoId);
        $editCertificateData = Certificate::getCertificateData($millerInfoId);
        $certificateId = CertificateIssur::getCertificate();
        $issuerId = Certificate::getIssuerIs();
        //$associationId = AssociationSetup::singleAssociation();
        return view('profile.miller.qcInformationNew',compact('millerInfoId','registrationType','ownerType','getDivision','getZone','processType','millType','capacity','certificate','issueBy','editMillData','editEntrepData','getEntrepreneurRowData','editCertificateData','associationId','certificateId','issuerId','getDistrict','getUpazilla'));
    }

    public function updateQcInfo(Request $request){
        $millerInfoId = $request->input('MILL_ID'); //$this->pr($millerInfoId);
        $updateEmpData = Qc::updateMillQcData($request, $millerInfoId);
        return "QC Information has been updated";
//        return $request;
    }

    public function updateQcInfoTem(Request $request){
        $millerInfoId = $request->input('MILL_ID'); //$this->pr($millerInfoId);
        $insertQc = Qc::insertQc($request);
        return "QC Information has been updated";
//        return $request;
    }

}
