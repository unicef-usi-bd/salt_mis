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

        $registrationType = LookupGroupData::getActiveGroupDataByLookupGroup($this->registrationTypeId);
        $ownerType = LookupGroupData::getActiveGroupDataByLookupGroup($this->ownerTypeId);

        $processType = LookupGroupData::getActiveGroupDataByLookupGroup($this->processTypeId);
        $millType = LookupGroupData::getActiveGroupDataByLookupGroup($this->millTypeId);
        //$zoneType = LookupGroupData::getActiveGroupDataByLookupGroup($this->zoneTypeId);
        $capacity = LookupGroupData::getActiveGroupDataByLookupGroup($this->capacityId);
        $certificate = LookupGroupData::getActiveGroupDataByLookupGroup($this->certificateTypeId);
        $issueBy = LookupGroupData::getActiveGroupDataByLookupGroup($this->issureTypeId);
        $millerList = MillerInfo::getAllMillDataList();


        //$this->pr($millerList);

        return view('profile.miller.millerIndex', compact( 'heading','previllage','getDivision','getZone','registrationType','ownerType','processType','millType','capacity','certificate','issueBy','millerList'));
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
            'MILL_NAME' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator);
        }else {

            $millerInfoId = MillerInfo::insertMillerInfoData($request);
//            $this->pr($createMillerInfo);
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
        $millerListForEntrepreneur = MillerInfo::showMillereEntreprepProfile($id);
        return view('profile.miller.modal.viewMillerIndex', compact('viewMillerData','millerListForEntrepreneur'));
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

         $registrationType = LookupGroupData::getActiveGroupDataByLookupGroup($this->registrationTypeId);
         $ownerType = LookupGroupData::getActiveGroupDataByLookupGroup($this->ownerTypeId);

         $processType = LookupGroupData::getActiveGroupDataByLookupGroup($this->processTypeId);
         $millType = LookupGroupData::getActiveGroupDataByLookupGroup($this->millTypeId);
         $capacity = LookupGroupData::getActiveGroupDataByLookupGroup($this->capacityId);
         $certificate = LookupGroupData::getActiveGroupDataByLookupGroup($this->certificateTypeId);
         $issueBy = LookupGroupData::getActiveGroupDataByLookupGroup($this->issureTypeId);
         $editMillData = MillerInfo::getMillData($id);
         $editEntrepData = Entrepreneur::getEntrepreneurData($id);
         $getEntrepreneurRowData = Entrepreneur::getEntrepreneurRowData($id);
         $editCertificateData = Certificate::getCertificateData($id);
         $editQcData = Qc::getQcData($id);
         $editEmployeeData = Employee::getEmployeeData($id);
         return view('profile.miller.modal.editMillerIndex', compact('millerInfoId','getDivision','getZone','registrationType','ownerType','processType','millType','capacity','certificate','issueBy','editMillData','editEntrepData','getEntrepreneurRowData','editCertificateData','editQcData','editEmployeeData'));
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
            'MILL_NAME' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {
            $millerInfoId = $request->input('MILL_ID');
            $updateMillData = MillerInfo::updateMillData($request, $id);
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
        $millerInfoId = $request->input('MILL_ID');
        //$this->pr($request->input('MILL_NAME'));
        $updateMillData = MillerInfo::updateMillData($request, $millerInfoId);
        return "Miller Information has been updated";
    }



}
