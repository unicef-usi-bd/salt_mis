<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ModuleLink extends Model {

    protected $table = 'sa_module_links';
    protected $primaryKey = 'LINK_ID';

    const CREATED_AT = 'CREATED_AT';
    const UPDATED_AT = 'UPDATED_AT';

    protected $fillable = ['LINK_NAME', 'LINK_NAME_BN', 'LINK_PAGES', 'MODULE_ID','LINK_URI', 'LINK_DESC', 'SL_NO', 'CREATE', 'READ', 'UPDATE', 'DELETE', 'STATUS', 'IS_ACTIVE', 'CREATED_BY', 'UPDATED_BY'];


    /**
     * Save or update Module
     *@author  Nurullah <nurul@atilimited.net>
     * @param array $data
     * @param string $user
     * @param string|null $id
     * @return string
     */
    public static function createLink ($data, $user, $id)
    {
        $maxSlNo = DB::table('sa_module_links')->max('SL_NO');
        if (!empty($id)) {
            $link               = ModuleLink::find($id);
            $link->IS_ACTIVE    = isset($data['IS_ACTIVE']) ? $data['IS_ACTIVE'] : 0;
            $link->UPDATED_BY   = $user;
        }  else {
            $link = new ModuleLink();
            $link->LINK_PAGES = 'I,V,U,D,S';
            $link->CREATE = 1;
            $link->READ = 1;
            $link->UPDATE = 1;
            $link->DELETE = 1;
            $link->STATUS = 1;
            $link->SL_NO = $maxSlNo+1;
            $link->CREATED_BY = $user;
        }
        $link->MODULE_ID = $data['MODULE_ID'];
        $link->LINK_NAME = $data['LINK_NAME'];
        $link->LINK_URI = $data['LINK_URI'];
        
        $link->save();
    }

    public static function insertData($data){
        return DB::table('sa_module_links')->insert($data);
    }

    public static function editData($id){
        return DB::table('sa_module_links')
            ->where('LINK_ID', '=', $id)
            ->first();
    }

    public static function updateData($request, $id){
        $create = $request->input('create')==null?'0':$request->input('create');
        $view = $request->input('view')==null?'0':$request->input('view');
        $update = $request->input('update')==null?'0':$request->input('update');
        $delete = $request->input('delete')==null?'0':$request->input('delete');
        $status = $request->input('status')==null?'0':$request->input('status');

        $update = DB::table('sa_module_links')
            ->where('LINK_ID', '=', $id)
            ->update([
                'MODULE_ID' => $request->input('module_id'),
                'LINK_NAME' => $request->input('link_name'),
                'LINK_URI' => $request->input('link_url'),
                'SL_NO' => $request->input('sl_no'),
                'CREATE' => $create,
                'READ' => $view,
                'UPDATE' => $update,
                'DELETE' => $delete,
                'STATUS' => $status,
                'CREATED_BY' => auth()->user()->id,
                'CREATED_AT' => date("Y-m-d h:i:s"),
            ]);
        return $update;
    }

    
     /**
     * Module data collection
     *@author  Nurullah <nurul@atilimited.net>
     * @param $input array
     * @return Collection
     */
    public static function getData($input)
    {
        $data = ModuleLink::orderBy('SL_NO','desc')
                    ->take($input['length'])
                    ->skip($input['start'])
                    ->get();
        
        $total = ModuleLink::count();

        return array('data' => $data, 'total' => $total, 'filtered' => $total);
    }

    public static function getMLData()
    {
        return DB::table('sa_module_links')
            ->select('sa_module_links.*', 'sa_modules.MODULE_NAME')
            ->leftjoin('sa_modules','sa_module_links.MODULE_ID', '=', 'sa_modules.MODULE_ID')
            ->orderByRaw('sa_module_links.SL_NO ASC')
            ->get();
    }

    public static function getActiveMLData($id=null)
    {
        return DB::table('sa_module_links')
            ->select('sa_module_links.*', 'sa_modules.MODULE_NAME')
            ->leftjoin('sa_modules','sa_module_links.MODULE_ID', '=', 'sa_modules.MODULE_ID')
            ->where('sa_module_links.IS_ACTIVE', '=', 1)
//            ->where('ORG_ID', '=', 1)
            ->get();
    }

    public static function deleteData($id){
        return DB::table('sa_module_links')->where('LINK_ID', $id)->delete();
    }

}
