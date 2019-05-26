<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\LookupGroupData;
use App\ReportAssociation;
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

class ReportAssociationController extends Controller
{

    // purchase salt
    public function getPurchaseSaltItem(){
        $purchaseSaltList = ReportAssociation::getPurchaseSaltItem();
        //$this->pr($purchaseSaltList);
        $view = view("reportAssociation.purchaseSaltListReport",compact('purchaseSaltList'))->render();
        return response()->json(['html'=>$view]);
    }
    public function getPurchaseSaltItemPdf(){
        $purchaseSaltList = ReportAssociation::getPurchaseSaltItem();
        $data = \View::make('reportAssociation.pdf.purchaseSaltListReportPdf',compact('purchaseSaltList'));
        $this->generatePdf($data);
    }
    public function getPurchaseSaltTotal(Request $request){
        $starDate = $request->input('assStartDate');
        $endDate = $request->input('assEndDate');
        $itemTypeAssoc = $request->input('itemTypeAssoc');
        $purchaseSaltTotal = ReportAssociation::getPurchaseSaltTotal($starDate,$endDate,$itemTypeAssoc);
        //$this->pr($itemTypeAssoc);
        $view = view("reportAssociation.purchaseSaltTotalReport",compact('purchaseSaltTotal','starDate','endDate','itemTypeAssoc'))->render();
        return response()->json(['html'=>$view]);
    }
    public function getPurchaseSaltTotalPdf(Request $request,$starDate,$endDate,$itemTypeAssoc){
        $starDate = $starDate;
        $endDate = $endDate;
        $itemTypeAssoc = $itemTypeAssoc;
        //$this->pr($starDate);
        $purchaseSaltTotal = ReportAssociation::getPurchaseSaltTotal($starDate,$endDate,$itemTypeAssoc);
        $data = \View::make('reportAssociation.pdf.purchaseSaltTotalReportPdf',compact('purchaseSaltTotal'));
        $this->generatePdf($data);
    }
    public function getPurchaseSaltTotalStock(Request $request){
        $starDate = $request->input('assStartDate');
        $endDate = $request->input('assEndDate');
        //$this->pr($starDate);
        $purchaseSaltTotalStock = ReportAssociation::getPurchaseSaltTotalStock($starDate,$endDate);
        $view = view("reportAssociation.purchaseSaltTotalStockReport",compact('purchaseSaltTotalStock','starDate','endDate'))->render();
        return response()->json(['html'=>$view]);
    }
    public function getPurchaseSaltTotalStockPdf(Request $request,$starDate,$endDate){
        $starDate = $starDate;
        $endDate = $endDate;
        $purchaseSaltTotalStock = ReportAssociation::getPurchaseSaltTotalStock($starDate,$endDate);
        $data = \View::make('reportAssociation.pdf.purchaseSaltTotalStockReportPdf',compact('purchaseSaltTotalStock'));
        $this->generatePdf($data);
    }
    // purchase salt end
    // purchase chemical
    public function getPurchaseChemicalItem(){
        $purchaseChemicalList = ReportAssociation::getPurchaseChemicalItem();
        $view = view("reportAssociation.purchaseChemicalListReport",compact('purchaseChemicalList'))->render();
        return response()->json(['html'=>$view]);

    }
    public function getPurchaseChemicalItemPdf(){
        $purchaseChemicalList = ReportAssociation::getPurchaseChemicalItem();
        $data = \View::make('reportAssociation.pdf.purchaseChemicalListReportPdf',compact('purchaseChemicalList'));
        $this->generatePdf($data);
    }

    public function getPurchaseChemicalTotal(Request $request){
        $starDate = $request->input('assStartDate');
        $endDate = $request->input('assEndDate');
        $purchaseChemicalTotal = ReportAssociation::getPurchaseChemicalTotal($starDate,$endDate);
        $view = view("reportAssociation.purchaseChemicalTotalReport",compact('purchaseChemicalTotal','starDate','endDate'))->render();
        return response()->json(['html'=>$view]);

    }
    public function getPurchaseChemicalTotalPdf(Request $request,$starDate,$endDate){
        $starDate = $starDate;
        $endDate = $endDate;
        $purchaseChemicalTotal = ReportAssociation::getPurchaseChemicalTotal($starDate,$endDate);
        $data = \View::make('reportAssociation.pdf.purchaseChemicalTotalReportPdf',compact('purchaseChemicalTotal'));
        $this->generatePdf($data);

    }
    public function getPurchaseChemicalTotalStock(Request $request){
        $starDate = $request->input('assStartDate');
        $endDate = $request->input('assEndDate');
        $purchaseChemicalTotalStock = ReportAssociation::getPurchaseChemicalTotalStock($starDate,$endDate);
        $view = view("reportAssociation.purchaseChemicalTotalStockReport",compact('purchaseChemicalTotalStock','starDate','endDate'))->render();
        return response()->json(['html'=>$view]);

    }
    public function getPurchaseChemicalTotalStockPdf(Request $request,$starDate,$endDate){
        $starDate = $starDate;
        $endDate = $endDate;
        $purchaseChemicalTotalStock = ReportAssociation::getPurchaseChemicalTotalStock($starDate,$endDate);
        $data = \View::make('reportAssociation.pdf.purchaseChemicalTotalStockReportPdf',compact('purchaseChemicalTotalStock'));
        $this->generatePdf($data);

    }
// purchase chemical end
// miller
    public function getTotalMiller(Request $request){
        $activStatus = $request->input('activStatus');
        //$this->pr($activStatus);
        $totalMiller = ReportAssociation::getMillerList($activStatus);
        $view = view("reportAssociation.totalMillerReport",compact('totalMiller','activStatus'))->render();
        return response()->json(['html'=>$view]);
    }
    public function getTotalMillerPdf(Request $request, $id){
        $activStatus = $id;
        $totalMiller = ReportAssociation::getMillerList($activStatus);//$this->pr($activStatus);
        $data = \View::make('reportAssociation.pdf.totalMillerReportPdf',compact('totalMiller','activStatus'));
        $this->generatePdf($data);
    }
    public function getMillerType(Request $request){
        $activStatus = $request->input('activStatus');
        //$this->pr($activStatus);
        $millerType = ReportAssociation::getMillerType();
        $view = view("reportAssociation.millerTypeReport",compact('millerType'))->render();
        return response()->json(['html'=>$view]);
    }
    public function getMillerTypePdf(Request $request){
        $activStatus = $request->input('activStatus');
        $millerType = ReportAssociation::getMillerType($activStatus);  //$this->pr($millerType);
        $data = \View::make('reportAssociation.pdf.millerTypeReportPdf',compact('millerType'));
        $this->generatePdf($data);
    }
    public function getMonitorMiller(){
        $monitorMiller = ReportAssociation::getMonitorMiller();
        $view = view("reportAssociation.monitorMillerReport",compact('monitorMiller'))->render();
        return response()->json(['html'=>$view]);
    }
    public function getMonitorMillerPdf(){
        $monitorMiller = ReportAssociation::getMonitorMiller();
        $data = \View::make('reportAssociation.pdf.monitorMillerReportPdf',compact('monitorMiller'));
        $this->generatePdf($data);
    }
    public function getListOfMiller(){
        $millerList = ReportAssociation::getListOfMiller();
        $view = view("reportAssociation.listOfMillerReport",compact('millerList'))->render();
        return response()->json(['html'=>$view]);
    }
    public function getListOfMillerPdf(){
        $millerList = ReportAssociation::getListOfMiller();
        $data = \View::make('reportAssociation.pdf.listOfMillerReportPdf',compact('millerList'));
        $this->generatePdf($data);
    }
    public function getMillerListForHr(){
        $MillerList = ReportAssociation::getMillerListForHr();
        $view = view("reportAssociation.millerListReport",compact('MillerList'))->render();
        return response()->json(['html'=>$view]);
    }
    public function getMillerListForHrPdf(){
        $MillerList = ReportAssociation::getMillerListForHr();
        $data = \View::make('reportAssociation.pdf.millerListReportPdf',compact('MillerList'));
        $this->generatePdf($data);
    }
// miller end
    public function getQcMillerList(){
        $MillerList = ReportAssociation::getQcMillerList();
        $view = view("reportAssociation.qcMillerListReport",compact('MillerList'))->render();
        return response()->json(['html'=>$view]);
    }
    public function getQcMillerListPdf(){
        $MillerList = ReportAssociation::getQcMillerList();
        $data = \View::make('reportAssociation.pdf.qcMillerListReportPdf',compact('MillerList'));
        $this->generatePdf($data);
    }
    public function getLicenseMillerList(Request $request){
        $renawlDate = $request->input('renawlDate');
        $failDate = $request->input('failDate');
        $issueby =  $request->input('issueby'); //$this->pr($issueby);
        $MillerList = ReportAssociation::getLicenseMillerList($issueby);
        $view = view("reportAssociation.licenseMillerListReport",compact('MillerList','issueby'))->render();
        return response()->json(['html'=>$view]);
    }
    public function getLicenseMillerListPdf(Request $request,$issueby){
        $issueby  =$issueby;
        $MillerList = ReportAssociation::getLicenseMillerList($issueby);
        $data = \View::make('reportAssociation.pdf.licenseMillerListReportPdf',compact('MillerList'));
        $this->generatePdf($data);
    }
    public function getSaleItemList(){
        $itemList = ReportAssociation::getSaleItemList();
        $view = view("reportAssociation.saleItemListReport",compact('itemList'))->render();
        return response()->json(['html'=>$view]);
    }
    public function getSaleItemListPdf(){
        $itemList = ReportAssociation::getSaleItemList();
        $data = \View::make('reportAssociation.pdf.saleItemListReportPdf',compact('itemList'));
        $this->generatePdf($data);
    }
    public function getSaleItemStock(){
        $itemStock = ReportAssociation::getSaleItemStock();
        $view = view("reportAssociation.saleItemStockReport",compact('itemStock','starDate','endDate'))->render();
        return response()->json(['html'=>$view]);
    }
    public function getSaleItemStockPdf(){
        $itemStock = ReportAssociation::getSaleItemStock();
        $data = \View::make('reportAssociation.pdf.saleItemStockReportPdf',compact('itemStock'));
        $this->generatePdf($data);
    }
    public function assocProcessStock(){
        $processStock = ReportAssociation::assocProcessStock();
        $view = view("reportAssociation.assocProcessStockReport",compact('processStock'))->render();
        return response()->json(['html'=>$view]);
    }
    public function assocProcessStockPdf(){
        $processStock = ReportAssociation::assocProcessStock();
        $data = \View::make('reportAssociation.pdf.assocProcessStockReportPdf',compact('processStock'));
        $this->generatePdf($data);
    }
    public function assocSale(Request $request){
        $divisionId = $request->input('divisionId');
        $districtId = $request->input('districtId');  //$this->pr($districtId);
        $assocSale = ReportAssociation::getAssocSale($divisionId,$districtId);
        $view = view("reportAssociation.assocSaleReport",compact('assocSale','divisionId','districtId'))->render();
        return response()->json(['html'=>$view]);
    }
    public function assocSalePdf(Request $request,$divisionId,$districtId){
        $assocSale = ReportAssociation::getAssocSale($divisionId,$districtId);
        $data = \View::make('reportAssociation.pdf.assocSaleReportPdf',compact('assocSale'));
        $this->generatePdf($data);
    }





} // class end
