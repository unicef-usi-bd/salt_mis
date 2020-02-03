<?php

namespace App\Http\Controllers;
use App\Bank;
use App\CostCenter;
use App\LookupGroupData;
use App\Mail\VerifyMail;
use App\UserGroup;
use App\UserGroupLevel;
use App\VerifyUser;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use UxWeb\SweetAlert\SweetAlert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\SendMailable;
use App\User;
use File;
use Illuminate\Support\Facades\Route;
use App\AssociationSetup;
use Intervention\Image\ImageManagerStatic as Image;

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
//        dd(session()->all());
        $users = User::getData();
//        $this->pr($users);

        return view('setup.generalSetup.users.userIndex',compact( 'users','heading','previllage'));
    }

    public function verifyUser($token){
        $verifyUser = VerifyUser::where('token', $token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser->user;
            if(!$user->verified) {
                $verifyUser->user->mail_verified = 1;
                $verifyUser->user->save();
                $status = "Your e-mail is verified. You can now login.";
            }else{
                $status = "Your e-mail is already verified. You can now login.";
            }
        }else{
            return redirect('/')->with('warning', "Sorry your email cannot be identified.");
        }

        return redirect('/')->with('status', $status);
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
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            //'designation_id' => 'required',
            'user_group_id' => 'required',
            'user_group_level_id' => 'required',
            //'contact_no' => 'nullable|unique:users|regex:/^(?:\+?88)?01[15-9]\d{8}$/'
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

            //for user image*************
            //$userImageName = 'defaultUserImage.png';
            if($request->file('user_image')!=null && $request->file('user_image')->isValid()) {
//                try {
//                    $file = $request->file('user_image');
//                    $tempName = strtolower(str_replace(' ', '', $request->input('user_image')));
//                    $userImageName = $tempName.date("Y-m-d")."_".time().'.' . $file->getClientOriginalExtension();
//
//                    $request->file('user_image')->move("image/user-image/", $userImageName);
//                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
//
//                }

                $image = $request->file('user_image');
                $filename = date('Y-m-d').'_'.time() . '.' . $image->getClientOriginalExtension();
                $path = 'image/user-image/' . $filename;
                Image::make($image->getRealPath())->resize(250, 250)->save($path);
                //********* End Image *********
                $user_image = "image/user-image/$filename";
            }else{
                $user_image = 'image/user-image/defaultUserImage.png';
            }

            //for user signature*************
            //$userSignatureName = 'defaultUserSignature.png';
            if($request->file('user_signature')!=null && $request->file('user_signature')->isValid()) {
//                try {
//                    $file = $request->file('user_signature');
//                    $tempName = strtolower(str_replace(' ', '', $request->input('user_signature')));
//                    $userSignatureName = $tempName.date("Y-m-d")."_".time().'.' . $file->getClientOriginalExtension();
//
//                    $request->file('user_signature')->move("image/user-signature/", $userSignatureName);
//                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
//
//                }
                $signature = $request->file('user_signature');
                $filename = date('Y-m-d').'_'.time() . '.' . $signature->getClientOriginalExtension();
                $path = 'image/user-signature/' . $filename;
                Image::make($signature->getRealPath())->resize(135, 50)->save($path);
                //********* End Image *********
                $user_signature = "image/user-signature/$filename";
            }else{
                $user_signature = 'image/user-signature/defaultUserSignature.png';
            }


            $data = array(
                'user_full_name' => $request['user_full_name'],
                'designation' => $request['designation'],
                'username' => $request['username'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'remember_token' => $request->input('_token'),
                'remarks' => $request->input('remarks'),
                'user_group_id' => $request->input('user_group_id'),
                'user_group_level_id' => $request->input('user_group_level_id'),
                'address' => $request->input('address'),
                'contact_no' => $request->input('contact_no'),
                'renewing_date' => date('Y-m-d'),
                'active_status' => 1,
//                'user_image' => 'image/user-image/'.$userImageName,
                'user_image' => $user_image,
//                'user_signature' => 'image/user-signature/'.$userSignatureName,
                'user_signature' => $user_signature,
                'center_id' => $request->input('center_id'),
                'create_by' => Auth::user()->id
            );

            dd($data);

            $userCreateId = User::insertData($data);

            if ($userCreateId) {
                $user = User::find($userCreateId);
                VerifyUser::create([
                    'user_id' => $userCreateId,
                    'token' => str_random(40)
                ]);

                Mail::to($user->email)->send(new VerifyMail($user));

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
              //'email' => 'nullable|string|email|max:255',
              
              //'cost_center_id' => 'required',
//            'designation_id' => 'required',
             //'contact_no' => 'nullable|regex:/^(?:\+?88)?01[15-9]\d{8}$/'
            );
        }else{
             $rules = array(
                 'user_full_name' =>'required|string|max:100',
                 'username' => 'required|string|max:100',
                 //'email' => 'required|string|email|max:255',
                 //'email' => 'nullable|string|email|max:255',
                 
                 //'cost_center_id' => 'required',
                 //'designation_id' => 'required',
                 'user_group_id' => 'required',
                 //'designation_id' => 'required',
                 //'contact_no' => 'nullable|regex:/^(?:\+?88)?01[15-9]\d{8}$/'
            );
        }
        $error = array(
            'password.required' => 'The Password field is required. Use minimum 6 character',
            'user_group_id.required' => 'The user group field is required.'
        );
        $validator = Validator::make(Input::all(), $rules, $error);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->all()]);
        } else {
            //for user image*************
            //$userImageName = 'defaultUserImage.png';
            if($request->file('user_image')!=null && $request->file('user_image')->isValid()) {

                $image_path = $editUser->user_image;  // Value is not URL but directory file path
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }//use for delete existing image

                $image = $request->file('user_image');
                $filename = date('Y-m-d').'_'.time() . '.' . $image->getClientOriginalExtension();
                $path = 'image/user-image/' . $filename;
                Image::make($image->getRealPath())->resize(250, 250)->save($path);
                //********* End Image *********
                $user_image = "image/user-image/$filename";
            }else{
                $user_image = 'image/user-image/defaultUserImage.png';
                $user_image = $editUser->user_image;
            }
            //for user signature*************
            //$userSignatureName = 'defaultUserSignature.png';
            if($request->file('user_signature')!=null && $request->file('user_signature')->isValid()) {

                $signature_path = $editUser->user_signature;  // Value is not URL but directory file path
                if(File::exists($signature_path)) {
                    File::delete($signature_path);
                }//use for delete existing image

                $signature = $request->file('user_signature');
                $filename = date('Y-m-d').'_'.time() . '.' . $signature->getClientOriginalExtension();
                $path = 'image/user-signature/' . $filename;
                Image::make($signature->getRealPath())->resize(135, 50)->save($path);
                //********* End Image *********
                $userSignatureName = "image/user-signature/$filename";
            }else{
                //$userSignatureName = 'image/user-signature/defaultUserSignature.png';
                $userSignatureName = $editUser->user_signature;
            }

//            $userUpdate = User::updateData($request, $id,$userImageName,$userSignatureName);
            User::updateData($request, $id, $user_image, $userSignatureName);

        }
        //session()->flash('message','User Successfully Updated');
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

    public function getEmailDuplicateOrNot(Request $request)
    {
        $email = $request->input('email');
        $emailDup = User::getDuplicateEmail($email);

        if ($emailDup) {
            echo 'yes';
        } else {
            echo 'no';
        }
        exit;
        //  return view("reportView.createUser",compact('emailList','email'))->render();

    }

}
