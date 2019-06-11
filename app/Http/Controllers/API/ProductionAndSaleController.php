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

                $millerInfo = MillerInfo::millInformation($request, $millId); //$this->pr($millId);
                $crudeSaltTypes = Item::itemTypeWiseItemList($this->crudSaltId);
                $chemicleType = Item::itemTypeWiseItemList($this->chemicalId);

                $totalIodizeProduction = Stock::totalIodizeProductionsService($child_id);
                $totalWashcrashProduction = Stock::totalWashCrashProductionsService($child_id);
                $totalProductons = $totalWashcrashProduction+$totalIodizeProduction;
                $totalWashCrashSale = abs(SalesDistribution::totalWashcrashSalesService($child_id));
                $totalIodizeSale = abs(SalesDistribution::totalIodizeSalesService($child_id));
                $totalProductSales = $totalWashCrashSale+$totalIodizeSale;
                $chemiclePurchase = ChemicalPurchase::chemicalPurchaseService();
                $saltprocrurement = CrudeSaltProcurement::crudeSaltePurchaseService();
                //$organogramDt = AssociationSetup::getZoneList();

//                $requireChemicalIodizedSalt = DB::table('smm_rmallocationchd')
//                    ->select('smm_item.ITEM_NAME','smm_rmallocationchd.*')
//                    ->leftJoin('smm_item','smm_rmallocationchd.ITEM_ID','=','smm_item.ITEM_NO')
//                    ->where('smm_rmallocationchd.RMALLOMST_ID','=',25)//it can be changed
//                    ->get();
                //$this->pr($requireChemicalIodizedSalt);
                return response()->json([

                    'message'=> 'Information are given below',
                    //'child_id'=>$child_id,
                    //'crude_salt_types' => $crudeSaltTypes,
                    //'chemical_types' => $chemicleType,
                    //'mill_information' => $millerInfo,
                    //'require_iodized_salt' => $requireChemicalIodizedSalt,

                    'iodize_production' => $totalIodizeProduction,
                    'wash_crash_production' => $totalWashcrashProduction,
                    'total_production' => $totalProductons,
                    'iodize_sale' => $totalIodizeSale,
                    'wash_crash_sale' => $totalWashCrashSale,
                    'total_sale' => $totalProductSales,
                    'chemicalPurchase' => $chemiclePurchase,
                    'saltProcurement' => $saltprocrurement,
                    'center_id' => $child_id,
                    //'zone_name' => $organogramDt
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
