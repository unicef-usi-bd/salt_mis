<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;

class Controller extends BaseController
{
    //############## Look Up Group Static Id For Get Group Data ###############
    public $agencyId= 1;
    public $crudSaltTypeId= 2;
    public $registrationTypeId= 4;
    public $ownerTypeId= 5;
    public $processTypeId= 6;
    public $millTypeId= 7;
    public $zoneTypeId= 8;
    public $capacityId= 9;


    public $sellerTypeId = 3;

    public $itemTypeId = 10;
    public $certificateTypeId = 12;
    public $issureTypeId = 13;
    public $supplierTypeId = 14;


    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function checkPrevillage($userGroupId,$userGroupLevelId,$url)
    {
        // $link = $url;
        //return DB::select(DB::raw("select a.`CREATE`,a.`READ`,a.`UPDATE`,a.`DELETE`,a.STATUS from sa_uglw_mlink a where a.USERGRP_ID='7' and  a.UG_LEVEL_ID='15' and a.LINK_URI='financial-report'"));
        return DB::table('sa_uglw_mlink as a')
            ->select('a.CREATE','a.READ','a.UPDATE','a.DELETE','a.STATUS')
            ->where('a.USERGRP_ID','=',$userGroupId)
            ->where('a.UG_LEVEL_ID','=',$userGroupLevelId)
            ->where('a.LINK_URI','=',$url)
            ->first();
    }

    protected function buildTree($flat, $pidKey, $idKey = null){

        $grouped = array();
        foreach ($flat as $sub) {
            $grouped[$sub[$pidKey]][] = $sub;
        }
        $treeBuilder = function($siblings) use (&$treeBuilder, $grouped, $idKey) {
            foreach ($siblings as $k => $sibling) {
                $id = $sibling[$idKey];
                if (isset($grouped[$id])) {
                    $sibling['children'] = $treeBuilder($grouped[$id]);
                }
                $siblings[$k] = $sibling;
            }
            return $siblings;
        };
        $tree = $treeBuilder($grouped[0]);
        return $tree;
    }

    protected function pr($data){
        echo '<pre>';
        print_r($data);
        exit();
    }
}
