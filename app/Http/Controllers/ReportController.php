<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\LookupGroupData;
use App\MillerInfo;
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
use App\BstiTestResultRange;

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
        $chemicalTypes = Item::itemTypeWiseItemList($this->chemicalId);
        $associationList = AssociationSetup::getZoneList();
        $getDivision = SupplierProfile::getDivision();
        $clintNameList = Report::getClintNameList();
        $finishSaltItem = Report::getFinishSaltItem();
        $millInfo = MillerInfo::millInfo();

        $adminId = $this->adminId;
        $bstiId = $this->bstiId;
        $bscicId = $this->bscicId;
        $unicefId = $this->unicefId;
        $associationId = $this->associationId;
        $millerId = $this->millerId;
//        $this->pr($associationList);
        return view("reports.reportDashboard", compact('itemList','getDivision','issueBy','crudeSaltTypes','associationList','clintNameList','finishSaltItem','adminId','bstiId','bscicId','unicefId','associationId','millerId','chemicalTypes','millInfo'));
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
        $data = \View::make('reportPdf.monitorAssociationListPdf',compact('monitorAssociationLists'));
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
//        $starDate = $request->input('startDate');
//        $endDate = $request->input('endDate');
//        $purchaseTotalSalt = Report::getPurchaseSalteLists ($centerId,$itemType,$starDate,$endDate);
        $purchaseTotalSalt = Report::getItemStock($centerId,$itemType);
        $view = view("reportView.purchaseSaltAmountReport",compact('purchaseTotalSalt','itemType','starDate','endDate'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getPurchaseSaltAmountPdf($itemType){
        $centerId = Auth::user()->center_id;
        //$itemType = $request->input('itemType');
//        $purchaseTotalSalt = Report::getPurchaseSalteLists($centerId,$itemType,$starDate,$endDate);
        $purchaseTotalSalt = Report::getItemStock($centerId,$itemType);
        $data = \View::make('reportPdf.purchaseSaltAmountReportPdf',compact('purchaseTotalSalt'));
        $this->generatePdf($data);
    }

    public function getAdminSaltStock(Request $request){
//        $starDate = $request->input('startDate');
//        $endDate = $request->input('endDate');
        $purchaseTotalSaltStock = Report::getStockSaltForAdmin();
        //$this->pr($purchaseTotalSaltStock);
        $view = view("reportView.purchaseSaltStockReport",compact('purchaseTotalSaltStock','starDate','endDate'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getAdminSaltStockPdf(){

        $purchaseTotalSaltStock = Report::getStockSaltForAdmin();
        $data = \View::make('reportPdf.purchaseSaltStockReportPdf',compact('purchaseTotalSaltStock'));
        $this->generatePdf($data);
    }

    public function getMonitorSaltsupplierList(Request $request){
        //$centerId = Auth::user()->center_id;
        $starDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $purchaseTotalSaltStock = Report::monitorSaltSupplierList($starDate,$endDate);
        $view = view("reportView.monitorSaltsupplierReportList",compact('purchaseTotalSaltStock','starDate','endDate'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getMonitorSaltsupplierListPdf($starDate,$endDate){
        $purchaseTotalSaltStock = Report::monitorSaltSupplierList($starDate,$endDate);
        $data = \View::make('reportPdf.monitorSaltsupplierReportListPdf',compact('purchaseTotalSaltStock'));
        $this->generatePdf($data);
    }

    public function getMillerSaltStock(Request $request){
        $centerId = Auth::user()->center_id;
        $starDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $itemType = $request->input('itemType');
        $purchaseTotalSaltStock = Report::getStockSaltForMiller($centerId,$starDate,$endDate,$itemType);
        $view = view("reportView.purchaseSaltstockMillerReport",compact('purchaseTotalSaltStock','starDate','endDate','itemType'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getMillerSaltStockPdf($starDate,$endDate,$itemType){
        $centerId = Auth::user()->center_id;
//        $starDate = $request->input('startDate');
//        $endDate = $request->input('endDate');
        $purchaseTotalSaltStock = Report::getStockSaltForMiller($centerId,$starDate,$endDate,$itemType);
        $data = \View::make('reportPdf.purchaseSaltstockMillerReportPdf',compact('purchaseTotalSaltStock'));
        $this->generatePdf($data);
    }

    public function getProcessReportAdmin(Request $request){
        //$centerId = Auth::user()->center_id;
        $starDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $processStock = Report::getProcessStockAdmin($starDate,$endDate);
        $view = view("reportView.processStockAdminReport",compact('processStock','starDate','endDate'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getProcessReportAdminPdf($starDate,$endDate){
        $processStock = Report::getProcessStockAdmin($starDate,$endDate);
        $data = \View::make('reportPdf.processStockAdminReportPdf',compact('processStock'));
        $this->generatePdf($data);
    }



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
        $renawlDate = date("Y-m-d", strtotime($request->input('renawlDate')));
     //  return $renawlDate;
        $failDate = date("Y-m-d", strtotime($request->input('failDate')));

        //echo $issuerId;die();

//        $issuerId = $request->input('issuerId');
        $listLicenseMiller = Report::getListofMillerLicense($centerId,$zone,$issuerId,$renawlDate,$failDate);
        //return $listLicenseMiller;
        //$this->pr($listLicenseMiller);
        $view = view("reportView.licenseMillerListReport",compact('listLicenseMiller','zone','issuerId','renawlDate','failDate'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getListofMillerLicensesPdf($zone,$issuerId,$renawlDate,$failDate){
        $centerId = Auth::user()->center_id;
//        $zone = $request->input('zone');
//        $issuerId = $request->input('issuerId');

        //echo $issuerId;die();

//        $issuerId = $request->input('issuerId');
        $listLicenseMiller = Report::getListofMillerLicense($centerId,$zone,$issuerId,$renawlDate,$failDate);
        //echo $listLicenseMiller;die();
        $data = \View::make('reportPdf.licenseMillerListReportPdf',compact('listLicenseMiller'));
        $this->generatePdf($data);
    }

    public function getQcreport(Request $request){
        $centerId = Auth::user()->center_id;
        $zone = $request->input('zone');
        $qualityControlResultRange = BstiTestResultRange::getBstiTestResultDataRangeForPassOrFail();
        $qcReports = Report::getQcReport($centerId,$zone);
        $view = view("reportView.qcReport",compact('qcReports','zone','qualityControlResultRange'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getQcreportPdf($zone){
        $centerId = Auth::user()->center_id;
        //$zone = $request->input('zone');
        $qualityControlResultRange = BstiTestResultRange::getBstiTestResultDataRangeForPassOrFail();
        $qcReports = Report::getQcReport($centerId,$zone);
        $data = \View::make('reportPdf.qcReportPdf',compact('qcReports','qualityControlResultRange'));
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
        $itemTypeId = $request->input('chemicalItemType');
        //$millTypeAdmin = $request->input('millTypeAdmin');

        //return $itemTypeId;

        $purchaseChemicals = Report::getPurchaseChemicalList($centerId,$starDate,$endDate,$itemTypeId);
        //return $endDate;
        $view = view("reportView.purchaseChemical",compact('purchaseChemicals','starDate','endDate','itemTypeId','millTypeAdmin'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getChemicalPurchasePdf($starDate,$endDate,$millTypeAdmin){
        $centerId = Auth::user()->center_id;
        $purchaseChemicals = Report::getPurchaseChemicalList($centerId,$starDate,$endDate,$millTypeAdmin);
        $data = \View::make('reportPdf.purchaseChemicalPdf',compact('purchaseChemicals'));
        $this->generatePdf($data);
    }

    public function getChemicalPurchaseStock(Request $request){
        $centerId = Auth::user()->center_id;
//        $starDate = $request->input('startDate');
//        $endDate = $request->input('endDate');
        $millTypeAdmin = $request->input('millTypeAdmin');
        $purchaseChemicalStocks = Report::adminChemicalStock($millTypeAdmin);
        //return $purchaseChemicalStocks;
        $view = view("reportView.adminPurchasseChemicalStock",compact('purchaseChemicalStocks','centerId','starDate','endDate','millTypeAdmin'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getChemicalPurchaseStockPdf($millTypeAdmin){
        $centerId = Auth::user()->center_id;
        $purchaseChemicalStocks = Report::adminChemicalStock($millTypeAdmin);
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

    public function getProcessReport(Request $request){
        $centerId = Auth::user()->center_id;
        $starDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $purchaseChemicalStocks = Report::adminChemicalStock($starDate,$endDate);
        $purchaseTotalSaltStocks = Report::getStockSaltForAdmin($starDate,$endDate);
        //return $purchaseTotalSaltStock;
        $view = view("reportView.processSrockReport",compact('purchaseChemicalStocks','purchaseTotalSaltStocks','centerId','starDate','endDate'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getProcessReportPdf($starDate,$endDate){
        $centerId = Auth::user()->center_id;
        $purchaseChemicalStocks = Report::adminChemicalStock($starDate,$endDate);
        $purchaseTotalSaltStocks = Report::getStockSaltForAdmin($starDate,$endDate);
        $data = \View::make('reportPdf.processStockPdf',compact('purchaseChemicalStocks','purchaseTotalSaltStocks'));
        $this->generatePdf($data);
    }

    public function getMillerProcessStockReport(Request $request){
        $centerId = Auth::user()->center_id;
        $starDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $purchaseChemicalStocks = Report::millerChemicalStock($centerId,$starDate,$endDate);
        $purchaseTotalSaltStocks = Report::getProcessStock($centerId,$starDate,$endDate);

        $view = view("reportView.millerProcessStockReport",compact('purchaseChemicalStocks','purchaseTotalSaltStocks','centerId','starDate','endDate'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getMillerProcessStockPdf($starDate,$endDate){
        $centerId = Auth::user()->center_id;
        $purchaseChemicalStocks = Report::millerChemicalStock($centerId,$starDate,$endDate);
        $purchaseTotalSaltStocks = Report::getProcessStock($centerId,$starDate,$endDate);
        $data = \View::make('reportPdf.millerProcessStockPdf',compact('purchaseChemicalStocks','purchaseTotalSaltStocks'));
        $this->generatePdf($data);
    }

    public function getMillerProcessListReport(Request $request){
        $centerId = Auth::user()->center_id;
        $processType = $request->input('processType');
        $starDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $millerProcessLists = Report::millerProcessList($centerId,$processType,$starDate,$endDate);

        $view = view("reportView.millerProcessListReport",compact('millerProcessLists','centerId','processType','starDate','endDate'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getMillerProcessListPdf($processType,$starDate,$endDate){
        $centerId = Auth::user()->center_id;
        $millerProcessLists = Report::millerProcessList($centerId,$processType,$starDate,$endDate);
        $data = \View::make('reportPdf.millerProcessListPdf',compact('millerProcessLists'));
        $this->generatePdf($data);
    }

    public function getListSupplierForMiller(Request $request){
        $centerId = Auth::user()->center_id;
        $divisionId = $request->input('divisionId');
        $districtId = $request->input('districtId');
        $supplierMillerList = Report::getListOfSupplierForMiller($centerId,$divisionId,$districtId);

//        $this->pr($divisionId);
        $view = view("reportView.purchaseSaltSupplierListforMiller",compact('supplierMillerList','divisionId','districtId'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getListSupplierForMillerPdf($divisionId,$districtId){
        $centerId = Auth::user()->center_id;
        $supplierMillerList = Report::getListOfSupplierForMiller($centerId,$divisionId,$districtId);
        $data = \View::make('reportPdf.purchaseSaltSupplierListforMillerPdf',compact('supplierMillerList'));
        $this->generatePdf($data);
    }

    public function getListSupplierWithNameForMiller(Request $request){
        $centerId = Auth::user()->center_id;
        $divisionId = $request->input('divisionId');
        $districtId = $request->input('districtId');
        $supplierMillerLisType = Report::getListOfSupplierWithNmaeForMiller($centerId,$divisionId,$districtId);
        //$this->pr($supplierMillerList);
        $view = view("reportView.purchaseSaltSupplierListforWithNameMiller",compact('supplierMillerLisType','divisionId','districtId'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getListSupplierWithNameForMillerPdf($divisionId,$districtId){
        $centerId = Auth::user()->center_id;
        $supplierMillerLisType = Report::getListOfSupplierWithNmaeForMiller($centerId,$divisionId,$districtId);
        $data = \View::make('reportPdf.purchaseSaltSupplierListforWithNameMillerPdf',compact('supplierMillerLisType'));
        $this->generatePdf($data);
    }

    public function getClintListFormiller(Request $request){
        $centerId = Auth::user()->center_id;
        $divisionId = $request->input('divisionId');
        $districtId = $request->input('districtId');
        $clintList = Report::getListofClint($centerId,$divisionId,$districtId);
        $view = view("reportView.millerClintList",compact('clintList','divisionId','districtId'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getClintListFormillerPdf($divisionId,$districtId){
        $centerId = Auth::user()->center_id;
        $clintList = Report::getListofClint($centerId,$divisionId,$districtId);
        $data = \View::make('reportPdf.millerClintListPdf',compact('clintList'));
        $this->generatePdf($data);
    }

    public function getSaleClintList(Request $request){
        $centerId = Auth::user()->center_id;
        $customerId = $request->input('customerId');
        $itemTypeId = $request->input('itemTypeId');
        $saleClintList = Report::getSaleClintList($centerId,$customerId,$itemTypeId);
        $view = view("reportView.saleClintReportList",compact('saleClintList','customerId','itemTypeId'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getSaleClintListPdf($customerId,$itemTypeId){
        $centerId = Auth::user()->center_id;
        $saleClintList = Report::getSaleClintList($centerId,$customerId,$itemTypeId);
        $data = \View::make('reportPdf.saleClintReportListPdf',compact('saleClintList'));
        $this->generatePdf($data);
    }

    public function getMonitorClintListMiller(){
        $centerId = Auth::user()->center_id;
        $monitorClintList = Report::monitorClintMiller($centerId);
        $view = view("reportView.monitorClintListReport",compact('monitorClintList'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getMonitorClintListMillerPdf(){
        $centerId = Auth::user()->center_id;
        $monitorClintList = Report::monitorClintMiller($centerId);
        $data = \View::make('reportPdf.monitorClintListReportPdf',compact('monitorClintList'));
        $this->generatePdf($data);
    }

    public function getItemStockMiller(){
        $centerId = Auth::user()->center_id;
        $itemStock = Report::itemStockMiller($centerId);
        $view = view("reportView.itemStockMillerReport",compact('itemStock'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getItemStockMillerPdf(){
        $centerId = Auth::user()->center_id;
        $itemStock = Report::itemStockMiller($centerId);
        $data = \View::make('reportPdf.itemStockMillerReportPdf',compact('itemStock'));
        $this->generatePdf($data);
    }

    public function getTotalMillerEmployee(){
        //$centerId = Auth::user()->center_id;
        $millId = MillerInfo::millId();
        $millId1 = (array)$millId;
        $links = implode(' ', array_values($millId1));
        $employeeList = Report::hrMillerEmployee($links);
        $view = view("reportView.hrEmployeemillerReport",compact('employeeList'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getTotalMillerEmployeePdf(){
        //$centerId = Auth::user()->center_id;
        $millId = MillerInfo::millId();
        $millId1 = (array)$millId;
        $links = implode(' ', array_values($millId1));
        $employeeList = Report::hrMillerEmployee($links);
        $data = \View::make('reportPdf.hrEmployeemillerReportPdf',compact('employeeList'));
        $this->generatePdf($data);
    }

    public function getAdminHrEmployee(){
        $hrEmployeeList = Report::adminHrmillerEmployee();
        $view = view("reportView.adminHrEmployeeReport",compact('hrEmployeeList'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getAdminHrEmployeePdf(){
        $hrEmployeeList = Report::adminHrmillerEmployee();
        $data = \View::make('reportPdf.adminHrEmployeeReportPdf',compact('hrEmployeeList'));
        $this->generatePdf($data);
    }

    public function getAssociationListForAdmin(){
        $associationList = Report::associationListForAdmin();
        $view = view("reportView.adminAssociationListreport",compact('associationList'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getAssociationListForAdminPdf(){
        $associationList = Report::associationListForAdmin();
        $data = \View::make('reportPdf.adminAssociationListreportPdf',compact('associationList'));
        $this->generatePdf($data);
    }

    public function getTotalSaleAdmin(Request $request){
//        $divisionId = $request->input('divisionId');
//        echo $request->input('processType');exit;
//        $districtId = $request->input('districtId');
        $processType = $request->input('processType');
        $totalSale = Report::totalSaleAdmin($processType);
//        $this->pr($totalSale);

        $view = view("reportView.totalSaleAdminReport",compact('totalSale','divisionId','districtId','processType'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getTotalSaleAdminPdf($processType){
        $totalSale = Report::totalSaleAdmin($processType);
        $data = \View::make('reportPdf.totalSaleAdminReportPdf',compact('totalSale'));
        $this->generatePdf($data);
    }

    public function getListOfMiller(Request $request){
        $zone = $request->input('zone');
        $totalMiller = Report::getListofMillerAdmin($zone);
        $view = view("reportView.listOfmillerUnderAssociationReport",compact('totalMiller','zone'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getListOfMillerpdf($zone){
        $totalMiller = Report::getListofMillerAdmin($zone);
        $data = \View::make('reportPdf.listOfmillerUnderAssociationReportPdf',compact('totalMiller'));
        $this->generatePdf($data);
    }

    public function getQcformiller(){
        $centerId = Auth::user()->center_id;
        $qualityControlResultRangeMiller = BstiTestResultRange::getBstiTestResultDataRangeForPassOrFail();
        $qcReportsMiller = Report::getQcReportMiller($centerId);
        $view = view("reportView.qcMillerReport",compact('qcReportsMiller','qualityControlResultRangeMiller'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getQcformillerPdf(){
        $centerId = Auth::user()->center_id;
        //$zone = $request->input('zone');
        $qualityControlResultRangeMiller = BstiTestResultRange::getBstiTestResultDataRangeForPassOrFail();
        $qcReportsMiller = Report::getQcReportMiller($centerId);
        $data = \View::make('reportPdf.qcMillerReportPdf',compact('qcReportsMiller','qualityControlResultRangeMiller'));
        $this->generatePdf($data);
    }

}
