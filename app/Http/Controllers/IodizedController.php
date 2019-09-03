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
            'title'=>'Iodization Production',
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
        $iodizeIndex = Iodized::getIodizeData();
        $num = count($iodizeIndex);
        $batchNo = 'I' . '-' . Auth::user()->center_id . '-' . date("y") . '-' . date("m") . '-' . date("d") . '-' .  date("H") . '-' . date("i") . '-' . sprintf("%'.04d\n", ++$num);
        $chemicleType = Item::itemTypeWiseItemList($this->chemicalId);
        $centerId = Auth::user()->center_id;
        //$this->pr($centerId);
        $incresedWashingSalt = Stock::getTotalWashingSalt($centerId);
        $reducedWashinfSalt = Stock::getTotalReduceWashingSalt($centerId);
        $WashingTotalUseInIodize = $incresedWashingSalt - abs($reducedWashinfSalt);

        $afterSaleWashing = Stock::getTotalReduceWashingSaltAfterSale($centerId);

        if($afterSaleWashing){
            $totalWashing = $WashingTotalUseInIodize - abs($afterSaleWashing);
        }else{
            $totalWashing = $WashingTotalUseInIodize;
        }
//        $this->pr($afterSaleWashing);
//        $idoizeSaltAmount = Stock::getTotalIodizeSaltForSale($centerId);
//        if($idoizeSaltAmount){
//            $totalWashing = $washingSalt - $idoizeSaltAmount;
//        }else{
//            $totalWashing = $washingSalt;
//        }
//        $this->pr($totalWashing);

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

            $entryBy = Auth::user()->id;
            $centerId = Auth::user()->center_id;

            $iodizeInsert = Iodized::insertIodizeData($request,$centerId,$entryBy);
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

        $centerId = Auth::user()->center_id;
//        $totalWashingSalt = Stock::getTotalWashingSalt($centerId);
//        $totalReduceWashingSalt = Stock::getTotalReduceWashingSalt($centerId);
//        $totalSalt = $totalWashingSalt - abs($totalReduceWashingSalt);

        $incresedWashingSalt = Stock::getTotalWashingSalt($centerId);
        $reducedWashinfSalt = Stock::getTotalReduceWashingSalt($centerId);
        $WashingTotalUseInIodize = $incresedWashingSalt - abs($reducedWashinfSalt);

        $afterSaleWashing = Stock::getTotalReduceWashingSaltAfterSale($centerId);

        if($afterSaleWashing){
            $totalSalt = $WashingTotalUseInIodize - abs($afterSaleWashing);
        }else{
            $totalSalt = $WashingTotalUseInIodize;
        }

        $totalReduceChemical = Stock::getTotalReduceChemical($editIodize->ITEM_NO,$centerId);
        $totalChemicalStock = Stock::getChemicalStock($editIodize->ITEM_NO,$centerId);
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
            $washAndCrushQty = intval($request->input('WASH_CRASH_QTY'));
            $iodizeWastage = ($washAndCrushQty *intval($request->input('WASTAGE')) / 100);
            $iodizeStock = $washAndCrushQty - $iodizeWastage;

            $iodizeUpdate = Iodized::updateIodizeData($request,$id,$iodizeStock);
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
        $centerId = Auth::user()->center_id;
        $chemicalStock = Stock::getChemicalStock($chemicalId,$centerId);
        $totalReduceChemical = Stock::getTotalReduceChemical($chemicalId,$centerId);

        $chemicalStock = $chemicalStock - abs($totalReduceChemical);
        $showRequireChemicalPerKgchd = RequireChemicalChd::getWastagePercentage($chemicalId);
        return json_encode(array("chemicalStock" => $chemicalStock, "chemicalPerKg" => $showRequireChemicalPerKgchd));
    }
}
