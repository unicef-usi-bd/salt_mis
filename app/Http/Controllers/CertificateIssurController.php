<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;
use App\LookupGroup;
use App\LookupGroupData;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\CertificateIssur;

class CertificateIssurController extends Controller
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
        $title = 'Certificate Issure Setup';

        $heading=array(
            'title'=> $title,
            'library'=>'datatable',
            'modalSize'=>'modal-md',
            'action'=>'certificate/create',
            'createPermissionLevel' => $previllage->CREATE
        );
        $issuerData = CertificateIssur::getData();

        return view('setup.certificateIssur.certificateIssureIndex',compact('heading','previllage','issuerData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$issuerId = CertificateIssur::getIssuer();
        $issuerId = LookupGroupData::getActiveGroupDataByLookupGroup($this->certificateissureTypeId);
        return view('setup.certificateIssur.modals.createCertificateIssuer',compact('issuerId'));
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
            //'ITEM_TYPE' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {
            $data = array([
                'CERTIFICATE_NAME' => $request->input('CERTIFICATE_NAME'),
                'ISSUR_ID' => $request->input('ISSUR_ID'),
                'CERTIFICATE_TYPE' => $request->input('CERTIFICATE_TYPE')?:0,
                'IS_EXPIRE' => $request->input('IS_EXPIRE')?:0,
                'ACTIVE_FLG' => $request->input('ACTIVE_FLG'),
                'center_id' => Auth::user()->center_id,
                'ENTRY_BY' => Auth::user()->id,
                'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
            ]);
            //dd($request->input('IS_EXPIRE'));

            $item = CertificateIssur::insertItemData($data);

            if($item){
                return redirect('/certificate')->with('success', 'Certificate Created Successfully!');
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
        $issuerView = CertificateIssur::viewData($id);
        return view('setup.certificateIssur.modals.viewCertificateIssuer',compact('issuerView'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $issuerEdit = CertificateIssur::editData($id);
        $issuerId = LookupGroupData::getActiveGroupDataByLookupGroup($this->certificateissureTypeId);
        return view('setup.certificateIssur.modals.editCertificateIssuer',compact('issuerEdit','issuerId'));
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
            //'ITEM_TYPE' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {
            $updateCertificateIssure = CertificateIssur::updateCertificateIssuer($request,$id);
            if($updateCertificateIssure){
                return redirect('/certificate')->with('success', 'Certificate Updated !');
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
        $delete = CertificateIssur::deleteCertificateData($id);
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

    public function getIssuerIdByAjax(Request $request)
    {
        $issuerId = $request->input('issuerId');
        //echo $issuerId;die();
        //return CertificateIssur::getIssuerByAjax($issuerId);
        $issurInfo = CertificateIssur::getIssuerByAjax($issuerId);
        $certificateInfo = CertificateIssur::getCertificateInfoByID($issuerId);
        $returnArray = array();
        $returnArray = ([$issurInfo,$certificateInfo]);
        //dd($returnArray[0]);
        return $returnArray;
    }
}
