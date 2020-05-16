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
        $previllage = $this->checkPrevillage($userGroupId, $userGroupLevelId, $url);

        $heading = array(
            'title' => 'Extended date',
            'library' => 'datatable',
            'modalSize' => 'modal-bg'
        );
        $millerId = ExtendedDate::millerName();

        return view('setup.extendate.index', compact('users', 'heading', 'previllage', 'millerId'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $millerId = ExtendedDate::millerName();
        return view('setup.extendate.modals.create', compact('millerId'));
    }


    public function millerInfo(Request $request)
    {
        $millId = $request->input('mill_id');
        $millInfo = ExtendedDate::millerDetails($millId);
        $entepreunerInfo = ExtendedDate::millerEnteprunerDetails($millId);
        $certificateInfo = ExtendedDate::millerCertificateInfo($millId);
        $centerId = AssociationSetup::associationByMillId($millId);
        $extendDate = User::extendDateByCenterId($centerId);
        $extendDetails = ExtendedDate::extendDetails($millId);
        $view = view("setup.extendate.millerInfo", compact('millInfo', 'millId', 'entepreunerInfo', 'certificateInfo', 'extendDate', 'extendDetails'))->render();
        return response()->json(['html' => $view]);
    }

    public function updateExtendedDate(Request $request)
    {
        $millerId = $request->input('MILL_ID');
        $extendDate = $this->dateFormat($request->input('renewing_date'));
        $extendDays = $request->input('renewing_days');

        $oldExtendDate = DB::table('miller_extend_dates')
            ->orderBy('extend_date', 'desc')
            ->pluck('extend_date')
            ->first();

        if($oldExtendDate){
            $oldExtendDate = $this->dateFormat($oldExtendDate);
            if($oldExtendDate>=$extendDate) return response()->json(['error' => 'Extended date Invalid.']);
        }
        $updated = DB::table('ssm_mill_info as smi')
            ->where('MILL_ID', $millerId)
            ->update([
                'extend_date' => $extendDate,
                'extend_days' => $extendDays
            ]);

        if ($updated) {
            $data = array(
                'mill_id' => $millerId,
                'extend_date' => $extendDate,
                'extend_days' => $extendDays
            );
            DB::table('miller_extend_dates')->insert($data);
            return response()->json(['success' => 'Extended date successfully.']);
        } else {
            return response()->json(['success' => 'Extended date failed.']);
        }

    }
}
