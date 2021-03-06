<?php

namespace App\Http\Controllers;

use App\Entrepreneur;
use App\LookupGroupData;
use App\MillerInfo;
use App\Certificate;
use App\Stock;
use App\SupplierProfile;
use Illuminate\Http\Request;
use App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\LookupGroup;
use phpDocumentor\Reflection\Types\Null_;
use UxWeb\SweetAlert\SweetAlert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\AssociationSetup;
use App\CertificateIssur;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $millerId = (array)MillerInfo::millId();
//        $millerId1 = (array)$millerId;
        $links = implode(' ', $millerId);

        $certificates = Certificate::getAllCertificate($links);

//        $this->pr($certificates);
        return view('profile.miller.millCertificateList', compact('certificates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userImageLimit = 0;
        $data = array();

        $rules = array(
            'MILL_ID' => 'required',
            'CERTIFICATE_TYPE_ID.*' => 'required',
            'ISSURE_ID.*' => 'required',
            'ISSUING_DATE.*' => 'required',
            'CERTIFICATE_NO.*' => 'required',
            'user_image.*' => 'required',
//            'RENEWING_DATE.*' => 'required',
        );
        $error = array(
            'MILL_ID.required' => 'Miller Information not available. <span class="text-primary">You need to provide miller information</span>.',
            'CERTIFICATE_TYPE_ID.*' => 'Certificate type field is required.',
            'ISSURE_ID.*' => 'Issuer field is required.',
            'ISSUING_DATE.*' => 'Issue date field is required.',
            'CERTIFICATE_NO.*' => 'Certificate no field is required.',
            'user_image.*' => 'File upload is required.',
//            'RENEWING_DATE.*' => 'Renewing date field is required.'
        );

        $validator = Validator::make(Input::all(), $rules, $error);

        if ($validator->fails()) return response()->json(['errors' => $validator->errors()->first()]);

        $millerId = $request->input('MILL_ID');
        $userCertificates = $request->input('CERTIFICATE_TYPE_ID');
        $hasRequiredCertificates = $this->isValidateCertificate($millerId, $userCertificates);
        if ($hasRequiredCertificates) {
            $certificates = implode(', ', $hasRequiredCertificates);
            return response()->json(['errors' => "<b>$certificates </b>certificates must be required."]);
        }
        if ($request->has('user_image')) {
            $userImageLimit = count($request->file('user_image'));
        }
        $loopLimit = count($userCertificates);
        if ($userImageLimit != $loopLimit) return response()->json(['errors' => 'Certificate Image * field is  required']);
        for ($i = 0; $i < $loopLimit; $i++) {
            // file upload
            $imagePath = '';
            if ($i < $userImageLimit && $request->file('user_image')[$i] != null && $request->file('user_image')[$i]->isValid()) {
                try {
                    $file = $request->file('user_image')[$i];
                    $tempName = strtolower(str_replace(' ', '', $request->input('user_image')[$i]));
                    $userImageName = $tempName . date("Y-m-d") . $i . '_' . time() . '.' . $file->getClientOriginalExtension();
                    $imagePath = 'public/image/user-image/' . $userImageName;
                    $request->file('user_image')[$i]->move("public/image/user-image", $userImageName);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {

                }
            }

            $renewingDate = $this->dateFormat($request->input('RENEWING_DATE')[$i]);

            $data[] = array(
                'MILL_ID' => $request->input('MILL_ID'),
                'CERTIFICATE_TYPE_ID' => $request->input('CERTIFICATE_TYPE_ID')[$i],
                'ISSURE_ID' => $request->input('ISSURE_ID')[$i],
                'DISTRICT_ID' => $request->input('DISTRICT_ID')[$i],
                'ISSUING_DATE' => date('Y-m-d', strtotime($request->input('ISSUING_DATE')[$i])),
                'CERTIFICATE_NO' => $request->input('CERTIFICATE_NO')[$i],
                //'TRADE_LICENSE' => 'public/image/user-image/'.$request->file('user_image')[$i],
                'TRADE_LICENSE' => $imagePath,
                'RENEWING_DATE' => $renewingDate,
                'CERTIFICATE_TYPE' => CertificateIssur::hasMendatory($userCertificates[$i]),
                'IS_EXPIRE' => CertificateIssur::hasExpired($userCertificates[$i]),
                'REMARKS' => $request->input('REMARKS')[$i],
                'center_id' => Auth::user()->center_id,
                'ENTRY_BY' => Auth::user()->id,
                'ENTRY_TIMESTAMP' => date("Y-m-d h:i:s")
            );
        }

        $duplicate = DB::table('ssm_certificate_info')->select('*')->where('MILL_ID', $request->input('MILL_ID'))->get();

        if (count($duplicate) > 0) {
            return response()->json(['errors' => 'Already Insert This Certificate']);
        } else {
            $inserted = DB::table('ssm_certificate_info')->insert($data);

            if ($inserted) {
                return response()->json(['success' => 'Certificate information has been saved successfully', 'insertId' => $millerId]);
            } else {
                return response()->json(['errorss' => 'Certificate information save failed']);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       //dd($_POST);exit();
        $rules = array(
            'CERTIFICATE_TYPE_ID.*' => 'required',
            'ISSURE_ID.*' => 'required',
            'ISSUING_DATE.*' => 'required',
            'CERTIFICATE_NO.*' => 'required',
            'user_image.*' => 'required',
//            'RENEWING_DATE.*' => 'required',
        );
        $error = array(
            'CERTIFICATE_TYPE_ID.*' => 'Certificate type field is required.',
            'ISSURE_ID.*' => 'Issuer field is required.',
            'ISSUING_DATE.*' => 'Issue date field is required.',
            'CERTIFICATE_NO.*' => 'Certificate no field is required.',
            'user_image.*' => 'File upload is required.',
//            'RENEWING_DATE.*' => 'Renewing date field is required.'
        );

        $validator = Validator::make(Input::all(), $rules, $error);

        if ($validator->fails()) return response()->json(['errors' => $validator->errors()->first()]);

        $millerId = $id;
        $image = $request->file('user_image');

        $userCertificates = $request->input('CERTIFICATE_TYPE_ID');
        //dd($userCertificates);
        $hasRequiredCertificates = $this->isValidateCertificate($millerId, $userCertificates);
        //dd($hasRequiredCertificates);
        if ($hasRequiredCertificates) {
            $certificates = implode(', ', $hasRequiredCertificates);
            return response()->json(['errors' => "<b>$certificates </b>certificates is  required."]);
        }

        $selfMillerInfo = MillerInfo::selfMillerAuthenticated();

        if ($selfMillerInfo->MILL_ID) {
            $hasRequest = $this->hasUpdateRequested($millerId);
            if ($hasRequest) return response()->json(['errors' => 'You have already requested to update your profile. You need to association approval for further request']);
            $updated = $this->certificateUpdateTemp($request, $millerId, $userCertificates, $image);
        } else {
            $updated = $this->certificateUpdate($request, $millerId, $userCertificates, $image);
        }

        if ($updated) {
            return response()->json(['success' => 'Certificate information has been updated successfully']);
        } else {
            return response()->json(['errors' => 'Certificate information updated failed']);
        }

    }

    private function hasUpdateRequested($millerId)
    {
        return DB::table('tem_ssm_certificate_info')->where('Mill_ID', '=', $millerId)->first();
    }

    private function certificateUpdate($request, $millerId, $userCertificates, $image)
    {
        $updated = false;
        $certificateId = $request->input('CERTIFICATE_ID');
        try {
            DB::beginTransaction();
            if($certificateId){
                $hasDelete = DB::table('ssm_certificate_info')
                    ->whereNotIn('CERTIFICATE_ID', $certificateId)
                    ->where('MILL_ID', '=', $millerId)
                    ->pluck('CERTIFICATE_ID')->toArray();
                if($hasDelete) $this->deleteCertificates($hasDelete);
            }


            for ($i = 0; $i < count($userCertificates); $i++) {
                $tempName = null;
                if (isset($image[$i]) && $image[$i]->isValid()) {
                    try {
                        $file = $image[$i];
                        $tempName = $tempName . date("Y-m-d") . $i . '_' . time() . '.' . $file->getClientOriginalExtension();

                        $image[$i]->move("public/image/user-image", $tempName);

                    } catch (Illuminate\Filesystem\FileNotFoundException $e) {

                    }
                }

                $renewingDate = $this->dateFormat($request->input('RENEWING_DATE')[$i]);

                $data = array(
                    'MILL_ID' => $millerId,
                    'CERTIFICATE_TYPE_ID' => $userCertificates[$i],
                    'ISSURE_ID' => $request->input('ISSURE_ID')[$i],
                    'DISTRICT_ID' => $request->input('DISTRICT_ID')[$i],
                    'ISSUING_DATE' => $this->dateFormat($request->input('ISSUING_DATE')[$i]),
                    'CERTIFICATE_NO' => $request->input('CERTIFICATE_NO')[$i],
                    'RENEWING_DATE' => $renewingDate,
                    'REMARKS' => $request->input('REMARKS')[$i],
                    'CERTIFICATE_TYPE' => CertificateIssur::hasMendatory($userCertificates[$i]),
                    'IS_EXPIRE' => CertificateIssur::hasExpired($userCertificates[$i]),
                    'UPDATE_BY' => Auth::user()->id,
                    'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s")
                );

                if (!empty($tempName)) {
                    $data['TRADE_LICENSE'] = 'public/image/user-image/' . $tempName;
                }

                if (!empty($certificateId[$i])) {
                    $updated = true;
                    DB::table('ssm_certificate_info')->where('CERTIFICATE_ID', $certificateId[$i])->update($data);
                } else {
                    $updated = true;
                    DB::table('ssm_certificate_info')->insert($data);
                }
            }
            DB::commit();
            return $updated;
        } catch (\Exception $e) {
//            var_dump($e->getMessage());
            DB::rollBack();
            return $updated;
        }
    }

    private function certificateUpdateTemp($request, $millerId, $userCertificates, $image)
    {
        $data = array();
        for ($i = 0; $i < count($userCertificates); $i++) {
            $tempName = null;
            if (isset($image[$i]) && $image[$i]->isValid()) {
                try {
                    $file = $image[$i];
                    $tempName = $tempName . date("Y-m-d") . $i . '_' . time() . '.' . $file->getClientOriginalExtension();

                    $image[$i]->move("public/image/user-image", $tempName);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {

                }
            }

            $renewingDate = $this->dateFormat($request->input('RENEWING_DATE')[$i]);

            $data[$i] = array(
                'MILL_ID' => $millerId,
                'CERTIFICATE_TYPE_ID' => $userCertificates[$i],
                'ISSURE_ID' => $request->input('ISSURE_ID')[$i],
                'DISTRICT_ID' => $request->input('DISTRICT_ID')[$i],
                'ISSUING_DATE' => $this->dateFormat($request->input('ISSUING_DATE')[$i]),
                'CERTIFICATE_NO' => $request->input('CERTIFICATE_NO')[$i],
                'RENEWING_DATE' => $renewingDate,
                'REMARKS' => $request->input('REMARKS')[$i],
                'CERTIFICATE_TYPE' => CertificateIssur::hasMendatory($userCertificates[$i]),
                'IS_EXPIRE' => CertificateIssur::hasExpired($userCertificates[$i]),
                'UPDATE_BY' => Auth::user()->id,
                'UPDATE_TIMESTAMP' => date("Y-m-d h:i:s")
            );
            if (!empty($tempName)) {
                $data[$i]['TRADE_LICENSE'] = 'public/image/user-image/' . $tempName;
            }
        }

        $inserted = DB::table('tem_ssm_certificate_info')->insert($data);

        if ($inserted) {
            $data = array(
                'approval_status' => 1
            );
            DB::table('ssm_mill_info')->where('MILL_ID', '=', $millerId)->update($data);
        }
        return $inserted;
    }

    private function isValidateCertificate($millerId, $userCertificates)
    {
        $certificates = null;
        $millerInfo = MillerInfo::millerInformation($millerId);
        if($millerInfo){
            $millTypeId = $millerInfo->MILL_TYPE_ID;
            $certificates = Certificate::getMandatoryCertificatesRemain($this->certificateTypeId, $millTypeId, $userCertificates);

        }
        return $certificates;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Monitoring::deleteMonitorData($id);
        if ($delete) {
            echo json_encode([
                'type' => 'tr',
                'id' => $id,
                'flag' => true,
                'message' => 'Monitor Data Successfully Deleted.',
            ]);
        } else {
            echo json_encode([
                'message' => 'Error Founded Here!',
            ]);
        }
    }

    public function deleteCertificates(array $certificates)
    {
        return DB::table('ssm_certificate_info')->whereIn('CERTIFICATE_ID', $certificates)->delete();
    }

    public function singleCertificateDeleteByAjax(Request $request)
    {
        $certificateId = $request->input('certificateId');
        DB::table('ssm_certificate_info')->where('CERTIFICATE_ID', $certificateId)->delete();
        return "Certificate Successfully Deleted";
    }

    public function getCertificateByMillTypeId($id)
    {

        $certificates = Certificate::getCertificateByMillTypeId($this->certificateTypeId, $id);

        $options = '<option value="">Select</option>';
        foreach ($certificates as $row) {
            $hasClass = '';
            if ($row->CERTIFICATE_TYPE == 1) $hasClass = 'color: purple;font-weight: bold;';
            $options .= '<option style="' . $hasClass . '" value="' . $row->LOOKUPCHD_ID . '">' . $row->LOOKUPCHD_NAME . '</option>';
        }
        echo $options;
        die();
    }


} // END CLASS
