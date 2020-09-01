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
            'UPAZILA_ID' => $request->input('THANA_ID'),
            'UNION_ID' => $request->input('UNION_ID'),
            'THANA_ID' => $request->input('THANA_ID'),
            'BAZAR_NAME' => $request->input('BAZAR_NAME'),
            'PHONE' => $request->input('PHONE'),
            'EMAIL' => $request->input('EMAIL'),
            'REMARKS' => $request->input('REMARKS'),
            'center_id' => Auth::user()->center_id,
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
                    'COV_UPAZILA_ID' => $request->input('COV_THANA_ID')[$i],
                    'COV_THANA_ID' => $request->input('COV_THANA_ID')[$i],
                    'center_id' => Auth::user()->center_id,
                    'ENTRY_BY' => Auth::user()->id,
                    'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
                ]);

            }
            return $insert;
        }
    }

    public function getAutogenerateSellerId(){
        return DB::select(DB::raw(""));
    }

    public static function sellerDistributorProfile(){
        return DB::table('ssm_customer_info')
            ->select('*')
            ->where('ssm_customer_info.center_id','=',Auth::user()->center_id)
            ->get();
    }

    public static function sellerDistributorProfileMaxId(){
        return DB::table('ssm_customer_info')
            ->where('ssm_customer_info.center_id','=',Auth::user()->center_id)
            ->max('SELLER_ID');
    }

    public static function showSellerDistributorProfile($id){
        return DB::table('ssm_customer_info')
            ->select('ssm_customer_info.*', 'ssc_divisions.DIVISION_NAME','ssc_districts.DISTRICT_NAME','ssc_upazilas.UPAZILA_NAME','ssc_unions.UNION_NAME','ssc_thana.THANA_NAME')
            ->leftjoin('ssc_divisions','ssm_customer_info.DIVISION_ID', '=', 'ssc_divisions.DIVISION_ID')
            ->leftjoin('ssc_districts','ssm_customer_info.DISTRICT_ID', '=', 'ssc_districts.DISTRICT_ID')
            ->leftjoin('ssc_upazilas','ssm_customer_info.UPAZILA_ID', '=', 'ssc_upazilas.UPAZILA_ID')
            ->leftjoin('ssc_thana','ssm_customer_info.THANA_ID', '=', 'ssc_thana.THANA_ID')
            ->leftjoin('ssc_unions','ssm_customer_info.UNION_ID', '=', 'ssc_unions.UNION_ID')
            ->where('CUSTOMER_ID', '=', $id)
            ->first();
    }

    public static function editSellerDistributorProfile($id){
        return DB::table('ssm_customer_info')
            ->select('ssm_customer_info.*', 'ssc_divisions.DIVISION_NAME','ssc_districts.DISTRICT_NAME','ssc_upazilas.UPAZILA_NAME','ssc_unions.UNION_NAME','ssc_lookupchd.LOOKUPCHD_NAME','ssc_upazilas.UPAZILA_NAME as THANA_NAME')
            ->leftjoin('ssc_divisions','ssm_customer_info.DIVISION_ID', '=', 'ssc_divisions.DIVISION_ID')
            ->leftjoin('ssc_districts','ssm_customer_info.DISTRICT_ID', '=', 'ssc_districts.DISTRICT_ID')
            ->leftjoin('ssc_upazilas','ssm_customer_info.THANA_ID', '=', 'ssc_upazilas.UPAZILA_ID')
            ->leftjoin('ssc_unions','ssm_customer_info.UNION_ID', '=', 'ssc_unions.UNION_ID')
            ->leftJoin('ssc_thana','ssm_customer_info.THANA_ID','=','ssc_thana.THANA_ID')
            ->leftjoin('ssc_divisions as a','ssm_customer_info.COV_DIVISION_ID', '=', 'a.DIVISION_ID')
            ->leftJoin('ssc_lookupchd','ssm_customer_info.SELLER_TYPE_ID', '=','ssc_lookupchd.LOOKUPCHD_ID')
            ->where('CUSTOMER_ID', '=', $id)
            ->first();
    }

    public static function editSellerDistributorProfilCoverageArea($id){
        return DB::table('ssm_coverage_area')
            ->select('ssm_coverage_area.*', 'ssc_divisions.DIVISION_NAME','ssc_districts.DISTRICT_NAME','ssc_upazilas.UPAZILA_NAME','ssc_thana.THANA_NAME')
            ->leftjoin('ssc_divisions','ssm_coverage_area.COV_DIVISION_ID', '=', 'ssc_divisions.DIVISION_ID')
            ->leftjoin('ssc_districts','ssm_coverage_area.COV_DISTRICT_ID', '=', 'ssc_districts.DISTRICT_ID')
            ->leftjoin('ssc_upazilas','ssm_coverage_area.COV_UPAZILA_ID', '=', 'ssc_upazilas.UPAZILA_ID')
            ->leftJoin('ssc_thana','ssm_coverage_area.COV_THANA_ID','=','ssc_thana.THANA_ID')
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
            'UPAZILA_ID' => $request->input('THANA_ID'),
            'UNION_ID' => $request->input('UNION_ID'),
            'THANA_ID' => $request->input('THANA_ID'),
            'BAZAR_NAME' => $request->input('BAZAR_NAME'),
            'PHONE' => $request->input('PHONE'),
            'EMAIL' => $request->input('EMAIL'),
            'REMARKS' => $request->input('REMARKS'),
            'center_id' => Auth::user()->center_id,
            'UPDATE_BY' => Auth::user()->id,
            'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s")
        ]);
        //return $update;
        if($update){
            $areas = self::deleteCoverageAreaWhenEdit($id, $request->input('COVERAGE_ID'));
            if($areas) DB::table('ssm_coverage_area')->whereIn('COVERAGE_ID', $areas)->delete();
            $coverageArea = count($_POST['COV_DIVISION_ID']);
            for ($i=0;$i<$coverageArea;$i++){
                $coverageAreaId = $request->input('COVERAGE_ID')[$i];
                if(!empty($coverageAreaId)){
                    $coverageAreaId = $request->input('COVERAGE_ID')[$i];
                    $updateOrinsertSeller = DB::table('ssm_coverage_area')->where('ssm_coverage_area.COVERAGE_ID',$coverageAreaId)->update([
                    'CUSTOMER_ID' => $id,
                    'COV_DIVISION_ID' => $request->input('COV_DIVISION_ID')[$i],
                    'COV_DISTRICT_ID' => $request->input('COV_DISTRICT_ID')[$i],
                    'COV_UPAZILA_ID' => $request->input('COV_THANA_ID')[$i],
                    'COV_THANA_ID' => $request->input('COV_THANA_ID')[$i],
                     'center_id' => Auth::user()->center_id,
                    'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s")
                ]);
                }else{
                    $updateOrinsertSeller = DB::table('ssm_coverage_area')->insert([
                        'CUSTOMER_ID' => $id,
                        'COV_DIVISION_ID' => $request->input('COV_DIVISION_ID')[$i],
                        'COV_DISTRICT_ID' => $request->input('COV_DISTRICT_ID')[$i],
                        'COV_UPAZILA_ID' => $request->input('COV_UPAZILA_ID')[$i],
                        'COV_THANA_ID' => $request->input('COV_THANA_ID')[$i],
                        'center_id' => Auth::user()->center_id,
                    ]);
                }
            }
            return $updateOrinsertSeller;
        }

    }

    public static function deleteCoverageAreaWhenEdit($id, array $ariaId){
        $ariaId = array_filter($ariaId);
        $areas = DB::table('ssm_coverage_area')
            ->where('CUSTOMER_ID', '=', $id)
            ->where('center_id', '=', Auth::user()->center_id)
            ->whereNotIn('COVERAGE_ID', $ariaId)
            ->pluck('COVERAGE_ID')
            ->toArray();
        return  $areas;
    }

//    public static function deleteSellerProfile($id){
//        return DB::table('ssm_customer_info')->where('CUSTOMER_ID', $id)->delete();
//    }

    public  static function deleteSellerProfile($id){
        $deletePr = DB::table('ssm_customer_info')->where('CUSTOMER_ID', $id)->delete();
        if($deletePr){
            $deleteChd = DB::table('ssm_coverage_area')->where('COVERAGE_ID', $id)->delete();
            return $deleteChd;
        }
    }

    public static function deleteCoverageArea($id){
        $deleteChd = DB::table('ssm_coverage_area')->where('ssm_coverage_area.COVERAGE_ID', $id)->delete();
        return $deleteChd;
    }

    public static function tradingList($sellerTypeId){
        $centerId = Auth::user()->center_id;
        $traders = DB::table('ssm_customer_info');
        $traders->where('SELLER_TYPE_ID', $sellerTypeId);
        if($centerId){
            $traders->where('center_id', '=' ,$centerId);
        }
        return $traders->get();
    }

    public static function millerWiseTraders(){
        $centerId = Auth::user()->center_id;
        return DB::table('ssm_customer_info')
            ->select('ssm_customer_info.*')
            ->where('ssm_customer_info.center_id','=',$centerId)
            ->get();
    }
}
