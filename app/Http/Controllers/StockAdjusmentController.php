<?php

namespace App\Http\Controllers;
use App\Bank;
use App\CostCenter;
use App\LookupGroupData;
use App\UserGroup;
use App\UserGroupLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $increasedWashingSalt = Stock::getTotalWashingSalt($centerId);
        $reducedWashingSalt = Stock::getTotalReduceWashingSalt($centerId);
        $WashingTotalUseInIodize = $increasedWashingSalt - abs($reducedWashingSalt);

        $afterSaleWashing = Stock::getTotalReduceWashingSaltAfterSale($centerId);

        if($afterSaleWashing){
            $washingStock = $WashingTotalUseInIodize - abs($afterSaleWashing);
        }else{
            $washingStock = $WashingTotalUseInIodize;
        }


        $beforeIodizeSaleStock = Stock::getTotalIodizeSaltForSale($centerId);
        $iodizeSale = abs(Stock::getTotalReduceIodizeSaltForSale($centerId));

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
            'system_wc_stock' => 'required',
            'wc_stock' => 'required',
            'system_iodize_stock' => 'required',
            'iodize_stock' => 'required'
        );
        $error = array(
            'system_wc_stock.required' => 'System Wash and crashing stock amount field is required.',
            'wc_stock.required' => 'Wash and crashing stock amount field is required.',
            'system_iodize_stock.required' => 'System Iodize stock amount field is required.',
            'iodize_stock.required' => 'Iodize stock amount field is required.'
        );

        $validator = Validator::make(Input::all(), $rules, $error);

        if ($validator->fails()) return response()->json(['errors'=>$validator->errors()->first()]);

        $data = array(
            'system_wc_stock' => $request->input('system_wc_stock'),
            'wc_stock' => $request->input('wc_stock'),
            'system_iodize_stock' => $request->input('system_iodize_stock'),
            'iodize_stock' => $request->input('iodize_stock'),
            'center_id' => Auth::user()->center_id,
            'ENTRY_BY' => Auth::user()->id
        );

        $insertedId = StockAdjusment::insertStockAdjustment($data);

        $this->washCrushingAdjustment($insertedId, $request->input('system_wc_stock'), $request->input('wc_stock'));
        $this->iodizedAdjustment($insertedId, $request->input('system_iodize_stock'), $request->input('iodize_stock'));

        if($insertedId){
            return response()->json(['success'=>'Stock adjustment has been created']);
        } else{
            return response()->json(['errors'=>'Stock adjustment create failed']);
        }

    }

    public function washCrushingAdjustment($stock_adjustment_id, $systemWashCrush, $stockWashCrush){
        $amount = null;
        if($systemWashCrush > $stockWashCrush){
            $amount = $stockWashCrush-$systemWashCrush; // if stock less than system stock

        } else if($systemWashCrush < $stockWashCrush){ // if stock greater than system stock
            $amount = $stockWashCrush-$systemWashCrush;
        }

        if(!empty($amount)) return StockAdjusment::washCrushForStock($stock_adjustment_id, $amount);
        return false;
    }

    public function iodizedAdjustment($stock_adjustment_id, $systemIodized, $stockIodized){
        $amount = null;
        if($systemIodized > $stockIodized){
            $amount = $stockIodized-$systemIodized; // if stock less than system stock

        } else if($systemIodized < $stockIodized){ // if stock greater than system stock
            $amount = $stockIodized-$systemIodized;
        }

        if(!empty($amount)) return StockAdjusment::iodizedForStock($stock_adjustment_id, $amount);
        return false;
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
            'system_wc_stock' => 'required',
            'wc_stock' => 'required',
            'system_iodize_stock' => 'required',
            'iodize_stock' => 'required'
        );
        $error = array(
            'system_wc_stock.required' => 'System Wash and crashing stock amount field is required.',
            'wc_stock.required' => 'Wash and crashing stock amount field is required.',
            'system_iodize_stock.required' => 'System Iodize stock amount field is required.',
            'iodize_stock.required' => 'Iodize stock amount field is required.'
        );

        $validator = Validator::make(Input::all(), $rules, $error);

        if ($validator->fails()) return response()->json(['errors'=>$validator->errors()->first()]);

        $data = array(
            'system_wc_stock' => $request->input('system_wc_stock'),
            'wc_stock' => $request->input('wc_stock'),
            'system_iodize_stock' => $request->input('system_iodize_stock'),
            'iodize_stock' => $request->input('iodize_stock'),
            'center_id' => Auth::user()->center_id,
            'ENTRY_BY' => Auth::user()->id
        );

        $updated = StockAdjusment::updateStockAdjust($data, $id);

        if($updated){
            $arrayStockId = StockAdjusment::getPrimaryIdByStockAdjustmentId($id);
            $delete = DB::table('tmm_itemstock')->whereIn('STOCK_NO', $arrayStockId)->delete();
            if($delete){
                $this->washCrushingAdjustment($id, $request->input('system_wc_stock'), $request->input('wc_stock'));
                $this->iodizedAdjustment($id, $request->input('system_iodize_stock'), $request->input('iodize_stock'));
            }
            return response()->json(['success'=>'Stock adjustment has been updated']);
        } else{
            return response()->json(['errors'=>'Stock adjustment update failed']);
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
        $delete = StockAdjusment::deleteStockAdjust($id);
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
