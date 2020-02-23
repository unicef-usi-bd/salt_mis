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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $currentMillInfo = MillerProfileApproval::previousMillerInformation($id);
        $updateMillInfo = MillerProfileApproval::presentMillerInformation($id);
        $currentEntrepreneurs = MillerProfileApproval::currentEntrepreneurInfo($id);
        $updateEntrepreneurs = MillerProfileApproval::updateEntrepreneurInfo($id);
        $presentCertificates = MillerProfileApproval::currentCertificatesInfo($id);
        $updateCertificates = MillerProfileApproval::updateCertificatesInfo($id);

        $previousQcData = MillerProfileApproval::previousQcInformation($id);
        $presentQcData = MillerProfileApproval::presentQcInformation($id);
        $presentEmployeeData = MillerProfileApproval::presentEmployeeInformation($id);
        $previousEmployeeData = MillerProfileApproval::previousEmployeeInformation($id);
//        dd($currentEntreprenurs);
        return view('profile.miller.modal.millerProfileApproval',compact('currentMillInfo','updateMillInfo','currentEntrepreneurs','updateEntrepreneurs','presentCertificates','updateCertificates','previousQcData','presentQcData','presentEmployeeData','previousEmployeeData','id'));
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
        // Start Mill Info Data
/*        $millerInfo = DB::table('tem_ssm_mill_info')
            ->where('MILL_ID', '=', $millerId)
            ->where('approval_status', '=', 0)
            ->first();

        if($millerInfo){
            $upateInfo = array(
                'MILL_NAME' => $millerInfo->MILL_NAME,
                'mill_logo' => $millerInfo->mill_logo,
                'PROCESS_TYPE_ID' => $millerInfo->PROCESS_TYPE_ID,
                'OWNER_TYPE_ID' => $millerInfo->OWNER_TYPE_ID,
                'CAPACITY_ID' => $millerInfo->CAPACITY_ID,
                'DIVISION_ID' => $millerInfo->DIVISION_ID,
                'DISTRICT_ID' => $millerInfo->DISTRICT_ID,
                'UPAZILA_ID' => $millerInfo->UPAZILA_ID,
                'ACTIVE_FLG' => $millerInfo->ACTIVE_FLG,
                'approval_status' => 0,
                'REMARKS' => $millerInfo->REMARKS,
                'approval_comments' => $request->input('REMARKS'),
                'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s"),
                'UPDATE_BY' => Auth::user()->id
            );
            $updated = DB::table('ssm_mill_info')->where('MILL_ID', '=' , $millerId)->update($upateInfo);

            if($updated){
                $tempStatus = ['approval_status' => '1'];
                DB::table('tem_ssm_mill_info')->where('MILL_ID', '=' , $millerId)->update($tempStatus);
            }
        }*/
        // End Mill Info Data

        // Start Entrepreneur Information Data
/*        $entrepreneurs = DB::table('tem_ssm_entrepreneur_info')
            ->where('MILL_ID','=',$millerId)
            ->where('approval_status','=',0)
            ->get();

        if($entrepreneurs) {
            $entrepreneurData = array();
            foreach ($entrepreneurs as $key => $entrepreneur) {
                $entrepreneurData[] = array(
                    'MILL_ID' => $entrepreneur->MILL_ID,
                    'OWNER_NAME' => $entrepreneur->OWNER_NAME,
                    'DIVISION_ID' => $entrepreneur->DIVISION_ID,
                    'DISTRICT_ID' => $entrepreneur->DISTRICT_ID,
                    'UPAZILA_ID' => $entrepreneur->UPAZILA_ID,
                    'NID' => $entrepreneur->NID,
                    'MOBILE_1' => $entrepreneur->MOBILE_1,
                    'MOBILE_2' => $entrepreneur->MOBILE_2,
                    'EMAIL' => $entrepreneur->EMAIL,
                    'REMARKS' => $entrepreneur->REMARKS,
                    'ACTIVE_FLG' => 1,
                    'approval_status' => 0,
                    'center_id' => Auth::user()->center_id,
                    'ENTRY_BY' => Auth::user()->id,
                    'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
                );
            }

            $deleteData = DB::table('ssm_entrepreneur_info')->where('MILL_ID', $millerId)->delete();
            if($deleteData) {
                $inserted = DB::table('ssm_entrepreneur_info')->insert($entrepreneurData);
                if($inserted){
                    $updateStatus = ['approval_status' => 1];
                    DB::table('tem_ssm_entrepreneur_info')->where('MILL_ID', '=' , $millerId)->update($updateStatus);
                }
            }
        }       */
        //End Entrepreneur Information Data

       //Start Certificate Information Data
        $certificates = DB::table('tem_ssm_certificate_info')
            ->where('MILL_ID','=',$millerId)
            ->where('approval_status','=',0)
            ->get();

        if($certificates){
            $updateCertificates = array();
            foreach ($certificates as $certificate){
                $updateCertificates[] = array(
                    'MILL_ID' => $certificate->MILL_ID,
                    'CERTIFICATE_TYPE_ID' => $certificate->CERTIFICATE_TYPE_ID,
                    'ISSURE_ID' => $certificate->ISSURE_ID,
                    'DISTRICT_ID' => $certificate->DISTRICT_ID,
                    'ISSUING_DATE' => date('Y-m-d',strtotime($certificate->ISSUING_DATE)),
                    'CERTIFICATE_NO' => $certificate->CERTIFICATE_NO,
                    'TRADE_LICENSE' => $certificate->TRADE_LICENSE,
                    'RENEWING_DATE' => $certificate->RENEWING_DATE,
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
                $status = DB::table('ssm_certificate_info')->insert($updateCertificates);
                if($status){
                    $tempCertificateInfoData = ['approval_status' => 1];
                    DB::table('tem_ssm_certificate_info')->where('MILL_ID', '=' , $millerId)->update($tempCertificateInfoData);
                }
            }
        }
        //End Certificate Information Data

        return true;
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
}
