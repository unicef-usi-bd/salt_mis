<?php

namespace App\Http\Controllers;

use App\LookupGroupData;
use App\Report;
use App\ReportTest;
use App\SupplierProfile;
use Carbon\Carbon;
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
        $purchaseChemicalLists = ReportTest::getPurchaseChemicalItemList($centerId);
        $view = view("reportView.purchaseChemicalList",compact('purchaseChemicalLists','centerId'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getChemicalItemListPdf(){
        $centerId = Auth::user()->center_id;
        $purchaseChemicalLists = ReportTest::getPurchaseChemicalItemList($centerId);
        $data = \View::make('reportPdf.purchaseChemicalListPdf',compact('purchaseChemicalLists'));
        $this->generatePdf($data);
    }

    public function getChemicalPurchase(Request $request){
        $centerId = Auth::user()->center_id;

        $starDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $purchaseChemicals = ReportTest::getPurchaseChemicalList($centerId,$starDate,$endDate);

        $view = view("reportView.purchaseChemical",compact('purchaseChemicals','centerId','starDate','endDate'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getChemicalPurchasePdf($starDate,$endDate){
        $centerId = Auth::user()->center_id;
        $purchaseChemicals = ReportTest::getPurchaseChemicalList($centerId,$starDate,$endDate);
        $data = \View::make('reportPdf.purchaseChemicalPdf',compact('purchaseChemicals'));
        $this->generatePdf($data);
    }

    public function getChemicalPurchaseStock(Request $request){
        $centerId = Auth::user()->center_id;
        $starDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $purchaseChemicalStocks = ReportTest::adminChemicalStock($starDate,$endDate);
        //return $purchaseChemicalStocks;
        $view = view("reportView.purchaseChemicalStock",compact('purchaseChemicalStocks','centerId','starDate','endDate'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getChemicalPurchaseStockPdf($starDate,$endDate){
        $centerId = Auth::user()->center_id;
        $purchaseChemicalStocks = ReportTest::adminChemicalStock($starDate,$endDate);
        $data = \View::make('reportPdf.purchaseChemicalStockPdf',compact('purchaseChemicalStocks'));
        $this->generatePdf($data);
    }

    public function getMonitorSupplier(){
        $monitorSuppliers = ReportTest::monitorSupplierList();
        $view = view("reportView.monitorSuppliers",compact('monitorSuppliers'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getMonitorSupplierPdf(){
        $monitorSuppliers = ReportTest::monitorSupplierList();
        $data = \View::make('reportPdf.monitorSuppliersPdf',compact('monitorSuppliers'));
        $this->generatePdf($data);
    }
}
