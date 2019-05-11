<?php

namespace App\Http\Controllers;
use App\Bank;
use App\CostCenter;
use App\LookupGroupData;
use App\UserGroup;
use App\UserGroupLevel;
use Illuminate\Http\Request;
use UxWeb\SweetAlert\SweetAlert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use App\User;
use File;
use Illuminate\Support\Facades\Route;
use App\AssociationSetup;


class UserController extends Controller
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

        $userCreate = trans('user.create_user');
        $heading=array(
            'title'=>$userCreate,
            'library'=>'datatable',
            'modalSize'=>'modal-lg',
            'action'=>'users/create',
            'createPermissionLevel' => $previllage->CREATE
        );
        //dd(session()->all());
        $users = User::getData();
//        $this->pr($users);

        return view('setup.generalSetup.users.userIndex',compact( 'users','heading','previllage'));
    }
    
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userGroups = UserGroup::getActiveData();
        $associationCenter = AssociationSetup::getAssociationCenterData();
//        $this->pr($userGroups);
        //$banks = Bank::getActiveBanks();
//        $costCenters = CostCenter::getActiveCostCenter();
//        $this->pr($costCenters);
//        $designations = LookupGroupData::getActiveGroupDataByLookupGroup($this->designationId);
        return view('setup.generalSetup.users.modals.createUser ',compact('costCenters','designations','banks', 'userGroups','associationCenter'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'user_full_name' =>'required|string|max:100',
            'username' => 'required|string|unique:users|max:100',
            //'email' => 'required|string|email|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
          //  'cost_center_id' => 'required',
            //'designation_id' => 'required',
            'user_group_id' => 'required',
            'user_group_level_id' => 'required',
            'contact_no' => 'nullable|unique:users|regex:/^(?:\+?88)?01[15-9]\d{8}$/'
        );
        $error = array(
            'password.required' => 'The Password field is required. Use minimum 6 character',
            'user_group_id.required' => 'The user group field is required.',
            'user_group_level_id.required' => 'The user group level field is required.'
        );
        $validator = Validator::make(Input::all(), $rules, $error);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }else {
         //  $costCenter= CostCenter::costCenterDetailsById($request->input('cost_center_id'));

            //for user image*************
            $userImageName = 'defaultUserImage.png';
            if($request->file('user_image')!=null && $request->file('user_image')->isValid()) {
                try {
                    $file = $request->file('user_image');
                    $tempName = strtolower(str_replace(' ', '', $request->input('user_image')));
                    $userImageName = $tempName.date("Y-m-d")."_".time().'.' . $file->getClientOriginalExtension();

                    $request->file('user_image')->move("image/user-image/", $userImageName);
                } catch (Illuminate\Filesystem\FileNotFoundException $e) {

                }
            }

            //for user signature*************
            $userSignatureName = 'defaultUserSignature.png';
            if($request->file('user_signature')!=null && $request->file('user_signature')->isValid()) {
                try {
                    $file = $request->file('user_signature');
                    $tempName = strtolower(str_replace(' ', '', $request->input('user_signature')));
                    $userSignatureName = $tempName.date("Y-m-d")."_".time().'.' . $file->getClientOriginalExtension();

                    $request->file('user_signature')->move("image/user-signature/", $userSignatureName);
                } catch (Illuminate\Filesystem\FileNotFoundException $e) {

                }
            }


            $data = array([
                'user_full_name' => $request['user_full_name'],
                'user_full_name_bn' => $request['user_full_name_bn'],
                'username' => $request['username'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'remember_token' => $request->input('_token'),
                'remarks' => $request->input('remarks'),
                'user_group_id' => $request->input('user_group_id'),
                'user_group_level_id' => $request->input('user_group_level_id'),
              //  'cost_center_id' => $request->input('cost_center_id'),
              //  'cost_center_type' => $costCenter->cost_center_type,
              //  'designation_id' => $request->input('designation_id'),
             //   'bank_id' => $request->input('bank_id'),
              //  'branch_id' => $request->input('branch_id'),
             //   'account_no' => $request->input('account_no'),
             //  //'route_no' => $request->input('route_no'),
                'address' => $request->input('address'),
                'contact_no' => $request->input('contact_no'),
                //'active_status' => $request->input('active_status'),
                'active_status' => 1,
                'user_image' => 'image/user-image/'.$userImageName,
                'user_signature' => 'image/user-signature/'.$userSignatureName,
                'center_id' => $request->input('center_id'),
                'create_by' => Auth::user()->id
            ]);

            //$this->pr($data);

            $userCreate = User::insertData($data);

            if ($userCreate) {
                //return response()->json(['success'=>'User Successfully Saved']);
                return redirect('/users')->with('success', 'User Successfully Saved');
               //return json_encode('Success');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userView = User::viewData($id);

        return view('setup.generalSetup.users.modals.viewUser ', compact('userView'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userGroups = UserGroup::getActiveData();
      //  $banks = Bank::getActiveBanks();
        $editData = User::editData($id);
      //  $costCenters = CostCenter::getActiveCostCenter();
     //   $designations = LookupGroupData::getActiveGroupDataByLookupGroup($this->designationId);
        $userGroupLevels = UserGroupLevel::getActiveUGL($editData->user_group_id);
        $associationCenter = AssociationSetup::getAssociationCenterData();
//        $this->pr($userGroupLevels);
        return view('setup.generalSetup.users.modals.editUser ', compact('editData','costCenters','designations', 'banks', 'userGroups', 'userGroupLevels','associationCenter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $editUser = User::editData($id);
        if ($editUser->user_full_name == $request->input('user_full_name')) {
            $rules = array(
            'user_full_name' =>'required|string|max:100',    
             'username' => 'required|string|max:100',
//            'email' => 'required|string|email|max:255',
              'email' => 'nullable|string|email|max:255',
              
              //'cost_center_id' => 'required',
//            'designation_id' => 'required',
             'contact_no' => 'nullable|regex:/^(?:\+?88)?01[15-9]\d{8}$/'
        );
        }else{
             $rules = array(
                 'user_full_name' =>'required|string|max:100',
                 'username' => 'required|string|max:100',
                 //'email' => 'required|string|email|max:255',
                 'email' => 'nullable|string|email|max:255',
                 
                 //'cost_center_id' => 'required',
                 //'designation_id' => 'required',
                 'user_group_id' => 'required',
                 //'designation_id' => 'required',
                 'contact_no' => 'nullable|regex:/^(?:\+?88)?01[15-9]\d{8}$/'
        );
        }
        $error = array(
            'password.required' => 'The Password field is required. Use minimum 6 character',
            'user_group_id.required' => 'The user group field is required.'
        );
        $validator = Validator::make(Input::all(), $rules, $error);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }else {

            $image_path = $editUser->user_image;  // Value is not URL but directory file path
            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            $signature_path = $editUser->user_signature;  // Value is not URL but directory file path
            if(File::exists($signature_path)) {
                File::delete($signature_path);
            }

            //for user image*************
            $userImageName = 'defaultUserImage.png';
            if($request->file('user_image')!=null && $request->file('user_image')->isValid()) {
                try {
                    $file = $request->file('user_image');
                    $tempName = strtolower(str_replace(' ', '', $request->input('user_image')));
                    $userImageName = $tempName.date("Y-m-d")."_".time().'.' . $file->getClientOriginalExtension();

                    $request->file('user_image')->move("image/user-image/", $userImageName);
                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
//                    return false;
                }
            }

            //for user signature*************
            $userSignatureName = 'defaultUserSignature.png';
            if($request->file('user_signature')!=null && $request->file('user_signature')->isValid()) {
                try {
                    $file = $request->file('user_signature');
                    $tempName = strtolower(str_replace(' ', '', $request->input('user_signature')));
                    $userSignatureName = $tempName.date("Y-m-d")."_".time().'.' . $file->getClientOriginalExtension();

                    $request->file('user_signature')->move("image/user-signature/", $userSignatureName);
                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
//                    return false;
                }
            }

            $userUpdate = User::updateData($request, $id,$userImageName,$userSignatureName);

        }

            //session()->flash('message','User Successfully Updated');
            //return json_encode('Success');
        return redirect('/users')->with('success', 'User Successfully Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = User::deleteData($id);
        if($delete){
            echo json_encode([
                'type' => 'tr',
                'id' => $id,
                'flag' => true,
                'message' => 'Level Successfully Deleted.',
            ]);
        } else{
            echo json_encode([
                'message' => 'Error Founded Here!',
            ]);
        }
    }

    public function resetPassword(Request $request){//this function use for reset password

       $emailSubject = 'Password Reset Details';
       $email_body = '<p>Your Password Successfully Reset.</p>Here is your new password: '.$request->input('password');
       $passwordReset = User::passwordReset($request);

        $data = [
            'email_subject' => $emailSubject,
            'email_body' => $email_body,
            'user_email_address' => $request->input('email'),
        ];

        \Mail::to($data['user_email_address'])
            ->send(new SendMailable($data));



       return redirect('/login');

    }

    public function userPasswordChange(){

        return view('setup.generalSetup.users.modals.changeUserPassword');
    }



    public function userChangePasswordPost(Request $request)
    {
        $rules = array(
            'old_password' => 'required',
            'password' => 'required|same:password',
            'password_confirmation' => 'required|same:password',
        );
        $error = array(
            'old_password.required' => 'Please enter current password',
            'password.required' => 'Please enter new password',
            'password_confirmation.same' => 'The new password and confirmation password do not match.'
        );
        $validator = Validator::make(Input::all(), $rules, $error);
        if(Auth::Check())
        {
            $request_data = $request->All();

            if($validator->fails())
            {
                return response()->json(['errors'=>$validator->errors()->all()]);

            }
            else
            {
                $current_password = Auth::User()->password;
                if(Hash::check($request_data['old_password'], $current_password))
                {
                    $user_id = Auth::User()->id;
                    $obj_user = User::find($user_id);
                    $obj_user->password = Hash::make($request_data['password']);;
                    $obj_user->save();
                    return response()->json(['success'=>'Password Successfully Updated']);

                }
                else
                {
                    return response()->json(['errors' => array('Please enter correct current password')]);
                }
            }
        }
        else
        {
            return redirect()->to('/');
        }
    }

}
