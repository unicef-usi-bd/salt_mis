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
            'modalSize'=>'modal-bg'
        );
        $millerId = ExtendedDate::millerName();

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



    public function millerInfo(Request $request){
        $millId = $request->input('mill_id');
        $millInfo = ExtendedDate::millerDetails($millId);
        $entepreunerInfo = ExtendedDate::millerEnteprunerDetails($millId);
        $certificateInfo = ExtendedDate::millerCertificateInfo($millId);
        $centerId = AssociationSetup::associationByMillId($millId);
        $extendDate = User::extendDateByCenterId($centerId);
        $view = view("setup.extendate.millerInfo",compact('millInfo','millId','entepreunerInfo','certificateInfo', 'extendDate'))->render();
        return response()->json(['html'=>$view]);
    }

    public function updateExtendedDate(Request $request){

        $millerId = $request->input('MILL_ID');

        $associationInfo = DB::table('ssm_associationsetup')
            ->select('ssm_associationsetup.ASSOCIATION_ID')
            ->where('MILL_ID','=', $millerId)
            ->first();

        $renewingDate = $this->dateFormat($request->input('renewing_date'));

        if(empty($renewingDate)){
            $renewingDate = '';
        }else{
            $renewingDate = date('Y-m-d',strtotime($request->input('renewing_date')));
        }

       if($associationInfo){
           $updated = DB::table('users')
               ->where('center_id', $associationInfo->ASSOCIATION_ID)
               ->update([
               'renewing_date' => $renewingDate,
               'renewing_days' => $request->input('renewing_days')
           ]);

           if($updated) {
               return response()->json(['success'=>'Extended date successfully.']);
           }else{
               return response()->json(['success'=>'Extended date failed.']);
           }
       }else{
           return response()->json(['success'=>'Miller not found']);
       }
    }
}
