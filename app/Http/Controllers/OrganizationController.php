<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Organization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use UxWeb\SweetAlert\SweetAlert;
use Illuminate\Support\Facades\Route;

class OrganizationController extends Controller
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
        //$this->pr($previllage);

        $createOrganisation = trans('organization.organisation_create');


            $heading=array(
                'title'=>$createOrganisation,
                'library'=>'datatable',
                'modalSize'=>'modal-lg',
                'action'=>'organizations/create',
                'createPermissionLevel' => $previllage->CREATE
            );


        $organizations = Organization::getData();
        return view('setup.generalSetup.organization.organizationIndex', compact('organizations', 'heading','previllage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banks = Bank::getActiveBanks();
//        $this->pr($banks);
        return view("setup.generalSetup.organization.modals.createOrganization", compact('banks'));
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
            'org_name' => 'required|unique:organizations|max:191',
            //'lender_status' => 'required',
            //'org_address' => 'required|max:191',
            'email_address' => 'nullable|unique:organizations|email',
            'phone' => 'nullable|unique:organizations|regex:/^(?:\+?88)?01[15-9]\d{8}$/',
           // 'website' => 'nullable|unique:organizations|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
           //'fax' => 'required|unique:organizations|max:191',
//            'route_no' => 'nullable|unique:organizations'
        );
        $error = array(
          'org_name.required' => 'The name field is required.',
          'org_address.required' => 'The address field is required.'
        );

        $validator = Validator::make(Input::all(), $rules, $error);

        
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }else {
            //for image*************
            $name = 'orgd150718.png';
            if($request->file('org_logo')!=null && $request->file('org_logo')->isValid()) {
                try {
                    $file = $request->file('org_logo');
                    $tempName = strtolower(str_replace(' ', '', $request->input('org_name')));
                    $name = $tempName.date("dmy").'.' . $file->getClientOriginalExtension();

                    $request->file('org_logo')->move("image/organization", $name);
                } catch (Illuminate\Filesystem\FileNotFoundException $e) {

                }
            }
            $data = array([
                'org_name' => $request->input('org_name'),
                'lender_status' => $request->input('lender_status'),
                'org_address' => $request->input('org_address'),
                'org_slogan' => $request->input('org_slogan'),
                'org_logo' => 'image/organization/'.$name,
                'email_address' => $request->input('email_address'),
                'phone' => $request->input('phone'),
                'website' => $request->input('website'),
                'fax' => $request->input('fax'),
                //'active_status' => $request->input('active_status'),
                'active_status' => 1,
                'bank_id' => $request->input('bank_id'),
                'branch_id' => $request->input('branch_id'),
                'account_no' => $request->input('account_no'),
                'route_no' => $request->input('route_no'),
                'create_by' => Auth::user()->id,
            ]);

            $createOrganization = Organization::insertData($data);

            if($createOrganization){
                return response()->json(['success'=>'Organization Successfully Saved']);
              //return json_encode('Success');
            }

        }



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $organization = Organization::viewData($id);
//        $this->pr($organization);
        return view("setup.generalSetup.organization.modals.viewOrganization", compact('organization'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banks = Bank::getActiveBanks();
        $editData = Organization::editData($id);

        return view('setup.generalSetup.organization.modals.editOrganization', compact('editData','banks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $editOrganization = Organization::editData($id);
         if($editOrganization->org_name == $request->input('org_name')){
            $rules = array(
            'org_name' => 'required|max:191',
            //'lender_status' => 'required',
            //'org_address' => 'required|max:191',
            'email_address' => 'nullable|email',
            'phone' => 'nullable|regex:/^(?:\+?88)?01[15-9]\d{8}$/',
            //'website' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            //'fax' => 'required|max:191',
//            'route_no' => 'nullable'

        ); 
        }else{
            $rules = array(
               'org_name' => 'required|unique:organizations|max:191',
               //'lender_status' => 'required',
                //'org_address' => 'required|max:191',
                'email_address' => 'nullable|unique:organizations|email',
                'phone' => 'nullable|unique:organizations|regex:/^(?:\+?88)?01[15-9]\d{8}$/',
                //'website' => 'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                //'fax' => 'required|max:191',
//            'route_no' => 'nullable|unique:organizations'
        ); 
        }
        $error = array(
          'org_name.required' => 'The name field is required.',
          'org_address.required' => 'The address field is required.'
        );
       

        $validator = Validator::make(Input::all(), $rules, $error);

       
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }else {
//            For Image
            $name = 'orgd150718.png';
            if($request->Input('org_logo')!='' && $request->file('org_logo')->isValid()) {
                try {
                    $file = $request->file('org_logo');
                    $tempName = strtolower(str_replace(' ', '', $request->input('org_name')));
                    $name = $tempName.date("dmy").'.' . $file->getClientOriginalExtension();

                    $request->file('org_logo')->move("image/organization", $name);
                } catch (Illuminate\Filesystem\FileNotFoundException $e) {

                }
            }

            $updateOrganization = Organization::updateData($request, $id, $name);

        }

            session()->flash('message','Organization Successfully Updated');
            //return json_encode('Success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Organization::deleteData($id);

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
