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
        $title = trans('Crude Salt Procurement');

        $heading=array(
            'title'=> $title,
            'library'=>'datatable',
            'modalSize'=>'modal-lg',
            'action'=>'crude-salt-procurement/create',
            'createPermissionLevel' => $previllage->CREATE
        );
        $crudeSalt = CrudeSaltProcurement::crudeSaltePurchase();
//        dd($crudeSalt);
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
            'RECEIVE_NO' => 'required',
            'INVOICE_NO' => 'required',
            'SUPP_ID_AUTO' => 'required',
            'SOURCE_ID' => 'required',
            'RCV_QTY' => 'required',
        );

        $error = array(
            'RECEIVE_NO.required' => 'Salt type field is required.',
            'INVOICE_NO.required' => 'Invoice field is required.',
            'SUPP_ID_AUTO.required' => 'Trading field is required.',
            'SOURCE_ID.required' => 'Source field is required.',
            'RCV_QTY.required' => 'Amount field is required.',
        );

        $validator = Validator::make(Input::all(), $rules, $error);

        if ($validator->fails()) return response()->json(['errors'=>$validator->errors()->first()]);

        $crudeSalt = CrudeSaltProcurement::insertCrudeSaltData($request);

        if($crudeSalt){
            return response()->json(['success'=>'Crud salt submission completed.']);
        } else{
            return response()->json(['errors'=>'Crud salt submission failed.']);
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
            'RECEIVE_NO' => 'required',
            'INVOICE_NO' => 'required',
            'SUPP_ID_AUTO' => 'required',
            'SOURCE_ID' => 'required',
            'RCV_QTY' => 'required',
        );

        $error = array(
            'RECEIVE_NO.required' => 'Salt type field is required.',
            'INVOICE_NO.required' => 'Invoice field is required.',
            'SUPP_ID_AUTO.required' => 'Trading field is required.',
            'SOURCE_ID.required' => 'Source field is required.',
            'RCV_QTY.required' => 'Amount field is required.',
        );
        $validator = Validator::make(Input::all(), $rules, $error);

        if ($validator->fails()) return response()->json(['errors'=>$validator->errors()->first()]);
        //$this->pr($request->input());
        $crudeSaltUpdate = CrudeSaltProcurement::updateCrudeSaltPurchase($request,$id);

        if($crudeSaltUpdate){
            return response()->json(['success'=>'Crud salt submission completed.']);
        } else{
            return response()->json(['errors'=>'Crud salt submission failed.']);
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
