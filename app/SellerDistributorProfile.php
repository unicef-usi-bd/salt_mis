<?php

namespace App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class SellerDistributorProfile extends Model
{
protected $fillable = [
    'SELLER_TYPE_ID',
    'TRADING_NAME',
    'TRADER_NAME',
    'SELLER_ID',
    'LICENCE_NO',
    'DIVISION_ID',
    'DISTRICT_ID',
    'UPAZILA_ID',
    'UNION_ID',
    'BAZAR_NAME',
    'PHONE',
    'EMAIL',
    'COV_DIVISION_ID',
    'COV_DISTRICT_ID',
    'COV_UPAZILA_ID',
    'COV_UNION_ID',
    'REMARKS'
];


    public static function insertData($request){
        $sellerProfile = DB::table('ssm_customer_info')->insertGetId([
            'SELLER_TYPE_ID' => $request->input('SELLER_TYPE_ID'),
            'TRADING_NAME' => $request->input('TRADING_NAME'),
            'LICENCE_NO' => $request->input('LICENCE_NO'),
            'TRADER_NAME' => $request->input('TRADER_NAME'),
            'SELLER_ID' => $request->input('SELLER_ID'),
            'DIVISION_ID' => $request->input('DIVISION_ID'),
            'DISTRICT_ID' => $request->input('DISTRICT_ID'),
            'UNION_ID' => $request->input('UNION_ID'),
            'UPAZILA_ID' => $request->input('UPAZILA_ID'),
            'UNION_ID' => $request->input('UNION_ID'),
            'BAZAR_NAME' => $request->input('BAZAR_NAME'),
            'PHONE' => $request->input('PHONE'),
            'EMAIL' => $request->input('EMAIL'),
            'REMARKS' => $request->input('REMARKS'),
            'ENTRY_BY' => Auth::user()->id,
            'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
        ]);
        if($sellerProfile){
            $coverageArea = count($_POST['COV_DIVISION_ID']);
            for ($i=0;$i<$coverageArea;$i++){
                $insert = DB::table('ssm_coverage_area')->insertGetId([
                    'CUSTOMER_ID' => $sellerProfile,
                    'COV_DIVISION_ID' => $request->input('COV_DIVISION_ID')[$i],
                    'COV_DISTRICT_ID' => $request->input('COV_DISTRICT_ID')[$i],
                    'COV_UPAZILA_ID' => $request->input('COV_UPAZILA_ID')[$i],
                ]);

            }
            return $insert;
        }
    }

    public static function sellerDistributorProfile(){
        return DB::table('ssm_customer_info')
            ->select('*')
            ->get();
    }

    public static function showSellerDistributorProfile($id){
        return DB::table('ssm_customer_info')
            ->select('ssm_customer_info.*', 'ssc_divisions.DIVISION_NAME','ssc_districts.DISTRICT_NAME','ssc_upazilas.UPAZILA_NAME','ssc_unions.UNION_NAME')
            ->leftjoin('ssc_divisions','ssm_customer_info.DIVISION_ID', '=', 'ssc_divisions.DIVISION_ID')
            ->leftjoin('ssc_districts','ssm_customer_info.DISTRICT_ID', '=', 'ssc_districts.DISTRICT_ID')
            ->leftjoin('ssc_upazilas','ssm_customer_info.UPAZILA_ID', '=', 'ssc_upazilas.UPAZILA_ID')
            ->leftjoin('ssc_unions','ssm_customer_info.UNION_ID', '=', 'ssc_unions.UNION_ID')
            ->where('CUSTOMER_ID', '=', $id)
            ->first();
    }

    public static function editSellerDistributorProfile($id){
        return DB::table('ssm_customer_info')
            ->select('ssm_customer_info.*', 'ssc_divisions.DIVISION_NAME','ssc_districts.DISTRICT_NAME','ssc_upazilas.UPAZILA_NAME','ssc_unions.UNION_NAME','ssc_lookupchd.LOOKUPCHD_NAME')
            ->leftjoin('ssc_divisions','ssm_customer_info.DIVISION_ID', '=', 'ssc_divisions.DIVISION_ID')
            ->leftjoin('ssc_districts','ssm_customer_info.DISTRICT_ID', '=', 'ssc_districts.DISTRICT_ID')
            ->leftjoin('ssc_upazilas','ssm_customer_info.UPAZILA_ID', '=', 'ssc_upazilas.UPAZILA_ID')
            ->leftjoin('ssc_unions','ssm_customer_info.UNION_ID', '=', 'ssc_unions.UNION_ID')
            ->leftjoin('ssc_divisions as a','ssm_customer_info.COV_DIVISION_ID', '=', 'a.DIVISION_ID')
            ->leftJoin('ssc_lookupchd','ssm_customer_info.SELLER_TYPE_ID', '=','ssc_lookupchd.LOOKUPCHD_ID')
            ->where('CUSTOMER_ID', '=', $id)
            ->first();
    }

    public static function editSellerDistributorProfilCoverageArea($id){
        return DB::table('ssm_coverage_area')
            ->select('ssm_coverage_area.*', 'ssc_divisions.DIVISION_NAME','ssc_districts.DISTRICT_NAME','ssc_upazilas.UPAZILA_NAME')
            ->leftjoin('ssc_divisions','ssm_coverage_area.COV_DIVISION_ID', '=', 'ssc_divisions.DIVISION_ID')
            ->leftjoin('ssc_districts','ssm_coverage_area.COV_DISTRICT_ID', '=', 'ssc_districts.DISTRICT_ID')
            ->leftjoin('ssc_upazilas','ssm_coverage_area.COV_UPAZILA_ID', '=', 'ssc_upazilas.UPAZILA_ID')
            ->where('CUSTOMER_ID', '=', $id)
            ->get();
    }

    public static function updateData($request, $id){
        $update = DB::table('ssm_customer_info')->where('CUSTOMER_ID',$id)->update([
            'SELLER_TYPE_ID' => $request->input('SELLER_TYPE_ID'),
            'TRADING_NAME' => $request->input('TRADING_NAME'),
            'LICENCE_NO' => $request->input('LICENCE_NO'),
            'TRADER_NAME' => $request->input('TRADER_NAME'),
            'SELLER_ID' => $request->input('SELLER_ID'),
            'DIVISION_ID' => $request->input('DIVISION_ID'),
            'DISTRICT_ID' => $request->input('DISTRICT_ID'),
            'UNION_ID' => $request->input('UNION_ID'),
            'UPAZILA_ID' => $request->input('UPAZILA_ID'),
            'UNION_ID' => $request->input('UNION_ID'),
            'BAZAR_NAME' => $request->input('BAZAR_NAME'),
            'PHONE' => $request->input('PHONE'),
            'EMAIL' => $request->input('EMAIL'),
            'REMARKS' => $request->input('REMARKS'),
            'ENTRY_BY' => Auth::user()->id,
            'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
        ]);
        if($update){
            $coverageArea = count($_POST['COV_DIVISION_ID']);
            for ($i=0;$i<$coverageArea;$i++){
                if($request->input('COVERAGE_ID')[$i]){
                $insert = DB::table('ssm_coverage_area')->where('ssm_coverage_area.COVERAGE_ID',$request->input('COVERAGE_ID')[$i])->update([
                    'CUSTOMER_ID' => $update,
                    'COV_DIVISION_ID' => $request->input('COV_DIVISION_ID')[$i],
                    'COV_DISTRICT_ID' => $request->input('COV_DISTRICT_ID')[$i],
                    'COV_UPAZILA_ID' => $request->input('COV_UPAZILA_ID')[$i],
                ]);
                }else{
                    $insertSeller = DB::table('ssm_coverage_area')->insertGetId([

                    ]);
                }
            }
            return $insert;
        }

    }

    public static function deleteSellerProfile($id){
        return DB::table('ssm_customer_info')->where('CUSTOMER_ID', $id)->delete();
    }
}
