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
        $centerId = Auth::user()->center_id;

        $washingStock = Stock::getTotalWashingSalt($centerId);
        $usedWashingSalt = Stock::getTotalReduceWashingSalt($centerId);
        $washingStock = $washingStock - abs($usedWashingSalt);
        $saleWashing = Stock::getTotalReduceWashingSaltAfterSale($centerId);
        if($saleWashing){
            $washingStock = $washingStock - abs($saleWashing);
        }

        $iodizeStock = Stock::getTotalIodizeSaltForSale($centerId);
        $iodizeSale = abs(Stock::getTotalReduceIodizeSaltForSale($centerId));
        if($iodizeSale) $iodizeStock = $iodizeStock - $iodizeSale;

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
        $saltPackId = LookupGroupData::getActiveGroupDataByLookupGroup($this->saltPackId);
        $washAndCrushId = $this->washAndCrushId;
        $iodizeId = $this->iodizeId;
        $centerId = Auth::user()->center_id;
        $beforeIodizeSaleStock = Stock::getTotalIodizeSaltForSale($centerId);
        $iodizeSale = abs(Stock::getTotalReduceIodizeSaltForSale($centerId));
        //$totalReduceIodizeSalt = Stock::getTotalReduceWashingSaltAfterSale($iodizeId);
        if($iodizeSale){
            $iodizeStock = $beforeIodizeSaleStock - $iodizeSale;
        }else{
            $iodizeStock = $beforeIodizeSaleStock;
        }

        $brandName = Brand::millerBrand();
        $traderName = SellerDistributorProfile::traderName();
        //$pckSize = SalesDistribution::getPacksize();
        //$this->pr($brandName);
        return view('transactions.salesDistribution.modals.createSalesDistribution',compact('sellerType','tradingId','saltId','saltPackId','washAndCrushId','iodizeId','iodizeStock','brandName','traderName'));
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
            'DRIVER_NAME' => 'required',
            'VEHICLE_NO' => 'required',
            'VEHICLE_LICENSE' => 'required',
            'TRANSPORT_NAME' => 'required',
            'MOBILE_NO' => 'required',
            'ITEM_ID.*' => 'required',
            'PACK_TYPE.*' => 'required',
            'PACK_QTY.*' => 'required',
            'total.*' => 'required',
        );

        $error = array(
            'SELLER_TYPE.required' => 'Seller type field is required.',
            'CUSTOMER_ID.required' => 'Trade field is required.',
            'SALES_DATE.required' => 'Date field is required.',
            'DRIVER_NAME.required' => 'Driver name field is required.',
            'VEHICLE_NO.required' => 'Driver licence field is required.',
            'VEHICLE_LICENSE.required' => 'Vehicle licence field is required.',
            'TRANSPORT_NAME.required' => 'Transport rent field is required.',
            'MOBILE_NO.required' => 'Mobile Number field is required.',
            'ITEM_ID.*' => 'Item * field required',
            'PACK_TYPE.*' => 'Pack type * field required',
            'PACK_QTY.*' => 'Pack Quantity * field required',
            'total.*' => 'Total * field required',
        );

        $validator = Validator::make(Input::all(), $rules, $error);

        if ($validator->fails()) return response()->json(['errors'=>$validator->errors()->first()]);

        //$this->pr($request->input());
        $salesDistributionInsert = SalesDistribution::insertSalesDistributionData($request,$this->saltPackId,$this->washAndCrushId,$this->iodizeId);


        if($salesDistributionInsert){
            return response()->json(['success'=>'Sales Distribution has been saved successfully.']);
        }else{
            return response()->json(['success'=>'Sales Distribution save failed.']);
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

    public function getWashingCrashingSalt(Request $request){
        $centerId = $request->input('centerId');
//     $washCrashStock = Stock::getTotalWashingSaltForSale($washCrashId);
//        $washingSalt = Stock::getTotalWashingSalt($centerId);
//        $washingSaltSale = abs(Stock::getTotalReduceWashingSaltAfterSale($centerId));
//
//        //$this->pr($washingSaltSale);
//
//        $idoizeSaltAmount = Stock::getTotalIodizeSaltForSale($centerId);
//
//        if($idoizeSaltAmount){
//            $afterIodizeWashingStock = $washingSalt - $idoizeSaltAmount;
//            if($washingSaltSale){
//                $stock = $afterIodizeWashingStock - $washingSaltSale;
//            }else{
//                $stock = $afterIodizeWashingStock;
//            }
//        }else{
//            if($washingSaltSale){
//                $stock = $washingSalt - $washingSaltSale;
//            }else{
//                $stock = $washingSalt;
//            }
//
//        }

        $incresedWashingSalt = Stock::getTotalWashingSalt($centerId);
        $reducedWashinfSalt = Stock::getTotalReduceWashingSalt($centerId);
        $WashingTotalUseInIodize = $incresedWashingSalt - abs($reducedWashinfSalt);

        $afterSaleWashing = Stock::getTotalReduceWashingSaltAfterSale($centerId);

        if($afterSaleWashing){
            $stock = $WashingTotalUseInIodize - abs($afterSaleWashing);
        }else{
            $stock = $WashingTotalUseInIodize;
        }
     //$totalReduceWashCrashSalt = Stock::getTotalReduceWashingSaltAfterSale($washCrashId);

     //$stock = $washCrashStock - abs($totalReduceWashCrashSalt);

     return $stock;

    }

    public function getIodizeSalt(Request $request){
        $centerId = $request->input('centerId');
        $beforeIodizeSaleStock = Stock::getTotalIodizeSaltForSale($centerId);
        $iodizeSale = abs(Stock::getTotalReduceIodizeSaltForSale($centerId));
        //$totalReduceIodizeSalt = Stock::getTotalReduceWashingSaltAfterSale($iodizeId);
        if($iodizeSale){
            $iodizeStock = $beforeIodizeSaleStock - $iodizeSale;
        }else{
            $iodizeStock = $beforeIodizeSaleStock;
        }
        //$idizeStock = $iodizeStock - abs($totalReduceIodizeSalt);

        return $iodizeStock;

    }

    public function getpackSizeData(Request $request){
        $packQuantity = $request->input('packId');
        $packSize = SalesDistribution::getPacksize($packQuantity);

       return  json_encode($packSize);
    }
}
