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
        $today = date('Y-m-d');
        if ($extendDate <= $today) {
            return response()->json(['errors' => 'Extended date must be greater than today.']);
        }
        $diff = date_diff(date_create($today), date_create($extendDate));
        $extendDays = $diff->format('%a');

        $oldExtendDate = DB::table('miller_extend_dates')
            ->where('mill_id', '=', $millerId)
            ->orderBy('extend_date', 'desc')
            ->pluck('extend_date')
            ->first();

        if ($oldExtendDate) {
            $oldExtendDate = $this->dateFormat($oldExtendDate);
            if ($oldExtendDate >= $extendDate) return response()->json(['errors' => "Extended date invalid. Last extend date is $oldExtendDate."]);
        }
        try {
            DB::beginTransaction();
            $updated = DB::table('ssm_mill_info as smi')
                ->where('smi.MILL_ID', $millerId)
                ->update([
                    'smi.extend_date' => $extendDate,
                    'smi.extend_days' => $extendDays
                ]);

            if ($updated) {
                $data = array(
                    'mill_id' => $millerId,
                    'extend_date' => $extendDate,
                    'extend_days' => $extendDays
                );
                DB::table('miller_extend_dates')->insert($data);
            }
            DB::commit();
            return response()->json(['success' => 'Extended date successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['errors' => 'Extended date failed.']);
        }

    }
}
