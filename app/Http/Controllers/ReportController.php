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
        $starDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $purchaseTotalSalt = Report::getPurchaseSalteLists ($centerId,$itemType,$starDate,$endDate);
        $view = view("reportView.purchaseSaltAmountReport",compact('purchaseTotalSalt','itemType','starDate','endDate'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getPurchaseSaltAmountPdf($itemType,$starDate,$endDate){
        $centerId = Auth::user()->center_id;
        //$itemType = $request->input('itemType');
        $purchaseTotalSalt = Report::getPurchaseSalteLists($centerId,$itemType,$starDate,$endDate);
        $data = \View::make('reportPdf.purchaseSaltAmountReportPdf',compact('purchaseTotalSalt'));
        $this->generatePdf($data);
    }

    public function getAdminSaltStock(Request $request){
        $starDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $purchaseTotalSaltStock = Report::getStockSaltForAdmin($starDate,$endDate);
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

        //echo $issuerId;die();

//        $issuerId = $request->input('issuerId');
        $listLicenseMiller = Report::getListofMillerLicense($centerId,$zone,$issuerId);
//        return $listLicenseMiller;
        $view = view("reportView.licenseMillerListReport",compact('listLicenseMiller','zone','issuerId'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getListofMillerLicensesPdf($zone,$issuerId){
        $centerId = Auth::user()->center_id;
//        $zone = $request->input('zone');
//        $issuerId = $request->input('issuerId');

        //echo $issuerId;die();

//        $issuerId = $request->input('issuerId');
        $listLicenseMiller = Report::getListofMillerLicense($centerId,$zone,$issuerId);
        //echo $listLicenseMiller;die();
        $data = \View::make('reportPdf.licenseMillerListReportPdf',compact('listLicenseMiller'));
        $this->generatePdf($data);
    }

    public function getQcreport(Request $request){
        $centerId = Auth::user()->center_id;
        $zone = $request->input('zone');
        $qcReports = Report::getQcReport($centerId,$zone);
        $view = view("reportView.qcReport",compact('qcReports','zone'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getQcreportPdf($zone){
        $centerId = Auth::user()->center_id;
        //$zone = $request->input('zone');
        $qcReports = Report::getQcReport($centerId,$zone);
        $data = \View::make('reportPdf.qcReportPdf',compact('qcReports'));
        $this->generatePdf($data);
    }

    public function getChemicalItemList(){
        $centerId = Auth::user()->center_id;
        $purchaseChemicalLists = Report::getPurchaseChemicalItemList($centerId);
        $view = view("reportView.purchaseChemicalList",compact('purchaseChemicalLists','centerId'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getChemicalItemListPdf(){
        $centerId = Auth::user()->center_id;
        $purchaseChemicalLists = Report::getPurchaseChemicalItemList($centerId);
        $data = \View::make('reportPdf.purchaseChemicalListPdf',compact('purchaseChemicalLists'));
        $this->generatePdf($data);
    }

    public function getChemicalPurchase(Request $request){
        $centerId = Auth::user()->center_id;

        $starDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $purchaseChemicals = Report::getPurchaseChemicalList($centerId,$starDate,$endDate);

        $view = view("reportView.purchaseChemical",compact('purchaseChemicals','centerId','starDate','endDate'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getChemicalPurchasePdf($starDate,$endDate){
        $centerId = Auth::user()->center_id;
        $purchaseChemicals = Report::getPurchaseChemicalList($centerId,$starDate,$endDate);
        $data = \View::make('reportPdf.purchaseChemicalPdf',compact('purchaseChemicals'));
        $this->generatePdf($data);
    }

    public function getChemicalPurchaseStock(Request $request){
        $centerId = Auth::user()->center_id;
        $starDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $purchaseChemicalStocks = Report::adminChemicalStock($starDate,$endDate);
        //return $purchaseChemicalStocks;
        $view = view("reportView.purchaseChemicalStock",compact('purchaseChemicalStocks','centerId','starDate','endDate'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getChemicalPurchaseStockPdf($starDate,$endDate){
        $centerId = Auth::user()->center_id;
        $purchaseChemicalStocks = Report::adminChemicalStock($starDate,$endDate);
        $data = \View::make('reportPdf.purchaseChemicalStockPdf',compact('purchaseChemicalStocks'));
        $this->generatePdf($data);
    }

    public function getMillerChemicalPurchaseStock(Request $request){
        $centerId = Auth::user()->center_id;
        $starDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $purchaseChemicalStocks = Report::millerChemicalStock($centerId,$starDate,$endDate);
        //return $purchaseChemicalStocks;
        $view = view("reportView.purchaseChemicalStock",compact('purchaseChemicalStocks','centerId','starDate','endDate'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getMonitorSupplier(Request $request){
        $starDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $monitorSuppliers = Report::monitorSupplierList($starDate,$endDate);
        $view = view("reportView.monitorSuppliers",compact('monitorSuppliers','starDate','endDate'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getMonitorSupplierPdf($starDate,$endDate){
        $monitorSuppliers = Report::monitorSupplierList($starDate,$endDate);
        $data = \View::make('reportPdf.monitorSuppliersPdf',compact('monitorSuppliers'));
        $this->generatePdf($data);
    }

}
