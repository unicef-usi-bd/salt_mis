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
                <h4>Association Setup</h4>
            </div>
            <div class="col-md-8" style="margin-top: 5px;">
                <p><a href="#" id="tree-expand-all">{{ trans('dashboard.expand_all') }}</a> | <a href="#" id="tree-collapse-all">{{ trans('dashboard.collapse_all') }}</a></p>
                <div class="panel panel-flat">
                    <div class="panel panel-body">
                        @if(session('message'))
                            <p  class="alert alert-warning alert-dismissible">{{ session('message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </p>

                        @endif
                        <?php
                        function createTree($tree, $session,$previllage)
                        {
                            foreach ($tree as $key => $value) {
                                $addLavel = "";
                                $createPermissionLevel = $previllage->CREATE;
                                $editPermissionLevel = $previllage->UPDATE;
                                $deletePermissionLevel = $previllage->DELETE;
                                $ASSOCIATION_ID = $value['ASSOCIATION_ID'];

                                if($createPermissionLevel == 1){
                                    $addLavel = 'association-setup/create/'.$ASSOCIATION_ID;
                                }else{
                                    $createPermissionLevel = $previllage->CREATE;
                                }
                                $editLavel = '/association-setup/'.$ASSOCIATION_ID.'/edit';
                                $deleteLavel=url('/association-setup/'.$ASSOCIATION_ID);

                                if(isset($value['children'])){
                                    $checkDelete = '';
                                } else {
                                    if($deletePermissionLevel == 1){
                                        $checkDelete = '<a class="clickForDelete btn btn-danger btn-xs row'.$ASSOCIATION_ID.'" data-token="'.csrf_token().'" data-action="'.$deleteLavel.'" role="button" style="margin-left: 5px;">
                                        <i class="ace-icon fa fa-trash-o"></i>
                                    </a>';
                                    }else{
                                        $checkDelete = '<a class="clickForDelete btn btn-danger btn-xs row'.$ASSOCIATION_ID.'" data-token="'.csrf_token().'" data-action="'.$deleteLavel.'" role="button" style="margin-left: 5px;display: none;">
                                        <i class="ace-icon fa fa-trash-o"></i>
                                    </a>';
                                    }

                                }
                                if ($session == 1) {
                                    if ($value['PARENT_ID']==0){
                                        if($editPermissionLevel == 1){
                                            echo '<li> <button id="'.$addLavel.'" data-target=".modal" data-permission="'.$createPermissionLevel.'" role="button" class="btn btn-primary btn-xs showModalGlobal checkPermission" data-toggle="modal" title="Create Level">'.$value['ASSOCIATION_NAME'].'</button>'.
                                                '<button id="'.$editLavel.'" data-target=".modal" data-permission="'.$editPermissionLevel.'" role="button" class="btn btn-warning btn-xs showModalGlobal checkPermission" data-toggle="modal" title="Edit Level" style="margin-left:5px;"><i class="ace-icon fa fa-pencil"></i></button>';
                                        }else{
                                            echo '<li> <button id="'.$addLavel.'" data-target=".modal" data-permission="'.$createPermissionLevel.'" role="button" class="btn btn-primary btn-xs showModalGlobal checkPermission" data-toggle="modal" title="Create Level">'.$value['ASSOCIATION_NAME'].'</button>'.
                                                '<button id="'.$editLavel.'" data-target=".modal" data-permission="'.$editPermissionLevel.'" role="button" class="btn btn-warning btn-xs showModalGlobal checkPermission" data-toggle="modal" title="Edit Level" style="margin-left:5px;display: none;"><i class="ace-icon fa fa-pencil"></i></button>';
                                        }

                                    }else {

                                        if($value['ASSOCIATION_ID'] == Auth::user()->center_id || $value['PARENT_ID'] == Auth::user()->center_id){
                                            if($editPermissionLevel == 1){
                                                echo '<li><button id=""  role="button" class="btn btn-primary btn-xs" title="Create Level">'.$value['ASSOCIATION_NAME'].'</button>'.
                                                    '<button id="'.$editLavel.'" data-target=".modal" data-permission="'.$editPermissionLevel.'" role="button" class="btn btn-warning btn-xs showModalGlobal checkPermission" data-toggle="modal" title="Edit Level" style="margin-left:5px;"><i class="ace-icon fa fa-pencil"></i></button>'.
                                                    $checkDelete;
                                            }else{
                                                echo '<li><button id=""  role="button" class="btn btn-primary btn-xs" title="Create Level">'.$value['ASSOCIATION_NAME'].'</button>'.
                                                    '<button id="'.$editLavel.'" data-target=".modal" data-permission="'.$editPermissionLevel.'" role="button" class="btn btn-warning btn-xs showModalGlobal checkPermission" data-toggle="modal" title="Edit Level" style="margin-left:5px;display: none;"><i class="ace-icon fa fa-pencil"></i></button>'.
                                                    $checkDelete;
                                            }
                                        }
                                        if(empty(Auth::user()->center_id)){
                                            if($editPermissionLevel == 1){
                                                echo '<li><button id=""  role="button" class="btn btn-primary btn-xs" title="Create Level">'.$value['ASSOCIATION_NAME'].'</button>'.
                                                    '<button id="'.$editLavel.'" data-target=".modal" data-permission="'.$editPermissionLevel.'" role="button" class="btn btn-warning btn-xs showModalGlobal checkPermission" data-toggle="modal" title="Edit Level" style="margin-left:5px;"><i class="ace-icon fa fa-pencil"></i></button>'.
                                                    $checkDelete;
                                            }else{
                                                echo '<li><button id=""  role="button" class="btn btn-primary btn-xs" title="Create Level">'.$value['ASSOCIATION_NAME'].'</button>'.
                                                    '<button id="'.$editLavel.'" data-target=".modal" data-permission="'.$editPermissionLevel.'" role="button" class="btn btn-warning btn-xs showModalGlobal checkPermission" data-toggle="modal" title="Edit Level" style="margin-left:5px;display: none;"><i class="ace-icon fa fa-pencil"></i></button>'.
                                                    $checkDelete;
                                            }
                                        }

                                    }

                                } else {
                                    echo '<li> <button>'.$value['ASSOCIATION_NAME'].'</button>';
                                }

                                if (!empty($value['children'])) {
                                    echo "<ul>";
                                    createTree($value['children'], $session,$previllage);
                                    echo "</ul>";
                                }
                                echo '</li>';
                            }

                        }
                        echo "<ul class='tree'>";

                        createTree($tree, $session, $previllage);
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
    @include('masterGlobal.ajaxFormSubmit')
@endsection

