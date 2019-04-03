<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RequireChemicalPerKg;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class RequireChemicalPerKgController extends Controller
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
        $heading=array(
            'title'=>'Require Chemical Per KG',
            'library'=>'datatable',
            'modalSize'=>'modal-md',
            'action'=>'require-chemical-per-kg/create',
            'createPermissionLevel' => $previllage->CREATE
        );

        $requiredPerkgs = RequireChemicalPerKg::getALLRequiredPerKg();

        return view('setup.requireChemical.requireChemicalIndex',compact('heading','requiredPerkgs','previllage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $chemicalTypes = Item::itemTypeWiseItemList($this->chemicalId);
        return view('setup.requireChemical.modals.createRequirechemial',compact('chemicalTypes'));
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
            'SALT_AMOUNT' => 'required',
            'ITEM_NO' => 'required',
            'CHEMICAL_AMOUNT' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {
            $data = array([
                'SALT_AMOUNT' => $request->input('SALT_AMOUNT'),
                'CHEMICAL_AMOUNT' => $request->input('CHEMICAL_AMOUNT'),
                'ITEM_NO' => $request->input('ITEM_NO'),
                'WASTAGE_AMOUNT' => $request->input('WASTAGE_AMOUNT'),
                'ACTIVE_FLG' => $request->input('ACTIVE_FLG'),
                'ENTRY_BY' => Auth::user()->id
            ]);

            $requirePerKg = RequireChemicalPerKg::insertRequiredPerKgData($data);

            if($requirePerKg){
                return redirect('/require-chemical-per-kg')->with('success', 'Require Chemical Per Kg Data Created !');
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
        $viewRequiredPerkg = RequireChemicalPerKg::viewRequiredPerKgData($id);
        return view('setup.requireChemical.modals.viewRequireChemical',compact('viewRequiredPerkg'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editRequiredPerkg = RequireChemicalPerKg::editRequiredPerKgData($id);
        $chemicalTypes = Item::itemTypeWiseItemList($this->chemicalId);
        return view('setup.requireChemical.modals.editRequirechemical',compact('editRequiredPerkg','chemicalTypes'));
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
            'SALT_AMOUNT' => 'required',
            'ITEM_NO' => 'required',
            'CHEMICAL_AMOUNT' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {
            $updateRequireChemicalPerKg = RequireChemicalPerKg::updateRequiredPerKgData($request,$id);
            if($updateRequireChemicalPerKg){
                return redirect('/require-chemical-per-kg')->with('success', 'Require Chemical Per Kg Data Updated !');
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
        $delete = RequireChemicalPerKg::deleteRequiredPerKgData($id);
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
