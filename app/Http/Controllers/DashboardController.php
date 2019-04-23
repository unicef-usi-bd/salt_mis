<?php

namespace App\Http\Controllers;

use App\MillerInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function index()
    {
        $user_group_id = Auth::user()->user_group_id; //$this->pr($user_group_id);
        $totalMillerUnderAdmin = count(MillerInfo::countMillersUnderAdmin());
        $totalActiveMillerUnderAdmin = count(MillerInfo::countActiveMillersUnderAdmin());
        $totalDeactiveMillerUnderAdmin = count(MillerInfo::countDeactiveMillersUnderAdmin());
        $coxAssoId = $this->coxAssoId;
        //$totalMillerUnderCoxAsso = count(MillerInfo::countMillersUnderCoxAsso());
//        $this->pr(session()->all());
        if ($user_group_id==$this->adminId){

            return view('layouts.groupWiseDashboard.adminDashboard',compact('totalMillerUnderAdmin','totalActiveMillerUnderAdmin','totalDeactiveMillerUnderAdmin'));

        }else if($user_group_id==$this->bstiId){

            return view('layouts.groupWiseDashboard.bstiDashboard' ,compact('totalMillerUnderAdmin','totalActiveMillerUnderAdmin','totalDeactiveMillerUnderAdmin'));

        }else if($user_group_id==$this->bscicId){

            return view('layouts.groupWiseDashboard.bscicDashboard' ,compact('totalMillerUnderAdmin','totalActiveMillerUnderAdmin','totalDeactiveMillerUnderAdmin'));

        }else if($user_group_id==$this->unicefId){

            return view('layouts.groupWiseDashboard.unicefDashboard' ,compact('totalMillerUnderAdmin','totalActiveMillerUnderAdmin','totalDeactiveMillerUnderAdmin'));

        }else if($user_group_id==$this->associationId){

            return view('layouts.groupWiseDashboard.associationDashboard');

        }else if($user_group_id==$this->millerId){

            return view('layouts.groupWiseDashboard.millersDashboard');

        }else{ // for super admin

            return view('layouts.dashBoard');
        }

    }
}
