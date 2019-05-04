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
use Psy\Util\Json;

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

// test controller
    public function getAssociationList(){

        $asociationLists = Report::getAssociationList();
        //return $asociationLists;
        $view = view("reportView.associationListReport",compact('asociationLists'))->render();
        return response()->json(['html'=>$view]);

    }


    public function getAssociationListPdf(){
        $asociationLists = Report::getAssociationList();
        $data = \View::make('reportPdf.associationListReportPdf',compact('asociationLists'));
        $this->generatePdf($data);
    }

    public function getMillerList(Request $request){
        $activStatus = $request->input('activStatus');
        $millerLists = Report::getMillerList($activStatus);
        //$this->pr($millerLists);
        $view = view("reportView.millerListReport",compact('millerLists','activStatus'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getMillerListPdf($activStatus){
        $millerLists = Report::getMillerList($activStatus);
        //$this->pr($millerLists);
        $data = \View::make('reportPdf.millerListReportPdf',compact('millerLists'));
        $this->generatePdf($data);
    }

    public function getMonitorAssociationList(){
        $monitorAssociationLists = Report::getMonitorAssociationList();
        $view = view("reportView.monitorAssociationList",compact('monitorAssociationLists'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getPurchaseSalteList(){
        $centerId = Auth::user()->center_id;
        $purchaseSaltList = Report::getPurchaseSalteList($centerId);
        $view = view("reportView.purchaseSaltList",compact('purchaseSaltList'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getPurchaseSalteListPdf(){
        $centerId = Auth::user()->center_id;
        $purchaseSaltList = Report::getPurchaseSalteList($centerId);
        $data = \View::make('reportPdf.purchaseSalteListReportPdf',compact('purchaseSaltList'));
        $this->generatePdf($data);
    }

    public function getPurchaseSaltAmount(){
        $centerId = Auth::user()->center_id;
        $purchaseSaltList = Report::getPurchaseSalteList($centerId);
        $view = view("reportView.purchaseSaltAmountReport",compact('purchaseSaltList'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getPurchaseSaltAmountPdf(){

    }

    public function getPurchaseSaltStock(){

    }

    public function getPurchaseSaltStockPdf(){

    }

}
