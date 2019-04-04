<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\ChemicalPurchase;
use App\LookupGroupData;

class ChemicalPurchaseController extends Controller
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
            'title'=>'Chemical Purchase',
            'library'=>'datatable',
            'modalSize'=>'modal-lg',
            'action'=>'chemical-purchase/create',
            'createPermissionLevel' => $previllage->CREATE
        );

        //$sellerDitributorProfile = SellerDistributorProfile::sellerDistributorProfile();
        return view('transactions.chemicalPurchase.chemicalPurchaseIndex',compact('heading'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $chemicleType = ChemicalPurchase::getChemical($this->itemTypeId);
        $supplierName = ChemicalPurchase::getSupplierName();
        $chemicalSupplier = ChemicalPurchase::getChemicalSupplier();
        return view('transactions.chemicalPurchase.modals.createChemicalPurchase',compact('chemicleType','agencyType','chemicalSupplier','supplierName'));
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
            'QTY' => 'required',


        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {
            $data = array([
                'TRADING_NAME' => $request->input('TRADING_NAME'),
                'TRADER_NAME' => $request->input('TRADER_NAME'),
                'SUPPLIER_ID' => $request->input('SUPPLIER_ID'),
                'LICENCE_NO' => $request->input('LICENCE_NO'),
                'SUPPLIER_TYPE_ID' => $request->input('SUPPLIER_TYPE_ID'),
                'DIVISION_ID' => $request->input('DIVISION_ID'),
                'DISTRICT_ID' => $request->input('DISTRICT_ID'),
                'UPAZILA_ID' => $request->input('UPAZILA_ID'),
                'UNION_ID' => $request->input('UNION_ID'),
                'BAZAR_NAME' => $request->input('BAZAR_NAME'),
                'PHONE' => $request->input('PHONE'),
                'EMAIL' => $request->input('EMAIL'),
                'REMARKS' => $request->input('REMARKS'),
                'ENTRY_BY' => Auth::user()->id,
                'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
            ]);

            //$this->pr($request->input());
            $chemicalePurchase = ChemicalPurchase::insertIntoItemStok($data);

            if($chemicalePurchase){
                //            return response()->json(['success'=>'Lookup Group Successfully Saved']);
                //return json_encode('Success');
                return redirect('/chemical-purchase')->with('success', 'Chemical Purchase Has been Created !');
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
}
