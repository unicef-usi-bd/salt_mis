<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\LookupGroupData;
use App\Iodized;
use App\BstiTestStandard;
use App\QulityControlTesting;

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

        //$chemicalPuchase = ChemicalPurchase::chemicalPurchase();
        return view('transactions.qualityControlAndTesting.qualityControlTestingIndex',compact('heading','previllage'));
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
            'RCV_QTY' => 'required',


        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {
            $qulityControlImge = '';
            if($request->file('quality-control-testing')!=null && $request->file('quality-control-testing')->isValid()) {
                try {
                    $file = $request->file('quality-control-testing');
                    $tempName = strtolower(str_replace(' ', '', $request->input('quality-control-testing')));
                    $qulityControlImge = $tempName.date("Y-m-d")."_".time().'.' . $file->getClientOriginalExtension();

                    $request->file('user_image')->move("image/quality-control-testing/", $qulityControlImge);
                } catch (Illuminate\Filesystem\FileNotFoundException $e) {

                }
            }
            $data = array([
                'QC_DATE' =>$request->input('QC_DATE'),
                'QC_BY' =>$request->input('QC_BY'),
                'AGENCY_ID' =>$request->input('AGENCY_ID'),
                'BATCH_NO' =>$request->input('BATCH_NO'),
                'QC_TESTNAME' =>$request->input('QC_TESTNAME'),
                'QUALITY_CONTROL_IMAGE' => 'image/quality-control-testing/'.$qulityControlImge,
            ]);


            //$this->pr($request->input());
            $qualityControlTestingInsert = QulityControlTesting::insertQualityControlTestingData($data);

            if($qualityControlTestingInsert){
                //            return response()->json(['success'=>'Lookup Group Successfully Saved']);
                //return json_encode('Success');
                return redirect('/quality-control-testing')->with('success', 'Quality  Purchase Has been Created !');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
