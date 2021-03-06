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
        $supplierId = SupplierProfile::supplierMaxId();
        $supplierId = sprintf("%04d", $supplierId+1);// $digits = 4;
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
            'SUPPLIER_TYPE_ID' => 'required',
            'TRADING_NAME' => 'required',
            'TRADER_NAME' => 'required',
            'PHONE' => 'required',
            'DIVISION_ID' => 'required',
            'DISTRICT_ID' => 'required',
            'UPAZILA_ID' => 'required',
        );
        $error = array(
            'SUPPLIER_TYPE_ID.required' => 'Supplier type field must be required.',
            'TRADING_NAME.required' => 'Trading field must be required.',
            'TRADER_NAME.required' => 'Trader field must be required.',
            'PHONE.required' => 'Phone number field must be required.',
            'DIVISION_ID.required' => 'Division field must be required',
            'DISTRICT_ID.required' => 'District field must be required',
            'UPAZILA_ID.required' => 'Upazila field must be required',
        );

        $validator = Validator::make(Input::all(), $rules, $error);

        if ($validator->fails()) return response()->json(['errors'=>$validator->errors()->first()]);

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
        $created = SupplierProfile::insertIntoSupplierProfile($data);

        $supplierId = SupplierProfile::supplierMaxId();
        $supplierId = sprintf("%04d", $supplierId+1);// $digits = 4;

        if($created){
            return response()->json(['success'=>'Supplier profile submission Completed', 'insertId'=>$supplierId]);
        } else{
            return response()->json(['errors'=>'Supplier profile create failed']);
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
        $rules = array(
            'SUPPLIER_TYPE_ID' => 'required',
            'TRADING_NAME' => 'required',
            'TRADER_NAME' => 'required',
            'PHONE' => 'required',
            'DIVISION_ID' => 'required',
            'DISTRICT_ID' => 'required',
            'UPAZILA_ID' => 'required',
        );
        $error = array(
            'SUPPLIER_TYPE_ID.required' => 'Supplier type field must be required.',
            'TRADING_NAME.required' => 'Trading field must be required.',
            'TRADER_NAME.required' => 'Trader field must be required.',
            'PHONE.required' => 'Phone number field must be required.',
            'DIVISION_ID.required' => 'Division field must be required',
            'DISTRICT_ID.required' => 'District field must be required',
            'UPAZILA_ID.required' => 'Upazila field must be required',
        );

        $validator = Validator::make(Input::all(), $rules, $error);

        if ($validator->fails()) return response()->json(['errors'=>$validator->errors()->first()]);

        $updated = SupplierProfile::updateSupplierProfileData($request, $id);

        if($updated){
            return response()->json(['success'=>'Supplier Profile Submission Completed']);
        } else{
            return response()->json(['errors'=>'Supplier profile update failed']);
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

    public function getDistrictByAjax($divisionId){
        return SupplierProfile::getDistrictByAjax($divisionId);

    }
    public function getUpazilaByAjax($districtId){
        return SupplierProfile::getUpazilaByAjax($districtId);
    }
    public function getUnionByAjax($upazilaId){
        return SupplierProfile::getUnionByAjax($upazilaId);

    }

    public static function getThanaByAjax($thanaId){
        return SupplierProfile::getThanaByAjax($thanaId);
    }
}
