<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    public $timestamps = false;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'org_id', 'emp_id', 'remarks', 'active_status', 'address', 'contact_no', 'designation_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser', 'user_id','id');
    }

    public static function userDetails($id)
    {
        return DB::table('users as u')
            ->select('cc.cost_center_name', 'ug.USERGRP_NAME', 'ugl.UGLEVE_NAME', 'a.ASSOCIATION_NAME', 'a.ASSOCIATION_ID', 'u.user_group_id', 'ugl.POSITIONLEVEl', 'a.MILL_ID', 'ugl.USERGRP_ID')

            //->select('cc.cost_center_name', 'ug.USERGRP_NAME' , 'ugl.UGLEVE_NAME','a.ASSOCIATION_NAME','a.ASSOCIATION_ID')
            ->leftjoin('cost_center as cc', 'u.cost_center_id', '=', 'cc.cost_center_id')
            ->leftjoin('sa_user_group as ug', 'u.user_group_id', '=', 'ug.USERGRP_ID')
            ->leftjoin('sa_ug_level as ugl', 'u.user_group_level_id', '=', 'ugl.UG_LEVEL_ID')
            ->leftjoin('ssm_associationsetup as a', 'u.center_id', '=', 'a.ASSOCIATION_ID')
            ->where('u.id', '=', $id)
            ->first();
    }

    public static function getActiveUser()
    {
        return DB::table('users')
            ->where('active_status', '=', 1)
            ->select('id', 'username')
            ->get();
    }

    public static function getCCTypeWiseActiveUser($id)
    {
        return DB::table('users')
            ->leftJoin('cost_center', 'users.cost_center_id', '=', 'cost_center.cost_center_id')
            ->where('cost_center.cost_center_type', '=', $id)
//            ->select('id','username','email','contact_no','cost_center_id')
            ->where('users.active_status', '=', 1)
            ->get();
    }

    public static function getCostCenterActiveUser($id)
    {
        return DB::table('users')->where('cost_center_id', '=', $id)
            ->select('id', 'username', 'email', 'contact_no', 'cost_center_id')
            ->where('users.active_status', '=', 1)
            ->get();
    }

    public static function getMailReceiver($id)
    {
        return DB::table('users')->where('id', '=', $id)
            ->select('id', 'email')
            ->get();
    }

    public static function getData($millerId)
    {
        $isMiller = false;
        if(Auth::user()->user_group_id == $millerId) $isMiller = true;
        $data = DB::table('users as u')
            ->select('u.*', 'cc.cost_center_name', 'ug.USERGRP_NAME', 'ugl.UGLEVE_NAME', 'a.ASSOCIATION_NAME', 'a.ASSOCIATION_ID', 'ugl.POSITIONLEVEl', 'ugl.USERGRP_ID')
            ->leftjoin('cost_center as cc', 'u.cost_center_id', '=', 'cc.cost_center_id')
            ->leftjoin('sa_user_group as ug', 'u.user_group_id', '=', 'ug.USERGRP_ID')
            ->leftjoin('sa_ug_level as ugl', 'u.user_group_level_id', '=', 'ugl.UG_LEVEL_ID')
            ->leftjoin('ssm_associationsetup as a', 'u.center_id', '=', 'a.ASSOCIATION_ID');
        if($isMiller) $data->where('u.center_id', '=', Auth::user()->center_id);

        return $data->orderBy('u.id', 'DESC')->get();
    }

    public static function viewData($id)
    {
        return DB::table('users')
            //  ->leftJoin('cost_center', 'users.cost_center_id', '=', 'cost_center.cost_center_id')
            //  ->leftJoin('cost_center_type', 'users.cost_center_type', '=', 'cost_center_type.cost_center_type_id')
            //   ->leftJoin('lookup_group_data', 'users.designation_id', '=', 'lookup_group_data.lookup_group_data_id')
            ->leftJoin('ssm_associationsetup', 'users.center_id', '=', 'ssm_associationsetup.ASSOCIATION_ID')
            ->where('id', '=', $id)
            ->select('users.*', 'ssm_associationsetup.ASSOCIATION_NAME')
            ->first();
    }

    public static function insertData($data)
    {
        return DB::table('users')->insertGetId($data);
    }

    public static function editData($id)
    {
        return DB::table('users')
            // ->leftJoin('bank_branch', 'users.branch_id', '=', 'bank_branch.bank_branch_id')
            //  ->leftJoin('lookup_group_data', 'users.designation_id', '=', 'lookup_group_data.lookup_group_data_id')
            ->leftJoin('sa_ug_level', 'users.user_group_level_id', '=', 'sa_ug_level.UG_LEVEL_ID')
            ->leftjoin('ssm_associationsetup', 'users.center_id', '=', 'ssm_associationsetup.ASSOCIATION_ID')
            ->where('id', '=', $id)
            ->select('users.*', 'sa_ug_level.UG_LEVEL_ID', 'sa_ug_level.UGLEVE_NAME', 'ssm_associationsetup.ASSOCIATION_NAME', 'ssm_associationsetup.ASSOCIATION_ID')
            ->first();
    }

    public static function updateData($request, $id, $user_image, $userSignatureName, $millerId, $hasUpdateEmail=false)
    {
        $data = array(
            'user_full_name' => $request['user_full_name'],
            'designation' => $request['designation'],
            'username' => $request['username'],
            'email' => $request['email'],
            'remarks' => $request->input('remarks'),
            'user_group_id' => $request->input('user_group_id'),
            'user_group_level_id' => $request->input('user_group_level_id'),
            'address' => $request->input('address'),
            'contact_no' => $request->input('contact_no'),
            'active_status' => $request->input('active_status'),
            'user_image' => $user_image,
            'user_signature' => $userSignatureName,
            'center_id' => $request->input('center_id'),
            'update_by' => Auth::user()->id,
            'update_at' => date("Y-m-d h:i:s")
        );

        if($request->input('user_group_id')==$millerId) $data['center_id'] = $request->input('center_id'); // 22 as Miller Id as Group level id
        if ($hasUpdateEmail) $data['mail_verified'] = 0;
        if ($request['password'] != '') $data['password'] = Hash::make($request['password']);

        $update = DB::table('users')->where('id', '=', $id)->update($data);
        return $update;
    }

    public static function deleteData($id)
    {
        return DB::table('users')->where('id', $id)->delete();
    }

    public static function getSaaoDetails($ccId)
    {
        return DB::table('users')
            ->where('cost_center_id', '=', $ccId)
            ->get();
    }

    public static function passwordReset($request)
    {
        $updatePassword = DB::table('users')->where('email', '=', $request['email'])->update([
            //'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return $updatePassword;
    }

    public static function userInfoByCenterId($centerId = null)
    {
        if (empty($centerId)) $centerId = Auth::user()->center_id;
        $data = DB::table('users')
            ->where('users.center_id', '=', $centerId)
            ->first();
        return $data;
    }

    public static function extendDateByCenterId($centerId = null)
    {
        if (empty($centerId)) $centerId = Auth::user()->center_id;
        $extendDate = DB::table('users')
            ->leftJoin('ssm_associationsetup as asc', 'users.center_id', '=', 'asc.ASSOCIATION_ID')
            ->leftJoin('ssm_mill_info as smi', 'asc.MILL_ID', '=', 'smi.MILL_ID')
            ->where('users.center_id', '=', $centerId)
            ->whereNotNull('smi.extend_date')
            ->pluck('smi.extend_date')
            ->first();
        return $extendDate;
    }

    public static function getDuplicateEmail($email)
    {
        return DB::table('users')->select('users.email')->where('users.email', '=', $email)->first();
    }

}
