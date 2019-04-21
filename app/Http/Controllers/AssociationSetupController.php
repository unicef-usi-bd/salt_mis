<?php

namespace App\Http\Controllers;

use App\AssociationSetup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use UxWeb\SweetAlert\SweetAlert;
use Illuminate\Support\Facades\Route;

class AssociationSetupController extends Controller
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

        $create_cc= trans('dashboard.create_level');
        $heading = array(
            'pageTitle'=>$create_cc,
            'library'=>'datatable',
            'modalSize'=>'modal-md',
            'action_tree'=>'organizations/create'
        );
        $organogramDt = AssociationSetup::getAssociationData();

        $resultArray = json_decode(json_encode($organogramDt), true);
        $tree  = $this->buildTree($resultArray, 'PARENT_ID','ASSOCIATION_ID');
//        $this->pr($tree);

        return view('setup.association.associationIndex', compact('heading', 'tree','previllage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $pr_id = $id;
        return view('setup.association.modals.createAssociation', compact( 'pr_id'));
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
            'ASSOCIATION_NAME' => 'required|unique:ssm_associationsetup|max:191',
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator);
        } else {
            $data = array([
                'ASSOCIATION_NAME' => $request->input('ASSOCIATION_NAME'),
                'PARENT_ID' => $request->input('PARENT_ID'),
                'center_id' => Auth::user()->center_id,
                'ACTIVE_FLG' => $request->input('ACTIVE_FLG'),
                'ENTRY_BY' => Auth::user()->id,
            ]);
//            $this->pr($data);
            $associationSetup = AssociationSetup::insertAssociationData($data);

            if($associationSetup){
                return redirect('/association-setup')->with('success', 'Level Created Successfully');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AssociationSetup  $associationSetup
     * @return \Illuminate\Http\Response
     */
    public function show(AssociationSetup $associationSetup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AssociationSetup  $associationSetup
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editData = AssociationSetup::editAssociationData($id);
        return view('setup.association.modals.editAssociation', compact('editData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AssociationSetup  $associationSetup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'ASSOCIATION_NAME' => 'required|unique:ssm_associationsetup|max:191',
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator);
        } else {

            $updateAssociationSetupData = AssociationSetup::updateAssociationData($id,$request);

            if($updateAssociationSetupData){
                return redirect('/association-setup')->with('success', 'Level Updated Successfully');
            }

        }

        session()->flash('message','Cost Center Successfully Updated');
        //return json_encode('Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AssociationSetup  $associationSetup
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = AssociationSetup::deleteAssociationData($id);

        if($delete){
            echo json_encode([
                'type' => 'li',
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
