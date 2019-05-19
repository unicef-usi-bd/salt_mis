<?php

namespace App\Http\Controllers;

use App\CrudeSaltProcurement;
use App\Item;
use App\LookupGroupData;
use App\SupplierProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class CrudeSaltProcurementController extends Controller
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
            'modalSize'=>'modal-lg',
            'action'=>'crude-salt-procurement/create',
            'createPermissionLevel' => $previllage->CREATE
        );
        $crudeSalt = CrudeSaltProcurement::crudeSaltePurchase();
        return view('transactions.crudeSaltProcurement.crudeSaltProcurementIndex', compact( 'heading','previllage','crudeSalt'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $crudeSaltTypes = Item::itemTypeWiseItemList($this->crudSaltId);
        $crudeSaltSuppliers = SupplierProfile::getCrudeSaltSupllier($this->crudeSaltSupplierTypeId);
        $crudeSaltSources = LookupGroupData::getActiveGroupDataByLookupGroup($this->crudeSaltSourceId);
        $importedId = LookupGroupData::viewSSCLookGroupData($this->importerId);
        $importedCrudeSaltCountry = CrudeSaltProcurement::getCountryName();
        $importedData = LookupGroupData::getImported();
        return view('transactions.crudeSaltProcurement.modals.createCrudeSaltProcurement',compact('crudeSaltTypes','crudeSaltSuppliers','crudeSaltSources','importedId','importedCrudeSaltCountry','importedData'));
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
            'RCV_QTY' => 'required',


        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {


            //$this->pr($request->input());
            $crudeSalte = CrudeSaltProcurement::insertCrudeSaltData($request);

            if($crudeSalte){
                //            return response()->json(['success'=>'Lookup Group Successfully Saved']);
                //return json_encode('Success');
                return redirect('/crude-salt-procurement')->with('success', 'Crude Salt Has been Created !');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CrudeSaltProcurement  $crudeSaltProcurement
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $crudeSaltShow = CrudeSaltProcurement::crudeSaltPurchaseShow($id);
        return view('transactions.crudeSaltProcurement.modals.viewCrudeSaltProcurement',compact('crudeSaltShow'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CrudeSaltProcurement  $crudeSaltProcurement
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editCrudeSalt = CrudeSaltProcurement::editCrudeSaltPurchase($id);
        $crudeSaltTypes = Item::itemTypeWiseItemList($this->crudSaltId);
        $crudeSaltSuppliers = SupplierProfile::getCrudeSaltSupllier($this->crudeSaltSupplierTypeId);
        $crudeSaltSources = LookupGroupData::getActiveGroupDataByLookupGroup($this->crudeSaltSourceId);
        $importedData = LookupGroupData::getImported();
        return view('transactions.crudeSaltProcurement.modals.editCrudeSaltProcurement',compact('editCrudeSalt','crudeSaltSources','crudeSaltTypes','crudeSaltSuppliers','importedData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CrudeSaltProcurement  $crudeSaltProcurement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'RCV_QTY' => 'required',


        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {


            //$this->pr($request->input());
            $crudeSalteUpdate = CrudeSaltProcurement::updateCrudeSaltPurchase($request,$id);

            if($crudeSalteUpdate){
                //            return response()->json(['success'=>'Lookup Group Successfully Saved']);
                //return json_encode('Success');
                return redirect('/crude-salt-procurement')->with('success', 'Crude Salt Has been Updated !');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CrudeSaltProcurement  $crudeSaltProcurement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = CrudeSaltProcurement::deleteCrudeSaltPurchase($id);

        if($delete){
            echo json_encode([
                'type' => 'tr',
                'id' => $id,
                'flag' => true,
                'message' => 'Crude Salt Successfully Deleted.',
            ]);
        } else{
            echo json_encode([
                'message' => 'Error Founded Here!',
            ]);
        }
    }

}
