<?php

namespace App\Http\Controllers;

use App\LookupGroupData;
use App\Monitoring;
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

class MonitoringController extends Controller
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
        $title = trans('Create Monitoring ');

        $heading=array(
            'title'=> $title,
            'library'=>'datatable',
            'modalSize'=>'modal-md',
            'action'=>'monitoring/create',
            'createPermissionLevel' => $previllage->CREATE
        );

        $monitoring = Monitoring::getMonitorData();

        //print_r($lookupGroups);exit;
        return view('setup.monitoring.monitoringIndex', compact( 'heading','previllage','monitoring'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agencyList = LookupGroupData::getActiveGroupDataByLookupGroup($this->agencyId);
       // $this->pr($agencyList);
        return view('setup.monitoring.modals.createMonitoring',compact('agencyList'));
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
            'AGENCY_ID' => 'required|integer'

        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {
           $data = array([
                'AGENCY_ID' => $request->input('AGENCY_ID'),
                'MOMITOR_DATE' =>date('Y-m-d', strtotime($request->input('MOMITOR_DATE'))),
                'REMARKS' => $request->input('REMARKS'),
                //'active_status' => $request->input('active_status'),
                //'ACTIVE_FLG' => $request->input('ACTIVE_FLG'),
                'ENTRY_BY' => Auth::user()->id,
                'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
           ]);


            $createMonitoring = Monitoring::insertIntoMonitor($data);
               
            if($createMonitoring){
    //            return response()->json(['success'=>'Lookup Group Successfully Saved']);
                //return json_encode('Success');
                return redirect('/monitoring')->with('success', 'Monitoring Has been Created !');
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
         $viewMonitoring = Monitoring::showMonitorData($id);

        return view('setup.monitoring.modals.viewMonitoring',compact( 'heading','previllage','viewMonitoring'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
     {
         $editMonitoring = Monitoring::editMonitorData($id);
         $agencyName = Monitoring::agencyName();
        return view('setup.monitoring.modals.editMonitoring' , compact('editMonitoring','agencyName'));

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
        //print_r($request->input());exit();

        $rules = array(
            'AGENCY_ID' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {
        $updateMonitoringData = Monitoring::updateMonitorData($request, $id);
            if($updateMonitoringData){
                return redirect('/monitoring')->with('success', 'Monitoring Data Updated !');
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
        $delete = Monitoring::deleteMonitorData($id);
        if($delete){
            echo json_encode([
                'type' => 'tr',
                'id' => $id,
                'flag' => true,
                'message' => 'Monitor Data Successfully Deleted.',
            ]);
        } else{
            echo json_encode([
                'message' => 'Error Founded Here!',
            ]);
        }


    }

}
