@extends('master')

@section('mainContent')
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.min.css') }}" />
    <div class="page-header">
        <h1>
            {{ trans('module.access_control') }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('module.user_group') }}
            </small>
        </h1>
    </div><!-- /.page-header -->
    <div class="row">
        @if(session('message'))
            <p  class="alert alert-warning alert-dismissible">{{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </p>

        @endif
        <div class="col-lg-10 col-lg-offset-1 col-xs-12">
            <div class="row">
                <div id="accordion" class="accordion-style2">

                    @foreach( $userGroups as $key => $userGroup)


                        <div class="group">
                            @php
                                $editPermissionLevel = $previllage->UPDATE;
                            @endphp
                            <h3 class="accordion-header action-buttons"> {{ ++$key }}.   {{$userGroup->USERGRP_NAME}}
                                {{--@if( $userGroup->checkDelete==0)--}}
                                @if($previllage->DELETE == 1)
                                        <a class="red pull-right clickForDelete row{{ $userGroup->USERGRP_ID }}" data-token="{{ csrf_token() }}" data-action="{{ 'user-groups/'.$userGroup->USERGRP_ID }}" role="button" title="{{ trans('module.delete_user_group') }}">
                                            <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                        </a>
                                @endif
                                {{--@endif--}}
                                @if($editPermissionLevel == 1)
                                <a id="{{ 'user-groups/'.$userGroup->USERGRP_ID.'/edit' }}" class="green pull-right showModalGlobal" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="{{ trans('module.edit_user_group') }}">
                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                </a>
                                @else
                                    <a id="{{ 'user-groups/'.$userGroup->USERGRP_ID.'/edit' }}" class="green pull-right showModalGlobal" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="{{ trans('module.edit_user_group') }}" style="display: none;">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>
                                @endif
                                {{--<a id="{{ 'user-groups/'.$userGroup->USERGRP_ID }}" class="blue pull-right showModalGlobal" data-target=".modal" role="button"  data-toggle="modal" title="View User Group">--}}
                                    {{--<i class="ace-icon fa fa-eye bigger-130"></i>--}}
                                {{--</a>--}}


                            </h3>

                            <div class="row">

                                <p style="margin-bottom: 30px;">
                                    @php
                                        $createPermissionLevel = $previllage->CREATE;
                                    @endphp
                                    <button id="{{ 'user-group-levels/create-data/'.$userGroup->USERGRP_ID }}" data-target=".modal" data-id="{{ $userGroup->USERGRP_ID }}" role="button" data-permission="{{ $createPermissionLevel }}" class="test btn btn-minier btn-primary pull-right showModalGlobal" data-toggle="modal" title="User Group Level Create"> {{ trans('dashboard.add_new') }} </button>
                                </p>
                                <div class="col-lg-12">
                                    <table style="margin-bottom: 10px;" class="table table-striped table-bordered table-hover gridTable" title="User Group Level List">
                                        <thead>
                                        <tr>

                                            <th class="fixedWidth" >{{ trans('dashboard.sl') }}</th>
                                            <th>{{ trans('user.name') }}</th>
                                            <th class="hidden-480">{{ trans('user.status') }}</th>
                                            <th class="center fixedWidth" >{{ trans('dashboard.action') }}</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                            <?php $sl=0;?>
                                            <?php $userGrpLvls = DB::table('sa_ug_level')->where('USERGRP_ID','=',$userGroup->USERGRP_ID)->get(); ?>
                                            <?php foreach($userGrpLvls as $userGrpLvl){ ?>


                                            <tr>
                                                <td  align="center">
                                                    {{ ++$sl }}
                                                </td>

                                                <td>
                                                    <?php echo $userGrpLvl->UGLEVE_NAME; ?>

                                                </td>
                                                <td class="hidden-480">
                                                    <?php  if($userGrpLvl->IS_ACTIVE == 0){ ?>
                                                    <span class="label label-sm label-danger arrowed arrowed-righ">Inactive</span>
                                                    <?php }else{ ?>
                                                    <span class="label label-sm label-info arrowed arrowed-righ">Active</span>
                                                    <?php } ?>

                                                </td>

                                                <td class="row{{ $userGrpLvl->UG_LEVEL_ID }}">
                                                    <div class="hidden-sm hidden-xs action-buttons">
                                                        @php
                                                            $editPermissionLevel = $previllage->UPDATE;
                                                        @endphp


                                                        {{--<a href="#" id="{{ 'user-group-levels/'.$userGrpLvl->UG_LEVEL_ID }}" class="blue showModalGlobal" data-target=".modal" data-toggle="modal" role="button" title="View Lookup Group Data">--}}
                                                        {{--<span class="blue">--}}
                                                            {{--<i class="ace-icon fa fa-eye bigger-130"></i>--}}
                                                        {{--</span>--}}
                                                        {{--</a>--}}
                                                        @if($editPermissionLevel == 1)
                                                            <a class="green showModalGlobal" id="{{ 'user-group-levels/'.$userGrpLvl->UG_LEVEL_ID.'/edit' }}" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="{{ trans('module.edit_user_group_level') }}">
                                                                <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                            </a>
                                                        @else
                                                            <a class="green showModalGlobal" id="{{ 'user-group-levels/'.$userGrpLvl->UG_LEVEL_ID.'/edit' }}" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="{{ trans('module.edit_user_group_level') }}" style="display: none;">
                                                                <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                            </a>
                                                        @endif
                                                        @if($previllage->DELETE == 1)
                                                            <a class="red clickForDelete row{{ $userGrpLvl->UG_LEVEL_ID }}" data-token="{{ csrf_token() }}" data-action="{{ 'user-group-levels/'.$userGrpLvl->UG_LEVEL_ID }}" role="button" title="{{ trans('module.delete_user_group_level') }}">
                                                                <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                            </a>
                                                        @endif

                                                    </div>

                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>

            </div>
            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->

    <!--Sweet Alert Global Script Start-->
    @include('masterGlobal.deleteScript')
    @include('masterGlobal.ajaxFormSubmit')
    <!-- Sweet Alert Global Script End -->


    <script type="text/javascript">


        //jquery accordion
        $( "#accordion" ).accordion({
            active: false,
            collapsible: true ,
            heightStyle: "content",
            animate: 250,
            header: ".accordion-header"
        }).sortable({
            axis: "y",
            handle: ".accordion-header",
            stop: function( event, ui ) {
                // IE doesn't register the blur when sorting
                // so trigger focusout handlers to remove .ui-state-focus
                ui.item.children( ".accordion-header" ).triggerHandler( "focusout" );
            }
        });

    </script>

@endsection
