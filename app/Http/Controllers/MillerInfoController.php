<?php

namespace App\Http\Controllers;

use App\LookupGroupData;
use App\Employee;
use App\MillerProfileApproval;
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
use function Sodium\compare;
use UxWeb\SweetAlert\SweetAlert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use File;
use Intervention\Image\ImageManagerStatic as Image;
use App\AssociationSetup;
use App\CertificateIssur;

class MillerInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userGroupId = Auth::user()->user_group_id;
        $userGroupLevelId = Auth::user()->user_group_level_id;
        $url = Route::getFacadeRoot()->current()->uri();
        $previllage = $this->checkPrevillage($userGroupId,$userGroupLevelId,$url);

        $title = trans('Create Miller Profile');

        $heading=array(
            'title'=> $title,
            'library'=>'datatable',
            'modalSize'=>'modal-bg',
            'action'=>'mill-info/create',
            'createPermissionLevel' => $previllage->CREATE
        );

        $millerList = MillerInfo::getAllMillDataList();

        $approvalMillList = MillerInfo::getApprovalAllMillDataList();
        $millerToMerge = MillerInfo::getMillerToMerge();
        $selfMillerInfo = MillerInfo::selfMillerAuthenticated();
        if(!empty($selfMillerInfo->MILL_ID)){
            $millerId = $selfMillerInfo->MILL_ID;
            $zones = SupplierProfile::getZone();
            $divisions = SupplierProfile::getDivision();
            $districts = SupplierProfile::getDistrict();
            $upazillas = SupplierProfile::getUpazilla();

            $registrationType = LookupGroupData::getActiveGroupDataByLookupGroup($this->registrationTypeId);
            $ownerType = LookupGroupData::getActiveGroupDataByLookupGroup($this->ownerTypeId);

            $processType = LookupGroupData::getActiveGroupDataByLookupGroup($this->processTypeId);
            $millType = LookupGroupData::getActiveGroupDataByLookupGroup($this->millTypeId);
            $capacity = LookupGroupData::getActiveGroupDataByLookupGroup($this->capacityId);
            $certificates = LookupGroupData::getActiveGroupDataByLookupGroup($this->certificateTypeId);
            $issueBy = CertificateIssur::getCertificateIssuer();
            $millerToMerge = MillerInfo::getMillerToMerge();

            $millerInfo = MillerInfo::millerInformation($millerId);
            $entrepreneurs = Entrepreneur::entrepreneurInformation($millerId);
            $certificateInfo = Certificate::certificateInformation($millerId);
            $qcInfo = Qc::qcInfo($millerId);
            $employeeInfo = Employee::employeeInformation($millerId);
            return view('profile.miller.self.index', compact('zones', 'divisions','districts', 'upazillas', 'registrationType', 'ownerType', 'processType', 'millType', 'capacity', 'certificates', 'issueBy', 'millerToMerge', 'millerInfo', 'entrepreneurs', 'certificateInfo', 'qcInfo', 'employeeInfo'));
        } else {
            return view('profile.miller.millerIndex', compact('heading', 'previllage', 'millerList', 'millerToMerge','approvalMillList'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getDivision = SupplierProfile::getDivision();
        $getZone = SupplierProfile::getZone();
        $getUpazilla = SupplierProfile::getUpazilla();

        $registrationType = LookupGroupData::getActiveGroupDataByLookupGroup($this->registrationTypeId);
        $ownerType = LookupGroupData::getActiveGroupDataByLookupGroup($this->ownerTypeId);

        $processType = LookupGroupData::getActiveGroupDataByLookupGroup($this->processTypeId);
        $millType = LookupGroupData::getActiveGroupDataByLookupGroup($this->millTypeId);
        //$zoneType = LookupGroupData::getActiveGroupDataByLookupGroup($this->zoneTypeId);
        $capacity = LookupGroupData::getActiveGroupDataByLookupGroup($this->capacityId);
        $certificates = Certificate::getCertificates($this->certificateTypeId);
        $issueBy = LookupGroupData::getActiveGroupDataByLookupGroup($this->issureTypeId);
        $millerToMerge = MillerInfo::getMillerToMerge();

        return view('profile.miller.modal.create', compact('getDivision', 'getZone','getUpazilla', 'registrationType', 'ownerType', 'processType', 'millType', 'capacity', 'certificates', 'issueBy', 'millerToMerge'));

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
            'REG_TYPE_ID' => 'required',
            'MILL_NAME' => 'required | unique:ssm_mill_info',
            'PROCESS_TYPE_ID' => 'required',
            'MILL_TYPE_ID' => 'required',
            'CAPACITY_ID' => 'required',
            'ZONE_ID' => 'required',
            'ACTIVE_FLG' => 'required'
        );
        $error = array(
            'REG_TYPE_ID.required' => 'Registration type field is required.',
            'MILL_NAME.required' => 'Mill name field is required.',
            'MILL_NAME.unique' => 'Mill name field must be unique.',
            'PROCESS_TYPE_ID.required' => 'Process type field is required.',
            'MILL_TYPE_ID.required' => 'Mill type field is required.',
            'CAPACITY_ID.required' => 'Capacity field is required.',
            'ZONE_ID.required' => 'Zone field is required.',
            'ACTIVE_FLG.required' => 'Active field is required.',
        );

        $validator = Validator::make(Input::all(), $rules, $error);

        if ($validator->fails()) return response()->json(['errors'=>$validator->errors()->first()]);

        if($request->file('mill_logo')!=null && $request->file('mill_logo')->isValid()) {
            $image = $request->file('mill_logo');
            $filename = date('Y-m-d').'_'.time() . '.' . $image->getClientOriginalExtension();
            $path = 'image/mill-logo/' . $filename;
            Image::make($image->getRealPath())->resize(250, 250)->save($path);

            //********* End Image *********
            $mill_logo = "image/mill-logo/$filename";
        }else{
            $mill_logo = 'image/mill-logo/defaultUserImage.png';
        }

        $millerId = MillerInfo::insertMillerInfo($request, $mill_logo);

        if($millerId){
            return response()->json(['success'=>'Miller Profile has been saved successfully', 'insertId' => $millerId]);
        } else{
            return response()->json(['errors'=>'Miller Profile save failed']);
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

        $previousMillerData = MillerProfileApproval::currentMillerInformation($id);
        $previousEnterpreneurData = MillerProfileApproval::currentEntrepreneurInfo($id);
        $previousCertificaterData = MillerProfileApproval::currentCertificatesInfo($id);
        $previousQcData = MillerProfileApproval::currentQcInfo($id);
        $previousEmployeeData = MillerProfileApproval::currentEmployeeInfo($id);
        //$this->pr($lookUpDataMill);
        return view('profile.miller.modal.viewMillerIndex', compact('previousMillerData','previousEnterpreneurData','previousCertificaterData','previousQcData','previousEmployeeData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id as MillerId
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $zones = SupplierProfile::getZone();
        $divisions = SupplierProfile::getDivision();
        $districts = SupplierProfile::getDistrict();
        $upazillas = SupplierProfile::getUpazilla();

        $registrationType = LookupGroupData::getActiveGroupDataByLookupGroup($this->registrationTypeId);
        $ownerType = LookupGroupData::getActiveGroupDataByLookupGroup($this->ownerTypeId);

        $processType = LookupGroupData::getActiveGroupDataByLookupGroup($this->processTypeId);
        $millType = LookupGroupData::getActiveGroupDataByLookupGroup($this->millTypeId);
        $capacity = LookupGroupData::getActiveGroupDataByLookupGroup($this->capacityId);
        $certificates = Certificate::getCertificates($this->certificateTypeId);
        $issueBy = CertificateIssur::getCertificateIssuer();
        $millerToMerge = MillerInfo::getMillerToMerge();

        $millerInfo = MillerInfo::millerInformation($id);
        $entrepreneurs = Entrepreneur::entrepreneurInformation($id);
        $certificateInfo = Certificate::certificateInformation($id);
        $qcInfo = Qc::qcInfo($id);
        $employeeInfo = Employee::employeeInformation($id);

        return view('profile.miller.modal.edit', compact('zones', 'divisions','districts', 'upazillas', 'registrationType', 'ownerType', 'processType', 'millType', 'capacity', 'certificates', 'issueBy', 'millerToMerge', 'millerInfo', 'entrepreneurs', 'certificateInfo', 'qcInfo', 'employeeInfo'));

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
            'REG_TYPE_ID' => 'required',
            'MILL_NAME' => 'required',
            'PROCESS_TYPE_ID' => 'required',
            'MILL_TYPE_ID' => 'required',
            'CAPACITY_ID' => 'required',
            'ZONE_ID' => 'required',
            'ACTIVE_FLG' => 'required'
        );
        $error = array(
            'REG_TYPE_ID.required' => 'Registration type field is required.',
            'MILL_NAME.required' => 'Mill name field is required.',
            'PROCESS_TYPE_ID.required' => 'Process type field is required.',
            'MILL_TYPE_ID.required' => 'Mill type field is required.',
            'CAPACITY_ID.required' => 'Capacity field is required.',
            'ZONE_ID.required' => 'Zone field is required.',
            'ACTIVE_FLG.required' => 'Active field is required.',
        );

        $validator = Validator::make(Input::all(), $rules, $error);

        if ($validator->fails()) return response()->json(['errors'=>$validator->errors()->first()]);

        if($request->file('mill_logo')!=null && $request->file('mill_logo')->isValid()) {
            $image = $request->file('mill_logo');
            $filename = date('Y-m-d').'_'.time() . '.' . $image->getClientOriginalExtension();
            $path = 'image/mill-logo/' . $filename;
            Image::make($image->getRealPath())->resize(250, 250)->save($path);
            //********* End Image *********
            $mill_logo = "image/mill-logo/$filename";
        } else if($request->file('mill_logo')==null){
            $mill_logo = $request->input('pre_mill_logo');
        }else{
            $mill_logo = 'image/mill-logo/defaultUserImage.png';
        }

        $selfMillerInfo = MillerInfo::selfMillerAuthenticated();

        if($selfMillerInfo->MILL_ID){
            $updated = MillerInfo::updateMillerInfoTemp($request, $id, $mill_logo);
        } else {
            $updated = MillerInfo::updateMillerInfo($request, $id, $mill_logo);
        }

        if($updated){
            return response()->json(['success'=>'Miller Profile has been updated successfully']);
        } else{
            return response()->json(['errors'=>'Miller Profile update failed']);
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
        //$this->pr($id);
        $delete = MillerInfo::deleteMillerProfile($id);

        if($delete){
            echo json_encode([
                'type' => 'tr',
                'id' => $id,
                'flag' => true,
                'message' => 'Miller Profile Successfully Deleted.',
            ]);
        } else{
            echo json_encode([
                'message' => 'Error Founded Here!',
            ]);
        }
        die();
    }

    public function deactivateMillProfile(Request $request){
        $checkType =  $request->input("is_checked");
        $millerInfoId =  $request->input("millId");

        MillerInfo::deactivateMillTable($millerInfoId);
        MillerInfo::deactivateMillEmpTable($millerInfoId);
    }

}
