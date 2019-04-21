<?php

namespace App\Http\Controllers;

use App\RequireChemicalChd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Iodized;
use App\Item;
use App\Stock;

class IodizedController extends Controller
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
            'title'=>'Iodize',
            'library'=>'datatable',
            'modalSize'=>'modal-md',
            'action'=>'iodized/create',
            'createPermissionLevel' => $previllage->CREATE
        );

        $iodizeIndex = Iodized::getIodizeData();
        return view('transactions.iodize.iodizeIndex',compact('heading','previllage','iodizeIndex'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $digits = 4;
//        $batchNo = rand(pow(10, $digits-1), pow(10, $digits)-1);
        $batchNo = 'I' . '-' . Auth::user()->center_id . '-' . date("y") . '-' . date("m") . '-' . date("d") . '-' .  date("H") . '-' . date("i");
        $chemicleType = Item::itemTypeWiseItemList($this->chemicalId);
        $totalWashing = Stock::getTotalWashingSalt();
        //$this->pr($test);
        return view('transactions.iodize.modals.creatIodize',compact('batchNo','chemicleType','totalReduceSalt','totalSaltStock','totalSalt','totalWashing'));
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
        if ($validator->fails()) {
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        } else {


            $iodizeInsert = Iodized::insertIodizeData($request);
        }


        if ($iodizeInsert) {
            //            return response()->json(['success'=>'Lookup Group Successfully Saved']);
            //return json_encode('Success');
            return redirect('/iodized')->with('success', 'Iodize Created!');
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
        $viewIodize = Iodized::showIodizeData($id);
        return view('transactions.iodize.modals.viewIodize',compact('viewIodize'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editIodize = Iodized::editIodizeData($id);
        $digits = 4;
        $batchNo = rand(pow(10, $digits-1), pow(10, $digits)-1);
        $chemicleType = Item::itemTypeWiseItemList($this->chemicalId);

        $totalWashingSalt = Stock::getTotalWashingSalt();
        $totalReduceWashingSalt = Stock::getTotalReduceWashingSalt();
        $totalSalt = $totalWashingSalt - abs($totalReduceWashingSalt);

        $totalReduceChemical = Stock::getTotalReduceChemical($editIodize->ITEM_NO);
        $totalChemicalStock = Stock::getChemicalStock($editIodize->ITEM_NO);
        $totalChemical = $totalChemicalStock - abs($totalReduceChemical);
       return view('transactions.iodize.modals.editIodize',compact('editIodize','batchNo','chemicleType','totalSalt','totalChemical'));
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
            'REQ_QTY' => 'required',

        );

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        } else {


            $iodizeUpdate = Iodized::updateIodizeData($request,$id);
        }


        if ($iodizeUpdate) {
            //            return response()->json(['success'=>'Lookup Group Successfully Saved']);
            //return json_encode('Success');
            return redirect('/iodized')->with('success', 'Iodize Update!');
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
        $delete = Iodized::deleteIodizeData($id);

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

    public function getChemicalStock(Request $request){
        $chemicalId = $request->input('chemicalId');
        $chemicalStock = Stock::getChemicalStock($chemicalId);
        $totalReduceChemical = Stock::getTotalReduceChemical($chemicalId);

        $chemicalStock = $chemicalStock - abs($totalReduceChemical);
        $showRequireChemicalPerKgchd = RequireChemicalChd::getWastagePercentage($chemicalId);
        return json_encode(array("chemicalStock" => $chemicalStock, "chemicalPerKg" => $showRequireChemicalPerKgchd));
    }
}
