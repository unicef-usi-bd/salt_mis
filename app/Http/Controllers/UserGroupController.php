<?php


namespace App\Http\Controllers;

use App\UserGroup;
use Illuminate\Http\Request;
use UxWeb\SweetAlert\SweetAlert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class UserGroupController extends Controller
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
        $usergroup = trans('module.user_group_create');
        $heading=array(
            'title'=>$usergroup,
            'library'=>'datatable',
            'modalSize'=>'modal-md',
            'action'=>'user-groups/create',
            'createPermissionLevel' => $previllage->CREATE
        );

        $userGroups = UserGroup::getData();

        return view('accessControl.userGroup.userGroupIndex',compact( 'userGroups','heading','previllage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('accessControl.userGroup.modals.createUserGroup');
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
            'group_name' => 'required',
            //'active_status' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails())
        {
            //return response()->json(['errors'=>$validator->errors()->all()]);
            return Redirect::back()->withErrors($validator);
        }else {
            $data = array([
                'USERGRP_NAME' => $request->input('group_name'),
                'ORG_ID' => 1,
                //'IS_ACTIVE' => $request->input('active_status'),
                'IS_ACTIVE' => 1,
                'CREATED_BY' => auth()->user()->id,
                'CREATED_AT' => date("Y-m-d h:i:s"),
            ]);

            $role = UserGroup::insertData($data);

            if ($role) {
                //return response()->json(['success'=>'User Group Successfully Saved']);
                return redirect('/user-groups')->with('success', 'User Group Successfully Saved!');
                //return json_encode('Success');
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

        $role = Role::viewData($id);
        //$this->pr($crop);
        return view('accessControl.acSetup.roles.modals.viewRole', compact('role'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $editUserGroup = UserGroup::editData($id);
        return view('accessControl.userGroup.modals.editUserGroup', compact('editUserGroup'));
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
        $editUserGroup = UserGroup::editData($id);
        if ($editUserGroup->USERGRP_NAME == $request->input('group_name')) {
            $rules = array(
            'group_name' => 'required',
            //'active_status' => 'required',
        );
        }else{
             $rules = array(
            'group_name' => 'required',
            //'active_status' => 'required',
        );
        }
       
        $validator = Validator::make(Input::all(), $rules);
         if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }else {
            $updateUserGroup = UserGroup::updateData($request, $id);

            }

            session()->flash('message','User Group Successfully Updated');
            //return json_encode('Success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $delete = UserGroup::deleteData($id);
        if($delete){
            echo json_encode([
                'type' => 'div',
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


