<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\UserGroupLevel;
use Illuminate\Http\Request;
use UxWeb\SweetAlert\SweetAlert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;


class UserGroupLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::getActiveUser();
        $roles = UserGroup::where('id','!=',1)->get();
        return view('accessControl.userPermissions.userPermissionIndex',compact( 'users','roles'));
    }

    public function getUserGroupLevelsByAjax(Request $request){
        $groupId = $request->input('group_id');
        return UserGroupLevel::getActiveUGL($groupId);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        return view('accessControl.userPermissions.modals.createUserPermission');
    }

    public function createData($id)
    {
        return view('accessControl.userGroup.modals.createUserGroupLevel', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userGrpID = $request->input('group_id');
        $positionID = $request->input('POSITIONLEVEl');
        $rules = array(
            'group_level_name' => 'required',
            'group_id' => 'required',
            'active_status' => 'required',
        );
        $error = array(
            'group_level_name.required' => 'Group level name field is required.',
            'group_id.required' => 'Group Id name field is required.',
        );

        $validator = Validator::make(Input::all(), $rules, $error);
        if ($validator->fails()) return response()->json(['errors' => $validator->errors()->first()]);

        $check = DB::table('sa_ug_level')->select('*')
            //->where('USERGRP_ID',$userGrpID)
            ->where('POSITIONLEVEl',$positionID)
            ->first();

        if(empty($check)) {
            $data = array([
                'UGLEVE_NAME' => $request->input('group_level_name'),
                'USERGRP_ID' => $request->input('group_id'),
                'ORG_ID' => 1,
                'IS_ACTIVE' => $request->input('active_status'),
                'POSITIONLEVEl' => $request->input('POSITIONLEVEl'),
                'CREATED_BY' => auth()->user()->id,
                'CREATED_AT' => date("Y-m-d h:i:s"),
            ]);

            $role = UserGroupLevel::insertData($data);

            if ($role) {
                return response()->json(['success' => 'Submission Completed.']);
            } else {
                return response()->json(['errors' => 'Submission failed.']);
            }
        }else{
            return response()->json(['errors' => 'This Position already exist.!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserPermission  $userPermission
     * @return \Illuminate\Http\Response
     */
    public function show(UserPermission $userPermission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserPermission  $userPermission
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editUserGroupLevel = UserGroupLevel::editData($id);
        return view('accessControl.userGroup.modals.editUserGroupLevel', compact('editUserGroupLevel'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserPermission  $userPermission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $positionID = $request->input('POSITIONLEVEl');

        $rules = array(
            'group_level_name' => 'required',
            'active_status' => 'required',
        );

        $error = array(
            'group_level_name.required' => 'Group level name field is required.',
            'group_id.required' => 'Group Id name field is required.',
        );

        $validator = Validator::make(Input::all(), $rules, $error);
        if ($validator->fails()) return response()->json(['errors' => $validator->errors()->first()]);

//        $check = DB::table('sa_ug_level')->select('*')
//            //->where('USERGRP_ID',$userGrpID)
//            ->where('POSITIONLEVEl',$positionID)
//            ->first();

            $updateUserGroupLevel = UserGroupLevel::updateData($request, $id);

            if ($updateUserGroupLevel) {
                return response()->json(['success' => 'Submission Completed.']);
            }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserPermission  $userPermission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = UserGroupLevel::deleteData($id);
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
