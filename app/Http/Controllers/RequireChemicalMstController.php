<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Item;
use App\RequireChemicalMst;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\LookupGroupData;

class RequireChemicalMstController extends Controller
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

        //$title = trans('lookupGroupIndex.create_lookup');

/*        $heading=array(
            'title'=> 'Require Chemical Per Kg',
            'library'=>'datatable',
            'modalSize'=>'modal-md',
            'action'=>'require-chemical-mst/create',
            'createPermissionLevel' => $previllage->CREATE
        );*/

        //$lookupGroups = LookupGroup::getSSCLookupData();
        //print_r($lookupGroups);exit;
        $requireChemical = RequireChemicalMst::getRequireChemicalData();


        //$this->pr($requireChemical);
        return view('setup.requireChemicalPerKg.requireChemicalPerKgIndex', compact( 'heading','previllage','requireChemical'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productionTypes = Item::itemTypeWiseItemList($this->finishedSaltId);

        return view('setup.requireChemicalPerKg.modals.createRequireChemicalPerKgMst',compact('productionTypes'));
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
            'PRODUCT_ID' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {
            $data = array([
                'PRODUCT_ID' => $request->input('PRODUCT_ID'),
                'ACTIVE_FLG' => $request->input('ACTIVE_FLG'),
                'ENTRY_BY' => Auth::user()->id,
                'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
            ]);

            $requirePerKg = RequireChemicalMst::insertRequireChemicalPerKg($data);

            if($requirePerKg){
                return redirect('/require-chemical-mst')->with('success', 'Require Chemical Per Kg Level Created !');
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
        $showRequireChemical = RequireChemicalMst::showRequireChemicalPerKg($id);

        return view('setup.requireChemicalPerKg.modals.viewRequireChemicalPerKgMst',compact('showRequireChemical'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editRequireChemicalPerKg = RequireChemicalMst::editRequireChemicalPerKg($id);
        $productionTypes = Item::itemTypeWiseItemList($this->finishedSaltId);

        return view('setup.requireChemicalPerKg.modals.editRequireChemicalPerKgMst',compact('editRequireChemicalPerKg','productionTypes'));
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
            'PRODUCT_ID' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {


            $updateRequirePerKg = RequireChemicalMst::updateRequireChemicalPerKg($request,$id);

            if($updateRequirePerKg){
                return redirect('/require-chemical-mst')->with('success', 'Require Chemical Per Kg Level Update !');
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
        $delete = RequireChemicalMst::deleteRequireChemicalPerKg($id);
        if($delete){
            echo json_encode([
                'type' => 'div',
                'id' => $id,
                'flag' => true,
                'message' => 'Require per kg level  Successfully Deleted.',
            ]);
        } else{
            echo json_encode([
                'message' => 'Error Founded Here!',
            ]);
        }


    }
}
