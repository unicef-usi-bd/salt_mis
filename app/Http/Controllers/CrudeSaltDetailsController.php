<?php

namespace App\Http\Controllers;

use App\CrudeSaltDetails;
use App\Item;
use App\LookupGroupData;
use Illuminate\Http\Request;
use App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\LookupGroup;
use UxWeb\SweetAlert\SweetAlert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class CrudeSaltDetailsController extends Controller
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

//        $title = trans('lookupGroupIndex.create_lookup');
        $title = trans('Crude Salt Create');

        $heading=array(
            'title'=> $title,
            'library'=>'datatable',
            'modalSize'=>'modal-md',
            'action'=>'crude-salt-details/create',
            'createPermissionLevel' => $previllage->CREATE
        );

        $crudeSalts = CrudeSaltDetails::getAllCrudDetailsData();

        //print_r($lookupGroups);exit;
        return view('setup.crudeSalt.crudeSaltIndex', compact( 'heading','previllage','crudeSalts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $crudSaltTypes = Item::itemTypeWiseItemList($this->crudSaltId);
        return view('setup.crudeSalt.modals.createCrudeSalt',compact('crudSaltTypes'));
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
            'CRUDSALT_TYPE_ID' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {
           $data = array([
                'CRUDSALT_TYPE_ID' => $request->input('CRUDSALT_TYPE_ID'),
                'SODIUM_CHLORIDE' => $request->input('SODIUM_CHLORIDE'),
                'MOISTURIZER' => $request->input('MOISTURIZER'),
                'PPM' => $request->input('PPM'),
                'PH' => $request->input('PH'),
                'ACTIVE_FLG' => $request->input('ACTIVE_FLG'),
                'ENTRY_BY' => Auth::user()->id
           ]);

            $crudSaltDetails = CrudeSaltDetails::insertCrudSaltDetailData($data);
               
            if($crudSaltDetails){
                return redirect('/crude-salt-details')->with('success', 'CRUD salt details Data Created !');
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
        $viewCrudSaltDetail = CrudeSaltDetails::viewCrudSaltDetailData($id);


        return view('setup.crudeSalt.modals.viewCrudeSalt',compact('viewCrudSaltDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
     {
         $editCrudSaltDetail = CrudeSaltDetails::editCrudSaltDetailData($id);
         $crudSaltTypes = Item::itemTypeWiseItemList($this->crudSaltId);
        return view('setup.crudeSalt.modals.editCrudeSalt' , compact('editCrudSaltDetail','crudSaltTypes'));

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
        $rules = array(
            'CRUDSALT_TYPE_ID' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {
        $updateCrudeSaltDetails = CrudeSaltDetails::updateCrudSaltDetailData($request, $id);
            if($updateCrudeSaltDetails){
                return redirect('/crude-salt-details')->with('success', 'Update Crude Salt Details Data Updated !');
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = CrudeSaltDetails::deleteCrudSaltDetail($id);
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
}
