<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            'title'=>'Seller & Distributor Profile',
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
        $digits = 4;
        $supplierId = rand(pow(10, $digits-1), pow(10, $digits)-1);
        $sellerType = LookupGroupData::getActiveGroupDataByLookupGroup($this->sellerTypeId);
        $getDivision = SupplierProfile::getDivision();
        return view('profile.sellerDistributorProfile.modals.createSellerDistributorProfile',compact('sellerType','supplierId','getDivision'));
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
//            'TRADING_NAME' => 'required|max:100',
//            'LICENCE_NO' => 'required|max:100',

        );

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        } else {


            $SellerDistributorProfile = SellerDistributorProfile::insertData($request);
        }

        //$this->pr($request->input());


        if ($SellerDistributorProfile) {
            //            return response()->json(['success'=>'Lookup Group Successfully Saved']);
            //return json_encode('Success');
            return redirect('/seller-distributor-profile')->with('success', 'Seller/Distributor profile Has been Created !');
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
            'LICENCE_NO' => 'required|max:100',

        );

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        } else {


            $SellerDistributorProfileupdate = SellerDistributorProfile::updateData($request,$id);
        }

        //$this->pr($SellerDistributorProfileupdate);


        if ($SellerDistributorProfileupdate) {
            //            return response()->json(['success'=>'Lookup Group Successfully Saved']);
            //return json_encode('Success');
            return redirect('/seller-distributor-profile')->with('success', 'Seller/Distributor profile Update!');
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

}
