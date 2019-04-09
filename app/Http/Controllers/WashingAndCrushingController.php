<?php

namespace App\Http\Controllers;

use App\Item;
use App\WashingAndCrushing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class WashingAndCrushingController extends Controller
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
            'action'=>'washing-crushing/create',
            'createPermissionLevel' => $previllage->CREATE
        );
        return view('transactions.washingAndCrushing.washingAndCrushingIndex',compact('heading','previllage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $digits = 4;
        $batch = rand(pow(10, $digits-1), pow(10, $digits)-1);
        $crudeSaltTypes = Item::itemTypeWiseItemList($this->crudSaltId);
        return view('transactions.washingAndCrushing.modals.createWashingAndCrushing',compact('crudeSaltTypes','crudeSaltSuppliers','batch'));
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
     * @param  \App\WashingAndCrushing  $washingAndCrushing
     * @return \Illuminate\Http\Response
     */
    public function show(WashingAndCrushing $washingAndCrushing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WashingAndCrushing  $washingAndCrushing
     * @return \Illuminate\Http\Response
     */
    public function edit(WashingAndCrushing $washingAndCrushing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WashingAndCrushing  $washingAndCrushing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WashingAndCrushing $washingAndCrushing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WashingAndCrushing  $washingAndCrushing
     * @return \Illuminate\Http\Response
     */
    public function destroy(WashingAndCrushing $washingAndCrushing)
    {
        //
    }
}
