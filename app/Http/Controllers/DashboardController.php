<?php

namespace App\Http\Controllers;

use App\MillerInfo;
use App\Stock;
use App\SalesDistribution;
use App\CrudeSaltProcurement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function index()
    {
        $user_group_id = Auth::user()->user_group_id; //$this->pr($user_group_id);

//        $totalActiveMillerUnderAdmin = count(MillerInfo::countActiveMillersUnderAdmin());
//        $totalDeactiveMillerUnderAdmin = count(MillerInfo::countDeactiveMillersUnderAdmin());
//        $coxAssoId = $this->coxAssoId;
//        //$totalMillerUnderCoxAsso = count(MillerInfo::countMillersUnderCoxAsso());
////        $this->pr(session()->all());
        if($user_group_id==$this->bstiId){
            return $this->bsti();
        }else if($user_group_id==$this->bscicId){
            return $this->basic();
        }else if($user_group_id==$this->unicefId){
            return $this->unicef();
        }else if($user_group_id==$this->associationId){
            return $this->association();
        }else if($user_group_id==$this->millerId){
            return $this->miller();
        }else{ // for super admin
            return $this->admin();
        }
    }

    public function admin(){

        $totalMiller= count(MillerInfo::countAllMillers());
        $totalActiveMiller= count(MillerInfo::countActiveMillers());
        $totalInactiveMiller= count(MillerInfo::countInactiveMillers());

        $totalWashcrashProduction = Stock::totalWashCrashProductions();
        $totalIodizeProduction = Stock::totalIodizeProductions();
        $totalProductons = $totalWashcrashProduction+$totalIodizeProduction;

        $totalWashCrashSale = abs(SalesDistribution::totalWashcrashSales());
        $totalIodizeSale = abs(SalesDistribution::totalIodizeSales());
        $totalProductSales = $totalWashCrashSale+$totalIodizeSale;

        $totalproduction = Stock::totalProduction();
        $totalSale = SalesDistribution::totalproductSale();
        $totalStock = Stock::totalStocks();

        $monthWiseProduction = Stock::monthWiseProduction();
        $saleTotal = SalesDistribution::totalSale();
//        $this->pr($monthWiseProduction);

        return view('dashboards.adminDashboard',compact('totalMiller','totalActiveMiller','totalInactiveMiller','totalWashcrashProduction','totalIodizeProduction','totalProductons','totalWashCrashSale','totalIodizeSale','totalProductSales','totalproduction','totalSale','totalStock', 'monthWiseProduction','saleTotal'));
    }

    public function unicef(){
        $totalMiller= count(MillerInfo::countAllMillers());
        $totalActiveMiller= count(MillerInfo::countActiveMillers());
        $totalInactiveMiller= count(MillerInfo::countInactiveMillers());

        $totalWashcrashProduction = Stock::totalWashCrashProductions();
        $totalIodizeProduction = Stock::totalIodizeProductions();
        $totalProductons = $totalWashcrashProduction+$totalIodizeProduction;

        $totalWashCrashSale = abs(SalesDistribution::totalWashcrashSales());
        $totalIodizeSale = abs(SalesDistribution::totalIodizeSales());
        $totalProductSales = $totalWashCrashSale+$totalIodizeSale;

        $totalproduction = Stock::totalProduction();
        $totalSale = SalesDistribution::totalproductSale();
        $totalStock = Stock::totalStocks();

        $saleTotal = SalesDistribution::totalSale();
        $monthWiseProduction = Stock::monthWiseProduction();
        return view('dashboards.unicefDashboard',compact('totalMiller','totalActiveMiller','totalInactiveMiller','totalWashcrashProduction','totalIodizeProduction','totalProductons','totalWashCrashSale','totalIodizeSale','totalProductSales','totalproduction','totalSale','totalStock','saleTotal','monthWiseProduction'));
    }

    public function bsti(){
        $totalMiller= count(MillerInfo::countAllMillers());
        $totalActiveMiller= count(MillerInfo::countActiveMillers());
        $totalInactiveMiller= count(MillerInfo::countInactiveMillers());

        $totalWashcrashProduction = Stock::totalWashCrashProductions();
        $totalIodizeProduction = Stock::totalIodizeProductions();
        $totalProductons = $totalWashcrashProduction+$totalIodizeProduction;

        $totalWashCrashSale = abs(SalesDistribution::totalWashcrashSales());
        $totalIodizeSale = abs(SalesDistribution::totalIodizeSales());
        $totalProductSales = $totalWashCrashSale+$totalIodizeSale;

        $totalproduction = Stock::totalProduction();
        $totalSale = SalesDistribution::totalproductSale();
        $totalStock = Stock::totalStocks();

        $saleTotal = SalesDistribution::totalSale();
        $monthWiseProduction = Stock::monthWiseProduction();
        return view('dashboards.bstiDashboard',compact('totalMiller','totalActiveMiller','totalInactiveMiller','totalWashcrashProduction','totalIodizeProduction','totalProductons','totalWashCrashSale','totalIodizeSale','totalProductSales','totalproduction','totalSale','totalStock','saleTotal','monthWiseProduction'));
    }

    public function basic(){
        $totalMiller= count(MillerInfo::countAllMillers());
        $totalActiveMiller= count(MillerInfo::countActiveMillers());
        $totalInactiveMiller= count(MillerInfo::countInactiveMillers());

        $totalWashcrashProduction = Stock::totalWashCrashProductions();
        $totalIodizeProduction = Stock::totalIodizeProductions();
        $totalProductons = $totalWashcrashProduction+$totalIodizeProduction;

        $totalWashCrashSale = abs(SalesDistribution::totalWashcrashSales());
        $totalIodizeSale = abs(SalesDistribution::totalIodizeSales());
        $totalProductSales = $totalWashCrashSale+$totalIodizeSale;

        $totalproduction = Stock::totalProduction();
        $totalSale = SalesDistribution::totalproductSale();
        $totalStock = Stock::totalStocks();

        $saleTotal = SalesDistribution::totalSale();
        $monthWiseProduction = Stock::monthWiseProduction();
        return view('dashboards.basicDashboard',compact('totalMiller','totalActiveMiller','totalInactiveMiller','totalWashcrashProduction','totalIodizeProduction','totalProductons','totalWashCrashSale','totalIodizeSale','totalProductSales','totalproduction','totalSale','totalStock','saleTotal','monthWiseProduction'));
    }

    public function association(){
        $totalMiller= count(MillerInfo::associationTotalMill());
        $totalActiveMiller= count(MillerInfo::associationTotalActiveMill());
        $totalInactiveMiller= count(MillerInfo::associationTotalInactiveMill());
        $associationWashCrash = Stock::totalAssociationWashcrash();
        $associationIodize = Stock::totalAssociationIodize();
        $totalAssociationproduction = Stock::totalAssociationproduction();
        $totalAssociationIodizeSale = Stock::totalAssociationIodizeSale();
        $totalAssociationWashCrasheSale = Stock::totalAssociationWashCrashSale();
        $totalSales = Stock::totalSale();
        $totlaProductionList = Stock::totalProductionList();
        $totalSaleLists = Stock::totalSaleList();
        $associationMonthWishProduction = Stock::monthWiseAssociationProduction();
        //$this->pr($totalActiveMiller);
        return view('dashboards.associationDashboard',compact('totalMiller','totalActiveMiller','totalInactiveMiller','associationWashCrash','totalAssociationproduction','associationIodize','totalAssociationIodizeSale','totalAssociationWashCrasheSale','totalSales','totlaProductionList','totalSaleLists','associationMonthWishProduction'));
    }

    public function miller(){
        $totalWashcrashProduction = Stock::totalWashCrashProductions();
        $totalIodizeProduction = Stock::totalIodizeProductions();
        $totalProductons = $totalWashcrashProduction+$totalIodizeProduction;

        $totalWashCrashSale = abs(SalesDistribution::totalWashcrashSales());
        $totalIodizeSale = abs(SalesDistribution::totalIodizeSales());
        $totalProductSales = $totalWashCrashSale+$totalIodizeSale;

        $procurementList = Stock::procurementList();
        $totalproduction = Stock::millerProduction();
        $totalSale = SalesDistribution::totalproductSale();

        $monthWiseProduction = Stock::monthWiseMillProduction();
//        $this->pr($monthWiseProduction);
        $monthWiseProcurement = Stock::monthWiseProcurement();
        $totalStock = Stock::totalStocks();
        $saleTotal = SalesDistribution::totalSale();
//        $this->pr($monthWiseProduction);
        return view('dashboards.millerDashboard',compact('totalWashcrashProduction','totalIodizeProduction','totalProductons','totalWashCrashSale','totalIodizeSale','totalProductSales','procurementList','totalproduction','totalSale','totalStock','saleTotal','monthWiseProcurement','monthWiseProduction'));
    }
}
