<?php

namespace App\Http\Controllers;

use App\CrudeSaltDetails;
use Illuminate\Http\Request;
use App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\LookupGroup;
use UxWeb\SweetAlert\SweetAlert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class CrudeSaltDetailsController extends Controller
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
        $title = trans('Crude Salt Create');

        $heading=array(
            'title'=> $title,
            'library'=>'datatable',
            'modalSize'=>'modal-md',
            'action'=>'crude-salt-details/create',
            'createPermissionLevel' => $previllage->CREATE
        );

        $crudeSalt = CrudeSaltDetails::getBasicSetupData();

        //print_r($lookupGroups);exit;
        return view('setup.crudeSalt.crudeSaltIndex', compact( 'heading','previllage','crudeSalt'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('setup.crudeSalt.modals.createCrudeSalt');
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
            'LOOKUPMST_NAME' => 'required|max:60',
            'UD_SL' => 'required|integer'
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {
           $data = array([
                'LOOKUPMST_NAME' => $request->input('LOOKUPMST_NAME'),
                'UD_SL' => $request->input('UD_SL'),
                'DESCRIPTION' => $request->input('DESCRIPTION'),
                //'active_status' => $request->input('active_status'),
                'ACTIVE_FLG' => $request->input('ACTIVE_FLG'),
                'ENTRY_BY' => Auth::user()->id
           ]);

            $lookupGroup = LookupGroup::insertIntoSSCLookupMst($data);
               
            if($lookupGroup){
    //            return response()->json(['success'=>'Lookup Group Successfully Saved']);
                //return json_encode('Success');
                return redirect('/lookup-groups')->with('success', 'Lookup Group Data Created !');
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
        $lookupGroup = LookupGroup::viewSSCLookupMst($id);


        return view('setup.crudeSalt.modals.viewCrudeSalt');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
     {

//        $lookupGroup = LookupGroup::editSSCLookupMst($id);
        $lookupGroup = LookupGroup::editSSCLookupMst(1);


        return view('setup.crudeSalt.modals.editCrudeSalt' , compact('lookupGroup'));

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
            'LOOKUPMST_NAME' => 'required|max:60',
            'UD_SL' => 'required|integer'
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {
        $updateLookupGroup = LookupGroup::updateSSCLookupMst($request, $id);
            if($updateLookupGroup){
                return redirect('/lookup-groups')->with('success', 'Lookup Group Data Updated !');
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
        $delete = LookupGroup::deleteSSCLookupMst($id);
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
