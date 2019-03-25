<?php

namespace App\Http\Controllers;
use App\Module;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use UxWeb\SweetAlert\SweetAlert;
use Illuminate\Support\Facades\Route;

class ModuleController extends Controller
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

        $moduleCreate = trans('module.module_create');

        $heading = array(
            'title'=>$moduleCreate,
            'library'=>'datatable',
            'modalSize'=>'modal-md  ',
            'action'=>'modules/create',
            'createPermissionLevel' => $previllage->CREATE
        );


        $modules = Module::getMData();

//        $link_url = 'module_list';// module url
//        $data['access'] = Module::checkPrevilege($link_url);// get access info by module url
//        print_r($data);exit;
        return view('accessControl.modules.moduleIndex', compact('heading', 'modules','previllage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accessControl.modules.modals.createModule');
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
            'module_name' => 'required',
            //'module_icon' => 'required',
            //'active_status' => 'required',
            'sl_no' => 'required'
        );
        $errors = array(
            'sl_no.required' => 'The SL no field is required.'
        );
        $validator = Validator::make(Input::all(), $rules,$errors);
         if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }else {
            $data = array([
                'MODULE_NAME' => $request->input('module_name'),
                'MODULE_ICON' => $request->input('module_icon'),
                'SL_NO' => $request->input('sl_no'),
                //'IS_ACTIVE' => $request->input('active_status'),
                'IS_ACTIVE' => 1,
                'CREATED_BY' => auth()->user()->id,
                'CREATED_AT' => date("Y-m-d h:i:s"),
            ]);

            $role = Module::insertData($data);

            if ($role) {
                return response()->json(['success'=>'Module Successfully Saved']);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editModule = Module::editData($id);
        return view('accessControl.modules.modals.editModule',compact('editModule'));

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
        $editModule = Module::editData($id);
        if ($editModule->MODULE_NAME == $request->input('MODULE_NAME')) {
            $rules = array(
            'module_name' => 'required',
            //'module_icon' => 'required',
            //'active_status' => 'required',
                'sl_no' => 'required'
        );
        } else{
            $rules = array(
            'module_name' => 'required',
            //'module_icon' => 'required',
            //'active_status' => 'required',
             'sl_no' => 'required'
        );
        }
        $errors = array(
            'sl_no.required' => 'The SL no field is required.'
        );
       
        $validator = Validator::make(Input::all(), $rules,$errors);
         if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }else {
            $updateModule = Module::updateData($request, $id);

        }
        session()->flash('message','Module Successfully Updated');

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
        $delete = Module::deleteData($id);
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
