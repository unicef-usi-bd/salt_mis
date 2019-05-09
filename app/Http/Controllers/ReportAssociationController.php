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
    public function getPurchaseSaltTotal(){
        $purchaseSaltTotal = ReportAssociation::getPurchaseSaltTotal();
        //$this->pr($purchaseSaltTotal);
        $view = view("reportAssociation.purchaseSaltTotalReport",compact('purchaseSaltTotal'))->render();
        return response()->json(['html'=>$view]);
    }
    public function getPurchaseSaltTotalPdf(){
        $purchaseSaltTotal = ReportAssociation::getPurchaseSaltTotal();
        $data = \View::make('reportAssociation.pdf.purchaseSaltTotalReportPdf',compact('purchaseSaltTotal'));
        $this->generatePdf($data);
    }
    public function getPurchaseSaltTotalStock(Request $request){
        $starDate = $request->input('assStartDate');
        $endDate = $request->input('assEndDate');
        //$this->pr($starDate);
        $purchaseSaltTotalStock = ReportAssociation::getPurchaseSaltTotalStock($starDate,$endDate);
        $view = view("reportAssociation.purchaseSaltTotalStockReport",compact('purchaseSaltTotalStock'))->render();
        return response()->json(['html'=>$view]);
    }
    public function getPurchaseSaltTotalStockPdf(){
        $purchaseSaltTotalStock = ReportAssociation::getPurchaseSaltTotalStock();
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

    public function getPurchaseChemicalTotal(){
        $purchaseChemicalTotal = ReportAssociation::getPurchaseChemicalTotal();
        $view = view("reportAssociation.purchaseChemicalTotalReport",compact('purchaseChemicalTotal'))->render();
        return response()->json(['html'=>$view]);

    }
    public function getPurchaseChemicalTotalPdf(){
        $purchaseChemicalTotal = ReportAssociation::getPurchaseChemicalTotal();
        $data = \View::make('reportAssociation.pdf.purchaseChemicalTotalReportPdf',compact('purchaseChemicalTotal'));
        $this->generatePdf($data);

    }
    public function getPurchaseChemicalTotalStock(Request $request){
        $starDate = $request->input('assStartDate');
        $endDate = $request->input('assEndDate');
        $purchaseChemicalTotalStock = ReportAssociation::getPurchaseChemicalTotalStock($starDate,$endDate);
        $view = view("reportAssociation.purchaseChemicalTotalStockReport",compact('purchaseChemicalTotalStock'))->render();
        return response()->json(['html'=>$view]);

    }
    public function getPurchaseChemicalTotalStockPdf(){
        $purchaseChemicalTotalStock = ReportAssociation::getPurchaseChemicalTotalStock();
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
        $millerType = ReportAssociation::getMillerType($activStatus);
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
        $issueby =  $request->input('issueby'); //$this->pr($issueby);
        $MillerList = ReportAssociation::getLicenseMillerList($issueby);
        $view = view("reportAssociation.licenseMillerListReport",compact('MillerList'))->render();
        return response()->json(['html'=>$view]);
    }
    public function getLicenseMillerListPdf(){
        $MillerList = ReportAssociation::getLicenseMillerList();
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
        $view = view("reportAssociation.saleItemStockReport",compact('itemStock'))->render();
        return response()->json(['html'=>$view]);
    }
    public function getSaleItemStockPdf(){
        $itemStock = ReportAssociation::getSaleItemStock();
        $data = \View::make('reportAssociation.pdf.saleItemStockReportPdf',compact('itemStock'));
        $this->generatePdf($data);
    }




} // class end
