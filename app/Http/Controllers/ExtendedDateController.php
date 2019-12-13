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
use Psy\Util\Json;
use App\User;
use File;
use Illuminate\Support\Facades\Route;
use App\AssociationSetup;
use Intervention\Image\ImageManagerStatic as Image;

use App\Http\Controllers\Controller;
use App\ExtendedDate;
use Illuminate\Support\Facades\DB;

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
            'modalSize'=>'modal-bg',
//            'action'=>'extended-date/create',
//            'createPermissionLevel' => $previllage->CREATE
        );
//        dd(session()->all());
           $millerId = ExtendedDate::millerName();
//        $this->pr($users);

        return view('setup.extendate.index',compact( 'users','heading','previllage','millerId'));
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
     $millId = $request->input('mill_id');
     $millInfo = ExtendedDate::millerDetails($millId);
     $millenteprunerInfo = ExtendedDate::millerEnteprunerDetails($millId);
     $certificateInfo = ExtendedDate::millerCertificateInfo($millId);
     //dd($millInfo);
     $view = view("setup.extendate.millerInfo",compact('millInfo','millId','millenteprunerInfo','certificateInfo'))->render();
     return response()->json(['html'=>$view]);
    }

    public function updateExtendedDate(Request $request){

        $center_id = Auth::user()->center_id ;

        $associationId = DB::table('ssm_associationsetup')
            ->select('ssm_associationsetup.ASSOCIATION_ID')
            ->where('MILL_ID','=',$request->input('MILL_ID'))
            ->first();

        $renewingDate = $request->input('renewing_date');
        if(empty($renewingDate)){
            $renewingDate = '';
        }else{
            $renewingDate = date('Y-m-d',strtotime($request->input('renewing_date')));
        }

       if($associationId){
           $status = DB::table('users')->where('center_id',$associationId->ASSOCIATION_ID)->update([
//               'renewing_date' => date('Y-m-d', strtotime($request->input('renewing_date'))),
               'renewing_date' => $renewingDate,
               'renewing_days' => $request->input('renewing_days')
           ]);
           if($status)
           {
               return redirect()->back()->with('success','Updated successfully');
           }else{
               return redirect()->back()->with('warning','Updated Fail');
           }
       }else{
           return redirect()->back()->with('danger','Miller does not found');
       }

        return redirect('/extended-date');
    }
}
