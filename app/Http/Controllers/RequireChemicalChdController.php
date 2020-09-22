<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Item;
use App\RequireChemicalChd;

class RequireChemicalChdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $heading=array(
            'title'=>'Require Chemical Per KG',
            'library'=>'datatable',
            'modalSize'=>'modal-md',
            'action'=>'require-chemical-chd/create'
        );
        return view('setup.requireChemicalPerKg.requireChemicalPerKgIndex', compact('heading'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createData($id)
    {
        $chemicleType = Item::itemTypeWiseItemList($this->chemicalId);
        $productionType = $this->finishedSaltId;
        return view('setup.requireChemicalPerKg.modals.createRequireChemicalPerKgChd',compact('id','chemicleType','productionType'));
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
            'ITEM_ID' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {
            $data = array([
                'RMALLOMST_ID' => $request->input('RMALLOMST_ID'),
                'ITEM_ID' => $request->input('ITEM_ID'),
                'USE_QTY' => $request->input('USE_QTY'),
                'CRUDE_SALT' => $request->input('CRUDE_SALT'),
                'ACTIVE_FLG' => $request->input('ACTIVE_FLG'),
                'ENTRY_BY' => Auth::user()->id,
                'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
            ]);

            $requirePerKgChd = RequireChemicalChd::insertRequireChemicalPerKgchd($data);

            if($requirePerKgChd){
                return redirect('/require-chemical-mst')->with('success', 'Require Chemical Per KG  Created !');
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
        $showRequireChemicalPerKgchd = RequireChemicalChd::showRequireChemicalPerKgchd($id);
        return view('setup.requireChemicalPerKg.modals.viewRequireChemicalPerKgChd',compact('showRequireChemicalPerKgchd'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editRequireChemicalPerKgchd = RequireChemicalChd::editRequirChemicalPerKgchd($id);
       // $this->pr($editRequireChemicalPerKgchd);
        $chemicleType = Item::itemTypeWiseItemList($this->chemicalId);
        $productionType = $this->finishedSaltId;
        return view('setup.requireChemicalPerKg.modals.editRequireChemicalPerKgChd',compact('editRequireChemicalPerKgchd','chemicleType','productionType'));
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
            'ITEM_ID' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {


            $updateRequirePerKgChd = RequireChemicalChd::updateRequireChemicalPerKgchd($request,$id);

            if($updateRequirePerKgChd){
                return redirect('/require-chemical-mst')->with('success', 'Require Chemical Per KG Updated !');
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
        $delete = RequireChemicalChd::deleteRequireChemicalPerKgchd($id);
        if($delete){
            echo json_encode([
                'type' => 'tr',
                'id' => $id,
                'flag' => true,
                'message' => 'Require Per KG Level Successfully Deleted.',
            ]);
        } else{
            echo json_encode([
                'message' => 'Error Founded Here!',
            ]);
        }

    }
}
