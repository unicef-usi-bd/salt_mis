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
            'TOTMALE_EMP' => 'required',
            'TOTFEM_EMP' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator);
        }else {
            //$this->pr($request->input());
            $millerInfoId = $request->input('MILL_ID');
            $employeeInfoId = Employee::insertMillerEmployeeInfo($request);

            if($employeeInfoId){
                return redirect('/mill-info')->with('success', 'Employee Information Has been Added !');
            }
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
        //$this->pr($request->input());

        $rules = array(
            'TOTMALE_EMP' => 'required',
            'TOTFEM_EMP' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator);
        }else {
            $updateMillEmployeeData = Employee::updateMillEmployeeData($request, $id);
            if($updateMillEmployeeData){
                return response()->json(['success'=> 'Employee Information has been updated!']);
            }
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
    $editQcData = Qc::getQcData($millerInfoId);
    //$associationId = AssociationSetup::singleAssociation();
    return view('profile.miller.employeeInformationNew',compact('millerInfoId','registrationType','ownerType','getDivision','getZone','processType','millType','capacity','certificate','issueBy','editMillData','editEntrepData','getEntrepreneurRowData','editCertificateData','editQcData','associationId'));
}

    public function updateEmployeeInfo(Request $request){
        $millerInfoId = $request->input('MILL_ID');
        $updateEmpData = Employee::updateMillEmployeeData($request, $millerInfoId);
        return "Employee Information has been updated";

    }

}
