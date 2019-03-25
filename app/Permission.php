<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Permission extends Model
{
    public static function checkPermissions($linkUrl) {
        $orgId = Session::get('orgId');
        $userGroupId = Auth::user()->user_group_id;
        $userGroupLevelId = Auth::user()->user_group_level_id;
//        $permission = DB::select("SELECT suml.`CREATE`, suml.`READ`, suml.`UPDATE`, suml.`DELETE`, suml.STATUS
//                    FROM sa_uglw_mlink suml
//                    LEFT JOIN sa_org_mlink soml ON soml.ORG_MLINKS_ID = suml.UGLWM_LINK
//                    LEFT JOIN sa_module_links sml ON soml.LINK_ID = sml.LINK_ID
//                    WHERE  (suml.`ORG_ID` = '$orgId' AND suml.`USERGRP_ID` = '$userGroupId' AND suml.`UG_LEVEL_ID` = '$userGroupLevelId' ) AND suml.LINK_URI = '$linkUrl'");
        $permission = DB::table('sa_uglw_mlink as suml')
                    ->select('suml.CREATE', 'suml.READ', 'suml.UPDATE', 'suml.DELETE', 'suml.STATUS')
                    ->leftjoin('sa_org_mlink as soml', 'suml.UGLWM_LINK' ,'=' , 'soml.ORG_MLINKS_ID')
                    ->leftjoin('sa_module_links as sml', 'sml.LINK_ID' ,'=' , 'soml.LINK_ID')
                    ->where('suml.ORG_ID', '=', $orgId)
                    ->where('suml.USERGRP_ID', '=', $userGroupId)
                    ->where('suml.UG_LEVEL_ID', '=', $userGroupLevelId)
                    ->where('suml.LINK_URI', '=', $linkUrl)
                    ->first();
        return $permission;

    }
}
