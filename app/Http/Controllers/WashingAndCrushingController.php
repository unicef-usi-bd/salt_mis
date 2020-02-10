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
        $title = trans('Washing and Crushing (Industrial) Union');

        $heading=array(
            'title'=> $title,
            'library'=>'datatable',
            'modalSize'=>'modal-md',
            'action'=>'washing-crushing/create',
            'createPermissionLevel' => $previllage->CREATE
        );

        $washingAndCrushingData = WashingAndCrushing::getWashingAndCrushingData();

//        dd($washingAndCrushingData);

        return view('transactions.washingAndCrushing.washingAndCrushingIndex',compact('heading','previllage','washingAndCrushingData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $washingAndCrushingData = WashingAndCrushing::getWashingAndCrushingData();
        $num = count($washingAndCrushingData);
        $batch = 'WC' . '-' . Auth::user()->center_id . '-' . date("y") . '-' . date("m") . '-' . date("d") . '-' .  date("H") . '-' . date("i") . '-' . sprintf("%'.04d\n", ++$num);

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
            'PRODUCT_ID' => 'required',
            'REQ_QTY' => 'required',
            'WASTAGE' => 'required',
        );
        $error = array(
            'PRODUCT_ID.required' => 'Salt type field is required.',
            'REQ_QTY.required' => 'Amount field is required.',
            'WASTAGE.required' => 'Wastage field is required.',
        );

        $validator = Validator::make(Input::all(), $rules, $error);

        if ($validator->fails()) return response()->json(['errors'=>$validator->errors()->first()]);
        //$this->pr($request->input());

        $entryBy = Auth::user()->id;
        $centerId = Auth::user()->center_id;

        $washingAndCrashing = WashingAndCrushing::insertWashingAndCrushingData($request,$entryBy,$centerId);

        if($washingAndCrashing){
            return response()->json(['success'=>'Washing & Crashing has been save successfully.']);
        } else{
            return response()->json(['success'=>'Washing & Crashing save failed.']);
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
        $editData = WashingAndCrushing::editWashingAndCrushingData($id);
        $editAmount = $editData->REQ_QTY+(($editData->WASTAGE*$editData->REQ_QTY)/(100-$editData->WASTAGE));
        $crudeSaltTypes = Item::itemTypeWiseItemList($this->crudSaltId);
        $saltStock = Stock::getSaltStock($editData->ITEM_NO, Auth::user()->center_id);
        $totalReduceSalt = Stock::getTotalReduceSalt($editData->ITEM_NO, Auth::user()->center_id);
        $saltStock = $saltStock - abs($totalReduceSalt);
        $totalStock = sprintf('%0.2f',  $saltStock)+$editAmount;


        return view('transactions.washingAndCrushing.modals.editWashingAndCrushing',compact('editData','crudeSaltTypes','saltStock','totalStock'));
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
            'PRODUCT_ID' => 'required',
            'REQ_QTY' => 'required',
            'WASTAGE' => 'required',
        );
        $error = array(
            'PRODUCT_ID.required' => 'Salt type field is required.',
            'REQ_QTY.required' => 'Amount field is required.',
            'WASTAGE.required' => 'Wastage field is required.',
        );

        $validator = Validator::make(Input::all(), $rules, $error);

        if ($validator->fails()) return response()->json(['errors'=>$validator->errors()->first()]);

        //$this->pr($request->input());
        $oty = intval($request->input('REQ_QTY'));
        $totalStock = (intval($request->input('REQ_QTY'))*intval($request->input('WASTAGE'))/100);
        $result = $oty - $totalStock;
        $update = WashingAndCrushing::updateWashingAndCrushingData($request,$id,$result);

        if($update){
            return response()->json(['success'=>'Washing & Crashing has been updated successfully.']);
        } else{
            return response()->json(['success'=>'Washing & Crashing update failed.']);
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
        $saltStock = Stock::getSaltStock($saltId,$centerId);
        $totalReduceSalt = Stock::getTotalReduceSalt($saltId, $centerId);
        $saltStock = $saltStock - abs($totalReduceSalt);
        return json_encode(array("saltStock" => $saltStock));
    }
}
