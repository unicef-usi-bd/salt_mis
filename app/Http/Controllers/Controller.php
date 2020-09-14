<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;
use Auth;
use Mockery\Exception;
use Session;
use View;
use PDF;
//require '../vendor/autoload.php';

class Controller extends BaseController
{
    //############## Look Up Group Static Id For Get Lookup Group ###############
    public $agencyId= 1;
    public $registrationTypeId= 4;
    public $ownerTypeId= 5;
    public $processTypeId= 6;
    public $millTypeId= 7;
    public $capacityId= 9;


    public $sellerTypeId = 3;

    public $itemTypeId = 10;
    public $certificateTypeId = 12;
    public $issureTypeId = 13;
    public $certificateissureTypeId = 21;
    public $supplierTypeId = 14;
    public $crudeSaltSourceId = 15;
    public $qualityControlId = 19;
    public $saltPackId = 20;
//############## Look Up Group Data Static Id For Get Lookup Group Data ###############
    public $bstiCertificateId = 34;
    public $edibleCertificateId = 39;

//############## Look Up Group Data Static Id For Get Lookup Group Data ###############
    public $iodizedRecommendChemId = 29;
    public $chemicalId = 25;
    public $crudSaltId = 26;
    public $finishedSaltId= 29;

    public $crudeSaltSupplierTypeId = 41;
    public $chemicalSupplierTypeId = 42;

    public $importerId = 44;

    //############## Static Item Id  ###############
    public $washAndCrushId = 7;
    public $iodizeId = 8;


    //-----dynamic dashboard for separate user group
    public $adminId = 1;
    public $bstiId = 18;
    public $bscicId = 19;
    public $unicefId = 20;
    public $associationId = 21;
    public $millerId = 22;

    //---------- association Id
    public $coxAssoId = 2;

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function checkPrevillage($userGroupId,$userGroupLevelId,$url)
    {
        // $link = $url;
        //return DB::select(DB::raw("select a.`CREATE`,a.`READ`,a.`UPDATE`,a.`DELETE`,a.STATUS from sa_uglw_mlink a where a.USERGRP_ID='7' and  a.UG_LEVEL_ID='15' and a.LINK_URI='financial-report'"));
        return DB::table('sa_uglw_mlink as a')
            ->select('a.CREATE','a.READ','a.UPDATE','a.DELETE','a.STATUS')
            ->where('a.USERGRP_ID','=',$userGroupId)
            ->where('a.UG_LEVEL_ID','=',$userGroupLevelId)
            ->where('a.LINK_URI','=',$url)
            ->first();
    }

    protected function buildTree($flat, $pidKey, $idKey = null){

        $grouped = array();
        foreach ($flat as $sub) {
            $grouped[$sub[$pidKey]][] = $sub;
        }
        $treeBuilder = function($siblings) use (&$treeBuilder, $grouped, $idKey) {
            foreach ($siblings as $k => $sibling) {
                $id = $sibling[$idKey];
                if (isset($grouped[$id])) {
                    $sibling['children'] = $treeBuilder($grouped[$id]);
                }
                $siblings[$k] = $sibling;
            }
            return $siblings;
        };
        $tree = $treeBuilder($grouped[0]);
        return $tree;
    }

    /**
     * Check date is expired ? false for already expired and true for not expired until now
     * @parameter date
     *
     * @throws Exception None
     * @author dev Coder <kartic@atilimited.net>
     * @return true or false
     */
    protected function hasAuthorization($date){
        $currentDate = date('Y-m-d');
        $date = $this->dateFormat($date);
        return $date >= $currentDate;
    }

    protected function dateFormat($date=null){
        if(!empty($date)) $date = date('Y-m-d', strtotime($date));
        return $date;
    }

    protected function floatFormat($number=0){
        $number = number_format($number, 2);
        return $number;
    }

    protected function pr($data){
        echo '<pre>';
        print_r($data);
        exit();
    }

    protected function generatePdf($data) {
        $html='<!doctype html>
                <html>
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport"
                          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <title>Document</title>
                    <style>
                        @page {
                            header: page-header;
                            footer: page-footer;
                            margin-top: 30mm;
                        }


                        .clear{
                            clear:both;
                        }
                        .header_area{
                            vertical-align: middle;
                        }
                        .header{
                            overflow: hidden;
                            border-bottom: 1px solid black;
                        }
                        .header_left{
                            text-align: left;
                            float: left;
                            width: 355px;
                        }
                        .logo{
                            float: left;
                            width: 50px;
                            margin-bottom: 5px;
                        }
                        .slogan{
                            float: right;
                            width: 300px;
                            padding-top: 15px;

                        }

                        .header_right{
                            text-align: right;
                            float: right;
                            width: 100px;
                        }

                        /*body, p, div { font-size: 14pt; font-family: solaimanlipi;}*/
                        body, p, div { font-size: 14pt; font-family: kalpurush;}

                    </style>
                </head>
                <body>
                <htmlpageheader name="page-header">
                    <div class="header_area clear">
                        <div class="header">
                            <div class="header_left">
                                <div class="logo"><img src="'. Session::get("orgLogo").'" width="50px" height="50px" alt="DAE Logo"></div>
                                <div class="slogan">'. Session::get("orgName").'</div>
                            </div>
                            <div class="header_right">
                                {DATE j-m-Y}
                            </div>
                            <div style="clear: both;"></div>
                        </div>
                    </div>
                </htmlpageheader>


                <div style="font-family: "SolaimanLipi";"> '.$data.' </div>


                <htmlpagefooter name="page-footer">
                    <div  style="border-bottom: 1px solid #000;"></div>
                    <table style="width: 100%">
                        <tr>
                            <td> {PAGENO}</td>
                            <td style="text-align: right">'.Session::get("orgAddress").'</td>
                        </tr>
                    </table>
                </htmlpagefooter>




                </body>
                </html>';
        $mpdf = new \Mpdf\Mpdf(['tempDir' => base_path().'/tmp']);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}
