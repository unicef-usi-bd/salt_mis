<?php

namespace App\Http\Controllers;

use App\MillerInfo;
use App\MillerProfileApproval;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        return view('profile.miller.modal.millerProfileApproval',compact('previousMillerData','presentMillerData','previousEnterpreneurData','presentEnterpreneurData','previousCertificaterData','presentCertificaterData','previousQcData','presentQcData','presentEmployeeData','previousEmployeeData'));
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
