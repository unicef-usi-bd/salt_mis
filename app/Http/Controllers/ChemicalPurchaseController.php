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
        $supplierName = SupplierProfile::supplierProfile($this->chemicalSupplierTypeId);
        $defultSupplier = SupplierProfile::defultSupplierProfile($this->chemicalSupplierTypeId);
//        $supplierNameBscic = SupplierProfile::supplierProfileBscic();
        //$this->pr($supplierName);
        return view('transactions.chemicalPurchase.modals.createChemicalPurchase',compact('chemicleType','agencyType','chemicalSupplier','supplierName','supplierNameBscic','defultSupplier'));
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
            'RCV_QTY' => 'required',


        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {


            //$this->pr($request->input());
            $chemicalePurchase = ChemicalPurchase::insertChemicalPurchaseData($request);

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
        //$supplierName = ChemicalPurchase::getSupplierName();
        $supplierName = SupplierProfile::supplierProfile($this->chemicalSupplierTypeId);
        $editChemicalpurchase = ChemicalPurchase::editChemicalPurchase($id);
        //$supplierNameBsti = SupplierProfile::supplierProfileBsti();

        return view('transactions.chemicalPurchase.modals.editChemicalPurchase',compact('chemicleType','supplierName','editChemicalpurchase','supplierNameBsti'));
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
            'RCV_QTY' => 'required',

        );

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        } else {


            $chemicalPurchesupdate = ChemicalPurchase::updateChemicalPurchaseData($request,$id);
        }


        if ($chemicalPurchesupdate) {
            //            return response()->json(['success'=>'Lookup Group Successfully Saved']);
            //return json_encode('Success');
            return redirect('/chemical-purchase')->with('success', 'Chemical Purchase Update!');
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
