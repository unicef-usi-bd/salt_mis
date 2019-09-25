<?php

namespace App\Http\Controllers;
use App\Bank;
use App\CostCenter;
use App\LookupGroupData;
use App\UserGroup;
use App\UserGroupLevel;
use Illuminate\Http\Request;
use UxWeb\SweetAlert\SweetAlert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use App\User;
use File;
use Illuminate\Support\Facades\Route;
use App\AssociationSetup;
use Intervention\Image\ImageManagerStatic as Image;
use App\Stock;
use App\StockAdjusment;

class StockAdjusmentController extends Controller
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
            'title'=>'Stock Adjustment',
            'library'=>'datatable',
            'modalSize'=>'modal-lg',
            'action'=>'stock-adjustment/create',
            'createPermissionLevel' => $previllage->CREATE
        );
//        dd(session()->all());

//        $this->pr($users);

        $stockAdjustmentData = StockAdjusment::getData();

        return view('transactions.stockAdjustment.stockAdustmentIndex',compact('heading','stockAdjustmentData','previllage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $centerId = Auth::user()->center_id;
        $incresedWashingSalt = Stock::getTotalWashingSalt($centerId);
        $reducedWashinfSalt = Stock::getTotalReduceWashingSalt($centerId);
        $WashingTotalUseInIodize = $incresedWashingSalt - abs($reducedWashinfSalt);

        $afterSaleWashing = Stock::getTotalReduceWashingSaltAfterSale($centerId);

        if($afterSaleWashing){
            $washingStock = $WashingTotalUseInIodize - abs($afterSaleWashing);
        }else{
            $washingStock = $WashingTotalUseInIodize;
        }


        $beforeIodizeSaleStock = Stock::getTotalIodizeSaltForSale($centerId);
        $iodizeSale = abs(Stock::getTotalReduceIodizeSaltForSale($centerId));
        //$totalReduceIodizeSalt = Stock::getTotalReduceWashingSaltAfterSale($iodizeId);
        if($iodizeSale){
            $iodizeStock = $beforeIodizeSaleStock - $iodizeSale;
        }else{
            $iodizeStock = $beforeIodizeSaleStock;
        }
        return view('transactions.stockAdjustment.modals.createStockAdjustment',compact('washingStock','iodizeStock'));
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
            //'brand_name' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {
            $data = array([
                'wc_stock' => $request->input('wc_stock'),
                'iodize_stock' => $request->input('iodize_stock'),
                'center_id' => Auth::user()->center_id,
                'ENTRY_BY' => Auth::user()->id
            ]);

            $brand = StockAdjusment::insertStockAdjestment($data);

            if($brand){
                return redirect('/stock-adjustment')->with('success', 'Stock Adjustment Data Created !');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $centerId = Auth::user()->center_id;
        $incresedWashingSalt = Stock::getTotalWashingSalt($centerId);
        $reducedWashinfSalt = Stock::getTotalReduceWashingSalt($centerId);
        $WashingTotalUseInIodize = $incresedWashingSalt - abs($reducedWashinfSalt);

        $afterSaleWashing = Stock::getTotalReduceWashingSaltAfterSale($centerId);

        if($afterSaleWashing){
            $washingStock = $WashingTotalUseInIodize - abs($afterSaleWashing);
        }else{
            $washingStock = $WashingTotalUseInIodize;
        }


        $beforeIodizeSaleStock = Stock::getTotalIodizeSaltForSale($centerId);
        $iodizeSale = abs(Stock::getTotalReduceIodizeSaltForSale($centerId));
        //$totalReduceIodizeSalt = Stock::getTotalReduceWashingSaltAfterSale($iodizeId);
        if($iodizeSale){
            $iodizeStock = $beforeIodizeSaleStock - $iodizeSale;
        }else{
            $iodizeStock = $beforeIodizeSaleStock;
        }
        $editStockAdjust = StockAdjusment::editStockAdjustment($id);

        return view('transactions.stockAdjustment.modals.editStockAdjustment',compact('editStockAdjust','washingStock','iodizeStock'));
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
            //'brand_name' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {
            $updateStockAsjustment = StockAdjusment::updateStockAdjust($request,$id);
            if($updateStockAsjustment){
                return redirect('/stock-adjustment')->with('success', 'Stock Adjustment Data Updated !');
            }
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
        $delete = StockAdjusment::deleteStokAdjust($id);
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
}
