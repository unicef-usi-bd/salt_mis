<?php

namespace App\Http\Controllers;

use App\Item;
use App\LookupGroup;
use App\LookupGroupData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


class ItemController extends Controller
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
        $title = 'Item Setup';

        $heading=array(
            'title'=> $title,
            'library'=>'datatable',
            'modalSize'=>'modal-md',
            'action'=>'item/create',
            'createPermissionLevel' => $previllage->CREATE
        );
        $items = Item::getItemData();

        return view('setup.item.itemIndex',compact('heading','previllage','items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $itemTypes = LookupGroupData::getActiveGroupDataByLookupGroup($this->itemTypeId);
        return view('setup.item.modals.createItem',compact('itemTypes'));
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
            'ITEM_TYPE' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {
            $data = array([
                'ITEM_TYPE' => $request->input('ITEM_TYPE'),
                'ITEM_NAME' => $request->input('ITEM_NAME'),
                'center_id' => Auth::user()->center_id,
                'ACTIVE_FLG' => $request->input('ACTIVE_FLG'),
                'ENTRY_BY' => Auth::user()->id
            ]);

            $item = Item::insertItemData($data);

            if($item){
                return redirect('/item')->with('success', 'Item Data Created !');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $viewItem = Item::viewItemData($id);
        return view('setup.item.modals.viewItem',compact('viewItem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editItem = Item::editItemData($id);
        $itemTypes = LookupGroupData::getActiveGroupDataByLookupGroup($this->itemTypeId);
        return view('setup.item.modals.editItem',compact('editItem','itemTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'ITEM_TYPE' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {
            $updateItem = Item::updateItemData($request,$id);
            if($updateItem){
                return redirect('/item')->with('success', 'Item Data Updated !');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Item::deleteItemData($id);
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
