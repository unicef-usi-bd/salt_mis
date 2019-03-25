<?php

namespace App\Http\Controllers;

use App\UserGroupLevel;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use UxWeb\SweetAlert\SweetAlert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;


class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $heading=array(
            'title'=>'UserGroupLevel Create',
            'library'=>'datatable',
            'modalSize'=>'modal-md',
            'action'=>'permissions/create'
        );

        $permissions = UserGroupLevel::getData();

        return view('accessControl.acSetup.permissions.permissionIndex',compact( 'permissions','heading'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('accessControl.acSetup.permissions.modals.createPermission');

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
            'name' => 'required',
            'guard_name' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back();
        } else {
            $data = array([
                'name' => $request->input('name'),
                'guard_name' => $request->input('guard_name')
            ]);

            $permission = UserGroupLevel::insertData($data);

            if ($permission) {
                return redirect('/permissions')->with('success', 'UserGroupLevel Created Successfully');
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
        $permission = UserGroupLevel::viewData($id);
        //$this->pr($crop);
        return view('accessControl.acSetup.permissions.modals.viewPermission', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editPermission = UserGroupLevel::editData($id);

        return view('accessControl.acSetup.permissions.modals.editPermission', compact('editPermission'));
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
            'name' => 'required',
            'guard_name' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            SweetAlert::error('Error', 'Something is Wrong !');
            return Redirect::back();
        } else {
            $updatePermission = UserGroupLevel::updateData($request, $id);
            if ($updatePermission) {
                return redirect('/permissions')->with('success', 'UserGroupLevel Updated Successfully');
            }
        }
    }


    /**
     * Remove the specified resource from storage.
     *
D
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = UserGroupLevel::deleteData($id);
        if ($delete) {
            echo json_encode([
                'type' => 'tr',
                'id' => $id,
                'flag' => true,
                'message' => 'Level Successfully Deleted.',
            ]);
        } else {
            echo json_encode([
                'message' => 'Error Founded Here!',
            ]);
        }
    }
}
