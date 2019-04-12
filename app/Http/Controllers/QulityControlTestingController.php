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
            'QC_TESTNAME' => 'required',


        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            //SweetAlert::error('Error','Something is Wrong !');
            return Redirect::back()->withErrors($validator);
        }else {
            $qulityControlImge = '';
            if($request->file('testimage')!=null && $request->file('testimage')->isValid()) {
                try {
                    $file = $request->file('testimage');
                    $tempName = strtolower(str_replace(' ', '', $request->input('testimage')));
                    $qulityControlImge = $tempName.date("Y-m-d")."_".time().'.' . $file->getClientOriginalExtension();

                    $request->file('testimage')->move("image/testimage/", $qulityControlImge);
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
                'ENTRY_BY' => Auth::user()->id,
                'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
            ]);


            //$this->pr($request->input());
            $qualityControlTestingInsert = QulityControlTesting::insertQualityControlTestingData($data);

            if($qualityControlTestingInsert){
                //            return response()->json(['success'=>'Lookup Group Successfully Saved']);
                //return json_encode('Success');
                return redirect('/testimage')->with('success', 'Quality  Purchase Has been Created !');
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
        return view('transactions.qualityControlAndTesting.modals.editQualityControlTesting',compact('editQualityControl'));
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
