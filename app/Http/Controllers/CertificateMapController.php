<?php

namespace App\Http\Controllers;

use App\CertificateMap;
use App\LookupGroupData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class CertificateMapController extends Controller
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
        $title = trans('Certificate Map');

        $heading=array(
            'title'=> $title,
            'library'=>'datatable',
            'modalSize'=>'modal-md',
            'action'=>'certificate-map/create',
            'createPermissionLevel' => $previllage->CREATE
        );

        $certificates = CertificateMap::getData();

//        $this->pr($certificates);

        return view('profile.certificateMap.certificateMapIndex',compact('heading','previllage','certificates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $certificate = LookupGroupData::getActiveGroupDataByLookupGroup($this->certificateTypeId);
        $issueBy = LookupGroupData::getActiveGroupDataByLookupGroup($this->issureTypeId);

        return view('profile.certificateMap.modal.createCertificateMap',compact('certificate','issueBy'));
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
            'ISSURE_ID' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {
            $data = array([
                'CERTIFICATE_TYPE_ID' => $request->input('CERTIFICATE_TYPE_ID'),
                'ISSURE_ID' => $request->input('ISSURE_ID'),
                'center_id' => Auth::user()->center_id,
                'ENTRY_BY' => Auth::user()->id
            ]);

            $certificateMap = CertificateMap::insertData($data);

            if($certificateMap){
                return redirect('/certificate-map')->with('success', 'Certificate Map Created !');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CertificateMap  $certificateMap
     * @return \Illuminate\Http\Response
     */
    public function show(CertificateMap $certificateMap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CertificateMap  $certificateMap
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editCertificate = CertificateMap::editData($id);
        $certificate = LookupGroupData::getActiveGroupDataByLookupGroup($this->certificateTypeId);
        $issueBy = LookupGroupData::getActiveGroupDataByLookupGroup($this->issureTypeId);
        return view('profile.certificateMap.modal.editCertificateMap',compact('editCertificate','certificate','issueBy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CertificateMap  $certificateMap
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'CERTIFICATE_TYPE_ID' => 'required',
            'ISSURE_ID' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {
            $updateCertificate = CertificateMap::updateData($request,$id);
            if($updateCertificate){
                return redirect('/certificate-map')->with('success', 'Certificate Map Data Updated !');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CertificateMap  $certificateMap
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = CertificateMap::deleteData($id);
        if($delete){
            echo json_encode([
                'type' => 'tr',
                'id' => $id,
                'flag' => true,
                'message' => 'Level Successfully Deleted.',
            ]);
        } else{
            echo json_encode([
                'message' => 'Error Founded Here!',
            ]);
        }
    }
}
