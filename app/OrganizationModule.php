<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class OrganizationModule extends Model
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

//    For Module Link
    public static function getActiveOMLData($orgID)
    {
        return DB::select( DB::raw("select sml.MODULE_ID,sml.LINK_NAME,sml.LINK_ID, mlt.`CREATE`,mlt.`READ`,mlt.`UPDATE`,mlt.`DELETE`,mlt.`STATUS` 
        from sa_module_links sml
        left join sa_org_mlink mlt on mlt.LINK_ID=sml.LINK_ID and mlt.ORG_ID=$orgID and mlt.MODULE_ID=sml.MODULE_ID
         where sml.IS_ACTIVE=1"));
    }

    public static function insertData($data){
        return DB::table('sa_org_mlink')->insert($data);
    }

    public static function checkOrgLinkData($orgId, $linkId,$moduleId){
        return DB::table('sa_org_mlink')
            ->where('ORG_ID', '=', $orgId)
            ->where('LINK_ID', '=', $linkId)
            ->where('MODULE_ID', '=', $moduleId)
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

    public static function updatePageData($orgId, $linkId,$moduleId, $pageType, $checkType){
        if($pageType=='C'){
            $colName = 'CREATE';
        } else if($pageType=='V'){
            $colName = 'READ';
        }else if($pageType=='U'){
            $colName = 'UPDATE';
        }else if($pageType=='D'){
            $colName = 'DELETE';
        }else if($pageType=='S'){
            $colName = 'STATUS';
        }
        return DB::table('sa_org_mlink')
            ->where('ORG_ID', '=', $orgId)
            ->where('LINK_ID', '=', $linkId)
            ->where('MODULE_ID', '=', $moduleId)
            ->update([
                $colName => $checkType,
                'UPDATED_BY'=> Auth::user()->id,
                'UPDATED_AT'=> date("Y-m-d h:i:s"),
            ]);
    }
}
