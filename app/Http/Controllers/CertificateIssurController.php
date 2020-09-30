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
        $title = 'Certificate Issuer Setup';

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
        $certificates = LookupGroupData::getActiveGroupDataByLookupGroup($this->certificateTypeId);
        $issuers= LookupGroupData::getActiveGroupDataByLookupGroup($this->certificateissureTypeId);
        $millTypes = LookupGroupData::getActiveGroupDataByLookupGroup($this->millTypeId);
        return view('setup.certificateIssur.modals.createCertificateIssuer',compact('certificates', 'issuers', 'millTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $certificateId = $request->input('CERTIFICATE_TYPE_ID');
        $issuerId = $request->input('ISSUR_ID');
        $rules = array(
            'CERTIFICATE_TYPE_ID' => 'required',
            'ISSUR_ID' => 'required',
            'mill_type_id' => 'required',
        );
        $error = array(
            'CERTIFICATE_TYPE_ID.required' => 'Certificate field is required.',
            'ISSUR_ID.required' => 'Issuer field is required.',
            'mill_type_id.required' => 'Mill type field is required.'
        );

        $validator = Validator::make(Input::all(), $rules, $error);

        if ($validator->fails()) return response()->json(['errors'=>$validator->errors()->first()]);

        $hasDuplicate = CertificateIssur::checkDuplicates($certificateId, $issuerId);

        if($hasDuplicate) return response()->json(['errors'=>'Certificate and issuer mapping already exist.']);

        $data = array([
            'CERTIFICATE_TYPE_ID' => $request->input('CERTIFICATE_TYPE_ID'),
            'ISSUR_ID' => $request->input('ISSUR_ID'),
            'CERTIFICATE_TYPE' => $request->input('CERTIFICATE_TYPE') ? : 0,
            'mill_type_id' => $request->input('mill_type_id') ? : 0,
            'IS_EXPIRE' => $request->input('IS_EXPIRE') ? : 0,
            'ACTIVE_FLG' => $request->input('ACTIVE_FLG'),
            'center_id' => Auth::user()->center_id,
            'ENTRY_BY' => Auth::user()->id,
            'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
        ]);

        $inserted = CertificateIssur::insertItemData($data);

        if($inserted){
            return response()->json(['success'=>'Certificate and issuer mapping has been created.']);
        } else{
            return response()->json(['errors'=>'Certificate and issuer mapping create failed.']);
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
        $certificates = LookupGroupData::getActiveGroupDataByLookupGroup($this->certificateTypeId);
        $issuers= LookupGroupData::getActiveGroupDataByLookupGroup($this->certificateissureTypeId);
        $millTypes = LookupGroupData::getActiveGroupDataByLookupGroup($this->millTypeId);
//        dd($millTypes);
        return view('setup.certificateIssur.modals.editCertificateIssuer',compact('issuerEdit', 'certificates', 'issuers', 'millTypes'));
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
        $certificateId = $request->input('CERTIFICATE_TYPE_ID');
        $issuerId = $request->input('ISSUR_ID');
        $rules = array(
            'CERTIFICATE_TYPE_ID' => 'required',
            'ISSUR_ID' => 'required',
            'mill_type_id' => 'required'
        );
        $error = array(
            'CERTIFICATE_TYPE_ID.required' => 'Certificate field is required.',
            'ISSUR_ID.required' => 'Issuer field is required.',
            'mill_type_id.required' => 'Mill type field is required.'
        );

        $validator = Validator::make(Input::all(), $rules, $error);

        if ($validator->fails()) return response()->json(['errors'=>$validator->errors()->first()]);

        $hasDuplicate = CertificateIssur::checkDuplicates($certificateId, $issuerId, $id);

        if($hasDuplicate) return response()->json(['errors'=>'Certificate and issuer mapping already exist.']);

        $updated = CertificateIssur::updateCertificateIssuer($request,$id);

        if($updated){
            return response()->json(['success'=>'Certificate and issuer mapping has been updated.']);
        } else{
            return response()->json(['errors'=>'Certificate and issuer mapping update failed.']);
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

    public function getProviderByCertificateId($id)
    {
        $providers = CertificateIssur::getProviderByCertificateId($id);
        $options = '<option value="">Select</option>';
        if($providers){
            foreach ($providers as $provider){
                $options .= '<option value="'.$provider->ISSUR_ID.'">'.$provider->ISSUER_NAME.'</option>';
            }
        }
        return $options;
    }
}
