<?php

namespace App\Http\Controllers;

use App\MillerInfo;
use App\MillerProfileApproval;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Auth;

class MillerProfileApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $previousMillerData = MillerProfileApproval::previousMillerInformation($id);
        $presentMillerData = MillerProfileApproval::presentMillerInformation($id);
        $previousEnterpreneurData = MillerProfileApproval::previousEntrepreneurInformation($id);
        $presentEnterpreneurData = MillerProfileApproval::presentEntrepreneurInformation($id);
        $previousCertificaterData = MillerProfileApproval::previousCertificateInformation($id);
        $presentCertificaterData = MillerProfileApproval::presentCertificateInformation($id);
        $previousQcData = MillerProfileApproval::previousQcInformation($id);
        $presentQcData = MillerProfileApproval::presentQcInformation($id);
        $presentEmployeeData = MillerProfileApproval::presentEmployeeInformation($id);
        $previousEmployeeData = MillerProfileApproval::previousEmployeeInformation($id);
//        dd($previousCertificaterData);
        return view('profile.miller.modal.millerProfileApproval',compact('previousMillerData','presentMillerData','previousEnterpreneurData','presentEnterpreneurData','previousCertificaterData','presentCertificaterData','previousQcData','presentQcData','presentEmployeeData','previousEmployeeData','id'));
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

        $millerId = $id;

        $miller = $request->input('MILL_ID');
        $millerIdTemp = $request->input('MILL_ID_TEM');

        $enterpreneurInfo = $request->input('ENTREPRENEUR_ID');
        $enterpreneurInfoTemp = $request->input('ENTREPRENEUR_ID_TEM');
        $tempEnterpreneurId = $request->input('TEM_ENTREPRENEUR_ID');

        $certificateId = $request->input('CERTIFICATE_ID');
        $certificateIdTemp = $request->input('CERTIFICATE_ID_TEM');
        $tempCertificateId = $request->input('TEM_CERTIFICATE_ID');

        $qcInfoId = $request->input('QCINFO_ID');
        $qcInfoTempId = $request->input('QCINFO_ID_TEM');
        $millEmpId = $request->input('MILLEMP_ID');
        $millEmpTempId = $request->input('MILLEMP_ID_TEM');
        $remarks = $request->input('REMARKS');


        //Mill Info Data
        $millerProfileTemp = DB::table('tem_ssm_mill_info')
            ->where('MILL_ID_TEM','=',$millerIdTemp)
            ->first();

        $millerInfoData = array(
            'MILL_NAME' => $millerProfileTemp->MILL_NAME,
            'PROCESS_TYPE_ID' => $millerProfileTemp->PROCESS_TYPE_ID,
            'OWNER_TYPE_ID' => $millerProfileTemp->OWNER_TYPE_ID,
            'CAPACITY_ID' => $millerProfileTemp->CAPACITY_ID,
            'DIVISION_ID' => $millerProfileTemp->DIVISION_ID,
            'DISTRICT_ID' => $millerProfileTemp->DISTRICT_ID,
            'UPAZILA_ID' => $millerProfileTemp->UPAZILA_ID,
            'ACTIVE_FLG' => $millerProfileTemp->ACTIVE_FLG,
            'approval_status' => '1',
            'REMARKS' => $millerProfileTemp->REMARKS,
            'approval_comments' => $request->input('REMARKS'),
            'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s"),
            'UPDATE_BY' => Auth::user()->id
        );

        $updateMillerInfo = DB::table('ssm_mill_info')->where('MILL_ID', '=' , $miller)->update($millerInfoData);

        //Enterpreneur Information Data
        $commonEnterpreneurInfoData = array_intersect($enterpreneurInfo, $tempEnterpreneurId);
        $notCommonEnterpreneurInfoData = array_merge(array_diff($enterpreneurInfo, $tempEnterpreneurId),array_diff($tempEnterpreneurId, $enterpreneurInfo));
        $notExistEnterpreneurInfoData = array_diff($enterpreneurInfo, $tempEnterpreneurId);

//        dd($enterpreneurInfo);

        $enterpreneurInfoOldData = array();
        for($i=0;$i<count($enterpreneurInfo);$i++){
            $enterpreneurOld = DB::table('ssm_entrepreneur_info')
                ->where('ENTREPRENEUR_ID','=',$enterpreneurInfo[$i])
                ->first();

            $enterpreneurInfoOldData[] = array(
                'ENTREPRENEUR_ID' => $enterpreneurOld->ENTREPRENEUR_ID,
                //'REG_TYPE_ID' => $request->input('REG_TYPE_ID'),
                'MILL_ID' => $enterpreneurOld->MILL_ID,
                //'OWNER_TYPE_ID' => $request->input('OWNER_TYPE_ID'),
                'OWNER_NAME' => $enterpreneurOld->OWNER_NAME,
                'DIVISION_ID' => $enterpreneurOld->DIVISION_ID,
                'DISTRICT_ID' => $enterpreneurOld->DISTRICT_ID,
                'UPAZILA_ID' => $enterpreneurOld->UPAZILA_ID,
                'NID' => $enterpreneurOld->NID,
                'MOBILE_1' => $enterpreneurOld->MOBILE_1,
                'MOBILE_2' => $enterpreneurOld->MOBILE_2,
                'EMAIL' => $enterpreneurOld->EMAIL,
                'REMARKS' => $enterpreneurOld->REMARKS,
                'ACTIVE_FLG' => 1,
                'center_id' => Auth::user()->center_id,
                'ENTRY_BY' => Auth::user()->id,
                'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
            );
        }

        $enterpreneurinfoData = array();
        for($i=0;$i<count($enterpreneurInfoTemp);$i++){
            $enterpreneur = DB::table('tem_ssm_entrepreneur_info')
                ->where('ENTREPRENEUR_ID_TEM','=',$enterpreneurInfoTemp[$i])
                ->first();
            $enterpreneurinfoData[] =  array(
                'ENTREPRENEUR_ID' => $enterpreneur->ENTREPRENEUR_ID,
                //'REG_TYPE_ID' => $request->input('REG_TYPE_ID'),
                'MILL_ID' => $enterpreneur->MILL_ID,
                //'OWNER_TYPE_ID' => $request->input('OWNER_TYPE_ID'),
                'OWNER_NAME' => $enterpreneur->OWNER_NAME,
                'DIVISION_ID' => $enterpreneur->DIVISION_ID,
                'DISTRICT_ID' => $enterpreneur->DISTRICT_ID,
                'UPAZILA_ID' => $enterpreneur->UPAZILA_ID,
                'NID' => $enterpreneur->NID,
                'MOBILE_1' => $enterpreneur->MOBILE_1,
                'MOBILE_2' => $enterpreneur->MOBILE_2,
                'EMAIL' => $enterpreneur->EMAIL,
                'REMARKS' => $enterpreneur->REMARKS,
                'ACTIVE_FLG' => 1,
                'center_id' => Auth::user()->center_id,
                'ENTRY_BY' => Auth::user()->id,
                'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
            );
        }


        //Certificate Information Data
        $commonCertificateInfoData = array_intersect($certificateId, $tempCertificateId);
        $notCommonCertificateInfoData = array_merge(array_diff($certificateId, $tempCertificateId),array_diff($tempCertificateId, $certificateId));
        $notExistCertificateInfoData = array_diff($certificateId, $tempCertificateId);


        $certificateinfoData = array();
        for($i=0;$i<count($certificateIdTemp);$i++){
            $certificate =  DB::table('tem_ssm_certificate_info')
                            ->where('CERTIFICATE_ID_TEM','=',$certificateIdTemp[$i])
                            ->first();
            $certificateinfoData[] = array(
                'MILL_ID' => $certificate->MILL_ID,
                'CERTIFICATE_TYPE_ID' => $certificate->CERTIFICATE_TYPE_ID,
                'ISSURE_ID' => $certificate->ISSURE_ID,
                'DISTRICT_ID' => $certificate->DISTRICT_ID,
                'ISSUING_DATE' => date('Y-m-d',strtotime($certificate->ISSUING_DATE)),
                'CERTIFICATE_NO' => $certificate->CERTIFICATE_NO,
                //'TRADE_LICENSE' => 'image/user-image/'.$request->file('user_image')[$i],
//                'TRADE_LICENSE' => $imagePath,
                'RENEWING_DATE' =>date('Y-m-d',strtotime( $certificate->RENEWING_DATE)),
                'CERTIFICATE_TYPE' =>  $certificate->CERTIFICATE_TYPE,
                'IS_EXPIRE' =>  $certificate->IS_EXPIRE,
                'REMARKS' =>  $certificate->REMARKS,
                'center_id' => Auth::user()->center_id,
                'ENTRY_BY' => Auth::user()->id,
                'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
            );
        }
        //QC Info Data
        $qcInfoTemp = DB::table('tem_tsm_qc_info')
            ->where('QCINFO_ID_TEM','=',$qcInfoTempId)
            ->first();

        $qcInfoData = array(
            'MILL_ID' => $qcInfoTemp->MILL_ID,
            'LABORATORY_FLG' => $qcInfoTemp->LABORATORY_FLG,
            'SOP_DESC' => $qcInfoTemp->SOP_DESC,
            'IODINE_CHECK_FLG' => $qcInfoTemp->IODINE_CHECK_FLG,
            'MONITORING_FLG' => $qcInfoTemp->MONITORING_FLG,
            'LAB_MAN_FLG' => $qcInfoTemp->LAB_MAN_FLG,
            'LAB_PERSON' => $qcInfoTemp->LAB_PERSON,
            'REMARKS' => $qcInfoTemp->REMARKS,
            'center_id' => Auth::user()->center_id,
            'ENTRY_BY' => Auth::user()->id,
            'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
        );
        $updateQcInformation = DB::table('tsm_qc_info')->where('MILL_ID', '=' , $miller)->update($qcInfoData);
        //Employee Information Data
        $qcInfoTemp = DB::table('tem_ssm_millemp_info')
            ->where('MILLEMP_ID_TEM','=',$millEmpTempId)
            ->first();

        $employeeInfoData = array(
            'TOTMALE_EMP' => $qcInfoTemp->TOTMALE_EMP,
            'TOTFEM_EMP' => $qcInfoTemp->TOTFEM_EMP,
            'FULLTIMEMALE_EMP' => $qcInfoTemp->FULLTIMEMALE_EMP,
            'FULLTIMEFEM_EMP' => $qcInfoTemp->FULLTIMEFEM_EMP,
            'PARTTIMEMALE_EMP' => $qcInfoTemp->PARTTIMEMALE_EMP,
            'PARTTIMEFEM_EMP' => $qcInfoTemp->PARTTIMEFEM_EMP,
            'TOTMALETECH_PER' => $qcInfoTemp->TOTMALETECH_PER,
            'TOTFEMTECH_PER' => $qcInfoTemp->TOTFEMTECH_PER,
            'REMARKS' => $qcInfoTemp->REMARKS,
            'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s"),
            'UPDATE_BY' => Auth::user()->id
        );

        $updateEmployeeInfo = DB::table('ssm_millemp_info')->where('MILL_ID', '=' , $miller)->update($employeeInfoData);

//        $data = array(
//            'millerId' => $id,
//            'MILL_ID' => $request->input('MILL_ID'),
//            'MILL_ID_TEM' => $request->input('MILL_ID_TEM'),
//            'ENTREPRENEUR_ID' => $request->input('ENTREPRENEUR_ID'),
//            'ENTREPRENEUR_ID_TEM' => $request->input('ENTREPRENEUR_ID_TEM'),
//            'CERTIFICATE_ID' => $request->input('CERTIFICATE_ID'),
//            'CERTIFICATE_ID_TEM' => $request->input('CERTIFICATE_ID_TEM'),
//            'QCINFO_ID' => $request->input('QCINFO_ID'),
//            'QCINFO_ID_TEM' => $request->input('QCINFO_ID_TEM'),
//            'MILLEMP_ID' => $request->input('MILLEMP_ID'),
//            'MILLEMP_ID_TEM' => $request->input('MILLEMP_ID_TEM'),
//            'REMARKS' => $request->input('REMARKS'),
//        );

        return redirect()->back();


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
