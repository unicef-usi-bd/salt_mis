<?php

namespace App\Http\Controllers;

use App\ChemicalPurchase;
use App\MillerInfo;
use App\Stock;
use App\SalesDistribution;
use App\CrudeSaltProcurement;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Certificate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::user()->mail_verified) {
                return $next($request);
            } else{
                $message = "Warning! Your account is not active yet, To activate check your Email \"".Auth::user()->email.'"';
                Auth::logout();
                return redirect()->route('login')->with('warning', $message);
            }
        });
    }
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
        $user_group_id = Auth::user()->user_group_id;

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
        $totalMiller= MillerInfo::totalMill();
        $totalActiveMiller= MillerInfo::totalActiveMill();
        $totalInactiveMiller= MillerInfo::totalInactiveMill();

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
        $totalSale = SalesDistribution::productSales();
        $totalStock = Stock::totalStocks();

        $monthWiseProduction = Stock::monthWiseProduction();
        $saleTotal = SalesDistribution::totalSale();
        $monthWiseProcurement = Stock::monthWiseProcurement();
        $totalWcDashboard = Stock::totalWashCrashForDashboard();
        $totalIoDashboard = Stock:: totalIodizeForDashboard();
        $totalWcIoDashboard = $totalWcDashboard+$totalIoDashboard;
        $totalSaleDashboard = SalesDistribution::totalSaleCurrentMonth();
        $totalYearProduction = Stock::adminYearWiseProduction();
        $totalProcrument = ChemicalPurchase::totalProcurment();
        $kiStock = ChemicalPurchase::kiInstock () ;
        $kiUsed = abs(ChemicalPurchase::kiInUsed());
        $totalKiInStock = $kiStock-$kiUsed;
        $totalStockKi = $totalProcrument - $kiUsed;
        //$this->pr($kiStock);exit;

        return view('dashboards.adminDashboard',compact('totalMiller','totalActiveMiller','totalInactiveMiller','totalWashcrashProduction','totalIodizeProduction','totalProductons','totalWashCrashSale','totalIodizeSale','totalProductSales','totalproduction','totalSale','totalStock', 'monthWiseProduction','saleTotal','totalMonthWiseProduction','totalsaleMonthWise','totalMonthWiseWascrashSale','totalMonthWiseIodizeSale','monthWiseProcurement','totalWcIoDashboard','totalSaleDashboard','totalYearProduction','totalProcrument','kiStock','kiUsed','totalKiInStock','totalStockKi'));
    }

    public function unicef(){
        $totalMiller= MillerInfo::totalMill();
        $totalActiveMiller= MillerInfo::totalActiveMill();
        $totalInactiveMiller= MillerInfo::totalInactiveMill();

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
        $totalSale = SalesDistribution::productSales();
        $totalStock = Stock::totalStocks();

        $saleTotal = SalesDistribution::totalSale();
        $monthWiseProduction = Stock::monthWiseProduction();
        $totalWcDashboard = Stock::totalWashCrashForDashboard();
        $totalIoDashboard = Stock:: totalIodizeForDashboard();
        $totalWcIoDashboard = $totalWcDashboard+$totalIoDashboard;
        $totalSaleDashboard = SalesDistribution::totalSaleCurrentMonth();
        $totalYearProduction = Stock::adminYearWiseProduction();
        $totalProcrument = ChemicalPurchase::totalProcurment();
        $kiStock = ChemicalPurchase::kiInstock () ;
        $kiUsed = abs(ChemicalPurchase::kiInUsed());
        $totalKiInStock = $kiStock-$kiUsed;
        $totalStockKi = $totalProcrument - $kiUsed;
        return view('dashboards.unicefDashboard',compact('totalMiller','totalActiveMiller','totalInactiveMiller','totalWashcrashProduction','totalIodizeProduction','totalProductons','totalWashCrashSale','totalIodizeSale','totalProductSales','totalproduction','totalSale','totalStock','saleTotal','monthWiseProduction','totalMonthWiseWashcrashProduction','totlalMonthWiseIodizeProduction','totalMonthWiseProduction','totalsaleMonthWise','totalMonthWiseWascrashSale','totalMonthWiseIodizeSale','totalWcIoDashboard','totalSaleDashboard','totalYearProduction','kiStock','kiUsed','totalKiInStock','totalProcrument','totalStockKi'));
    }

    public function bsti(){
        $totalMiller= MillerInfo::totalMill();
        $totalActiveMiller= MillerInfo::totalActiveMill();
        $totalInactiveMiller= MillerInfo::totalInactiveMill();

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
        $totalSale = SalesDistribution::productSales();
        $totalStock = Stock::totalStocks();

        $saleTotal = SalesDistribution::totalSale();
        $monthWiseProduction = Stock::monthWiseProduction();
        $monthWiseProcurement = Stock::monthWiseProcurement();
        $totalWcDashboard = Stock::totalWashCrashForDashboard();
        $totalIoDashboard = Stock:: totalIodizeForDashboard();
        $totalWcIoDashboard = $totalWcDashboard+$totalIoDashboard;
        $totalSaleDashboard = SalesDistribution::totalSaleCurrentMonth();
        $totalYearProduction = Stock::adminYearWiseProduction();
        $totalProcrument = ChemicalPurchase::totalProcurment();
        $kiStock = ChemicalPurchase::kiInstock () ;
        $kiUsed = abs(ChemicalPurchase::kiInUsed());
        $totalKiInStock = $kiStock-$kiUsed;
        $totalStockKi = $totalProcrument - $kiUsed;
        return view('dashboards.bstiDashboard',compact('totalMiller','totalActiveMiller','totalInactiveMiller','totalWashcrashProduction','totalIodizeProduction','totalProductons','totalWashCrashSale','totalIodizeSale','totalProductSales','totalproduction','totalSale','totalStock','saleTotal','monthWiseProduction','totalMonthWiseWashcrashProduction','totlalMonthWiseIodizeProduction','totalMonthWiseProduction','totalMonthWiseWascrashSale','totalMonthWiseIodizeSale','totalsaleMonthWise','monthWiseProcurement','totalWcIoDashboard','totalSaleDashboard','totalYearProduction','kiStock','kiUsed','totalKiInStock','totalProcrument','totalStockKi'));
    }

    public function basic(){
        $totalMiller= MillerInfo::totalMill();
        $totalActiveMiller= MillerInfo::totalActiveMill();
        $totalInactiveMiller= MillerInfo::totalInactiveMill();

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
        $totalSale = SalesDistribution::productSales();
        $totalStock = Stock::totalStocks();

        $saleTotal = SalesDistribution::totalSale();
        $monthWiseProduction = Stock::monthWiseProduction();
        $monthWiseProcurement = Stock::monthWiseProcurement();
        $totalWcDashboard = Stock::totalWashCrashForDashboard();
        $totalIoDashboard = Stock:: totalIodizeForDashboard();
        $totalWcIoDashboard = $totalWcDashboard+$totalIoDashboard;
        $totalSaleDashboard = SalesDistribution::totalSaleCurrentMonth();
        $totalYearProduction = Stock::adminYearWiseProduction();
        $totalProcrument = ChemicalPurchase::totalProcurment();
        $kiStock = ChemicalPurchase::kiInstock () ;
        $kiUsed = abs(ChemicalPurchase::kiInUsed());
        $totalKiInStock = $kiStock-$kiUsed;
        $totalStockKi = $totalProcrument - $kiUsed;
        return view('dashboards.basicDashboard',compact('totalMiller','totalActiveMiller','totalInactiveMiller','totalWashcrashProduction','totalIodizeProduction','totalProductons','totalWashCrashSale','totalIodizeSale','totalProductSales','totalproduction','totalSale','totalStock','saleTotal','monthWiseProduction','totalMonthWiseWashcrashProduction','totlalMonthWiseIodizeProduction','totalMonthWiseProduction','totalMonthWiseWascrashSale','totalMonthWiseIodizeSale','totalsaleMonthWise','monthWiseProcurement','totalWcIoDashboard','totalSaleDashboard','totalYearProduction','kiStock','kiUsed','totalKiInStock','totalProcrument','totalStockKi'));
    }

    public function association(){
        $totalMiller= MillerInfo::totalMill();
        $totalActiveMiller= MillerInfo::totalActiveMill();
        $totalInactiveMiller= MillerInfo::totalInactiveMill();

        $associationWashCrash = Stock::totalAssociationWashcrash();
        $associationIodize = Stock::totalAssociationIodize();

        $totalassociationproduction = ($associationWashCrash+$associationIodize);

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
        $monthWiseProcurement = Stock::monthWiseProcurement(); // Non Consider miller active
        $associationMillerCertificate = Certificate::associatonCertificate();
        $totalWcDashboard = Stock::totalAssociationWashCrashForDashboard();
        $totalIoDashboard = Stock:: totalAssociationIodizeForDashboard();
        $totalWcIoDashboard = $totalWcDashboard+$totalIoDashboard;
        $totalSaleDashboard = SalesDistribution::totalSaleAssociationDashboard();
        $totalYearProduction = Stock::associationYearWiseProduction();
        $totalProcrument = ChemicalPurchase::totalAssociationProcurment();
        //dd($totalProcrument);
        $kiStock = ChemicalPurchase::kiAssociationInstock () ;
        $kiUsed = abs(ChemicalPurchase::kiAssociationInUsed());
        $totalKiInStock = $kiStock-$kiUsed;
        $totalStock = $totalProcrument - $kiUsed;

        return view('dashboards.associationDashboard',compact('totalMiller','totalActiveMiller','totalInactiveMiller','associationWashCrash','totalAssociationproduction','associationIodize','totalAssociationIodizeSale','totalAssociationWashCrasheSale','totalSales','totlaProductionList','totalSaleLists','associationMonthWishProduction','totalassociationproduction','associationTotalStockMonthWise','totalassociationsaleMonthwise','totalassociationIodizeSaleMonthWise','totalAssociationWashCrasheSaleMonthWise','monthWiseProcurement','approvelNotificaion','associationMillerCertificate','totalWcIoDashboard','totalSaleDashboard','totalYearProduction','totalProcrument','kiStock','kiUsed','totalKiInStock','totalStock'));
    }

    public function miller(){
        $totalWashcrashProduction = Stock::totalWashCrashProductions();
        $totalIodizeProduction = Stock::totalIodizeProductions();
        $totalProductons = $totalWashcrashProduction + $totalIodizeProduction;
        $totalWashCrashSale = abs(SalesDistribution::totalWashcrashSales());
        $totalIodizeSale = abs(SalesDistribution::totalIodizeSales());
        $totalProductSales = $totalWashCrashSale + $totalIodizeSale;
        $procurementList = Stock::procurementList();
        $totalproduction = Stock::millerProduction();
        $totalSale = SalesDistribution::productSales();
        $monthWiseProduction = Stock::monthWiseMillProduction();
        $monthWiseProcurement = Stock::monthWiseProcurement();
        $totalStock = Stock::totalStocks();
        $saleTotal = SalesDistribution::totalSale();
        $millId = MillerInfo::millId();
        $arrayMillsId = (array)$millId;
        $millsId = implode(' ', array_values($arrayMillsId));
        $renewalMessageCertificate = Certificate::certificateRenewalMessage($millsId);
        $totalWcDashboard = Stock::totalWashCrashForDashboard();
        $totalIoDashboard = Stock:: totalIodizeForDashboard();
        $totalWcIoDashboard = $totalWcDashboard + $totalIoDashboard;
        $totalSaleDashboard = SalesDistribution::totalSaleCurrentMonth();
        $totalYearProduction = Stock::millerYearWiseProduction();
        $totalProcrument = ChemicalPurchase::totalProcurment();
        $kiStock = ChemicalPurchase::kiInstock();
        $kiUsed = abs(ChemicalPurchase::kiInUsed());
        $totalKiInStock = $kiStock - $kiUsed;
        $totalStockKi = $totalProcrument - $kiUsed;
        $centerId = Auth::user()->center_id ;
        $millerInfo = MillerInfo::millerInfoByCenterId();
        $extendDate = User::extendDateByCenterId();

        $millerCertificateInfo = Certificate::millerCertificateInfoByMillId($millerInfo->MILL_ID);
        if(!$millerCertificateInfo){
            $message = "Miller certificate's not found. Please provide your certificates to association.!!!";
            Auth::logout();
            return redirect()->route('login')->with(['warning' => $message]);
        }
        $milerExpireDate = $this->dateFormat($millerCertificateInfo->RENEWING_DATE);
        $userExpireDate = $this->dateFormat($extendDate);

        if($millerCertificateInfo) {
            $checkExpired = $milerExpireDate > $userExpireDate;
            if ($checkExpired) {
                $userExpireDate = $milerExpireDate;
                DB::table('users')->where('center_id', $centerId)->update([
                    'renewing_date' => $milerExpireDate,
                ]);
            }

            if ($this->hasAuthorization($userExpireDate)) {
                return view('dashboards.millerDashboard', compact('totalWashcrashProduction', 'totalIodizeProduction', 'totalProductons', 'totalWashCrashSale', 'totalIodizeSale', 'totalProductSales', 'procurementList', 'totalproduction', 'totalSale', 'totalStock', 'saleTotal', 'monthWiseProcurement', 'monthWiseProduction', 'renewalMessageCertificate', 'millId', 'totalWcIoDashboard', 'totalSaleDashboard', 'totalYearProduction', 'kiStock', 'kiUsed', 'totalKiInStock', 'totalProcrument','totalStockKi'));
            } else {
                $message = "Your Certificate Is Expired. Please Contact With Your Association.!!!";
            }
        }else{
            $message = "No Info Found. Please Contact With Your Association.!!!";
        }
        Auth::logout();
        return redirect()->route('login')->with(['warning' => $message]);
      }
}
