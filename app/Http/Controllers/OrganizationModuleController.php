<?php

namespace App\Http\Controllers;

use App\Module;
use App\ModuleLink;
use App\OrganizationModule;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


class OrganizationModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userGroupId = Auth::user()->user_group_id;
        $userGroupLevelId = Auth::user()->user_group_level_id;
        $url = Route::getFacadeRoot()->current()->uri();

        $previllage = $this->checkPrevillage($userGroupId,$userGroupLevelId,$url);
        //$this->pr($previllage);
        return view('accessControl.organizationModules.organizationModuleIndex', compact('previllage'));
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

    public function assignModulesOrganization($orgId)
    {
        $modules = OrganizationModule::getInactiveOMData($orgId);
        $orgModules = OrganizationModule::getActiveOMData($orgId);
        return view('accessControl.organizationModules.modals.organizationAssignModules', compact('modules', 'orgModules'));
    }


//    public function addPagesOrganization($id)

    public function addModules($orgId, Request $request)
    {
        $create = OrganizationModule::createModulesData($orgId, $request);
        return $create;
    }

    public function removeModules($orgId, Request $request)
    {
        $update = OrganizationModule::updateModulesData($orgId, $request);
        return $update;
    }


    public function addPagesOrganization($orgId)
    {
//        $modules = Module::getActiveMData();
        $modules = OrganizationModule::getActiveOMData($orgId);
        $moduleLinks = OrganizationModule::getActiveOMLData($orgId);
       // $test = OrganizationModule::organaizationActiveModuleLink($id);
//        $this->pr($moduleLinks);
        return view('accessControl.organizationModules.modals.organizationAddPages',compact('modules','moduleLinks','orgId'));
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
     * @param  \App\OrganizationModule  $organizationModule
     * @return \Illuminate\Http\Response
     */
    public function show(OrganizationModule $organizationModule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrganizationModule  $organizationModule
     * @return \Illuminate\Http\Response
     */
    public function edit(OrganizationModule $organizationModule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrganizationModule  $organizationModule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrganizationModule $organizationModule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrganizationModule  $organizationModule
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrganizationModule $organizationModule)
    {
        //
    }

    public function addRemovePagesByAjax(Request $request){
        $values = explode(",", $request->input('values'));
        $checkType =  $request->input("is_checked");

        $orgId = $values[0];
        $moduleId = $values[1];
        $linkId = $values[2];
        $pageType = $values[3];
        $isExist = OrganizationModule::checkOrgLinkData($orgId, $linkId,$moduleId);
        if($isExist){
            $result = OrganizationModule::updatePageData($orgId, $linkId, $moduleId, $pageType, $checkType);
        } else {
            $moduleLink = ModuleLink::editData($linkId);
            $data = array([
                'LINK_ID' => $linkId,
                'LINK_NAME' => $moduleLink->LINK_NAME,
                'LINK_PAGES' => $moduleLink->LINK_PAGES,
                'LINK_URI' => $moduleLink->LINK_URI,
                'MODULE_ID' => $moduleId,
                'ORG_ID' => $orgId,
                'CREATE' => ($pageType == 'C') ? 1 : 0,
                'READ' => ($pageType == 'V') ? 1 : 0,
                'UPDATE' => ($pageType == 'U') ? 1 : 0,
                'DELETE' => ($pageType == 'D') ? 1 : 0,
                'STATUS' => ($pageType == 'S') ? 1 : 0,
                'CREATED_BY' => Auth::user()->id,
            ]);
            $result = OrganizationModule::insertData($data);
        }
        return $result;
    }
}
