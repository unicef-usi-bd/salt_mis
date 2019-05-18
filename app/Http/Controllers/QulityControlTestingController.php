<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\LookupGroupData;
use App\Iodized;
use App\BstiTestStandard;
use App\QulityControlTesting;
use App\BstiTestResultRange;

class QulityControlTestingController extends Controller
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
        $heading=array(
            'title'=>'Quality Control & Testing',
            'library'=>'datatable',
            'modalSize'=>'modal-bg',
            'action'=>'quality-control-testing/create',
            'createPermissionLevel' => $previllage->CREATE
        );

       $qualityControl = QulityControlTesting::getQualityControlData();
       $qualityControlResultRange = BstiTestResultRange::getBstiTestResultDataRangeForPassOrFail();

//       $this->pr($qualityControlResultRange);
        return view('transactions.qualityControlAndTesting.qualityControlTestingIndex',compact('heading','previllage','qualityControl','qualityControlResultRange'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agencyId = LookupGroupData::getActiveGroupDataByLookupGroup($this->agencyId);
        $qulityControlId = LookupGroupData::getActiveGroupDataByLookupGroup($this->qualityControlId);
        $iodizeBatch = Iodized::getIodizeBatchId();
        $bstiChemicalData = BstiTestStandard::getBstiChemicalData();
        return view('transactions.qualityControlAndTesting.modals.createQualityControlAndTesting',compact('agencyId','qulityControlId','iodizeBatch','bstiChemicalData'));
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
            'QC_TESTNAME' => 'required',


        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {
           // $this->pr($request->file('QUALITY_CONTROL_IMAGE'));
            //$qulityControlImge = '';
            if($request->file('QUALITY_CONTROL_IMAGE')!=null && $request->file('QUALITY_CONTROL_IMAGE')->isValid()) {
                try {
                    $file = $request->file('QUALITY_CONTROL_IMAGE');
                    $tempName = strtolower(str_replace(' ', '', $request->input('QUALITY_CONTROL_IMAGE')));
                    $qulityControlImge = $tempName.date("Y-m-d")."_".time().'.' . $file->getClientOriginalExtension();

                    $request->file('QUALITY_CONTROL_IMAGE')->move("image/testimage/", $qulityControlImge);
                } catch (Illuminate\Filesystem\FileNotFoundException $e) {

                }
            }

            $data = array([
                'QC_DATE' =>date('Y-m-d', strtotime(Input::get('QC_DATE'))),
                'QC_BY' =>$request->input('QC_BY'),
                'AGENCY_ID' =>$request->input('AGENCY_ID'),
                'BATCH_NO' =>$request->input('BATCH_NO'),
                'QC_TESTNAME' =>$request->input('QC_TESTNAME'),
                'QUALITY_CONTROL_IMAGE' => 'image/testimage/'.$qulityControlImge,
                'REMARKS' => $request->input('REMARKS'),
                'SODIUM_CHLORIDE' =>$request->input('SODIUM_CHLORIDE'),
                'MOISTURIZER' =>$request->input('MOISTURIZER'),
                'IODINE_CONTENT' =>$request->input('IODINE_CONTENT'),
                'PH' =>$request->input('PH'),
                'center_id' => Auth::user()->center_id,
                'ENTRY_BY' => Auth::user()->id,
                'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
            ]);


            //$this->pr($request->input());
            $qualityControlTestingInsert = QulityControlTesting::insertQualityControlTestingData($data);

            if($qualityControlTestingInsert){
                //            return response()->json(['success'=>'Lookup Group Successfully Saved']);
                //return json_encode('Success');
                return redirect('/quality-control-testing')->with('success', 'Quality  Control & Testing Has been Created !');
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
        $viewQualityConteol = QulityControlTesting::showQualityConteolTestingDatya($id);
        return view('transactions.qualityControlAndTesting.modals.viewQualityControlTesting',compact('viewQualityConteol'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editQualityControl = QulityControlTesting::editQualityConteolTestingDatya($id);
        $agencyId = LookupGroupData::getActiveGroupDataByLookupGroup($this->agencyId);
        $qulityControlId = LookupGroupData::getActiveGroupDataByLookupGroup($this->qualityControlId);
        $iodizeBatch = Iodized::getIodizeBatchId();
        $bstiChemicalData = BstiTestStandard::getBstiChemicalData();
        //$this->pr($editQualityControl);
        return view('transactions.qualityControlAndTesting.modals.editQualityControlTesting',compact('editQualityControl','agencyId','qulityControlId','iodizeBatch','bstiChemicalData'));
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
            'QC_TESTNAME' => 'required',


        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {
            // $this->pr($request->file('QUALITY_CONTROL_IMAGE'));
            $qulityControlImge = '';
            if($request->file('QUALITY_CONTROL_IMAGE')!=null && $request->file('QUALITY_CONTROL_IMAGE')->isValid()) {
                try {
                    $file = $request->file('QUALITY_CONTROL_IMAGE');
                    $tempName = strtolower(str_replace(' ', '', $request->input('QUALITY_CONTROL_IMAGE')));
                    $qulityControlImge = $tempName.date("Y-m-d")."_".time().'.' . $file->getClientOriginalExtension();

                    //$file->move("image/testimage/", $qulityControlImge);
                    $request->file('QUALITY_CONTROL_IMAGE')->move("image/testimage/", $qulityControlImge);
                } catch (Illuminate\Filesystem\FileNotFoundException $e) {

                }
            }




            //$this->pr($request->input());
            $qualityControlTestingUpdate = QulityControlTesting::updateQualityControlTestingData($request,$id,$qulityControlImge);

            if($qualityControlTestingUpdate){
                //            return response()->json(['success'=>'Lookup Group Successfully Saved']);
                //return json_encode('Success');
                return redirect('/quality-control-testing')->with('success', 'Quality  Control & Testing Has been Updated !');
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
        $delete = QulityControlTesting::deleteQualityControlTestingData($id);

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
