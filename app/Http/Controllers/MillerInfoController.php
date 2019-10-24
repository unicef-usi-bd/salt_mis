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
            'modalSize'=>'modal-md',
            //'action'=>'monitoring/create',
            'createPermissionLevel' => $previllage->CREATE
        );

        //$monitoring = Entrepreneur::getMonitorData();
        $getDivision = SupplierProfile::getDivision();
        $getZone = SupplierProfile::getZone();
        $getDistrict = SupplierProfile::getDistrict();

        $registrationType = LookupGroupData::getActiveGroupDataByLookupGroup($this->registrationTypeId);
        $ownerType = LookupGroupData::getActiveGroupDataByLookupGroup($this->ownerTypeId);

        $processType = LookupGroupData::getActiveGroupDataByLookupGroup($this->processTypeId);
        $millType = LookupGroupData::getActiveGroupDataByLookupGroup($this->millTypeId);
        //$zoneType = LookupGroupData::getActiveGroupDataByLookupGroup($this->zoneTypeId);
        $capacity = LookupGroupData::getActiveGroupDataByLookupGroup($this->capacityId);
        $certificate = LookupGroupData::getActiveGroupDataByLookupGroup($this->certificateTypeId);
        $issueBy = LookupGroupData::getActiveGroupDataByLookupGroup($this->issureTypeId);
        $millerList = MillerInfo::getAllMillDataList();
        $approvalMillList = MillerInfo::getApprovalAllMillDataList();
        $millerToMerge = MillerInfo::getMillerToMerge();
        //$this->pr($millerList);
        $centerId = Auth::user()->center_id;

        $individualMillerProfileCheck = MillerInfo::singleMiller($centerId);
        $millerInfoId = $individualMillerProfileCheck->MILL_ID; //$this->pr($individualMillerProfileCheck);
        if(!empty($individualMillerProfileCheck->MILL_ID)){
            //echo "personal dashboard for single miller ".$millerInfoId;
            $editMillData = MillerInfo::getMillData($millerInfoId);
            $editEntrepData = Entrepreneur::getEntrepreneurData($millerInfoId);
            $getEntrepreneurRowData = Entrepreneur::getEntrepreneurRowData($millerInfoId);
            $editCertificateData = Certificate::getCertificateData($millerInfoId);
            $editQcData = Qc::getQcData($millerInfoId);
            $editEmployeeData = Employee::getEmployeeData($millerInfoId);
            return view('profile.miller.singleMiller.singleMillerProfileIndex', compact('millerInfoId','getDivision','getZone','registrationType','ownerType','processType','millType','capacity','certificate','issueBy','editMillData','editEntrepData','getEntrepreneurRowData','editCertificateData','editQcData','editEmployeeData','getDistrict'));

        }else {
            return view('profile.miller.millerIndex', compact('heading', 'previllage', 'getDivision', 'getZone', 'registrationType', 'ownerType', 'processType', 'millType', 'capacity', 'certificate', 'issueBy', 'millerList', 'millerToMerge','approvalMillList'));
        }
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
//            'MILL_NAME' => 'required',
//            'PROCESS_TYPE_ID' => 'required',
//            'MILL_TYPE_ID' => 'required',
//            'CAPACITY_ID' => 'required',
//            'ZONE_ID' => 'required',
//            'ACTIVE_FLG' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator);
        }else {
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
//            dd($mill_logo);
            $millerInfoId = MillerInfo::insertMillerInfoData($request, $mill_logo);
            //$association = MillerInfo::insertIntoAssociation($request);
            //$this->pr($association);

//            if($ownerType == 12){
//
//                return redirect('/certificate-info/createCertificate/'.$millerInfoId)->with('disableEntrepreneur','disabled disabledTab');
////                return redirect('/certificate-info/createCertificate/'.$millerInfoId)->with('ownerType'=> 12);
//            }else{
//                return redirect('/entrepreneur-info/createEntrepreneur/'.$millerInfoId)->with('success', 'Miller Profile has been Created !');
//            }
            if($millerInfoId){
                return redirect('/entrepreneur-info/createEntrepreneur/'.$millerInfoId)->with('success', 'Miller Profile has been Created !');

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

        $viewMillerData = MillerInfo::showMillereProfile($id);
        $millerListForEntrepreneur = Entrepreneur::showEntrepreneurProfile($id);
        $lookUpDataMill = MillerInfo::getAllMillLookUpData($id);

        $lookUpDataEntp = MillerInfo::getAllEntrepLookUpData($id);
        $lookUpDataCertificate = MillerInfo::getAllCertificateLookUpData($id);
        $remarks = MillerInfo::allRemarks($id);
        //$this->pr($lookUpDataMill);
        return view('profile.miller.modal.viewMillerIndex', compact('viewMillerData','millerListForEntrepreneur','lookUpDataMill','lookUpDataEntp','lookUpDataCertificate','remarks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $millerInfoId = $id;
        $getDivision = SupplierProfile::getDivision();
        $getZone = SupplierProfile::getZone();
        $getDistrict = SupplierProfile::getDistrict();

        $registrationType = LookupGroupData::getActiveGroupDataByLookupGroup($this->registrationTypeId);
        $ownerType = LookupGroupData::getActiveGroupDataByLookupGroup($this->ownerTypeId);

        $processType = LookupGroupData::getActiveGroupDataByLookupGroup($this->processTypeId);
        $millType = LookupGroupData::getActiveGroupDataByLookupGroup($this->millTypeId);
        $capacity = LookupGroupData::getActiveGroupDataByLookupGroup($this->capacityId);
        $certificate = LookupGroupData::getActiveGroupDataByLookupGroup($this->certificateTypeId);
        $certificateId = CertificateIssur::getCertificate();
        $issueBy = LookupGroupData::getActiveGroupDataByLookupGroup($this->issureTypeId);
        $editMillData = MillerInfo::getMillData($id);
        $editEntrepData = Entrepreneur::getEntrepreneurData($id);
        $getEntrepreneurRowData = Entrepreneur::getEntrepreneurRowData($id);
        $editCertificateData = Certificate::getCertificateData($id);
        $issuerId = Certificate::getIssuerIs();
        $editQcData = Qc::getQcData($id);
        $editEmployeeData = Employee::getEmployeeData($id);
        $associationId = AssociationSetup::singleAssociation();
        //echo $associationId;exit;
//        $this->pr($editCertificateData);
        return view('profile.miller.modal.editMillerIndex', compact('millerInfoId','getDivision','getZone','registrationType','ownerType','processType','millType','capacity','certificate','certificateId','issueBy','editMillData','editEntrepData','getEntrepreneurRowData','editCertificateData','editQcData','editEmployeeData','getDistrict','associationId','issuerId'));
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
        return "Miller Information has been updated";
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
            $mill_logo = 'image/mill-logo/defaultUserImage.png';
        }
        $ownerType = $request->input('OWNER_TYPE_ID');
        //$this->pr($request->input('MILL_NAME'));
        $updateMillData = MillerInfo::insertMillerInfoTemData($request,$millerInfoId,$mill_logo,$millerInfoId);

        //echo $updateMillData;die();
        return "Miller Information has been updated";
    }

    public function deactivateMillProfile(Request $request){
        $values = 0;
        $checkType =  $request->input("is_checked");
        $millerInfoId =  $request->input("millId");
        //$this->pr($millId);
        $updateMillStatusFromMillTable = MillerInfo::deactivateMillTable($request, $millerInfoId);
        $updateMillStatusFromEmpTable = MillerInfo::deactivateMillEmpTable($request, $millerInfoId);

    }




}
