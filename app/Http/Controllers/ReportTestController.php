<?php

namespace App\Http\Controllers;

use App\LookupGroupData;
use App\Report;
use App\ReportTest;
use App\SupplierProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemList = Report::itemList();
        $getDivision = SupplierProfile::getDivision();
        $issueBy = LookupGroupData::getActiveGroupDataByLookupGroup($this->issureTypeId);
        return view("reportTest.reportDashboard", compact('itemList','getDivision','issueBy'));
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
     * @param  \App\ReportTest  $reportTest
     * @return \Illuminate\Http\Response
     */
    public function show(ReportTest $reportTest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReportTest  $reportTest
     * @return \Illuminate\Http\Response
     */
    public function edit(ReportTest $reportTest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReportTest  $reportTest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReportTest $reportTest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReportTest  $reportTest
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReportTest $reportTest)
    {
        //
    }
}
