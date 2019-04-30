<?php

namespace App\Http\Controllers;

use App\LookupGroupData;
use App\Report;
use App\ReportTest;
use App\SupplierProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReportTestController extends Controller
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
        return view("reportTest.reportDashboard", compact('itemList','getDivision','issueBy'));
    }

    public function getChemicalItemList(){
        $centerId = Auth::user()->center_id;
        $purchaseChemicalLists = ReportTest::getPurchaseChemicalList($centerId);
        $view = view("reportView.purchaseChemicalList",compact('purchaseChemicalLists','centerId'))->render();
        return response()->json(['html'=>$view]);
    }
}
