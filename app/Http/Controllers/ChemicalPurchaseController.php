<?php

namespace App\Http\Controllers;

use App\SupplierProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\ChemicalPurchase;
use App\LookupGroupData;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Item;

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

        $chemicalPuchase = ChemicalPurchase::chemicalPurchase();
        return view('transactions.chemicalPurchase.chemicalPurchaseIndex',compact('heading','chemicalPuchase','previllage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $chemicleType = Item::itemTypeWiseItemList($this->chemicalId);
        $suppliers = SupplierProfile::supplierProfile($this->chemicalSupplierTypeId);

        return view('transactions.chemicalPurchase.modals.createChemicalPurchase',compact('chemicleType','agencyType','chemicalSupplier','suppliers','supplierNameBscic'));
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
            'RECEIVE_NO' => 'required',
            'RCV_QTY' => 'required',
            'INVOICE_NO' => 'required',
            'SUPP_ID_AUTO' => 'required',
        );
        $error = array(
            'RCV_QTY.required' => 'Amount field is required.',
            'RECEIVE_NO.required' => 'Procurement Chemical field is required.',
            'INVOICE_NO.required' => 'Invoice number field is required.',
            'SUPP_ID_AUTO.required' => 'Chemical Source field is required.',
        );

        $validator = Validator::make(Input::all(), $rules, $error);

        if ($validator->fails()) return response()->json(['errors'=>$validator->errors()->first()]);

        //$this->pr($request->input());
        $chemicalPurchase = ChemicalPurchase::insertChemicalPurchaseData($request, $this->chemicalSupplierTypeId);

        if($chemicalPurchase){
            return response()->json(['success'=>'Chemical purchase has been created']);
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
        $chemicalPurchaseView = ChemicalPurchase::chemicalPurchaseShow($id);

        return view('transactions.chemicalPurchase.modals.viewChemicalPurches',compact('chemicalPurchaseView'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $chemicleType = Item::itemTypeWiseItemList($this->chemicalId);
        $suppliers = SupplierProfile::supplierProfile($this->chemicalSupplierTypeId);
        $editChemicalpurchase = ChemicalPurchase::editChemicalPurchase($id);

        return view('transactions.chemicalPurchase.modals.editChemicalPurchase',compact('chemicleType','suppliers','editChemicalpurchase','supplierNameBsti'));
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
            'RECEIVE_NO' => 'required',
            'RCV_QTY' => 'required',
            'INVOICE_NO' => 'required',
            'SUPP_ID_AUTO' => 'required',
        );

        $error = array(
            'RCV_QTY.required' => 'Amount field is required.',
            'RECEIVE_NO.required' => 'Procurement Chemical field is required.',
            'INVOICE_NO.required' => 'Invoice number field is required.',
            'SUPP_ID_AUTO.required' => 'Chemical Source field is required.',
        );

        $validator = Validator::make(Input::all(), $rules, $error);

        if ($validator->fails()) return response()->json(['errors'=>$validator->errors()->first()]);

        $update = ChemicalPurchase::updateChemicalPurchaseData($request,$id);

        if ($update) {
            return response()->json(['success'=>'Chemical purchase has been updated']);
        } else{
            return response()->json(['errors'=>'Chemical purchase update failed']);
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
        $delete = ChemicalPurchase::deleteChemicalPurchase($id);

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
