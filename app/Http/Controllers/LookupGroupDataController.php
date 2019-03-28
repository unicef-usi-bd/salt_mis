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
            'group_data_name' => 'required|max:150',
            //'group_data_abbr' => 'required|max:100',
            'user_define_id' => 'required|max:11'
        );
        $error = array(
            'group_data_abbr.required' => 'The abbreviation  field is required.',
            'user_define_id.required' => 'The user define serial field is required.'
        );

        $validator = Validator::make(Input::all(), $rules, $error);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }else {

            $data = array([
                'lookup_group_id' => $request->input('lookup_group_id'),
                'group_data_name' => $request->input('group_data_name'),
                'group_data_abbr' => $request->input('group_data_abbr'),
                'user_define_id' => $request->input('user_define_id'),
                'description' => $request->input('description'),
                //'active_status' => $request->input('active_status'),
                'active_status' => 1,
                'create_by' => Auth::user()->id
            ]);

            $lookupGroupData = LookupGroupData::insertData($data);

            if ($lookupGroupData) {
                return response()->json(['success'=>'Lookup Group Successfully Saved']);
                return json_encode('Success');
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
        $lookupGroupData = LookupGroupData::viewData($id);


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
        $lookupGroupData = LookupGroupData::editData($id); 
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
        $editLookupGroupData = LookupGroupData::editData($id);

        if ($editLookupGroupData->group_data_name == $request->input('group_data_name')) {
            $rules = array(
            'group_data_name' => 'required|max:150',
            //'group_data_abbr' => 'required|max:100',
            'user_define_id' => 'required|max:11'
        );
        }else{
             $rules = array(
            'group_data_name' => 'required|max:150',
            //'group_data_abbr' => 'required|max:100',
            'user_define_id' => 'required|max:11'
        );
        }
        $error = array(
            'group_data_abbr.required' => 'The abbreviation  field is required.',
            'user_define_id.required' => 'The user define serial field is required.'
        );


         $validator = Validator::make(Input::all(), $rules, $error);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }else {

            $lookupGroupData = LookupGroupData::updateData($request, $id);
        }

            session()->flash('message','Lookup Group Successfully Updated');
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
        $delete = LookupGroupData::deleteData($id);

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
