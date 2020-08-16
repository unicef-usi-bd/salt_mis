<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BstiTestResultRange;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class BstiTestResultRangeController extends Controller
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

        $editBstiTestStandardResultRange = BstiTestResultRange::getBstiTestResultDataRange();

        return view('setup.bstiTestStandard.createBstiTestStandard',compact('editBstiTestStandardResultRange','previllage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'SODIUM_CHLORIDE_MIN' => 'required',
            'SODIUM_CHLORIDE_MAX' => 'required',
            'MOISTURIZER_MIN' => 'required',
            'MOISTURIZER_MAX' => 'required',
            'PPM_MIN' => 'required',
            'PPM_MAX' => 'required',
            'PH_MIN' => 'required',
            'PH_MAX' => 'required',
            'WIM_MIN' => 'required',
            'WIM_MAX' => 'required',
            'MSWSC_MIN' => 'required',
            'MSWSC_MAX' => 'required',
        );
        $error = array(
            'SODIUM_CHLORIDE_MIN.required' => 'Sodium minimum length field is required.',
            'SODIUM_CHLORIDE_MAX.required' => 'Sodium maximum length field is required.',
            'MOISTURIZER_MIN.required' => 'Moisturizer minimum length field is required.',
            'MOISTURIZER_MAX.required' => 'Moisturizer maximum length field is required.',
            'PPM_MIN.required' => 'Iodize content minimum length field is required.',
            'PPM_MAX.required' => 'Iodize content maximum length field is required.',
            'PH_MIN.required' => 'PH minimum length field is required.',
            'PH_MAX.required' => 'PH maximum length field is required.',
            'WIM_MIN.required' => 'Water insoluble matter minimum length field is required.',
            'WIM_MAX.required' => 'Water insoluble matter maximum length field is required.',
            'MSWSC_MIN.required' => 'Matter soluble water sodium chloride minimum length field is required.',
            'MSWSC_MAX.required' => 'Matter soluble water sodium chloride maximum length field is required.',
        );

        $validator = Validator::make(Input::all(), $rules, $error);
        if ($validator->fails()) return response()->json(['errors'=>$validator->errors()->first()]);
        $created = BstiTestResultRange::insertBstiTestRangeData($request);
        if($created){
            return response()->json(['success'=>'BSTI Test Standard range has been created']);
        } else{
            return response()->json(['errors'=>'BSTI Test Standard range create failed']);
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
        $editBstiTestResutlRange = BstiTestResultRange::editBstiTestResultDataRange($id);
        return view('setup.bstiTestStandard.editBstiTestStandardRange',compact('editBstiTestResutlRange'));
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
            'SODIUM_CHLORIDE_MIN' => 'required',
            'SODIUM_CHLORIDE_MAX' => 'required',
            'MOISTURIZER_MIN' => 'required',
            'MOISTURIZER_MAX' => 'required',
            'PPM_MIN' => 'required',
            'PPM_MAX' => 'required',
            'PH_MIN' => 'required',
            'PH_MAX' => 'required',
            'WIM_MIN' => 'required',
            'WIM_MAX' => 'required',
            'MSWSC_MIN' => 'required',
            'MSWSC_MAX' => 'required',
        );
        $error = array(
            'SODIUM_CHLORIDE_MIN.required' => 'Sodium minimum length field is required.',
            'SODIUM_CHLORIDE_MAX.required' => 'Sodium maximum length field is required.',
            'MOISTURIZER_MIN.required' => 'Moisturizer minimum length field is required.',
            'MOISTURIZER_MAX.required' => 'Moisturizer maximum length field is required.',
            'PPM_MIN.required' => 'Iodize content minimum length field is required.',
            'PPM_MAX.required' => 'Iodize content maximum length field is required.',
            'PH_MIN.required' => 'PH minimum length field is required.',
            'PH_MAX.required' => 'PH maximum length field is required.',
            'WIM_MIN.required' => 'Water insoluble matter minimum length field is required.',
            'WIM_MAX.required' => 'Water insoluble matter maximum length field is required.',
            'MSWSC_MIN.required' => 'Matter soluble water sodium chloride minimum length field is required.',
            'MSWSC_MAX.required' => 'Matter soluble water sodium chloride maximum length field is required.',
        );

        $validator = Validator::make(Input::all(), $rules, $error);
        if ($validator->fails()) return response()->json(['errors'=>$validator->errors()->first()]);

        $updated = BstiTestResultRange::updateBstiTestDataRang($request, $id);
        if($updated){
            return response()->json(['success'=>'BSTI Test Standard range has been updated']);
        } else{
            return response()->json(['errors'=>'BSTI Test Standard range update failed']);
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
        //
    }
}
