<?php

namespace App\Http\Controllers;

use App\LookupGroupData;
use App\Entrepreneur;
use App\MillerInfo;
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
use App\AssociationSetup;

class EntrepreneurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'MILL_ID' => 'required',
            'OWNER_NAME.*' => 'required',
            'NID.*' => 'required',
//            'MOBILE_1.*' => 'required',
//            'EMAIL.*' => 'required',
        );
        $error = array(
            'MILL_ID.required' => 'Miller Information not available. <span class="text-primary">You need to provide miller information</span>.',
            'OWNER_NAME.*' => 'Owner name field is required.',
            'NID.*' => 'NID field is required.',
//            'MOBILE_1.*' => 'Mobile_1 field is required.',
//            'EMAIL.*' => 'Email field is required.'
        );

        $validator = Validator::make(Input::all(), $rules, $error);

        if ($validator->fails()) return response()->json(['errors'=>$validator->errors()->first()]);

        $millerId = $request->input('MILL_ID');

        $inserted = Entrepreneur::insertEntrepreneurInfo($request);

        if($inserted){
            return response()->json(['success'=>'Entrepreneur info has been saved successfully', 'insertId' => $millerId]);
        } else{
            return response()->json(['errors'=>'Entrepreneur info save failed']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $millerId)
    {
        $updated = false;
        $rules = array(
            'OWNER_NAME.*' => 'required',
//            'NID.*' => 'required',
//            'MOBILE_1.*' => 'required',
//            'EMAIL.*' => 'required',
        );
        $error = array(
            'OWNER_NAME.*' => 'Owner name field is required.',
//            'NID.*' => 'NID field is required.',
//            'MOBILE_1.*' => 'Mobile_1 field is required.',
//            'EMAIL.*' => 'Email field is required.'
        );
        $validator = Validator::make(Input::all(), $rules, $error);
        if ($validator->fails()) return response()->json(['errors'=>$validator->errors()->first()]);

        $selfMillerInfo = MillerInfo::selfMillerAuthenticated();
        if($selfMillerInfo->MILL_ID){
            $hasRequest = $this->hasUpdateRequested($millerId);
            if($hasRequest) return response()->json(['errors'=>'You have already requested to update your profile. You need to association approval for further request']);
            $updated = Entrepreneur::updateEntrepreneurInfoTemp($request, $millerId);
        } else {
            $updated = Entrepreneur::updateEntrepreneurInfo($request, $millerId);
        }

        if($updated){
            return response()->json(['success'=>'Entrepreneur info has been updated successfully']);
        } else{
            return response()->json(['errors'=>'Entrepreneur info update failed']);
        }
    }

    private function hasUpdateRequested($millerId){
        return DB::table('tem_ssm_entrepreneur_info')->where('Mill_ID', '=', $millerId)->first();
    }

    public function singleEnterpreneurDeleteByAjax(Request $request){
        $enterpreneurId = $request->input('enterpreneurId');
        $delete = DB::table('ssm_entrepreneur_info')->where('ENTREPRENEUR_ID', $enterpreneurId)->delete();
        return "ENTREPRENEUR Successfully Deleted";
    }

}
