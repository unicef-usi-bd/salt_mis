<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class BrandController extends Controller
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
        $title = trans(' Add Brand Name');

        $heading=array(
            'title'=> $title,
            'library'=>'datatable',
            'modalSize'=>'modal-md',
            'action'=>'brand/create',
            'createPermissionLevel' => $previllage->CREATE
        );

        $brands = Brand::getData();

        return view('setup.brand.brandIndex', compact( 'heading','previllage','brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('setup.brand.modals.createBrand');
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
            'brand_name' => 'required'
        );

        $error = array(
            'brand_name.required' => 'Name field is required.',
        );

        $validator = Validator::make(Input::all(), $rules, $error);

        if ($validator->fails()) return response()->json(['errors'=>$validator->errors()->first()]);

        $data = array([
            'brand_name' => $request->input('brand_name'),
            'center_id' => Auth::user()->center_id,
            'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s"),
            'ENTRY_BY' => Auth::user()->id
        ]);

        $created = Brand::insertBrandData($data);

        if($created){
            return response()->json(['success'=>'Brand has been created']);
        } else{
            return response()->json(['errors'=>'Brand create failed']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editBrand = Brand::editBrandData($id);
        return view('setup.brand.modals.editBrand',compact('editBrand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'brand_name' => 'required'
        );

        $error = array(
            'brand_name.required' => 'Name field is required.',
        );

        $validator = Validator::make(Input::all(), $rules, $error);

        if ($validator->fails()) return response()->json(['errors'=>$validator->errors()->first()]);

        $updated = Brand::updateBrandData($request,$id);

        if($updated){
            return response()->json(['success'=>'Brand has been updated']);
        } else{
            return response()->json(['errors'=>'Brand update failed']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Brand::deleteBrandData($id);
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
