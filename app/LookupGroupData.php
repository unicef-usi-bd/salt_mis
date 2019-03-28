<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LookupGroupData extends Model
{
    protected $fillable = [
        'lookup_group_id',
        'group_data_name',
        'group_data_abbr',
        'sys_code',
        'description',
        'remarks',
        'user_define_id',
        'active_status'
    ];




    public static function insertData($data){
        return DB::table('lookup_group_data')->insert($data);
    }

    public static function getActiveGroupDataByLookupGroup($id){
        return DB::table('lookup_group_data')
            ->select('lookup_group_data_id', 'group_data_name','group_data_abbr','description')
            ->where('lookup_group_id', '=', $id)
            ->where('active_status', '=', 1)
            ->get();
    }

    public static function viewData($id){
        return DB::table('lookup_group_data')->where('lookup_group_data_id', '=', $id)->first();
    }

    public static function editData($id){
        return  DB::table('lookup_group_data')->where('lookup_group_data_id', '=', $id)->first();
    }

    public static function updateData($request,$id){
        return DB::table('lookup_group_data')->where('lookup_group_data_id', '=' , $id)->update([
            'group_data_name' => $request->input('group_data_name'),
            'group_data_abbr' => $request->input('group_data_abbr'),
            'user_define_id' => $request->input('user_define_id'),
            'description' => $request->input('description'),
            'active_status' => $request->input('active_status'),
            'update_at' => date("Y-m-d h:i:s"),
            'update_by' => Auth::user()->id
        ]);
    }

    public static function deleteData($id){
        return DB::table('lookup_group_data')->where('lookup_group_data_id', $id)->delete();
    }
}
