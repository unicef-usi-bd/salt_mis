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
    public function getPurchaseSaltTotal(){
        $purchaseSaltTotal = ReportAssociation::getPurchaseSaltTotal();
        //$this->pr($purchaseSaltTotal);
        $view = view("reportAssociation.purchaseSaltTotalReport",compact('purchaseSaltTotal'))->render();
        return response()->json(['html'=>$view]);
    }
    public function getPurchaseSaltTotalStock(){
        $purchaseSaltTotalStock = ReportAssociation::getPurchaseSaltTotalStock();
        $view = view("reportAssociation.purchaseSaltTotalStockReport",compact('purchaseSaltTotalStock'))->render();
        return response()->json(['html'=>$view]);
    }
    // purchase salt end
    // purchase chemical
    public function getPurchaseChemicalItem(){
        $purchaseChemicalList = ReportAssociation::getPurchaseChemicalItem();
        $view = view("reportAssociation.purchaseChemicalListReport",compact('purchaseChemicalList'))->render();
        return response()->json(['html'=>$view]);

    }
    public function getPurchaseChemicalTotal(){
        $purchaseChemicalTotal = ReportAssociation::getPurchaseChemicalTotal();
        $view = view("reportAssociation.purchaseChemicalTotalReport",compact('purchaseChemicalTotal'))->render();
        return response()->json(['html'=>$view]);

    }
    public function getPurchaseChemicalTotalStock(){
        $purchaseChemicalTotalStock = ReportAssociation::getPurchaseChemicalTotalStock();
        $view = view("reportAssociation.purchaseChemicalTotalStockReport",compact('purchaseChemicalTotalStock'))->render();
        return response()->json(['html'=>$view]);

    }
// purchase chemical end
// miller
    public function getTotalMiller(Request $request){
        $activStatus = $request->input('statusAssociation');
        $totalMiller = ReportAssociation::getMillerList($activStatus);
        $view = view("reportAssociation.totalMillerReport",compact('totalMiller'))->render();
        return response()->json(['html'=>$view]);
    }
// miller end
    public function abc(){
        $centerId = Auth::user()->center_id;
        $purchaseTotalSaltStock = Report::getPurchaseSalteList($centerId);
        $data = \View::make('reportPdf.purchaseSaltStockReportPdf',compact('purchaseTotalSaltStock'));
        $this->generatePdf($data);
    }



}
