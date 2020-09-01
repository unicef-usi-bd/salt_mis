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
        $currentMillInfo = MillerProfileApproval::currentMillerInformation($id);
        $updateMillInfo = MillerProfileApproval::updateMillerInformation($id);

        $currentEntrepreneurs = MillerProfileApproval::currentEntrepreneurInfo($id);
        $updateEntrepreneurs = MillerProfileApproval::updateEntrepreneurInfo($id);

        $presentCertificates = MillerProfileApproval::currentCertificatesInfo($id);
        $updateCertificates = MillerProfileApproval::updateCertificatesInfo($id);

        $currentQcInfo = MillerProfileApproval::currentQcInfo($id);
        $updateQcInfo = MillerProfileApproval::updateQcInfo($id);

        $currentEmployees = MillerProfileApproval::currentEmployeeInfo($id);
        $updateEmployees = MillerProfileApproval::updateEmployeeInfo($id);

//        dd($currentEntrepreneurs);
        return view('profile.miller.modal.millerProfileApproval',compact('currentMillInfo','updateMillInfo','currentEntrepreneurs','updateEntrepreneurs','presentCertificates','updateCertificates','currentQcInfo','updateQcInfo','currentEmployees','updateEmployees','id'));
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
        $hasRequested = false;
        $millerId = $id;
        try {
            DB::beginTransaction();
            // Start Mill Info Data
            $millerInfo = DB::table('tem_ssm_mill_info')
                ->where('MILL_ID', '=', $millerId)
                ->where('approval_status', '=', 0)
                ->first();

            if ($millerInfo) {
                $updateInfo = array(
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
                DB::table('ssm_mill_info')->where('MILL_ID', '=', $millerId)->update($updateInfo);
                $association = DB::table('ssm_associationsetup')->where('MILL_ID', '=', $id)->first();
                if ($association) {
                    DB::table('ssm_associationsetup')->where('ASSOCIATION_ID', '=', $association->ASSOCIATION_ID)->update(['ASSOCIATION_NAME' => $millerInfo->MILL_NAME]);
                    DB::table('tem_ssm_mill_info')->where('MILL_ID', '=', $millerId)->update(['approval_status' => '1']);
                }
                $hasRequested = true;
            }
            // End Mill Info Data

            // Start Entrepreneur Information Data
            $entrepreneurs = DB::table('tem_ssm_entrepreneur_info')
                ->where('MILL_ID', '=', $millerId)
                ->where('approval_status', '=', 0)
                ->get();

            if (sizeof($entrepreneurs) != 0) {
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
                if ($deleteData) {
                    $inserted = DB::table('ssm_entrepreneur_info')->insert($entrepreneurData);
                    if ($inserted) {
                        DB::table('tem_ssm_entrepreneur_info')->where('MILL_ID', '=', $millerId)->delete();
                    }
                }
                $hasRequested = true;
            }
            //End Entrepreneur Information Data

            //Start Certificate Information Data
            $certificates = DB::table('tem_ssm_certificate_info')
                ->where('MILL_ID', '=', $millerId)
                ->where('approval_status', '=', 0)
                ->get();

            if (sizeof($certificates) != 0) {
                $updateCertificates = array();
                foreach ($certificates as $certificate) {
                    $updateCertificates[] = array(
                        'MILL_ID' => $certificate->MILL_ID,
                        'CERTIFICATE_TYPE_ID' => $certificate->CERTIFICATE_TYPE_ID,
                        'ISSURE_ID' => $certificate->ISSURE_ID,
                        'DISTRICT_ID' => $certificate->DISTRICT_ID,
                        'ISSUING_DATE' => date('Y-m-d', strtotime($certificate->ISSUING_DATE)),
                        'CERTIFICATE_NO' => $certificate->CERTIFICATE_NO,
                        'TRADE_LICENSE' => $certificate->TRADE_LICENSE,
                        'RENEWING_DATE' => $certificate->RENEWING_DATE,
                        'CERTIFICATE_TYPE' => $certificate->CERTIFICATE_TYPE,
                        'IS_EXPIRE' => $certificate->IS_EXPIRE,
                        'REMARKS' => $certificate->REMARKS,
                        'approval_status' => 0,
                        'center_id' => Auth::user()->center_id,
                        'ENTRY_BY' => Auth::user()->id,
                        'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
                    );
                }
                $deleteData = DB::table('ssm_certificate_info')->where('MILL_ID', $millerId)->delete();
                if ($deleteData) {
                    $status = DB::table('ssm_certificate_info')->insert($updateCertificates);
                    if ($status) {
                        DB::table('tem_ssm_certificate_info')->where('MILL_ID', '=', $millerId)->delete();;
                    }
                }
                $hasRequested = true;
            }
            //End Certificate Information Data

            //QC Info Data
            $qcInfo = DB::table('tem_tsm_qc_info')
                ->where('MILL_ID', '=', $millerId)
                ->where('approval_status', '=', 0)
                ->first();
            if ($qcInfo) {
                $updateQc = array(
                    'MILL_ID' => $qcInfo->MILL_ID,
                    'LABORATORY_FLG' => $qcInfo->LABORATORY_FLG,
                    'SOP_DESC' => $qcInfo->SOP_DESC,
                    'IODINE_CHECK_FLG' => $qcInfo->IODINE_CHECK_FLG,
                    'MONITORING_FLG' => $qcInfo->MONITORING_FLG,
                    'LAB_MAN_FLG' => $qcInfo->LAB_MAN_FLG,
                    'LAB_PERSON' => $qcInfo->LAB_PERSON,
                    'REMARKS' => $qcInfo->REMARKS,
                    'approval_status' => 0,
                    'center_id' => Auth::user()->center_id,
                    'ENTRY_BY' => Auth::user()->id,
                    'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
                );
                DB::table('tsm_qc_info')->where('MILL_ID', '=', $millerId)->update($updateQc);
                DB::table('tem_tsm_qc_info')->where('MILL_ID', '=', $millerId)->update(['approval_status' => '1']);
                $hasRequested = true;
            }
//        //Employee Information Data
            $employeeInfo = DB::table('tem_ssm_millemp_info')
                ->where('MILL_ID', '=', $millerId)
                ->where('approval_status', '=', 0)
                ->first();

            if ($employeeInfo) {
                $employeeUpdate = array(
                    'TOTMALE_EMP' => $employeeInfo->TOTMALE_EMP,
                    'TOTFEM_EMP' => $employeeInfo->TOTFEM_EMP,
                    'FULLTIMEMALE_EMP' => $employeeInfo->FULLTIMEMALE_EMP,
                    'FULLTIMEFEM_EMP' => $employeeInfo->FULLTIMEFEM_EMP,
                    'PARTTIMEMALE_EMP' => $employeeInfo->PARTTIMEMALE_EMP,
                    'PARTTIMEFEM_EMP' => $employeeInfo->PARTTIMEFEM_EMP,
                    'TOTMALETECH_PER' => $employeeInfo->TOTMALETECH_PER,
                    'TOTFEMTECH_PER' => $employeeInfo->TOTFEMTECH_PER,
                    'REMARKS' => $employeeInfo->REMARKS,
                    'approval_status' => 0,
                    'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s"),
                    'UPDATE_BY' => Auth::user()->id
                );
                DB::table('ssm_millemp_info')->where('MILL_ID', '=', $millerId)->update($employeeUpdate);
                DB::table('tem_ssm_millemp_info')->where('MILL_ID', '=', $millerId)->delete();
                DB::table('ssm_mill_info')->where('MILL_ID', '=', $millerId)->update(['approval_status' => '1']);
                $hasRequested = true;
            }

            if ($hasRequested) {
                DB::table('ssm_mill_info')->where('MILL_ID', '=', $millerId)->update(['approval_status' => '0']);
            }
            DB::commit();
            return response()->json(['success'=>'Miller Profile has been Updated']);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json(['errors'=>'Miller Profile has been Update Failed']);
        }
    }
}
