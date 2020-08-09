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
use File;
use Intervention\Image\ImageManagerStatic as Image;

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

        if($qualityControlResultRange && sizeof($qualityControl)>0){
            foreach ($qualityControl as $quality){
                $quality->status = self::testPassOrFail($qualityControlResultRange, $quality);
            }
        }

//       $this->pr($qualityControlResultRange);
        return view('transactions.qualityControlAndTesting.qualityControlTestingIndex',compact('heading','previllage','qualityControl','qualityControlResultRange'));
    }

    public static function testPassOrFail($range, $quality){
        if($quality->SODIUM_CHLORIDE<$range->SODIUM_CHLORIDE_MIN || $quality->SODIUM_CHLORIDE>$range->SODIUM_CHLORIDE_MAX) return 'Fail';
        if($quality->MOISTURIZER<$range->MOISTURIZER_MIN || $quality->MOISTURIZER>$range->MOISTURIZER_MIN) return 'Fail';
        if($quality->IODINE_CONTENT<$range->PPM_MIN || $quality->IODINE_CONTENT>$range->PPM_MIN) return 'Fail';
        if($quality->PH<$range->PH_MIN || $quality->PH>$range->PH_MIN) return 'Fail';
        return 'Pass';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $filterBatch = array();
        $agencyId = LookupGroupData::getActiveGroupDataByLookupGroup($this->agencyId);
        $qulityControlId = LookupGroupData::getActiveGroupDataByLookupGroup($this->qualityControlId);
//        $iodizeBatch = Iodized::getIodizeBatchId();
        $qualityControlBatch= QulityControlTesting::getQualityControlBatchList();
        foreach ($qualityControlBatch as $batch){
            $filterBatch[] = $batch->BATCH_NO;
        }
        $iodizeBatch = Iodized::getIodizeBatchList($filterBatch);

        $bstiChemicalData = BstiTestStandard::getBstiChemicalData();

        $iodizeBatchIdByMonth = QulityControlTesting::iodizeBatchNo();

//        $this->pr($qualityControlBatch);
        return view('transactions.qualityControlAndTesting.modals.createQualityControlAndTesting',compact('agencyId','qulityControlId','iodizeBatch','bstiChemicalData','iodizeBatchIdByMonth'));
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
            'QC_BY' => 'required',
            'AGENCY_ID' => 'required',
            'BATCH_NO' => 'required',
            'QC_TESTNAME' => 'required',
            'QUALITY_CONTROL_IMAGE' => 'required',
            'SODIUM_CHLORIDE' => 'required',
            'MOISTURIZER' => 'required',
            'IODINE_CONTENT' => 'required',
            'PH' => 'required',
        );
        $error = array(
            'QC_BY.required' => 'Quality control by is required.',
            'AGENCY_ID.required' => 'Agency field is required.',
            'BATCH_NO.required' => 'Batch No field is required.',
            'QC_TESTNAME.required' => 'Test Name field is required.',
            'QUALITY_CONTROL_IMAGE.required' => 'Attachment file is required.',
            'SODIUM_CHLORIDE.required' => 'Sodium Chloride field is required.',
            'MOISTURIZER.required' => 'Moisturizer field is required.',
            'IODINE_CONTENT.required' => 'Iodin content field is required.',
            'PH.required' => 'PH field is required.',
        );

        $validator = Validator::make(Input::all(), $rules, $error);

        if ($validator->fails()) return response()->json(['errors'=>$validator->errors()->first()]);

        $qualityTestImage = null;
        if($request->file('QUALITY_CONTROL_IMAGE')!=null && $request->file('QUALITY_CONTROL_IMAGE')->isValid()) {
            $image = $request->file('QUALITY_CONTROL_IMAGE');
            $extension = $image->getClientOriginalExtension();
            //
            if($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "gif"){
                if($request->file('QUALITY_CONTROL_IMAGE')!=null && $request->file('QUALITY_CONTROL_IMAGE')->isValid()) {
                    $image = $request->file('QUALITY_CONTROL_IMAGE');
                    $filename = date('Y-m-d').'_'.time() . '.' . $extension;
                    $path = 'public/image/qualitycontrol/' . $filename;
                    Image::make($image->getRealPath())->resize(250, 250)->save($path);
                    //********* End Image *********
                    $qualityTestImage = "$filename";
                }else{
                    $qualityTestImage = 'defaultUserImage.png';
                }
            }else{
                return response()->json(['errors'=>'Attached file should be image [ jpeg, jpg, png, gif ].']);
            }
            // exit;
        }

        $data = array(
            'QC_DATE' =>date('Y-m-d', strtotime(Input::get('QC_DATE'))),
            'QC_BY' =>$request->input('QC_BY'),
            'AGENCY_ID' =>$request->input('AGENCY_ID'),
            'BATCH_NO' =>$request->input('BATCH_NO'),
            'QC_TESTNAME' =>$request->input('QC_TESTNAME'),
            'REMARKS' => $request->input('REMARKS'),
            'SODIUM_CHLORIDE' =>$request->input('SODIUM_CHLORIDE'),
            'MOISTURIZER' =>$request->input('MOISTURIZER'),
            'IODINE_CONTENT' =>$request->input('IODINE_CONTENT'),
            'PH' =>$request->input('PH'),
            'center_id' => Auth::user()->center_id,
            'ENTRY_BY' => Auth::user()->id,
            'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
        );

        if(!empty($qualityTestImage)) $data['QUALITY_CONTROL_IMAGE'] = 'public/image/qualitycontrol/'.$qualityTestImage;

        //$this->pr($request->input());
        $inserted = QulityControlTesting::insertQualityControlTestingData($data);

        if($inserted){
            return response()->json(['success'=>'Quality  Control & Testing submission completed.']);
        } else {
            return response()->json(['success'=>'Quality  Control & Testing submission failed.']);
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
            'QC_BY' => 'required',
            'AGENCY_ID' => 'required',
            'BATCH_NO' => 'required',
            'QC_TESTNAME' => 'required',
//            'QUALITY_CONTROL_IMAGE' => 'required',
            'SODIUM_CHLORIDE' => 'required',
            'MOISTURIZER' => 'required',
            'IODINE_CONTENT' => 'required',
            'PH' => 'required',
        );
        $error = array(
            'QC_BY.required' => 'Quality control by is required.',
            'AGENCY_ID.required' => 'Agency field is required.',
            'BATCH_NO.required' => 'Batch No field is required.',
            'QC_TESTNAME.required' => 'Test Name field is required.',
//            'QUALITY_CONTROL_IMAGE.required' => 'Attachment file is required.',
            'SODIUM_CHLORIDE.required' => 'Sodium Chloride field is required.',
            'MOISTURIZER.required' => 'Moisturizer field is required.',
            'IODINE_CONTENT.required' => 'Iodin content field is required.',
            'PH.required' => 'PH field is required.',
        );

        $validator = Validator::make(Input::all(), $rules, $error);

        if ($validator->fails()) return response()->json(['errors'=>$validator->errors()->first()]);
        $qualityTestImage = null;
        if($request->file('QUALITY_CONTROL_IMAGE')!=null && $request->file('QUALITY_CONTROL_IMAGE')->isValid()) {
            $image = $request->file('QUALITY_CONTROL_IMAGE');
            $extension = $image->getClientOriginalExtension();
            if($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "gif"){
                if($request->file('QUALITY_CONTROL_IMAGE')!=null && $request->file('QUALITY_CONTROL_IMAGE')->isValid()) {
                    $image = $request->file('QUALITY_CONTROL_IMAGE');
                    $filename = date('Y-m-d').'_'.time() . '.' . $image->getClientOriginalExtension();
                    $path = 'public/image/qualitycontrol/' . $filename;
                    Image::make($image->getRealPath())->resize(250, 250)->save($path);
                    //********* End Image *********
                    $qualityTestImage = "$filename";
                }else{
                    $qualityTestImage = 'defaultUserImage.png';
                }
            }else{
                return response()->json(['errors'=>'Attached file should be image [ jpeg, jpg, png, gif ].']);
//                try {
//                    $file = $request->file('QUALITY_CONTROL_IMAGE');
//                    $tempName = strtolower(str_replace(' ', '', $request->input('QUALITY_CONTROL_IMAGE')));
//                    $qualityTestImage = $tempName.date("Y-m-d")."_".time().'.' . $file->getClientOriginalExtension();
//
//                    $request->file('QUALITY_CONTROL_IMAGE')->move("public/image/qualitycontrol/", $qualityTestImage);
//                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
//
//                }
            }
            // exit;
        }

        //$this->pr($request->input());
        $updated = QulityControlTesting::updateQualityControlTestingData($request, $id, $qualityTestImage);

        if($updated){
            return response()->json(['success'=>'Quality  Control & Testing submission completed.']);
        } else {
            return response()->json(['success'=>'Quality  Control & Testing submission failed.']);
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
