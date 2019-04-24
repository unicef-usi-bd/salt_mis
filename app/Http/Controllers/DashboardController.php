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

//        $totalActiveMillerUnderAdmin = count(MillerInfo::countActiveMillersUnderAdmin());
//        $totalDeactiveMillerUnderAdmin = count(MillerInfo::countDeactiveMillersUnderAdmin());
//        $coxAssoId = $this->coxAssoId;
//        //$totalMillerUnderCoxAsso = count(MillerInfo::countMillersUnderCoxAsso());
////        $this->pr(session()->all());
        if($user_group_id==$this->bstiId){
            return $this->bsti();
        }else if($user_group_id==$this->bscicId){
            return $this->basic();
        }else if($user_group_id==$this->unicefId){
            return $this->unicef();
        }else if($user_group_id==$this->associationId){
            return $this->association();
        }else if($user_group_id==$this->millerId){
            return $this->miller();
        }else{ // for super admin
            return $this->admin();
        }
    }

    public function admin(){
        $totalMiller= count(MillerInfo::countAllMillers());
        $totalActiveMiller= count(MillerInfo::countActiveMillers());
        $totalInactiveMiller= count(MillerInfo::countInactiveMillers());
       // $this->pr($totalMillerUnderAdmin);
        return view('dashboards.adminDashboard',compact('totalMiller','totalActiveMiller','totalInactiveMiller'));
    }

    public function unicef(){
        return view('dashboards.unicefDashboard');
    }

    public function bsti(){
        return view('dashboards.bstiDashboard');
    }

    public function basic(){
        return view('dashboards.basicDashboard');
    }

    public function association(){
        $totalMiller= count(MillerInfo::countAllMillers());
        $totalActiveMiller= count(MillerInfo::countActiveMillers());
        $totalInactiveMiller= count(MillerInfo::countInactiveMillers());
      //  $this->pr($totalMiller);
        return view('dashboards.associationDashboard',compact('totalMiller','totalActiveMiller','totalInactiveMiller'));
    }

    public function miller(){
        return view('dashboards.millerDashboard');
    }
}
