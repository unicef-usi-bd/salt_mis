<?php

namespace App\Http\Controllers\API;
use App\Item;
use App\MillerInfo;
use App\RequireChemicalMst;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Validator;
use DB;
use Session;
use App\Stock;
use App\SalesDistribution;
use App\AssociationSetup;
use App\ChemicalPurchase;
use App\CrudeSaltProcurement;

class ProductionAndSaleController extends Controller
{


    public function userLogin(Request $request)
    {

        $email = $request->email;
        $password  = $request->password;

        $checkResult = DB::table('users')
            ->where('email', '=', $email)
            ->first();

        //$this->pr($millId);
        if($checkResult){
            $result = Hash::check($password, $checkResult->password);
            if ($result){
                $center_id = DB::table('users')
                    ->select('users.center_id')
                    ->where('email', '=', $email)
                    ->where('password', '=', $checkResult->password)
                    ->first();
                $child_id = $center_id->center_id;
                //$this->pr($center_id);
                $millInfo = DB::table('ssm_associationsetup')
                    ->select('ssm_associationsetup.MILL_ID')
                    ->where('ASSOCIATION_ID', '=', $center_id->center_id)
                    ->first();
                $millId = $millInfo->MILL_ID;

                $totalIodizeProduction = Stock::totalIodizeProductionsService($child_id);
                $totalWashcrashProduction = Stock::totalWashCrashProductionsService($child_id);
                $totalProductons = $totalWashcrashProduction+$totalIodizeProduction;
                $totalWashCrashSale = abs(SalesDistribution::totalWashcrashSalesService($child_id));
                $totalIodizeSale = abs(SalesDistribution::totalIodizeSalesService($child_id));
                $totalProductSales = $totalWashCrashSale+$totalIodizeSale;

                $totalChemicalPurchaseTypewise = ChemicalPurchase::totalchemicalPurchaseTypeWise($child_id);
                $totalSaltePurchaseTypeWise = CrudeSaltProcurement::totalSaltpurchaseTypeWise($child_id);
                return response()->json([
                    'message'=> 'Sales and Production Information are given below',
                    'iodize_production' => $totalIodizeProduction,
                    'wash_crash_production' => $totalWashcrashProduction,
                    'total_production' => $totalProductons,
                    'iodize_sale' => $totalIodizeSale,
                    'wash_crash_sale' => $totalWashCrashSale,
                    'total_sale' => $totalProductSales,
                    'totalChemicalPurchaseTypewise' => $totalChemicalPurchaseTypewise,
                    'totalSaltePurchaseTypeWise' => $totalSaltePurchaseTypeWise,
                    'center_id' => $child_id,
                ]);
            }else{
                return response()->json([

                    'message'=> 'Please, check your password!'
                ]);
            }
        }else{
            return response()->json([

                'message'=> 'Please, check your user name!'
            ]);
        }
    }

    public function userLoginNew(Request $request)
    {

        $email = $request->email;
        $password  = $request->password;

        $checkResult = DB::table('users')
            ->where('email', '=', $email)
            ->first();

        //$this->pr($millId);
        if($checkResult){
            $result = Hash::check($password, $checkResult->password);
            if ($result){
                $center_id = DB::table('users')
                    ->select('users.center_id')
                    ->where('email', '=', $email)
                    ->where('password', '=', $checkResult->password)
                    ->first();
                $child_id = $center_id->center_id;
                //$this->pr($center_id);
                $millInfo = DB::table('ssm_associationsetup')
                    ->select('ssm_associationsetup.MILL_ID')
                    ->where('ASSOCIATION_ID', '=', $center_id->center_id)
                    ->first();
                $millId = $millInfo->MILL_ID;

                $totalWashcrashProduction = Stock::totalWashCrashProductions($child_id);
                $totalIodizeProduction = Stock::totalIodizeProductions($child_id);
                $totalProductons = $totalWashcrashProduction + $totalIodizeProduction;
                $totalWashCrashSale = abs(SalesDistribution::totalWashcrashSalesService($child_id));
                $totalIodizeSale = abs(SalesDistribution::totalIodizeSalesService($child_id));
                $totalProductSales = $totalWashCrashSale+$totalIodizeSale;
                $totalChemicalPurchaseTypewise = ChemicalPurchase::totalchemicalPurchaseTypeWiseNew($child_id);
                $totalSaltePurchaseTypeWise = CrudeSaltProcurement::totalSaltpurchaseTypeWiseNew($child_id);

                return response()->json([
                    'message'=> 'Sales and Production Information are given below',
                    'iodize_production' => $totalIodizeProduction,
                    'wash_crash_production' => $totalWashcrashProduction,
                    'total_production' => $totalProductons,
                    'iodize_sale' => $totalIodizeSale,
                    'wash_crash_sale' => $totalWashCrashSale,
                    'total_sale' => $totalProductSales,
                    'totalChemicalPurchaseTypewise' => $totalChemicalPurchaseTypewise,
                    'totalSaltePurchaseTypeWise' => $totalSaltePurchaseTypeWise,
                    'center_id' => $child_id,
                ]);
            }else{
                return response()->json([

                    'message'=> 'Please, check your password!'
                ]);
            }
        }else{
            return response()->json([

                'message'=> 'Please, check your user name!'
            ]);
        }





    }
}
