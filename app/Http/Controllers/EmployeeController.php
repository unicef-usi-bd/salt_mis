<?php

namespace App\Http\Controllers;

use App\LookupGroupData;
use App\Employee;
use App\Qc;
use App\MillerInfo;
use App\Entrepreneur;
use App\Certificate;
use App\SupplierProfile;
use Illuminate\Http\Request;
use App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\LookupGroup;
use App\Http\Controllers\Session;
use UxWeb\SweetAlert\SweetAlert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\AssociationSetup;
use App\CertificateIssur;

class EmployeeController extends Controller
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
            'TOTMALE_EMP' => 'required',
        );
        $error = array(
            'MILL_ID.required' => 'Miller Information not available. <span class="text-primary">You need to provide miller information</span>.',
            'TOTMALE_EMP.required' => 'Employee type field is required.'
        );

        $validator = Validator::make(Input::all(), $rules, $error);

        if ($validator->fails()) return response()->json(['errors'=>$validator->errors()->first()]);

        $millerId = $request->input('MILL_ID');
        $inserted = Employee::insertEmployeeInfo($request);

        if($inserted){
            return response()->json(['success'=>'Employee information has been saved successfully', 'insertId' => $millerId]);
        } else{
            return response()->json(['errors'=>'Employee information Profile save failed']);
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
        $rules = array(
            'TOTMALE_EMP' => 'required',
        );
        $error = array(
            'TOTMALE_EMP.required' => 'Employee type field is required.'
        );

        $validator = Validator::make(Input::all(), $rules, $error);

        if ($validator->fails()) return response()->json(['errors'=>$validator->errors()->first()]);

        $selfMillerInfo = MillerInfo::selfMillerAuthenticated();

        if($selfMillerInfo->MILL_ID){
            $updated = Employee::updateEmployeeInfoTemp($request, $id);
        } else {
            $updated = Employee::updateEmployeeInfo($request, $id);
        }

        if($updated){
            return response()->json(['success'=>'Employee information has been updated successfully']);
        } else{
            return response()->json(['errors'=>'Employee information Profile update failed']);
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

public function createEmployee($millerInfoId){
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
    $editCertificateData = Certificate::certificateInformation($millerInfoId);
    $editQcData = Qc::qcInfo($millerInfoId);
    $certificateId = CertificateIssur::getCertificate();
    $issuerId = Certificate::getIssuerIs();
    //$associationId = AssociationSetup::singleAssociation();
    return view('profile.miller.employeeInformationNew',compact('millerInfoId','registrationType','ownerType','getDivision','getZone','processType','millType','capacity','certificate','issueBy','editMillData','editEntrepData','getEntrepreneurRowData','editCertificateData','editQcData','associationId','certificateId','issuerId','getDistrict','getUpazilla'));
}

    public function updateEmployeeInfoTem(Request $request){
        $millerInfoId = $request->input('MILL_ID');
        $updateEmpData = Employee::insertMillerEmployeeInfoTem($request);
        return "Employee Information has been updated";
//        return $request;

    }

}
