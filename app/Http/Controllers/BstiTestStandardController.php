<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BstiTestStandard;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\BstiTestResultRange;

class BstiTestStandardController extends Controller
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
        $editBstiTestStandard = BstiTestStandard::getBstiTestData();
        $editBstiTestStandardResultRange = BstiTestResultRange::getBstiTestResultDataRange();

        //$this->pr($editBstiTestStandard);

        return view('setup.bstiTestStandard.createBstiTestStandard',compact('editBstiTestStandardResultRange','editBstiTestStandard','previllage'));
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
            'SODIUM_CHLORIDE' => 'required',
            'MOISTURIZER' => 'required',
            'PPM' => 'required',
            'PH' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {
            $bstiTestStandard = BstiTestStandard::insertBstiTestData($request);

            if($bstiTestStandard){
                return redirect('/bsti-test-standard')->with('success', 'BSTI Test Standard Data Created !');
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
        $editBstiTestStandard = BstiTestStandard::editBstiTestData($id);
        $editBstiTestStandardResultRange = BstiTestResultRange::editBstiTestResultDataRange($id);
        if($editBstiTestStandard ){

         return view('setup.bstiTestStandard.editBstiTestStandard',compact('editBstiTestStandard'));
        }elseif ($editBstiTestStandardResultRange ){
            return view('setup.bstiTestStandard.editBstiTestStandardRange',compact('editBstiTestResutlRange'));
        }
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
            'SODIUM_CHLORIDE' => 'required',
            'MOISTURIZER' => 'required',
            'PPM' => 'required',
            'PH' => 'required'
        );
        $error = array(
            'SODIUM_CHLORIDE.required' => 'Sodium Chloride field is required.',
            'MOISTURIZER.required' => 'Moisturizer field is required.',
            'PPM.required' => 'Iodine Content field is required.',
            'PH.required' => 'PH field is required.',
        );

        $validator = Validator::make(Input::all(), $rules, $error);

        if ($validator->fails()) return response()->json(['errors'=>$validator->errors()->first()]);

        $updated = BstiTestStandard::updateBstiTestData($request, $id);
        if($updated){
            return response()->json(['success'=>'BSTI Test Standard has been updated']);
        } else{
            return response()->json(['errors'=>'BSTI Test Standard update failed']);
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

//    public function editBstitestResutlRange($id)
//    {
//        $editBstiTestResutlRange = BstiTestResultRange::editBstiTestResultDataRange($id);
//        return view('setup.bstiTestStandard.editBstiTestStandardRange',compact('editBstiTestResutlRange'));
//    }
}
