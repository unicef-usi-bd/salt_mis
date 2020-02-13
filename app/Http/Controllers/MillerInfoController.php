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

//        $title = trans('lookupGroupIndex.create_lookup');
        $title = trans('Create Miller Profile');

        $heading=array(
            'title'=> $title,
            'library'=>'datatable',
            'modalSize'=>'modal-bg',
            'action'=>'mill-info/create',
            'createPermissionLevel' => $previllage->CREATE
        );

        //$monitoring = Entrepreneur::getMonitorData();
        $getDivision = SupplierProfile::getDivision();
        $getZone = SupplierProfile::getZone();
        $getDistrict = SupplierProfile::getDistrict();
        $getUpazilla = SupplierProfile::getUpazilla();

        $registrationType = LookupGroupData::getActiveGroupDataByLookupGroup($this->registrationTypeId);
        $ownerType = LookupGroupData::getActiveGroupDataByLookupGroup($this->ownerTypeId);

        $processType = LookupGroupData::getActiveGroupDataByLookupGroup($this->processTypeId);
        $millType = LookupGroupData::getActiveGroupDataByLookupGroup($this->millTypeId);
        //$zoneType = LookupGroupData::getActiveGroupDataByLookupGroup($this->zoneTypeId);
        $capacity = LookupGroupData::getActiveGroupDataByLookupGroup($this->capacityId);
        $certificate = LookupGroupData::getActiveGroupDataByLookupGroup($this->certificateTypeId);
        $issueBy = LookupGroupData::getActiveGroupDataByLookupGroup($this->issureTypeId);
        $millerList = MillerInfo::getAllMillDataList();
        //$millerUpdateStatus = MillerInfo::getAllMillDataList($MILL_ID);
        $approvalMillList = MillerInfo::getApprovalAllMillDataList();
        $millerToMerge = MillerInfo::getMillerToMerge();
        //$this->pr($millerList);
        $centerId = Auth::user()->center_id;

        $individualMillerProfileCheck = MillerInfo::singleMiller($centerId);
        $millerInfoId = $individualMillerProfileCheck->MILL_ID;
        //$this->pr($individualMillerProfileCheck);
        if(!empty($individualMillerProfileCheck->MILL_ID)){
            //echo "personal dashboard for single miller ".$millerInfoId;
            $editMillData = MillerInfo::getMillData($millerInfoId);
            $editEntrepData = Entrepreneur::getEntrepreneurData($millerInfoId);
            $getEntrepreneurRowData = Entrepreneur::getEntrepreneurRowData($millerInfoId);
            $editCertificateData = Certificate::getCertificateData($millerInfoId);
            $editQcData = Qc::getQcData($millerInfoId);
            $editEmployeeData = Employee::getEmployeeData($millerInfoId);
            $certificateId = CertificateIssur::getCertificate();
            $issuerId = Certificate::getIssuerIs();
            $getUpazilla = SupplierProfile::getUpazilla();
            return view('profile.miller.singleMiller.singleMillerProfileIndex', compact('millerInfoId','getDivision','getZone','registrationType','ownerType','processType','millType','capacity','certificate','issueBy','editMillData','editEntrepData','getEntrepreneurRowData','editCertificateData','editQcData','editEmployeeData','getDistrict','certificateId','issuerId','getUpazilla'));

        } else {
            return view('profile.miller.millerIndex', compact('heading', 'previllage', 'getDivision', 'getZone','getUpazilla', 'registrationType', 'ownerType', 'processType', 'millType', 'capacity', 'certificate', 'issueBy', 'millerList', 'millerToMerge','approvalMillList'));
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
        $certificate = LookupGroupData::getActiveGroupDataByLookupGroup($this->certificateTypeId);
        $issueBy = LookupGroupData::getActiveGroupDataByLookupGroup($this->issureTypeId);
        $millerToMerge = MillerInfo::getMillerToMerge();
        $centerId = Auth::user()->center_id;

        $individualMillerProfileCheck = MillerInfo::singleMiller($centerId);

        return view('profile.miller.modal.create', compact('getDivision', 'getZone','getUpazilla', 'registrationType', 'ownerType', 'processType', 'millType', 'capacity', 'certificate', 'issueBy', 'millerToMerge'));

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
        }else{
            $mill_logo = 'image/mill-logo/defaultUserImage.png';
        }

        $millerId = MillerInfo::insertMillerInfoData($request, $mill_logo);

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

        $previousMillerData = MillerProfileApproval::previousMillerInformation($id);
        $previousEnterpreneurData = MillerProfileApproval::previousEntrepreneurInformation($id);
        $previousCertificaterData = MillerProfileApproval::previousCertificateInformation($id);
        $previousQcData = MillerProfileApproval::previousQcInformation($id);
        $previousEmployeeData = MillerProfileApproval::previousEmployeeInformation($id);
        //$this->pr($lookUpDataMill);
        return view('profile.miller.modal.viewMillerIndex', compact('previousMillerData','previousEnterpreneurData','previousCertificaterData','previousQcData','previousEmployeeData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $certificate = LookupGroupData::getActiveGroupDataByLookupGroup($this->certificateTypeId);
        $issueBy = LookupGroupData::getActiveGroupDataByLookupGroup($this->issureTypeId);
        $millerToMerge = MillerInfo::getMillerToMerge();
        $centerId = Auth::user()->center_id;

        $individualMillerProfileCheck = MillerInfo::singleMiller($centerId);

        return view('profile.miller.modal.edit', compact('getDivision', 'getZone','getUpazilla', 'registrationType', 'ownerType', 'processType', 'millType', 'capacity', 'certificate', 'issueBy', 'millerToMerge'));

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
        $associationId = AssociationSetup::singleAssociation();
        $rules = array(
            'MILL_NAME' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {
            $millerInfoId = $request->input('MILL_ID');
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
            $ownerType = $request->input('OWNER_TYPE_ID');
            $updateMillData = MillerInfo::updateMillData($request, $id,$associationId,$mill_logo);
            if($updateMillData){
//                return redirect('/entrepreneur-info/createEntrepreneur/'.$millerInfoId)->with('success', 'Miller Profile has been Updated !');
                return "Mill informatin has been updated!";
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
    }

    public function updateMillInfo(Request $request){
            //$this->pr($request->input());
            $centerId = Auth::user()->center_id;
            $associationId = AssociationSetup::singleAssociation();
            $millerInfoId = $request->input('MILL_ID');
            $mill_logo = "";
            if(!empty($request->file('mill_logo'))) {
                if ($request->file('mill_logo') != null && $request->file('mill_logo')->isValid()) {
                    $image = $request->file('mill_logo');
                    $filename = date('Y-m-d') . '_' . time() . '.' . $image->getClientOriginalExtension();
                    $path = 'image/mill-logo/' . $filename;
                    Image::make($image->getRealPath())->resize(250, 250)->save($path);
                    //********* End Image *********
                    $mill_logo = "image/mill-logo/$filename";
                } else {
                    $mill_logo = 'image/mill-logo/defaultUserImage.png';
                }
            }
            $ownerType = $request->input('OWNER_TYPE_ID');
            //$this->pr($request->input('MILL_NAME'));
//        $updateMillData = MillerInfo::updateMillData($request, $millerInfoId, $centerId,$associationId,$mill_logo);
            $updateMillData = MillerInfo::updateMillData($request, $millerInfoId,$associationId,$mill_logo);
            //echo $updateMillData;die();
            if($updateMillData){
//                return redirect('/entrepreneur-info/createEntrepreneur/'.$millerInfoId)->with('success', 'Miller Profile has been Updated !');
//            return "Mill informatin has been updated!";
                return "Mill informatin has been updated!";
            }

//
    }

    public function approveByAssociation(Request $request){
        //return $request->all();
//        $centerId = Auth::user()->center_id;
//        $associationId = AssociationSetup::singleAssociation();
        $millerInfoId = $request->input('MILL_ID');
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
        $ownerType = $request->input('OWNER_TYPE_ID');
        //$this->pr($request->input('MILL_NAME'));
        $updateMillData = MillerInfo::approveByassociation($request,$millerInfoId,$mill_logo);

        //echo $updateMillData;die();
        return "Miller Information has been updated";
    }

    public function temUpdate(Request $request){
        //return $request->all();
        //$centerId = Auth::user()->center_id;
        //$associationId = AssociationSetup::singleAssociation();
        $millerInfoId = $request->input('MILL_ID');
        //$this->pr($request->input('MILL_ID'));exit();
        if($request->file('mill_logo')!=null && $request->file('mill_logo')->isValid()) {
            $image = $request->file('mill_logo');
            $filename = date('Y-m-d').'_'.time() . '.' . $image->getClientOriginalExtension();
            $path = 'image/mill-logo/' . $filename;
            Image::make($image->getRealPath())->resize(250, 250)->save($path);
            //********* End Image *********
            $mill_logo = "image/mill-logo/$filename";
        }else{
//            $mill_logo = 'image/mill-logo/defaultUserImage.png';
            $mill_logo = $request->input('mill_logo');
        }
        $ownerType = $request->input('OWNER_TYPE_ID');
        $updateMillData = MillerInfo::insertMillerInfoTemData($request,$mill_logo,$millerInfoId);
        if($updateMillData){
            return "Miller Information has been updated";
        }else{
            return "Miller Information has been updated failed";
        }
    }

    public function deactivateMillProfile(Request $request){
        $values = 0;
        $checkType =  $request->input("is_checked");
        $millerInfoId =  $request->input("millId");
        //$this->pr($millId);
        MillerInfo::deactivateMillTable($request, $millerInfoId);
        MillerInfo::deactivateMillEmpTable($request, $millerInfoId);
    }




}
