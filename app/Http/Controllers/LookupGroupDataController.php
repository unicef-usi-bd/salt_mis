<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\LookupGroupData;
use UxWeb\SweetAlert\SweetAlert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class LookupGroupDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $heading=array(
            'title'=>'Group Data Create',
            'library'=>'datatable',
            'modalSize'=>'modal-md',
            'action'=>'lookup-groups/create'
        );
        return view('setup.generalSetup.lookupGroups.lookupGroupIndex', compact('heading'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createData($id)
    {
        return view('setup.generalSetup.lookupGroups.modals.createLookupGroupData', compact('id'));
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
            'LOOKUPCHD_NAME' => 'required|max:60',
//            'UD_ID' => 'required|integer|unique:ssc_lookupchd'
        );
        $error = array(
            'LOOKUPCHD_NAME.required' =>'The Group Data Name field is required.',
//            'UD_ID.required' => 'The User Define Id field is required.',
//            'UD_ID.unique' => 'The User Define Id already been taken.',
        );

        $validator = Validator::make(Input::all(), $rules,$error);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {

            $data = array([
                'LOOKUPMST_ID' => $request->input('LOOKUPMST_ID'),
                'LOOKUPCHD_NAME' => $request->input('LOOKUPCHD_NAME'),
                'UD_ID' => $request->input('UD_ID'),
                'DESCRIPTION' => $request->input('DESCRIPTION'),
                'ACTIVE_FLG' => $request->input('ACTIVE_FLG'),
                'center_id' => Auth::user()->center_id,
                'ENTRY_BY' => Auth::user()->id
            ]);

            $lookupGroupData = LookupGroupData::insertSSCLookGroupData($data);

//            if ($lookupGroupData) {
//                return response()->json(['success'=>'Lookup Group Successfully Saved']);
//                return json_encode('Success');
//            }

            if($lookupGroupData){
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
        $lookupGroupData = LookupGroupData::viewSSCLookGroupData($id);


        return view('setup.generalSetup.lookupGroups.modals.viewLookupGroupData' , compact('lookupGroupData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lookupGroupData = LookupGroupData::editSSCLookGroupData($id);
        return view('setup.generalSetup.lookupGroups.modals.editLookupGroupData' , compact('lookupGroupData'));
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
            'LOOKUPCHD_NAME' => 'required|max:60',
            //'UD_ID' => 'required|integer'
        );
        $error = array(
            'LOOKUPCHD_NAME.required' =>'The Group Data Name field is required.',
            //'UD_ID.required' => 'The User Define Id field is required.',
        );

        $validator = Validator::make(Input::all(), $rules,$error);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else  {

            $lookupGroupData = LookupGroupData::updateSSCLookGroupData($request, $id);
            if($lookupGroupData){
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
        $delete = LookupGroupData::deleteSSCLookGroupData($id);

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
