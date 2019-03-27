<?php

namespace App\Http\Controllers;

use App\MillProfile;
use App\Module;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use UxWeb\SweetAlert\SweetAlert;
use Illuminate\Support\Facades\Route;

class MillProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile.millerProfile');
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
     * @param  \App\MillProfile  $millProfile
     * @return \Illuminate\Http\Response
     */
    public function show(MillProfile $millProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MillProfile  $millProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(MillProfile $millProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MillProfile  $millProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MillProfile $millProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MillProfile  $millProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(MillProfile $millProfile)
    {
        //
    }
}
