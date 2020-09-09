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
use App\Brand;
use App\SellerDistributorProfile;

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

        $salesDistInfo = SalesDistribution::getSalesDistributionData();
//        dd($salesDistInfo);
        $centerId = Auth::user()->center_id;

        $washingStock = Stock::stockWashAndCrushForSales($centerId);
        $iodizeStock = Stock::stockIodizeForSales($centerId);

        return view('transactions.salesDistribution.salesDistributionIndex',compact('heading','previllage','salesDistInfo','washingStock','iodizeStock'));
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
        $saltPackTypes = LookupGroupData::getActiveGroupDataByLookupGroup($this->saltPackId);
        $centerId = Auth::user()->center_id;

        $washingStock = Stock::stockWashAndCrushForSales($centerId);
        $iodizeStock = Stock::stockIodizeForSales($centerId);

        $brandName = Brand::millerBrand();

        return view('transactions.salesDistribution.modals.createSalesDistribution',compact('sellerType','tradingId','saltId','saltPackTypes','washingStock','iodizeStock','brandName'));
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
            'SELLER_TYPE' => 'required',
            'CUSTOMER_ID' => 'required',
            'SALES_DATE' => 'required',
            'ITEM_ID.*' => 'required',
            'PACK_TYPE.*' => 'required',
            'PACK_QTY.*' => 'required',
            'total.*' => 'required',
        );

        $error = array(
            'SELLER_TYPE.required' => 'Seller type field is required.',
            'CUSTOMER_ID.required' => 'Trade field is required.',
            'SALES_DATE.required' => 'Date field is required.',
            'ITEM_ID.*' => 'Item * field required',
            'PACK_TYPE.*' => 'Pack type * field required',
            'PACK_QTY.*' => 'Pack Quantity * field required',
            'total.*' => 'Total * field required',
        );

        $validator = Validator::make(Input::all(), $rules, $error);

        if ($validator->fails()) return response()->json(['errors'=>$validator->errors()->first()]);

        //$this->pr($request->input());
        $salesDistributionInsert = SalesDistribution::insertSalesDistributionData($request, $this->washAndCrushId,$this->iodizeId);


        if($salesDistributionInsert){
            return response()->json(['success'=>'Sales Distribution submission completed.']);
        }else{
            return response()->json(['success'=>'Sales Distribution submission failed.']);
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
        $delete = SalesDistribution::saleDistributionDelete($id);

        if($delete){
            echo json_encode([
                'type' => 'tr',
                'id' => $id,
                'flag' => true,
                'message' => 'Sale Distribution Successfully Deleted.',
            ]);
        } else{
            echo json_encode([
                'message' => 'Error Founded Here!',
            ]);
        }
    }

    public function getpackSizeData(Request $request){
        $packQuantity = $request->input('packId');
        $packSize = SalesDistribution::getPacksize($packQuantity);

       return  json_encode($packSize);
    }
}
