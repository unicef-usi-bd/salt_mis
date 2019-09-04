<?php

namespace App\Http\Controllers;

use App\MillerInfo;
use App\Stock;
use App\SalesDistribution;
use App\CrudeSaltProcurement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Certificate;


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

        $totalMonthWiseWashcrashProduction = Stock::totalWashCrashProductionsMonthWise();
        $totlalMonthWiseIodizeProduction = Stock::totalIodizeProductionsMonthWise();
        $totalMonthWiseProduction = $totalMonthWiseWashcrashProduction+$totlalMonthWiseIodizeProduction;

        $totalWashCrashSale = abs(SalesDistribution::totalWashcrashSales());
        $totalIodizeSale = abs(SalesDistribution::totalIodizeSales());
        $totalProductSales = $totalWashCrashSale+$totalIodizeSale;

        $totalMonthWiseWascrashSale = abs(SalesDistribution::totalWashcrashSalesMonthWise());
        $totalMonthWiseIodizeSale = abs(SalesDistribution::totalIodizeSalesMonthWise());
        $totalsaleMonthWise = $totalMonthWiseWascrashSale+$totalMonthWiseIodizeSale;

        $totalproduction = Stock::totalProduction();
        $totalSale = SalesDistribution::totalproductSale();
        $totalStock = Stock::totalStocks();

        $monthWiseProduction = Stock::monthWiseProduction();
        $saleTotal = SalesDistribution::totalSale();
        $monthWiseProcurement = Stock::monthWiseProcurement();
        //$this->pr($totalsaleMonthWise);

        return view('dashboards.adminDashboard',compact('totalMiller','totalActiveMiller','totalInactiveMiller','totalWashcrashProduction','totalIodizeProduction','totalProductons','totalWashCrashSale','totalIodizeSale','totalProductSales','totalproduction','totalSale','totalStock', 'monthWiseProduction','saleTotal','totalMonthWiseProduction','totalsaleMonthWise','totalMonthWiseWascrashSale','totalMonthWiseIodizeSale','monthWiseProcurement'));
    }

    public function unicef(){
        $totalMiller= count(MillerInfo::countAllMillers());
        $totalActiveMiller= count(MillerInfo::countActiveMillers());
        $totalInactiveMiller= count(MillerInfo::countInactiveMillers());

        $totalWashcrashProduction = Stock::totalWashCrashProductions();
        $totalIodizeProduction = Stock::totalIodizeProductions();
        $totalProductons = $totalWashcrashProduction+$totalIodizeProduction;

        $totalMonthWiseWashcrashProduction = Stock::totalWashCrashProductionsMonthWise();
        $totlalMonthWiseIodizeProduction = Stock::totalIodizeProductionsMonthWise();
        $totalMonthWiseProduction = $totalMonthWiseWashcrashProduction+$totlalMonthWiseIodizeProduction;

        $totalWashCrashSale = abs(SalesDistribution::totalWashcrashSales());
        $totalIodizeSale = abs(SalesDistribution::totalIodizeSales());
        $totalProductSales = $totalWashCrashSale+$totalIodizeSale;

        $totalMonthWiseWascrashSale = abs(SalesDistribution::totalWashcrashSalesMonthWise());
        $totalMonthWiseIodizeSale = abs(SalesDistribution::totalIodizeSalesMonthWise());
        $totalsaleMonthWise = $totalMonthWiseWascrashSale+$totalMonthWiseIodizeSale;

        $totalproduction = Stock::totalProduction();
        $totalSale = SalesDistribution::totalproductSale();
        $totalStock = Stock::totalStocks();

        $saleTotal = SalesDistribution::totalSale();
        $monthWiseProduction = Stock::monthWiseProduction();
        return view('dashboards.unicefDashboard',compact('totalMiller','totalActiveMiller','totalInactiveMiller','totalWashcrashProduction','totalIodizeProduction','totalProductons','totalWashCrashSale','totalIodizeSale','totalProductSales','totalproduction','totalSale','totalStock','saleTotal','monthWiseProduction','totalMonthWiseWashcrashProduction','totlalMonthWiseIodizeProduction','totalMonthWiseProduction','totalsaleMonthWise','totalMonthWiseWascrashSale','totalMonthWiseIodizeSale'));
    }

    public function bsti(){
        $totalMiller= count(MillerInfo::countAllMillers());
        $totalActiveMiller= count(MillerInfo::countActiveMillers());
        $totalInactiveMiller= count(MillerInfo::countInactiveMillers());

        $totalWashcrashProduction = Stock::totalWashCrashProductions();
        $totalIodizeProduction = Stock::totalIodizeProductions();
        $totalProductons = $totalWashcrashProduction+$totalIodizeProduction;

        $totalMonthWiseWashcrashProduction = Stock::totalWashCrashProductionsMonthWise();
        $totlalMonthWiseIodizeProduction = Stock::totalIodizeProductionsMonthWise();
        $totalMonthWiseProduction = $totalMonthWiseWashcrashProduction+$totlalMonthWiseIodizeProduction;

        $totalWashCrashSale = abs(SalesDistribution::totalWashcrashSales());
        $totalIodizeSale = abs(SalesDistribution::totalIodizeSales());
        $totalProductSales = $totalWashCrashSale+$totalIodizeSale;

        $totalMonthWiseWascrashSale = abs(SalesDistribution::totalWashcrashSalesMonthWise());
        $totalMonthWiseIodizeSale = abs(SalesDistribution::totalIodizeSalesMonthWise());
        $totalsaleMonthWise = $totalMonthWiseWascrashSale+$totalMonthWiseIodizeSale;

        $totalproduction = Stock::totalProduction();
        $totalSale = SalesDistribution::totalproductSale();
        $totalStock = Stock::totalStocks();

        $saleTotal = SalesDistribution::totalSale();
        $monthWiseProduction = Stock::monthWiseProduction();
        $monthWiseProcurement = Stock::monthWiseProcurement();
        return view('dashboards.bstiDashboard',compact('totalMiller','totalActiveMiller','totalInactiveMiller','totalWashcrashProduction','totalIodizeProduction','totalProductons','totalWashCrashSale','totalIodizeSale','totalProductSales','totalproduction','totalSale','totalStock','saleTotal','monthWiseProduction','totalMonthWiseWashcrashProduction','totlalMonthWiseIodizeProduction','totalMonthWiseProduction','totalMonthWiseWascrashSale','totalMonthWiseIodizeSale','totalsaleMonthWise','monthWiseProcurement'));
    }

    public function basic(){
        $totalMiller= count(MillerInfo::countAllMillers());
        $totalActiveMiller= count(MillerInfo::countActiveMillers());
        $totalInactiveMiller= count(MillerInfo::countInactiveMillers());

        $totalWashcrashProduction = Stock::totalWashCrashProductions();
        $totalIodizeProduction = Stock::totalIodizeProductions();
        $totalProductons = $totalWashcrashProduction+$totalIodizeProduction;

        $totalMonthWiseWashcrashProduction = Stock::totalWashCrashProductionsMonthWise();
        $totlalMonthWiseIodizeProduction = Stock::totalIodizeProductionsMonthWise();
        $totalMonthWiseProduction = $totalMonthWiseWashcrashProduction+$totlalMonthWiseIodizeProduction;

        $totalWashCrashSale = abs(SalesDistribution::totalWashcrashSales());
        $totalIodizeSale = abs(SalesDistribution::totalIodizeSales());
        $totalProductSales = $totalWashCrashSale+$totalIodizeSale;

        $totalMonthWiseWascrashSale = abs(SalesDistribution::totalWashcrashSalesMonthWise());
        $totalMonthWiseIodizeSale = abs(SalesDistribution::totalIodizeSalesMonthWise());
        $totalsaleMonthWise = $totalMonthWiseWascrashSale+$totalMonthWiseIodizeSale;

        $totalproduction = Stock::totalProduction();
        $totalSale = SalesDistribution::totalproductSale();
        $totalStock = Stock::totalStocks();

        $saleTotal = SalesDistribution::totalSale();
        $monthWiseProduction = Stock::monthWiseProduction();
        $monthWiseProcurement = Stock::monthWiseProcurement();
        return view('dashboards.basicDashboard',compact('totalMiller','totalActiveMiller','totalInactiveMiller','totalWashcrashProduction','totalIodizeProduction','totalProductons','totalWashCrashSale','totalIodizeSale','totalProductSales','totalproduction','totalSale','totalStock','saleTotal','monthWiseProduction','totalMonthWiseWashcrashProduction','totlalMonthWiseIodizeProduction','totalMonthWiseProduction','totalMonthWiseWascrashSale','totalMonthWiseIodizeSale','totalsaleMonthWise','monthWiseProcurement'));
    }

    public function association(){
        $totalMiller= count(MillerInfo::associationTotalMill());
        $totalActiveMiller= count(MillerInfo::associationTotalActiveMill());
        $totalInactiveMiller= count(MillerInfo::associationTotalInactiveMill());

        $associationWashCrash = Stock::totalAssociationWashcrash();
        $associationIodize = Stock::totalAssociationIodize();

        $totalassociationproduction = $associationWashCrash+$associationIodize;

        $associationWashCrashMonthwise = Stock::totalAssociationWashcrashMonthWise();
        $associationIodizeMonthWise = Stock::totalAssociationIodizeMonthwise();

        $associationTotalStockMonthWise = $associationWashCrashMonthwise+$associationIodizeMonthWise;

        //$totalAssociationproduction = Stock::totalAssociationproduction();
        $totalAssociationIodizeSale = abs(Stock::totalAssociationIodizeSale());
        $totalAssociationWashCrasheSale = abs(Stock::totalAssociationWashCrashSale());
        $totalSales = $totalAssociationIodizeSale + $totalAssociationWashCrasheSale;

        $totalassociationIodizeSaleMonthWise = abs(Stock::totalAssociationIodizeSaleMonthWise());
        $totalAssociationWashCrasheSaleMonthWise = abs(Stock::totalAssociationWashCrashSaleMonthWise());
        $totalassociationsaleMonthwise = $totalassociationIodizeSaleMonthWise+$totalAssociationWashCrasheSaleMonthWise;


        //$totalSales = Stock::totalSale();
        $totlaProductionList = Stock::totalProductionList();
        $totalSaleLists = Stock::totalSaleList();
        $associationMonthWishProduction = Stock::monthWiseAsociationProduction();
        $monthWiseProcurement = Stock::monthWiseProcurement();
        //$associationmonthwisestock = Stock::monthWiseAssociationProduction();
       //$this->pr($associationTotalStockMonthWise);
        return view('dashboards.associationDashboard',compact('totalMiller','totalActiveMiller','totalInactiveMiller','associationWashCrash','totalAssociationproduction','associationIodize','totalAssociationIodizeSale','totalAssociationWashCrasheSale','totalSales','totlaProductionList','totalSaleLists','associationMonthWishProduction','totalassociationproduction','associationTotalStockMonthWise','totalassociationsaleMonthwise','totalassociationIodizeSaleMonthWise','totalAssociationWashCrasheSaleMonthWise','monthWiseProcurement'));
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
        $renewalMessageCertificate = Certificate::certificateRenewalMessage();
        $millId = Stock::millId();
        $this->pr($millId);
        return view('dashboards.millerDashboard',compact('totalWashcrashProduction','totalIodizeProduction','totalProductons','totalWashCrashSale','totalIodizeSale','totalProductSales','procurementList','totalproduction','totalSale','totalStock','saleTotal','monthWiseProcurement','monthWiseProduction','renewalMessageCertificate'));
    }
}
