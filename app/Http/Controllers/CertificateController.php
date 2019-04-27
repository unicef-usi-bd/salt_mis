<?php

namespace App\Http\Controllers;

use App\Entrepreneur;
use App\LookupGroupData;
use App\MillerInfo;
use App\Certificate;
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

class CertificateController extends Controller
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
            'CERTIFICATE_TYPE_ID' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator);
        }else {
            $millerInfoId = $request->input('MILL_ID');
            //$this->pr($request->input());
            $reqTime = count($_POST['CERTIFICATE_TYPE_ID']); //$this->pr($request->file('user_image'));
            for($i=0; $i<$reqTime; $i++){
                // file upload
                $userImageName[$i] = '';
                if($request->file('user_image')[$i]!=null && $request->file('user_image')[$i]->isValid()) {
                    try {
                        $file = $request->file('user_image')[$i];
                        $tempName = strtolower(str_replace(' ', '', $request->input('user_image')[$i]));
                        $userImageName[$i] = $tempName.date("Y-m-d").$i.'_'.time().'.' . $file->getClientOriginalExtension();

                        $request->file('user_image')[$i]->move("image/user-image", $userImageName[$i]);

                    } catch (Illuminate\Filesystem\FileNotFoundException $e) {

                    }
                }
                $data = ([
                    'MILL_ID' => $request->input('MILL_ID'),
                    'CERTIFICATE_TYPE_ID' => $request->input('CERTIFICATE_TYPE_ID')[$i],
                    'ISSURE_ID' => $request->input('ISSURE_ID')[$i],
                    'ISSUING_DATE' => date('Y-m-d',strtotime($request->input('ISSUING_DATE')[$i])),
                    'CERTIFICATE_NO' => $request->input('CERTIFICATE_NO')[$i],
                    //'TRADE_LICENSE' => 'image/user-image/'.$request->file('user_image')[$i],
                    'TRADE_LICENSE' => 'image/user-image/'.$userImageName[$i],
                    'RENEWING_DATE' =>date('Y-m-d',strtotime($request->input('RENEWING_DATE')[$i])),
                    'REMARKS' => $request->input('REMARKS')[$i],
                    'center_id' => Auth::user()->center_id,
                    'ENTRY_BY' => Auth::user()->id,
                    'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
                ]);

                //$this->pr($userImageName[$i]);
                // -/---file upload

                $insert = DB::table('ssm_certificate_info')->insert($data);

            } //end for

            if($insert){
                return redirect('/qc-info/createQc/'.$millerInfoId)->with('success', 'Certificate Has been Added !');
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

    public function createCertificate($millerInfoId){
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
        return view('profile.miller.certificateInformationNew',compact('millerInfoId','registrationType','ownerType','getDivision','getZone','processType','millType','capacity','certificate','issueBy','editMillData','editEntrepData','getEntrepreneurRowData'));
    }
//    public function updateCertificateInfo(Request $request)
//    {
//        $millerInfoId = $request->input('MILL_ID'); //$this->pr( count($_POST['CERTIFICATE_TYPE_ID']));
//        $updateCertificateData = Certificate::updateMillCertificateData($request, $millerInfoId);
//        return "Certificate Information has been updated";
//    }

    public function updateCertificateInfoNormal(Request $request)
//    public function updateCertificateInfo(Request $request)
    {
        //$this->pr($request->file('user_image'));
        $millerInfoId = $request->input('MILL_ID');//$this->pr($millerInfoId);
        $certificateId = DB::table('ssm_certificate_info')->where('MILL_ID', $millerInfoId)->delete();
        if ($certificateId) {
            //$this->pr($request->input());
            $reqTime = count($_POST['CERTIFICATE_TYPE_ID']);
            for ($i = 0; $i < $reqTime; $i++) {
                // file upload
                $userImageName[$i] = 'defaultImage.jpg';
                if ($request->file('user_image')[$i] != null && $request->file('user_image')[$i]->isValid()) {
                    try {
                        $file = $request->file('user_image')[$i];
                        $tempName = strtolower(str_replace(' ', '', $request->input('user_image')[$i]));
                        $userImageName[$i] = $tempName . date("Y-m-d") . $i . '_' . time() . '.' . $file->getClientOriginalExtension();


                        $request->file('user_image')[$i]->move("image/user-image", $userImageName[$i]);

                    } catch (Illuminate\Filesystem\FileNotFoundException $e) {

                    }
                }
                $data = ([
                    'MILL_ID' => $millerInfoId,
                    'CERTIFICATE_TYPE_ID' => $request->input('CERTIFICATE_TYPE_ID')[$i],
                    'ISSURE_ID' => $request->input('ISSURE_ID')[$i],
                    'ISSUING_DATE' => date('Y-m-d', strtotime($request->input('ISSUING_DATE')[$i])),
                    'CERTIFICATE_NO' => $request->input('CERTIFICATE_NO')[$i],
                    'TRADE_LICENSE' => 'image/user-image/' . $userImageName[$i],
                    'RENEWING_DATE' => date('Y-m-d', strtotime($request->input('RENEWING_DATE')[$i])),
                    'REMARKS' => $request->input('REMARKS')[$i],
                    'UPDATE_BY' => Auth::user()->id,
                    'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s")
                ]);
                //$this->pr($data);
                //  file upload
                $insert = DB::table('ssm_certificate_info')->insert($data);

            } //end for
        }
//        return "Certificate Updated Successful";
        return Redirect::back()->with('message','Certificate Updated Successful !');
    }

} // END CLASS
