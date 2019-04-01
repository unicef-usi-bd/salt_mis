@extends('master')
@section('mainContent')
<?php
$session=1;

?>
@include('masterGlobal.tree')
<link href="{{asset('/assets/tree/abixTreeList.css')}}" rel="stylesheet" type="text/css" >
<div class="content ajaxLoad ">
    <div class="panel panel-flat">
        <div class="panel-heading" style="padding:0px 0px 0px 10px;">
            <h4>{{ trans('breadcrumb.cost_center') }}</h4>
        </div>
        <div class="col-md-8" style="margin-top: 5px;">
            <p><a href="#" id="tree-expand-all">{{ trans('dashboard.expand_all') }}</a> | <a href="#" id="tree-collapse-all">{{ trans('dashboard.collapse_all') }}</a></p>
            <div class="panel panel-flat">
                <div class="panel panel-body">
                    <?php

                    function createTree($tree, $session)
                    {
                        foreach ($tree as $key => $value) {
                            $cost_center_id = $value['cost_center_id'];
                            $addLavel = 'cost-center/create/'.$cost_center_id;
                            $editLavel = '/cost-center/'.$cost_center_id.'/edit';
                            $deleteLavel=url('/cost-center/'.$cost_center_id);
                            if(isset($value['children'])){
                                $checkDelete = '';
                            } else {
                                $checkDelete = '<a class="clickForDelete btn btn-danger btn-xs row'.$cost_center_id.'" data-token="'.csrf_token().'" data-action="'.$deleteLavel.'" role="button" style="margin-left: 5px;">
                                        <i class="ace-icon fa fa-trash-o"></i>
                                    </a>';
                            }
                            if ($session == 1) {
                                if ($value['pr_cost_center_id']==0){
                                    echo '<li> <button id="'.$addLavel.'" data-target=".modal" role="button" class="btn btn-primary btn-xs showModalGlobal" data-toggle="modal" title="Create Level">'.$value['cost_center_name'].'</button>'.
                                        '<button id="'.$editLavel.'" data-target=".modal" role="button" class="btn btn-warning btn-xs showModalGlobal" data-toggle="modal" title="Edit Level" style="margin-left:5px;"><i class="ace-icon fa fa-pencil"></i></button>';
                                }else {
                                    echo '<li><button id="'.$addLavel.'" data-target=".modal" role="button" class="btn btn-primary btn-xs showModalGlobal" data-toggle="modal" title="Create Level">'.$value['cost_center_name'].'</button>'.
                                        '<button id="'.$editLavel.'" data-target=".modal" role="button" class="btn btn-warning btn-xs showModalGlobal" data-toggle="modal" title="Edit Level" style="margin-left:5px;"><i class="ace-icon fa fa-pencil"></i></button>'.
                                        $checkDelete;
                                }

                            } else {
                                echo '<li> <button>'.$value['cost_center_name'].'</button>';
                            }

                            if (!empty($value['children'])) {
                                echo "<ul>";
                                createTree($value['children'], $session);
                                echo "</ul>";
                            }
                            echo '</li>';
                        }

                    }
                    echo "<ul class='tree'>";

                    createTree($tree, $session);
                    echo "</ul>";
                    ?>

                </div>

            </div>

            <!-- Listing directory ZendX from ZendFramework library -->

            <script type="text/javascript" src="{{asset('/assets/tree/abixTreeList.min.js')}}"></script>
            <script>
                $(document).ready(function() {
                    $('.tree').abixTreeList();
                });
            </script>
        </div>
        <div class="col-md-6">

        </div>
    </div>
</div>
    @include('masterGlobal.deleteScript')
@endsection
