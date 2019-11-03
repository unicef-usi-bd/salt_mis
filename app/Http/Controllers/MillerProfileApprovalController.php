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
//        dd($previousEnterpreneurData);
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
        //Start Mill Info Data
        $millerProfileTemp = DB::table('tem_ssm_mill_info')
            ->where('MILL_ID','=',$millerId)
            ->where('approval_status','=',0)
            ->first();

        if($millerProfileTemp){
            $millerInfoData = array(
                'MILL_NAME' => $millerProfileTemp->MILL_NAME,
                'PROCESS_TYPE_ID' => $millerProfileTemp->PROCESS_TYPE_ID,
                'OWNER_TYPE_ID' => $millerProfileTemp->OWNER_TYPE_ID,
                'CAPACITY_ID' => $millerProfileTemp->CAPACITY_ID,
                'DIVISION_ID' => $millerProfileTemp->DIVISION_ID,
                'DISTRICT_ID' => $millerProfileTemp->DISTRICT_ID,
                'UPAZILA_ID' => $millerProfileTemp->UPAZILA_ID,
                'ACTIVE_FLG' => $millerProfileTemp->ACTIVE_FLG,
                'approval_status' => 0,
                'REMARKS' => $millerProfileTemp->REMARKS,
                'approval_comments' => $request->input('REMARKS'),
                'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s"),
                'UPDATE_BY' => Auth::user()->id
            );
            $updateMillerInfo = DB::table('ssm_mill_info')->where('MILL_ID', '=' , $millerId)->update($millerInfoData);
            if($updateMillerInfo){
                $tempMillerInfoData = ['approval_status' => '1'];
                DB::table('tem_ssm_mill_info')->where('MILL_ID', '=' , $millerId)->update($tempMillerInfoData);
            }
        }
        //End Mill Info Data

        //Start Enterpreneur Information Data
        $enterpreneur = DB::table('tem_ssm_entrepreneur_info')
            ->where('MILL_ID','=',$millerId)
            ->where('approval_status','=',0)
            ->get();

        if($enterpreneur) {
            $enterpreneurinfoDataInsert = array();
            foreach ($enterpreneur as $key => $value) {
                $enterpreneurinfoDataInsert [] = array(
                    'MILL_ID' => $value->MILL_ID,
                    'OWNER_NAME' => $value->OWNER_NAME,
                    'DIVISION_ID' => $value->DIVISION_ID,
                    'DISTRICT_ID' => $value->DISTRICT_ID,
                    'UPAZILA_ID' => $value->UPAZILA_ID,
                    'NID' => $value->NID,
                    'MOBILE_1' => $value->MOBILE_1,
                    'MOBILE_2' => $value->MOBILE_2,
                    'EMAIL' => $value->EMAIL,
                    'REMARKS' => $value->REMARKS,
                    'ACTIVE_FLG' => 1,
                    'approval_status' => 0,
                    'center_id' => Auth::user()->center_id,
                    'ENTRY_BY' => Auth::user()->id,
                    'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
                );
            }
            $deleteData = DB::table('ssm_entrepreneur_info')->where('MILL_ID', $millerId)->delete();
            if($deleteData) {
                $status = DB::table('ssm_entrepreneur_info')->insert($enterpreneurinfoDataInsert);
                if($status){
                    $tempEnterpreneurInfoData = ['approval_status' => 1];
                }
                DB::table('tem_ssm_entrepreneur_info')->where('MILL_ID', '=' , $millerId)->update($tempEnterpreneurInfoData);
            }
        }
        //End Enterpreneur Information Data

       //Start Certificate Information Data
        $certificates = DB::table('tem_ssm_certificate_info')
            ->where('MILL_ID','=',$millerId)
            ->where('approval_status','=',0)
            ->get();

        if($certificates){
            $certificateinfoData = array();
            foreach ($certificates as $key=>$certificate){
                $certificateinfoData[] = array(
                    'MILL_ID' => $certificate->MILL_ID,
                    'CERTIFICATE_TYPE_ID' => $certificate->CERTIFICATE_TYPE_ID,
                    'ISSURE_ID' => $certificate->ISSURE_ID,
                    'DISTRICT_ID' => $certificate->DISTRICT_ID,
                    'ISSUING_DATE' => date('Y-m-d',strtotime($certificate->ISSUING_DATE)),
                    'CERTIFICATE_NO' => $certificate->CERTIFICATE_NO,
                    'TRADE_LICENSE' => $certificate->TRADE_LICENSE,
                    'RENEWING_DATE' =>date('Y-m-d',strtotime( $certificate->RENEWING_DATE)),
                    'CERTIFICATE_TYPE' =>  $certificate->CERTIFICATE_TYPE,
                    'IS_EXPIRE' =>  $certificate->IS_EXPIRE,
                    'REMARKS' =>  $certificate->REMARKS,
                    'approval_status' => 0,
                    'center_id' => Auth::user()->center_id,
                    'ENTRY_BY' => Auth::user()->id,
                    'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
                );
            }
            $deleteData = DB::table('ssm_certificate_info')->where('MILL_ID', $millerId)->delete();
            if($deleteData) {
                $status = DB::table('ssm_certificate_info')->insert($certificateinfoData);
                if($status){
                    $tempCertificateInfoData = ['approval_status' => 1];
                    DB::table('tem_ssm_certificate_info')->where('MILL_ID', '=' , $millerId)->update($tempCertificateInfoData);
                }
            }
        }
        //End Certificate Information Data
        //QC Info Data
        $qcInfoTemp = DB::table('tem_tsm_qc_info')
            ->where('MILL_ID','=',$millerId)
            ->where('approval_status','=',0)
            ->first();
        if($qcInfoTemp) {
            $qcInfoData = array(
                'MILL_ID' => $qcInfoTemp->MILL_ID,
                'LABORATORY_FLG' => $qcInfoTemp->LABORATORY_FLG,
                'SOP_DESC' => $qcInfoTemp->SOP_DESC,
                'IODINE_CHECK_FLG' => $qcInfoTemp->IODINE_CHECK_FLG,
                'MONITORING_FLG' => $qcInfoTemp->MONITORING_FLG,
                'LAB_MAN_FLG' => $qcInfoTemp->LAB_MAN_FLG,
                'LAB_PERSON' => $qcInfoTemp->LAB_PERSON,
                'REMARKS' => $qcInfoTemp->REMARKS,
                'approval_status' => 0,
                'center_id' => Auth::user()->center_id,
                'ENTRY_BY' => Auth::user()->id,
                'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
            );
            $updateQcInformation = DB::table('tsm_qc_info')->where('MILL_ID', '=', $millerId)->update($qcInfoData);
            if($updateQcInformation){
                $tempQCInfoData = ['approval_status' => 1];
                DB::table('tem_tsm_qc_info')->where('MILL_ID', '=' , $millerId)->update($tempQCInfoData);
            }
        }
//        //Employee Information Data
        $empInfoTemp = DB::table('tem_ssm_millemp_info')
            ->where('MILL_ID','=',$millerId)
            ->where('approval_status','=',0)
            ->first();

        if($empInfoTemp){
            $employeeInfoData = array(
                'TOTMALE_EMP' => $empInfoTemp->TOTMALE_EMP,
                'TOTFEM_EMP' => $empInfoTemp->TOTFEM_EMP,
                'FULLTIMEMALE_EMP' => $empInfoTemp->FULLTIMEMALE_EMP,
                'FULLTIMEFEM_EMP' => $empInfoTemp->FULLTIMEFEM_EMP,
                'PARTTIMEMALE_EMP' => $empInfoTemp->PARTTIMEMALE_EMP,
                'PARTTIMEFEM_EMP' => $empInfoTemp->PARTTIMEFEM_EMP,
                'TOTMALETECH_PER' => $empInfoTemp->TOTMALETECH_PER,
                'TOTFEMTECH_PER' => $empInfoTemp->TOTFEMTECH_PER,
                'REMARKS' => $empInfoTemp->REMARKS,
                'approval_status' => 0,
                'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s"),
                'UPDATE_BY' => Auth::user()->id
            );
            $updateEmployeeInfo = DB::table('ssm_millemp_info')->where('MILL_ID', '=' , $millerId)->update($employeeInfoData);
            if($updateEmployeeInfo){
                $tempEmpInfoData = ['approval_status' => 1];
                DB::table('tem_ssm_millemp_info')->where('MILL_ID', '=' , $millerId)->update($tempEmpInfoData);
            }

        }







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
