<?php

namespace App\Http\Controllers;

use App\LookupGroupData;
use App\Entrepreneur;
use App\MillerInfo;
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

class EntrepreneurController extends Controller
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
            'OWNER_NAME' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator);
        }else {
            //$this->pr($request->input());
            $millerInfoId = $request->input('MILL_ID'); //$this->pr($millerInfoId);
            $insert = Entrepreneur::insertMillerProfile($request);
            //$millerInfoId = $request->input('MILL_ID');

            if($insert){
                //return redirect('/mill-info')->with('success', 'Entrepreneur Has been Created !');
                return redirect('/certificate-info/createCertificate/'.$millerInfoId)->with('success', 'Entrepreneur Has been Created !');
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
//        $delete = Monitoring::deleteMonitorData($id);
//        if($delete){
//            echo json_encode([
//                'type' => 'tr',
//                'id' => $id,
//                'flag' => true,
//                'message' => 'Monitor Data Successfully Deleted.',
//            ]);
//        } else{
//            echo json_encode([
//                'message' => 'Error Founded Here!',
//            ]);
//        }


    }

    public function createEntrepreneur($millerInfoId){
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
        //$this->pr($millerInfoId);
        return view('profile.miller.entrepreneurInformationNew',compact('millerInfoId','registrationType','ownerType','getDivision','getZone','processType','millType','capacity','certificate','issueBy','editMillData'));
    }

    public function updateEntrepreneurInfo(Request $request){
        $millerInfoId = $request->input('MILL_ID'); //$this->pr($millerInfoId);
        $updateEmpData = Entrepreneur::updateMillEntrepData($request, $millerInfoId);
        return "Entrepreneur Information has been updated";
    }



}
