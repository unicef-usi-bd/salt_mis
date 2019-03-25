<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ModuleLinkAssignUGLW;
use DB;
use Auth;

class Module extends Model {

    protected $table = 'sa_modules';
    protected $primaryKey = 'MODULE_ID';

    const CREATED_AT = 'CREATED_AT';
    const UPDATED_AT = 'UPDATED_AT';

    protected $fillable = ['MODULE_NAME', 'MODULE_NAME_BN', 'MODULE_ICON', 'SL_NO', 'IS_ACTIVE', 'CREATED_BY', 'UPDATED_BY'];


    /**
     * Save or update Module
     *@author  Nurullah <nurul@atilimited.net>
     * @param array $data
     * @param string $user
     * @param string|null $id
     * @return string
     */

    public static function getMData ()
    {
        return DB::table('sa_modules')->get();
    }

    public static function getActiveMData ()
    {
        return DB::table('sa_modules')->where('IS_ACTIVE', '=', 1)->get();
    }

    public static function insertData ($data)
    {
        return DB::table('sa_modules')->insert($data);
    }

    public static function editData($id){
        return DB::table('sa_modules')->where('MODULE_ID', '=', $id)->first();
    }

    public static function updateData($request,$id){
        return DB::table('sa_modules')->where('MODULE_ID', '=' , $id)->update([
            'MODULE_NAME' => $request->input('module_name'),
            'MODULE_ICON' => $request->input('module_icon'),
            'SL_NO' => $request->input('sl_no'),
            'IS_ACTIVE' => $request->input('active_status'),
            'UPDATED_BY' => auth()->user()->id,
            'UPDATED_AT' => date("Y-m-d h:i:s"),
        ]);

    }

    public static function deleteData($id){
        return DB::table('sa_modules')->where('MODULE_ID', $id)->delete();
    }
    
     /**
     * Module data collection
     *@author  Nurullah <nurul@atilimited.net>
     * @param $input array
     * @return Collection
     */
    public static function getData($input)
    {
        $data = Module::orderBy('SL_NO','desc')
                    ->take($input['length'])
                    ->skip($input['start'])
                    ->get();
        
        $total = Module::count();

        return array('data' => $data, 'total' => $total, 'filtered' => $total);
    }
    
    public static function checkPrevilege($link_url) {
        $session_info       = Auth::user();
        $org_id = $session_info['ORG_ID'];
        $user_id = $session_info['USER_ID'];
        $org_group = $session_info['USERGRP_ID'];
        $org_group_level = $session_info['USERLVL_ID'];
        
        $access = ModuleLinkAssignUGLW::where('LINK_URI',$link_url)
                                                                    ->where('ORG_ID', $org_id)
                                                                    ->where('USERGRP_ID', $org_group)
                                                                    ->where('UG_LEVEL_ID', $org_group_level)
                                                                    ->where('USER_ID', $user_id)
                                                                    ->first(['CREATE', 'READ', 'UPDATE', 'DELETE', 'STATUS']);
        return $access;
    }

}
