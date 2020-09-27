<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\SellerDistributorProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\LookupGroupData;
use App\SupplierProfile;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;



class SellerDistributorProfileController extends Controller
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
            'title'=>'Create Seller & Distributor Profile',
            'library'=>'datatable',
            'modalSize'=>'modal-bg',
            'action'=>'seller-distributor-profile/create',
            'createPermissionLevel' => $previllage->CREATE
        );

        $sellerDitributorProfile = SellerDistributorProfile::sellerDistributorProfile();
        return view('profile.sellerDistributorProfile.sellerDistributorProfileIndex',compact('heading','previllage','sellerDitributorProfile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sellerId = SellerDistributorProfile::sellerDistributorProfileMaxId();
        $sellerId = sprintf("%04d", $sellerId+1);
        $sellerType = LookupGroupData::getActiveGroupDataByLookupGroup($this->sellerTypeId);
        $getDivision = SupplierProfile::getDivision();
        return view('profile.sellerDistributorProfile.modals.createSellerDistributorProfile',compact('sellerType','sellerId','getDivision'));
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
            'TRADING_NAME' => 'required|max:100',
            'TRADER_NAME' => 'required|max:100',
//            'LICENCE_NO' => 'required|max:100',
            'PHONE' => 'required|max:100',
            'DIVISION_ID' => 'required|max:100',
            'DISTRICT_ID' => 'required|max:100',
            'THANA_ID' => 'required|max:100',
        );
        $error = array(
            'TRADING_NAME.required' => 'Trade name field is required.',
            'TRADER_NAME.required' => 'Trader no field is required.',
//            'LICENCE_NO.required' => 'Licence no field is required.',
            'PHONE.required' => 'Phone number field is required.',
            'DIVISION_ID.required' => 'Division field is required.',
            'DISTRICT_ID.required' => 'District no field is required.',
            'THANA_ID.required' => 'Thana/Upazilla field is required.',
        );

        $validator = Validator::make(Input::all(), $rules, $error);

        if ($validator->fails()) return response()->json(['errors'=>$validator->errors()->first()]);

        $inserted = SellerDistributorProfile::insertData($request);

        $sellerId = SellerDistributorProfile::sellerDistributorProfileMaxId();
        $sellerId = sprintf("%04d", $sellerId+1);

        if($inserted){
            return response()->json(['success'=>'Seller/Distributor Submission Completed', 'insertId'=> $sellerId]);
        } else{
            return response()->json(['errors'=>'Seller/Distributor create failed']);
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
        $viewSellerDistributor = SellerDistributorProfile::showSellerDistributorProfile($id);
        $editsellerProfilearray = SellerDistributorProfile::editSellerDistributorProfilCoverageArea($id);

        return view('profile.sellerDistributorProfile.modals.viewSellerDistributorProfile',compact('viewSellerDistributor','editsellerProfilearray'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sellerType = LookupGroupData::getActiveGroupDataByLookupGroup($this->sellerTypeId);
        $editSellerProfile = SellerDistributorProfile::editSellerDistributorProfile($id);

        $getDivision = SupplierProfile::getDivision();
        $editsellerProfilearray = SellerDistributorProfile::editSellerDistributorProfilCoverageArea($id);

        return view('profile.sellerDistributorProfile.modals.editSellerDistributorProfile',compact('sellerType','editSellerProfile','getDivision','editsellerProfilearray'));
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
            'TRADING_NAME' => 'required|max:100',
            'TRADER_NAME' => 'required|max:100',
//            'LICENCE_NO' => 'required|max:100',
            'PHONE' => 'required|max:100',
            'DIVISION_ID' => 'required|max:100',
            'DISTRICT_ID' => 'required|max:100',
            'THANA_ID' => 'required|max:100',
        );
        $error = array(
            'TRADING_NAME.required' => 'Trade name field is required.',
            'TRADER_NAME.required' => 'Trader no field is required.',
//            'LICENCE_NO.required' => 'Licence no field is required.',
            'PHONE.required' => 'Phone number field is required.',
            'DIVISION_ID.required' => 'Division field is required.',
            'DISTRICT_ID.required' => 'District no field is required.',
            'THANA_ID.required' => 'Thana/Upazilla field is required.',
        );

        $validator = Validator::make(Input::all(), $rules, $error);

        if ($validator->fails()) return response()->json(['errors'=>$validator->errors()->first()]);

        $updated = SellerDistributorProfile::updateData($request, $id);

        if($updated){
            return response()->json(['success'=>'Seller/Distributor Submission Completed']);
        } else{
            return response()->json(['errors'=>'Seller/Distributor create failed']);
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
        $delete = SellerDistributorProfile::deleteSellerProfile($id);

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

    public function deleteCoverageareaByAjax(Request $request){
        $fundAllocationChdId = $request->input('fundAllocationChdId');
        $deleteChd = FundAllocation::deleteFundAllocationChd($fundAllocationChdId);
        return $deleteChd;
    }

    public function getTradingList(Request $request){
        $sellerTypeId = $request->input('sellerTypeId');
        $tradingLists = SellerDistributorProfile::tradingList($sellerTypeId);
      //  return json_encode($tradingLists);
        return $tradingLists;

    }

}
