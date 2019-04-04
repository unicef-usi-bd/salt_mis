<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ChemicalPurchase extends Model
{
    public static function getChemical(){
        return DB::table('smm_item')
            ->select('*')
            ->where('ITEM_TYPE','=',25)
            ->get();
    }

    public static function getSource(){
        return DB::table('smm_item')
            ->select('*')
            ->where('ITEM_TYPE','=',25)
            ->get();
    }

    public static function getChemicalSupplier(){
        return DB::table('ssm_supplier_info')
            ->select('ssm_supplier_info.*')
            ->get();
    }

    public static function getSupplierName(){
        return DB::table('ssm_supplier_info')
            ->select('ssm_supplier_info.*')
            ->get();
    }

    public static function insertIntoItemStok($data){
        return DB::table('tmm_itemstock')->insert($data);
    }
}
