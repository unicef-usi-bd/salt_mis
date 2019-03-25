<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;

class Controller extends BaseController
{
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
}
