<?php

namespace App\Http\Controllers;
use App\LookupGroupData;
use App\SupplierProfile;
use Illuminate\Http\Request;
use App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\LookupGroup;
use UxWeb\SweetAlert\SweetAlert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class SupplierProfileController extends Controller
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

//        $title = trans('lookupGroupIndex.create_lookup');
        $title = trans('Create New Supplier Profile');

        $heading=array(
            'title'=> $title,
            'library'=>'datatable',
            'modalSize'=>'modal-bg',
            'action'=>'supplier-profile/create',
            'createPermissionLevel' => $previllage->CREATE
        );

        $supplierProfile = SupplierProfile::supplierProfileList();

        //print_r($lookupGroups);exit;
        return view('profile.supplier.supplierProfileIndex', compact( 'heading','previllage','supplierProfile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supplier = count(SupplierProfile::supplier());
        $supplierId = sprintf("%04d", $supplier+1);
//        $digits = 4;
//        $supplierId = rand(pow(10, $digits-1), pow(10, $digits)-1);
        $getDivision = SupplierProfile::getDivision();
        $getSupplierType = LookupGroupData::getActiveGroupDataByLookupGroup($this->supplierTypeId);
//        $this->pr($test);
        return view('profile.supplier.createSupplierProfile',compact('getDivision','supplierId','getSupplierType'));
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
            //'LICENCE_NO' => 'required|max:100',

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
                'THANA_ID' => $request->input('THANA_ID'),
                'BAZAR_NAME' => $request->input('BAZAR_NAME'),
                'PHONE' => $request->input('PHONE'),
                'EMAIL' => $request->input('EMAIL'),
                'REMARKS' => $request->input('REMARKS'),
                'center_id' => Auth::user()->center_id,
                'ENTRY_BY' => Auth::user()->id,
                'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
           ]);

            //$this->pr($request->input());
            $createSupplierProfile = SupplierProfile::insertIntoSupplierProfile($data);
               
            if($createSupplierProfile){
    //            return response()->json(['success'=>'Lookup Group Successfully Saved']);
                //return json_encode('Success');
                return redirect('/supplier-profile')->with('success', 'Supplier profile Has been Created !');
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
         $viewSupplierProfile = SupplierProfile::showSupplierProfile($id);

        return view('profile.supplier.viewSupplierProfile',compact( 'viewSupplierProfile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
     {
         $editData = SupplierProfile::editSupplierProfile($id);
         $getDivision = SupplierProfile::getDivision();
         $getSupplierType = LookupGroupData::getActiveGroupDataByLookupGroup($this->supplierTypeId);
        return view('profile.supplier.editSupplierProfile' , compact('editData','getDivision','getSupplierType'));

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
        //print_r($request->input());exit();

        $rules = array(
            'TRADING_NAME' => 'required|max:100',
            //'LICENCE_NO' => 'required|max:100',
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {
        $updateSupplierData = SupplierProfile::updateSupplierProfileData($request, $id);
            if($updateSupplierData){
                return redirect('/supplier-profile')->with('success', 'Supplier Profile Data Updated !');
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
        $delete = SupplierProfile::deleteSupplierProfile($id);
        if($delete){
            echo json_encode([
                'type' => 'tr',
                'id' => $id,
                'flag' => true,
                'message' => 'Supplier Profile Successfully Deleted.',
            ]);
        } else{
            echo json_encode([
                'message' => 'Error Founded Here!',
            ]);
        }


    }

    public function getDistrictByAjax(Request $request){
        $divisionId = $request->input('divisionId');
        return SupplierProfile::getDistrictByAjax($divisionId);

    }
    public function getUpazilaByAjax(Request $request){
        $districtId = $request->input('districtId');
        return SupplierProfile::getUpazilaByAjax($districtId);

    }
    public function getUnionByAjax(Request $request){
        $upazilaId = $request->input('upazilaId');
        return SupplierProfile::getUnionByAjax($upazilaId);

    }

    public static function getThanaByAjax(Request $request){
        $thanaId = $request->input('districtId');
        return SupplierProfile::getThanaByAjax($thanaId);
    }
}
