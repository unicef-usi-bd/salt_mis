<?php

namespace App\Http\Controllers;

use App\Stock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\LookupGroupData;
use App\SalesDistribution;
use App\Item;

class SalesDistributionController extends Controller
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
            'title'=>'Sales & Distribution',
            'library'=>'datatable',
            'modalSize'=>'modal-bg',
            'action'=>'sales-distribution/create',
            'createPermissionLevel' => $previllage->CREATE
        );

        $salesDitributionIndex = SalesDistribution::getSalesDistributionData();
        return view('transactions.salesDistribution.salesDistributionIndex',compact('heading','previllage','salesDitributionIndex'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sellerType = LookupGroupData::getActiveGroupDataByLookupGroup($this->sellerTypeId);
        $tradingId = SalesDistribution::getTradingName();
        $saltId = Item::itemTypeWiseItemList($this->finishedSaltId);
        $saltPackId = LookupGroupData::getActiveGroupDataByLookupGroup($this->saltPackId);
        $washAndCrushId = $this->washAndCrushId;
        $iodizeId = $this->iodizeId;
        return view('transactions.salesDistribution.modals.createSalesDistribution',compact('sellerType','tradingId','saltId','saltPackId','washAndCrushId','iodizeId'));
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
            'DRIVER_NAME' => 'required',


        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {

            $salesDistributionInsert = SalesDistribution::insertSalesDistributionData($request,$this->saltPackId);


            if($salesDistributionInsert){
                //            return response()->json(['success'=>'Lookup Group Successfully Saved']);
                //return json_encode('Success');
                return redirect('/sales-distribution')->with('success', 'Sales Distribution Has been Created !');
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
        $viewSalersDistributor = SalesDistribution::showSalesDistributionDataMst($id);
        $viewSalersDistributorChd = SalesDistribution::showSalesDistributionDataChd($id);
        return view('transactions.salesDistribution.modals.viewSalesDistribution',compact('viewSalersDistributor','viewSalersDistributorChd'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getWashingCrashingSalt(Request $request){
     $washCrashId = $request->input('washAndCrushId');
     $washCrashStock = Stock::getTotalWashingSaltForSale($washCrashId);
     $totalReduceWashCrashSalt = Stock::getTotalReduceWashingSaltAfterSale($washCrashId);

     $stock = $washCrashStock - abs($totalReduceWashCrashSalt);

     return $stock;

    }

    public function getIodizeSalt(Request $request){
        $iodizeId = $request->input('iodizeId');
        $iodizeStock = Stock::getTotalIodizeSaltForSale($iodizeId);
        $totalReduceIodizeSalt = Stock::getTotalReduceWashingSaltAfterSale($iodizeId);

        $idizeStock = $iodizeStock - abs($totalReduceIodizeSalt);

        return $idizeStock;

    }
}
