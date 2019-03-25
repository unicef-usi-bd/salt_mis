<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class UserModule extends Model
{
    protected $table = 'sa_org_modules';
    protected $primaryKey = 'ORG_MODULE_ID';

    const CREATED_AT = 'CREATED_AT';
    const UPDATED_AT = 'UPDATED_AT';

    protected $fillable = ['MODULE_ID', 'MODULE_NAME', 'ORG_ID', 'DEFAULT_FLAG', 'IS_ACTIVE', 'CREATED_BY', 'UPDATED_BY'];


    /**
     * Save or update Module
     *@author  Nurullah <nurul@atilimited.net>
     * @param array $data
     * @param string $user
     * @param string|null $id
     * @return string
     */
    public static function getInactiveOMData ($orgID)
    {
        return DB::select( DB::raw("select sm.*, (select IS_ACTIVE from sa_org_modules som where som.MODULE_ID=sm.MODULE_ID and som.ORG_ID=$orgID) as IS_EXIST_OR_ACTIVE from sa_modules sm;"));
    }

    public static function getActiveOMData ($orgId)
    {
        return DB::table('sa_org_modules')
            ->where('IS_ACTIVE', '=', 1)
            ->where('ORG_ID', '=', $orgId)
            ->get();
    }

    public static function createModulesData ($orgId, $request)
    {
        $modulesId = $request->input('modulesId');
        for($i=0;$i<count($modulesId);$i++){
            $existModule =DB::table('sa_org_modules')->where('MODULE_ID', '=', $modulesId[$i])->first();
            if($existModule){
                $create = DB::table('sa_org_modules')
                    ->where('MODULE_ID', '=', $modulesId[$i])
                    ->where('ORG_ID', '=', $orgId)
                    ->update([
                        'UPDATED_BY'=> Auth::user()->id,
                        'UPDATED_AT'=> date("Y-m-d h:i:s"),
                        'IS_ACTIVE'=> 1,
                    ]);
            } else {
                $module = DB::table('sa_modules')->where('MODULE_ID', '=', $modulesId[$i])->first();
                $create = DB::table('sa_org_modules')->insert([
                    'MODULE_ID' => $module->MODULE_ID,
                    'MODULE_NAME' => $module->MODULE_NAME,
                    'CREATED_BY' => Auth::user()->id,
                    'ORG_ID' => $orgId,
                    'IS_ACTIVE' => 1,
                ]);
            }
        }
        return $create;
    }

    public static function updateModulesData ($orgId, $request)
    {
        $modulesId = $request->input('modulesId');
        for($i=0;$i<count($modulesId);$i++){
            DB::table('sa_org_modules')
                ->where('MODULE_ID', '=', $modulesId[$i])
                ->where('ORG_ID', '=', $orgId)
                ->update([
                    'UPDATED_BY'=> Auth::user()->id,
                    'UPDATED_AT'=> date("Y-m-d h:i:s"),
                    'IS_ACTIVE'=> 0,
                ]);
        }
        return $modulesId;

    }

    /**
     * Module data collection
     *@author  Nurullah <nurul@atilimited.net>
     * @param $input array
     * @return Collection
     */

    public static function getActiveLevelrMLData($orgId, $userGroupLevelId)
    {
        return DB::select( DB::raw("SELECT soml.ORG_MLINKS_ID,soml.MODULE_ID,soml.LINK_ID,soml.LINK_NAME,suml.`CREATE`,suml.`READ`,suml.`UPDATE`,suml.`DELETE`,suml.`STATUS`,soml.`CREATE` as OP_CREATE,soml.`READ` as OP_READ,soml.`UPDATE` as OP_UPDATE,soml.`DELETE` as OP_DELETE,soml.`STATUS` as OP_STATUS FROM sa_org_mlink soml
                          left join sa_uglw_mlink suml on suml.LINK_ID=soml.LINK_ID and suml.UG_LEVEL_ID=$userGroupLevelId and suml.ORG_ID=soml.ORG_ID
                          where soml.IS_ACTIVE=1 and soml.ORG_ID=$orgId"));
    }

    public static function insertData($data){
        return DB::table('sa_uglw_mlink')->insert($data);
    }

    public static function checLevelLinkData($orgId, $groupId, $levelId, $moduleId, $linkId,$orgMLinkId){
        return DB::table('sa_uglw_mlink')
            ->where('ORG_ID', '=', $orgId)
            ->where('USERGRP_ID', '=', $groupId)
            ->where('UG_LEVEL_ID', '=', $levelId)
            ->where('MODULE_ID', '=', $moduleId)
            ->where('LINK_ID', '=', $linkId)
            ->where('ORG_MLINKS_ID', '=', $orgMLinkId)
            ->first();
    }

    public static function updateAllPageData($orgId, $linkId, $moduleId, $checkType){
        return DB::table('sa_org_mlink')
            ->where('ORG_ID', '=', $orgId)
            ->where('LINK_ID', '=', $linkId)
            ->where('MODULE_ID', '=', $moduleId)
            ->update([
                'CREATE' => $checkType,
                'READ' => $checkType,
                'UPDATE' => $checkType,
                'DELETE' => $checkType,
                'STATUS' => $checkType,
                'UPDATED_BY'=> Auth::user()->id,
                'UPDATED_AT'=> date("Y-m-d h:i:s"),
            ]);
    }

    public static function updateUserData($UGLWM_LINK,$orgId, $groupId, $levelId, $moduleId, $linkId, $actionType, $checkType,$orgMLinkId){

        if($actionType=='C'){
            $colName = 'CREATE';
        } else if($actionType=='V'){
            $colName = 'READ';
        }else if($actionType=='U'){
            $colName = 'UPDATE';
        }else if($actionType=='D'){
            $colName = 'DELETE';
        }else if($actionType=='S'){
            $colName = 'STATUS';
        }
        return DB::table('sa_uglw_mlink')
            ->where('UGLWM_LINK', '=', $UGLWM_LINK)

            ->update([
                $colName => $checkType,
                'ORG_MLINKS_ID' => $orgMLinkId,
                'UPDATED_BY'=> Auth::user()->id,
                'UPDATED_AT'=> date("Y-m-d h:i:s"),
            ]);
    }
}
