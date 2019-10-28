<?php

namespace App\Http\Controllers;

use App\Entrepreneur;
use App\LookupGroupData;
use App\MillerInfo;
use App\Certificate;
use App\Stock;
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
use App\AssociationSetup;
use App\CertificateIssur;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $millerId = (array)MillerInfo::millId();
//        $millerId1 = (array)$millerId;
        $links = implode(' ', $millerId);

        $certificates = Certificate::getAllCertificate($links);
//        $this->pr($certificates);
        return view('profile.miller.millCertificateList',compact('certificates'));
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
        //$this->pr($request->all());exit();
        $rules = array(
//            'CERTIFICATE_TYPE_ID.*' => 'required',
//            'ISSURE_ID.*' => 'required',
//            'ISSUING_DATE.*' => 'required',
//            'CERTIFICATE_NO.*' => 'required',
//            'user_image.*' => 'required',
//            'RENEWING_DATE.*' => 'required',
        );
        $data = array();
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator);
        }else {
            $millerInfoId = $request->input('MILL_ID');
            //$this->pr($request->input());
            $reqTime = count($_POST['CERTIFICATE_TYPE_ID']); //$this->pr($request->file('user_image'));
            for($i=0; $i<$reqTime; $i++){
                // file upload
                $imagePath = '';
                $arrLimit = count($request->file('user_image'));
                if($i<$arrLimit && $request->file('user_image')[$i]!=null && $request->file('user_image')[$i]->isValid()) {
                    try {
                        $file = $request->file('user_image')[$i];
                        $tempName = strtolower(str_replace(' ', '', $request->input('user_image')[$i]));
                        $userImageName = $tempName.date("Y-m-d").$i.'_'.time().'.' . $file->getClientOriginalExtension();
                        $imagePath= 'image/user-image/'.$userImageName;
                        $request->file('user_image')[$i]->move("image/user-image", $userImageName);

                    } catch (Illuminate\Filesystem\FileNotFoundException $e) {

                    }
                }
                $data[] = array(
                    'MILL_ID' => $request->input('MILL_ID'),
                    'CERTIFICATE_TYPE_ID' => $request->input('CERTIFICATE_TYPE_ID')[$i],
                    'ISSURE_ID' => $request->input('ISSURE_ID')[$i],
                    'DISTRICT_ID' => $request->input('DISTRICT_ID')[$i],
                    'ISSUING_DATE' => date('Y-m-d',strtotime($request->input('ISSUING_DATE')[$i])),
                    'CERTIFICATE_NO' => $request->input('CERTIFICATE_NO')[$i],
                    //'TRADE_LICENSE' => 'image/user-image/'.$request->file('user_image')[$i],
                    'TRADE_LICENSE' => $imagePath,
                    'RENEWING_DATE' =>date('Y-m-d',strtotime($request->input('RENEWING_DATE')[$i])),
                    'CERTIFICATE_TYPE' => $request->input('CERTIFICATE_TYPE')[$i],
                    'IS_EXPIRE' => $request->input('IS_EXPIRE')[$i],
                    'REMARKS' => $request->input('REMARKS')[$i],
                    'center_id' => Auth::user()->center_id,
                    'ENTRY_BY' => Auth::user()->id,
                    'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
                );
                //$this->pr($data);exit();
                //var_dump($data);exit();
                // -/---file upload

            } //end for
            //dd($data);
            $insert = DB::table('ssm_certificate_info')->insert($data);

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
        $getDistrict = SupplierProfile::getDistrict();
        $getUpazilla = SupplierProfile::getUpazilla();

        $registrationType = LookupGroupData::getActiveGroupDataByLookupGroup($this->registrationTypeId);
        $ownerType = LookupGroupData::getActiveGroupDataByLookupGroup($this->ownerTypeId);

        $processType = LookupGroupData::getActiveGroupDataByLookupGroup($this->processTypeId);
        $millType = LookupGroupData::getActiveGroupDataByLookupGroup($this->millTypeId);
        $capacity = LookupGroupData::getActiveGroupDataByLookupGroup($this->capacityId);
        //$certificate = LookupGroupData::getActiveGroupDataByLookupGroup($this->certificateTypeId);
        $certificate = CertificateIssur::getCertificate();
        //$certificateEdit =
        $certificateIssuer = CertificateIssur::getIssuerByAjax();
        $issueBy = LookupGroupData::getActiveGroupDataByLookupGroup($this->issureTypeId);
        $editMillData = MillerInfo::getMillData($millerInfoId);
        $editEntrepData = Entrepreneur::getEntrepreneurData($millerInfoId);
        $getEntrepreneurRowData = Entrepreneur::getEntrepreneurRowData($millerInfoId);
        $associationId = AssociationSetup::singleAssociation();
        return view('profile.miller.certificateInformationNew',compact('millerInfoId','registrationType','ownerType','getDivision','getZone','processType','millType','capacity','certificate','issueBy','editMillData','editEntrepData','getEntrepreneurRowData','getDistrict','associationId','certificateIssuer','getUpazilla'));
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
//        dd($request->input());
//        $data = array();
        $millerInfoId = $request->input('MILL_ID');
        $certificateId = $request->input('CERTIFICATE_ID');
        $image = $request->file('user_image');

        $millinfo = count($_POST['CERTIFICATE_TYPE_ID']);
        for($i = 0; $i<$millinfo; $i++){
            $tempName = null;
           if (isset($image[$i]) && $image[$i]->isValid()) {
               try {
                   $file = $image[$i];
                   $tempName = $tempName . date("Y-m-d") . $i . '_' . time() . '.' . $file->getClientOriginalExtension();

                   $image[$i]->move("image/user-image", $tempName);

               } catch (Illuminate\Filesystem\FileNotFoundException $e) {

               }
           }

           $data = array(
                   'MILL_ID' => $millerInfoId,
                   'CERTIFICATE_TYPE_ID' => $request->input('CERTIFICATE_TYPE_ID')[$i],
                   'ISSURE_ID' => $request->input('ISSURE_ID')[$i],
                   'DISTRICT_ID' => $request->input('DISTRICT_ID')[$i],
                   'ISSUING_DATE' => date('Y-m-d', strtotime($request->input('ISSUING_DATE')[$i])),
                   'CERTIFICATE_NO' => $request->input('CERTIFICATE_NO')[$i],
                   'RENEWING_DATE' => date('Y-m-d', strtotime($request->input('RENEWING_DATE')[$i])),
                   'REMARKS' => $request->input('REMARKS')[$i],
                   'UPDATE_BY' => Auth::user()->id,
                   'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s")
           );
            if(!empty($tempName)){
                $data['TRADE_LICENSE'] = 'image/user-image/' . $tempName;
            }
//            else{
//                $data['TRADE_LICENSE'] = $request->input('tradeFile')[$i];
//            }

           if(!empty($certificateId[$i])){
               $update = DB::table('ssm_certificate_info')->where('CERTIFICATE_ID',$certificateId[$i])->update($data);
           } else{
               $inset = DB::table('ssm_certificate_info')->insert($data);
           }

       }
//       $this->pr($request);

        return Redirect::back()->with('message','Certificate Updated Successful !');
//        return $request;

    }

    public function updateCertificateInfoNormalTem(Request $request)
//    public function updateCertificateInfo(Request $request)
    {
//        dd($request);
//        $rules = array(
////            'CERTIFICATE_TYPE_ID.*' => 'required',
////            'ISSURE_ID.*' => 'required',
////            'ISSUING_DATE.*' => 'required',
////            'CERTIFICATE_NO.*' => 'required',
////            'user_image.*' => 'required',
////            'RENEWING_DATE.*' => 'required',
//        );
//        $data = array();
//        $validator = Validator::make(Input::all(), $rules);
//        if($validator->fails()){
//            return Redirect::back()->withErrors($validator);
//        }else {
//            $millerInfoId = $request->input('MILL_ID');
//            //$this->pr($request->input());
//            $reqTime = count($_POST['CERTIFICATE_TYPE_ID']); //$this->pr($request->file('user_image'));
//            for ($i = 0; $i < $reqTime; $i++) {
//                // file upload
//                $userImageName[$i] = '';
//                if ($request->file('user_image')[$i] != null && $request->file('user_image')[$i]->isValid()) {
//                    try {
//                        $file = $request->file('user_image')[$i];
//                        $tempName = strtolower(str_replace(' ', '', $request->input('user_image')[$i]));
//                        $userImageName[$i] = $tempName . date("Y-m-d") . $i . '_' . time() . '.' . $file->getClientOriginalExtension();
//
//                        $request->file('user_image')[$i]->move("image/user-image", $userImageName[$i]);
//
//                    } catch (Illuminate\Filesystem\FileNotFoundException $e) {
//
//                    }
//                }
//                $data[] = array(
//                    'MILL_ID' => $request->input('MILL_ID'),
//                    'CERTIFICATE_TYPE_ID' => $request->input('CERTIFICATE_TYPE_ID')[$i],
//                    'ISSURE_ID' => $request->input('ISSURE_ID')[$i],
//                    'DISTRICT_ID' => $request->input('DISTRICT_ID')[$i],
//                    'ISSUING_DATE' => date('Y-m-d', strtotime($request->input('ISSUING_DATE')[$i])),
//                    'CERTIFICATE_NO' => $request->input('CERTIFICATE_NO')[$i],
//                    //'TRADE_LICENSE' => 'image/user-image/'.$request->file('user_image')[$i],
//                    'TRADE_LICENSE' => 'image/user-image/' . $userImageName[$i],
//                    'RENEWING_DATE' => date('Y-m-d', strtotime($request->input('RENEWING_DATE')[$i])),
//                    'CERTIFICATE_TYPE' => $request->input('CERTIFICATE_TYPE')[$i],
//                    'IS_EXPIRE' => $request->input('IS_EXPIRE')[$i],
//                    'REMARKS' => $request->input('REMARKS')[$i],
//                    'center_id' => Auth::user()->center_id,
//                    'ENTRY_BY' => Auth::user()->id,
//                    'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
//                );
//                //$this->pr($data);exit();
//                //var_dump($data);exit();
//                // -/---file upload
//
//            } //end for
//            //dd($data);
//            $insert = DB::table('tem_ssm_certificate_info')->insert($data);
//
//        }
//
//        return Redirect::back()->with('message','Certificate Updated Successful !');

        //        $data = array();
        $tempName = null;
        $millerInfoId = $request->input('MILL_ID');
        $certificateId = $request->input('CERTIFICATE_ID');
        $image = $request->file('user_image');

        $millinfo = count($_POST['CERTIFICATE_TYPE_ID']);
        for($i = 0;$i <$millinfo; $i++){
            if (isset($image[$i]) && $image[$i]->isValid()) {
                try {
                    $file = $image[$i];
                    $tempName = $tempName . date("Y-m-d") . $i . '_' . time() . '.' . $file->getClientOriginalExtension();

                    $image[$i]->move("image/user-image", $tempName);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {

                }
            }

            $data = array(
                'MILL_ID' => $millerInfoId,
                'CERTIFICATE_TYPE_ID' => $request->input('CERTIFICATE_TYPE_ID')[$i],
                'ISSURE_ID' => $request->input('ISSURE_ID')[$i],
                'DISTRICT_ID' => $request->input('DISTRICT_ID')[$i],
                'ISSUING_DATE' => date('Y-m-d', strtotime($request->input('ISSUING_DATE')[$i])),
                'CERTIFICATE_NO' => $request->input('CERTIFICATE_NO')[$i],
                'RENEWING_DATE' => date('Y-m-d', strtotime($request->input('RENEWING_DATE')[$i])),
                'REMARKS' => $request->input('REMARKS')[$i],
                'UPDATE_BY' => Auth::user()->id,
                'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s")
            );
            if(!empty($tempName)){
                $data['TRADE_LICENSE'] = 'image/user-image/' . $tempName;
            }else{
                $data['TRADE_LICENSE'] = $request->input('userImage');
            }

//            if(!empty($certificateId[$i])){
//                $update = DB::table('ssm_certificate_info')->where('CERTIFICATE_ID',$certificateId[$i])->update($data);
//            } else{
//                $inset = DB::table('tem_ssm_certificate_info')->insert($data);
//            }

            $inset = DB::table('tem_ssm_certificate_info')->insert($data);

        }
        //$this->pr($data);

        return Redirect::back()->with('message','Certificate Updated Successful !');

    }

    public function singleCertificateDeleteByAjax(Request $request){
        $certificateId = $request->input('certificateId');
        $delete = DB::table('ssm_certificate_info')->where('CERTIFICATE_ID',$certificateId)->delete();
        return "Certificate Successfully Deleted";
    }


} // END CLASS
