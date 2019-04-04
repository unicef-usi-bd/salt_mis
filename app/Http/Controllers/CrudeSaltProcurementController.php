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
            'modalSize'=>'modal-md',
            'action'=>'crude-salt-procurement/create',
            'createPermissionLevel' => $previllage->CREATE
        );

        return view('transactions.crudeSaltProcurement.crudeSaltProcurementIndex', compact( 'heading','previllage'));
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
        return view('transactions.crudeSaltProcurement.modals.createCrudeSaltProcurement',compact('crudeSaltTypes','crudeSaltSuppliers','crudeSaltSources'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CrudeSaltProcurement  $crudeSaltProcurement
     * @return \Illuminate\Http\Response
     */
    public function show(CrudeSaltProcurement $crudeSaltProcurement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CrudeSaltProcurement  $crudeSaltProcurement
     * @return \Illuminate\Http\Response
     */
    public function edit(CrudeSaltProcurement $crudeSaltProcurement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CrudeSaltProcurement  $crudeSaltProcurement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CrudeSaltProcurement $crudeSaltProcurement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CrudeSaltProcurement  $crudeSaltProcurement
     * @return \Illuminate\Http\Response
     */
    public function destroy(CrudeSaltProcurement $crudeSaltProcurement)
    {
        //
    }
}
