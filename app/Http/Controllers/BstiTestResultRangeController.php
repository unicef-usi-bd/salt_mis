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
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {
            $bstiTestStandardResultRange = BstiTestResultRange::insertBstiTestRangeData($request);

            if($bstiTestStandardResultRange){
                return redirect('/bsti-test-standard')->with('success', 'BSTI Test Standard Range Data Created !');
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
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {
            $updateBstiTestStandard = BstiTestResultRange::updateBstiTestDataRang($request, $id);
            if($updateBstiTestStandard){
                return redirect('/bsti-test-standard')->with('success', 'Update Bsti Test Standard Data Updated !');
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
        //
    }
}
