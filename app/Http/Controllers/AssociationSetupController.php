<?php

namespace App\Http\Controllers;

use App\AssociationSetup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssociationSetupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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

        return view('setup.association.associationIndex', compact('heading', 'tree'));
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
            'cost_center_name' => 'required|unique:cost_center|max:191',
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            SweetAlert::error('Error','Cost Center Name must be unique !');
            return Redirect::back();
        } else {
            $data = array([
                'ASSOCIATION_NAME' => $request->input('ASSOCIATION_NAME'),
                'PARENT_ID' => $request->input('PARENT_ID'),
                'ACTIVE_FLG' => $request->input('ACTIVE_FLG'),
                'create_by' => Auth::user()->id,
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
        return view('setup.association.modals.editAssociation-setup', compact('editData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AssociationSetup  $associationSetup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssociationSetup $associationSetup)
    {
        //
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
