<?php

namespace App\Http\Controllers;

use App\Module;
use App\ModuleLink;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use UxWeb\SweetAlert\SweetAlert;
use Illuminate\Support\Facades\Route;

class ModuleLinkController extends Controller
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

        $modulelink = trans('moduleLinks.module_link_create');
        $heading = array(
            'title'=>$modulelink,
            'library'=>'datatable',
            'modalSize'=>'modal-md  ',
            'action'=>'module-links/create',
            'createPermissionLevel' => $previllage->CREATE
        );
        $moduleLinks = ModuleLink::getMLData();
//        $this->pr($moduleLinks);
        return view('accessControl.moduleLinks.moduleLinkIndex', compact('heading', 'moduleLinks','previllage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modules = Module::getActiveMData();
        return view('accessControl.moduleLinks.modals.createModuleLink', compact('modules'));
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
            'module_id' => 'required',
            'link_name' => 'required',
            'link_url' => 'required',
        );
         $error = array(
            'module_id.required' => 'The module name field is required.',
        );
        $validator = Validator::make(Input::all(), $rules,$error);
       if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }else {
            $create = $request->input('create')==null?'0':$request->input('create');
            $view = $request->input('view')==null?'0':$request->input('view');
            $update = $request->input('update')==null?'0':$request->input('update');
            $delete = $request->input('delete')==null?'0':$request->input('delete');
            $status = $request->input('status')==null?'0':$request->input('status');

            $data = array([
                'MODULE_ID' => $request->input('module_id'),
                'LINK_NAME' => $request->input('link_name'),
                'LINK_URI' => $request->input('link_url'),
                'SL_NO' => $request->input('sl_no'),
                'CREATE' => $create,
                'READ' => $view,
                'UPDATE' => $update,
                'DELETE' => $delete,
                'STATUS' => $status,
                'CREATED_BY' => auth()->user()->id,
                'CREATED_AT' => date("Y-m-d h:i:s"),
            ]);

            $insert = ModuleLink::insertData($data);

            if ($insert) {
                return response()->json(['success'=>'Module Link  Successfully Saved']);
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
        $modules = Module::getActiveMData();
        $editData = ModuleLink::editData($id);

        return view('accessControl.moduleLinks.modals.editModuleLink', compact('modules', 'editData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $editModuleLink = ModuleLink::editData($id);
        if ($editModuleLink->LINK_NAME == $request->input('link_name')){
            $rules = array(
            'module_id' => 'required',
//            'link_name' => 'required',
//            'link_url' => 'required',
        );

        } else{
            $rules = array(
            'module_id' => 'required',
            'link_name' => 'required',
            'link_url' => 'required',
        );
        }
        $error = array(
            'module_id.required' => 'The module name field is required.',
        );
        $validator = Validator::make(Input::all(), $rules, $error);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }else {
            $update = ModuleLink::updateData($request, $id);

        }
        session()->flash('message','Module Link Successfully Updated');
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
        $delete = ModuleLink::deleteData($id);
        if($delete){
            echo json_encode([
                'type' => 'tr',
                'id' => $id,
                'flag' => true,
                'message' => 'Module Link Successfully Deleted.',
            ]);
        } else{
            echo json_encode([
                'message' => 'Error Founded Here!',
            ]);
        }
    }
}
