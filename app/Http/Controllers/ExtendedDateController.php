<?php

namespace App\Http\Controllers;

use App\Bank;
use App\CostCenter;
use App\LookupGroupData;
use App\UserGroup;
use App\UserGroupLevel;
use Illuminate\Http\Request;
use UxWeb\SweetAlert\SweetAlert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use App\User;
use File;
use Illuminate\Support\Facades\Route;
use App\AssociationSetup;
use Intervention\Image\ImageManagerStatic as Image;

use App\Http\Controllers\Controller;
use App\ExtendedDate;

class ExtendedDateController extends Controller
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
            'title'=>'Extended date',
            'library'=>'datatable',
            'modalSize'=>'modal-lg',
            'action'=>'extended-date/create',
            'createPermissionLevel' => $previllage->CREATE
        );
//        dd(session()->all());
        $users = User::getData();
//        $this->pr($users);

        return view('setup.extendate.index',compact( 'users','heading','previllage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $millerId = ExtendedDate::millerName();
        return view('setup.extendate.modals.create',compact('millerId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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

    public function millerInfo(Request $request){
     $millId = $request->input('millerName');
     $view = view("extendate.millerInfo",compact('millId'))->render();
     return response()->json(['html'=>$view]);
    }
}
