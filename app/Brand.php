<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Auth;

class Brand extends Model
{
    public static function getData(){
        $center_id = Auth::user()->center_id;
        return DB::table('brand')
            ->select('brand.*')
            ->where('brand.center_id','=',$center_id)
            ->get();
    }

    public static function insertBrandData($data){
        return DB::table('brand')->insert($data);
    }

    public static function editBrandData($id){
        return DB::table('brand')
            ->select('brand.*')
            ->where('brand.brand_id','=',$id)
            ->first();
    }

    public static function updateBrandData($request,$id){
        $update = DB::table('brand')->where('brand_id', '=' , $id)->update([
            'brand_name' => $request->input('brand_name'),
            'center_id' => Auth::user()->center_id,
            'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s"),
            'UPDATE_BY' => Auth::user()->id
        ]);

        return $update;
    }

    public static function deleteBrandData($id){
        return DB::table('brand')->where('brand_id', $id)->delete();
    }

    public static function millerBrand(){
        $centerId = Auth::user()->center_id;
        return DB::table('brand')
            ->select('brand.*')
            ->where('brand.center_id','=',$centerId)
            ->get();
    }
}
