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

    public function abc(){
        $centerId = Auth::user()->center_id;
        $purchaseTotalSaltStock = Report::getPurchaseSalteList($centerId);
        $data = \View::make('reportPdf.purchaseSaltStockReportPdf',compact('purchaseTotalSaltStock'));
        $this->generatePdf($data);
    }



}
