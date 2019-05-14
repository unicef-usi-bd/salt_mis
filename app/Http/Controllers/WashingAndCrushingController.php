<?php

namespace App\Http\Controllers;

use App\Item;
use App\RequireChemicalChd;
use App\Stock;
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
        $title = trans('Washing and Crushing');

        $heading=array(
            'title'=> $title,
            'library'=>'datatable',
            'modalSize'=>'modal-md',
            'action'=>'washing-crushing/create',
            'createPermissionLevel' => $previllage->CREATE
        );

        $washingAndCrushingData = WashingAndCrushing::getWashingAndCrushingData();

        return view('transactions.washingAndCrushing.washingAndCrushingIndex',compact('heading','previllage','washingAndCrushingData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $batch = 'WC' . '-' . Auth::user()->center_id . '-' . date("y") . '-' . date("m") . '-' . date("d") . '-' .  date("H") . '-' . date("i");

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
        $rules = array(
            'REQ_QTY' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {


            //$this->pr($request->input());
            $entryBy = Auth::user()->id;
            $centerId = Auth::user()->center_id;
            $oty = intval($request->input('REQ_QTY'));
            $totalStock = (intval($request->input('REQ_QTY'))*intval($request->input('WASTAGE'))/100);
            $result = $oty - $totalStock;
            //$this->pr($result);
            $washingAndCrashing = WashingAndCrushing::insertWashingAndCrushingData($request,$entryBy,$centerId,$result);

            if($washingAndCrashing){
                return redirect('/washing-crushing')->with('success', 'Washing & Crashing Has been Created !');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WashingAndCrushing  $washingAndCrushing
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $viewWashingAndCrushing = WashingAndCrushing::viewWashingAndCrushingData($id);
        return view('transactions.washingAndCrushing.modals.viewWashingAndCrushing',compact('viewWashingAndCrushing'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WashingAndCrushing  $washingAndCrushing
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editWashingAndCrushingData = WashingAndCrushing::editWashingAndCrushingData($id);
        $crudeSaltTypes = Item::itemTypeWiseItemList($this->crudSaltId);
        $saltStock = Stock::getSaltStock($editWashingAndCrushingData->ITEM_NO,Auth::user()->center_id);
        $totalReduceSalt = Stock::getTotalReduceSalt($editWashingAndCrushingData->ITEM_NO,Auth::user()->center_id);
        $saltStock = $saltStock - abs($totalReduceSalt);

        return view('transactions.washingAndCrushing.modals.editWashingAndCrushing',compact('editWashingAndCrushingData','crudeSaltTypes','saltStock'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WashingAndCrushing  $washingAndCrushing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'REQ_QTY' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {


            //$this->pr($request->input());
            $oty = intval($request->input('REQ_QTY'));
            $totalStock = (intval($request->input('REQ_QTY'))*intval($request->input('WASTAGE'))/100);
            $result = $oty - $totalStock;
            $washingAndCrashing = WashingAndCrushing::updateWashingAndCrushingData($request,$id,$result);

            if($washingAndCrashing){
                return redirect('/washing-crushing')->with('success', 'Washing & Crashing Has been Updated !');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WashingAndCrushing  $washingAndCrushing
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = WashingAndCrushing::deleteWashingAndCrushingData($id);

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

    public function getCrudeSaltStock(Request $request){
        $saltId = $request->input('saltId');
        $centerId = Auth::user()->center_id;
        $showRequireChemicalPerKgchd = RequireChemicalChd::getWastagePercentage($saltId);
        $saltStock = Stock::getSaltStock($saltId,$centerId);
        $totalReduceSalt = Stock::getTotalReduceSalt($saltId,$centerId);

        $saltStock = $saltStock - abs($totalReduceSalt);

        return json_encode(array("saltStock" => $saltStock, "wastageAmount" => $showRequireChemicalPerKgchd));
    }
}
