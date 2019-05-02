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

    public function getChemicalItemListPdf(){
        $centerId = Auth::user()->center_id;
        $purchaseChemicalLists = ReportTest::getPurchaseChemicalList($centerId);
        $data = \View::make('reportPdf.purchaseChemicalListPdf',compact('purchaseChemicalLists'));
        $this->generatePdf($data);
    }

    public function getChemicalPurchase(){
        $centerId = Auth::user()->center_id;
        $purchaseChemicals = ReportTest::getPurchaseChemicalList($centerId);
        $view = view("reportView.purchaseChemical",compact('purchaseChemicals','centerId'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getChemicalPurchasePdf(){
        $centerId = Auth::user()->center_id;
        $purchaseChemicals = ReportTest::getPurchaseChemicalList($centerId);
        $data = \View::make('reportPdf.purchaseChemicalPdf',compact('purchaseChemicals'));
        $this->generatePdf($data);
    }

    public function getChemicalPurchaseStock(){
        $centerId = Auth::user()->center_id;
        $purchaseChemicalStocks = ReportTest::getPurchaseChemicalList($centerId);
        $view = view("reportView.purchaseChemicalStock",compact('purchaseChemicalStocks','centerId'))->render();
        return response()->json(['html'=>$view]);
    }

    public function getChemicalPurchaseStockPdf(){
        $centerId = Auth::user()->center_id;
        $purchaseChemicalStocks = ReportTest::getPurchaseChemicalList($centerId);
        $data = \View::make('reportPdf.purchaseChemicalStockPdf',compact('purchaseChemicalStocks'));
        $this->generatePdf($data);
    }
}
