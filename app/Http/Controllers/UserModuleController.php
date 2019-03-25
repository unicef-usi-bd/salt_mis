<?php

namespace App\Http\Controllers;

use App\AssignModule;
use App\Module;
use App\ModuleLink;
use App\OrganizationModule;
use App\UserGroup;
use App\UserGroupLevel;
use App\UserModule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class UserModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orgId = Session::get('orgId');
        $userGroups = UserGroup::getOrgActiveData($orgId);
        return view('accessControl.userModules.userModuleIndex', compact('userGroups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AssignModule  $assignModule
     * @return \Illuminate\Http\Response
     */
    public function show(AssignModule $assignModule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AssignModule  $assignModule
     * @return \Illuminate\Http\Response
     */
    public function edit(AssignModule $assignModule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AssignModule  $assignModule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssignModule $assignModule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AssignModule  $assignModule
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssignModule $assignModule)
    {
        //
    }

    public function getUserGroupLevelByAjax(Request $request){
        $orgId = Session::get('orgId');
       $userGroupLevels = UserGroupLevel::getActiveUserGroupLevel($request->userGroupId, $orgId);
       return $userGroupLevels;
    }

    public function userGroupLevelPermissionAjax(Request $request){
        $userGroupLevelId = $request->input('userGroupLevelId');
        $userGroupId = $request->input('userGroupId');
        $orgId = Session::get('orgId');
        $modules = OrganizationModule::getActiveOMData ($orgId);
        $moduleLinks = UserModule::getActiveLevelrMLData($orgId, $userGroupLevelId);
        return view('accessControl.userModules.levelPermission', compact('modules', 'moduleLinks','orgId','userGroupId','userGroupLevelId'));
    }

    public function addRemovePermissionByAjax(Request $request){
 
        $values = explode(",", $request->input('values'));
        $checkType =  $request->input("is_checked");

        $orgId = $values[0];
        $groupId = $values[1];
        $levelId = $values[2];
        $moduleId = $values[3];
        $linkId = $values[4];
        $orgMLinkId = $values[5];
        $actionType = $values[6];


       $isExist = UserModule::checLevelLinkData($orgId, $groupId, $levelId, $moduleId, $linkId,$orgMLinkId);


      // $this->pr($isExist);

        if($isExist){
            $UGLWM_LINK=$isExist->UGLWM_LINK;
            $result = UserModule::updateUserData($UGLWM_LINK,$orgId, $groupId, $levelId, $moduleId, $linkId, $actionType, $checkType,$orgMLinkId);
        } else {
            $moduleLink = ModuleLink::editData($linkId);
            $data = array([
                'LINK_ID' => $linkId,
                'ORG_MLINKS_ID' => $orgMLinkId,
                'USER_ID' => 7, // Static Data
                'USERGRP_ID' => $groupId,
                'UG_LEVEL_ID' => $levelId,
                'LINK_URI' => $moduleLink->LINK_URI,
                'MODULE_ID' => $moduleId,
                'ORG_ID' => $orgId,
                'CREATE' => ($actionType == 'C') ? 1 : 0,
                'READ' => ($actionType == 'V') ? 1 : 0,
                'UPDATE' => ($actionType == 'U') ? 1 : 0,
                'DELETE' => ($actionType == 'D') ? 1 : 0,
                'STATUS' => ($actionType == 'S') ? 1 : 0,
                'CREATED_BY' => Auth::user()->id,
            ]);
 
           //$this->pr($data);
 
            $result = UserModule::insertData($data);
        }
        //return $result;
        return response()->json($result);
    }


}
