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
use App\Item;
use App\AssociationSetup;

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
        $crudeSaltTypes = Item::itemTypeWiseItemList($this->crudSaltId);
        $associationList = AssociationSetup::getZoneList();
//        $this->pr($associationList);
        return view("reports.reportDashboard", compact('itemList','getDivision','issueBy','crudeSaltTypes','associationList'));
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

    public function getMonitorAssociationListPdf(){
        $monitorAssociationLists = Report::getMonitorAssociationList();
        $data = \View::make('reportPdf.purchaseSalteListReportPdf',compact('monitorAssociationLists'));
        $this->generatePdf($data);
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

    public function getPurchaseSaltAmount(Request $request){
        $centerId = Auth::user()->center_id;
        $itemType = $request->input('itemType');
        $purchaseTotalSalt = Report::getPurchaseSalteList($centerId,$itemType);
        $view = view("reportView.purchaseSaltAmountReport",compact('purchaseTotalSalt','itemType'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getPurchaseSaltAmountPdf($itemType){
        $centerId = Auth::user()->center_id;
        //$itemType = $request->input('itemType');
        $purchaseTotalSalt = Report::getPurchaseSalteList($centerId,$itemType);
        $data = \View::make('reportPdf.purchaseSaltAmountReportPdf',compact('purchaseTotalSalt'));
        $this->generatePdf($data);
    }

    public function getPurchaseSaltStock(){
        $centerId = Auth::user()->center_id;
        $purchaseTotalSaltStock = Report::getPurchaseSalteList($centerId);
        $view = view("reportView.purchaseSaltStockReport",compact('purchaseTotalSaltStock'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getPurchaseSaltStockPdf(){
        $centerId = Auth::user()->center_id;
        $purchaseTotalSaltStock = Report::getPurchaseSalteList($centerId);
        $data = \View::make('reportPdf.purchaseSaltStockReportPdf',compact('purchaseTotalSaltStock'));
        $this->generatePdf($data);
    }

    public function getProcessReport(){
        $centerId = Auth::user()->center_id;

        $processStock = Route::getProcessStock($centerId);
        $view = view("reportView.purchaseSaltStockReport",compact('processStock'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getProcessReportPdf(){}

    public function getSalesList(){
        $salesList = Report::getSalesItemMiller();
        $view = view("reportView.salesListReport",compact('salesList'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getSalesListPdf(){
        $salesList = Report::getSalesItemMiller();
        $data = \View::make('reportPdf.salesListRepoetPdf',compact('salesList'));
        $this->generatePdf($data);
    }

    public function getSalesListAll(){
        $salesList = Report::getSalesItem();
        $view = view("reportView.salesListReportAll",compact('salesList'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getSalesListAllpdf(){
        $salesList = Report::getSalesItem();
        $data = \View::make('reportPdf.salesListRepoetAllPdf',compact('salesList'));
        $this->generatePdf($data);
    }

    public function getListofMillerLicenses(Request $request){
        $centerId = Auth::user()->center_id;
        $zone = $request->input('zone');
        $issuerId = $request->input('issuerId');
//        return $zone;
        $listLicenseMiller = Report::getListofMillerLicense($centerId,$zone,$issuerId);
//        return $listLicenseMiller;
        $view = view("reportView.licenseMillerListReport",compact('listLicenseMiller','zone','issuerId'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getListofMillerLicensesPdf(){}

}
