<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\LookupGroupData;
use App\Report;
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

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemList = Report::itemList();
        $getDivision = SupplierProfile::getDivision();
        $issueBy = LookupGroupData::getActiveGroupDataByLookupGroup($this->issureTypeId);
        return view("reports.reportDashboard", compact('itemList','getDivision','issueBy'));
    }


    public function getAssociationList(){

        $asociationLists = Report::getAssociationList();
        //return $asociationLists;
        $view = view("reportView.associationListReport",compact('asociationLists'))->render();
        return response()->json(['html'=>$view]);

    }

}
