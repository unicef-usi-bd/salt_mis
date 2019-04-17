<?php

namespace App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Organization extends Model
{
    protected $fillable = [
        'org_name',
        'org_address',
        'org_slogan',
        'org_logo',
        'email_address',
        'phone',
        'website',
        'fax',
        'active_status'
    ];

    public static function getActiveLender(){
        return DB::table('organizations')
            ->where('lender_status','=', 1)
            ->where('active_status', '=', 1)
            ->get();

    }

    public static function getOrgInfoForSession(){
        $orgInfo = DB::table('organizations')
            ->where('is_owner', '=', 1)
            ->first();
        return $orgInfo;
    }
    public static function getOwnerOrgInfo(){
        $orgInfo = DB::table('organizations')
            ->where('is_owner', '=', 1)
            ->first();
        return $orgInfo;
    }

    public static function getActiveOrganisation(){
        return DB::table('organizations')
            ->select('org_id', 'org_name')
            ->where('active_status', '=', 1)
            ->get();
    }

    public  static function getData(){
        return DB::table('organizations')
           // ->leftJoin('bank', 'organizations.bank_id', '=', 'bank.bank_id')
           // ->leftJoin('bank_branch', 'organizations.branch_id', '=', 'bank_branch.bank_branch_id')
            ->select('organizations.*')
            ->orderBy('organizations.org_id','DESC')
            ->get();
    }

    public  static function insertData($data){
        return DB::table('organizations')->insert($data);
    }

    public  static function viewData($id){
        return DB::table('organizations')
//            ->leftJoin('bank', 'organizations.bank_id', '=', 'bank.bank_id')
//            ->leftJoin('bank_branch', 'organizations.branch_id', '=', 'bank_branch.bank_branch_id')
            ->where('org_id', '=', $id)
            ->first();
    }

    public  static function editData($id){
        return DB::table('organizations')
          //  ->leftJoin('bank_branch', 'organizations.branch_id', '=', 'bank_branch.bank_branch_id')
            ->where('org_id', '=', $id)
            ->first();
    }

    public  static function updateData($request, $id, $imgName){
        $update = DB::table('organizations')->where('org_id', $id)->update([
            'org_name' => $request->input('org_name'),
            'lender_status' => $request->input('lender_status'),
            'org_address' => $request->input('org_address'),
            'org_slogan' => $request->input('org_slogan'),
            'org_logo' => 'image/organization/'.$imgName,
            'email_address' => $request->input('email_address'),
            'phone' => $request->input('phone'),
            'website' => $request->input('website'),
            'fax' => $request->input('fax'),
//            'bank_id' => $request->input('bank_id'),
//            'branch_id' => $request->input('branch_id'),
//            'account_no' => $request->input('account_no'),
//            'route_no' => $request->input('route_no'),
            'active_status' => $request->input('active_status'),
            //'active_status' => 1,
            'update_by' => Auth::user()->id,
            'update_at' => date("Y-m-d h:i:s")
        ]);
        return $update;
    }

    public  static function deleteData($id){
        return DB::table('organizations')->where('org_id', $id)->delete();
    }

}
