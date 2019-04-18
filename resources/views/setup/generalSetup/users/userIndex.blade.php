@extends('master')

@section('mainContent')

    <div class="page-header">
        <h1>
            {{ trans('breadcrumb.all_setup') }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('user.user') }}
            </small>
        </h1>
    </div><!-- /.page-header -->
    <div class="row">
        <div class="col-xs-12">
            @if(session('message'))
                <p  class="alert alert-warning alert-dismissible">{{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </p>

            @endif

            <table class="table table-striped table-bordered table-hover gridTable" title="{{ trans('user.user_list') }}">
                <thead>
                <tr>

                    <th class="fixedWidth">{{ trans('dashboard.sl') }}</th>
                    <th>{{ trans('user.user_full_name') }}</th>
                    <th>{{ trans('user.user_name') }}</th>
                    <th>Center</th>
                    <th>{{ trans('user.user_group') }}</th>
                    <th>{{ trans('user.group_level') }}</th>
                    <th>{{ trans('user.email') }}</th>
                    <th>{{ trans('user.remark') }}</th>
                    <th>{{ trans('user.status') }}</th>
                    <th width="50px">{{ trans('dashboard.action') }}</th>
                </tr>
                </thead>


                <tbody>
                <?php $sl=0;?>
                @foreach($users as $user)
                    <tr>
                        <td class="center">{{ ++$sl }}</td>
                        <td>{{$user->user_full_name}}</td>
                        <td>{{$user->username}}</td>
                        <td>{{$user->ASSOCIATION_NAME}}</td>
                        <td>{{$user->USERGRP_NAME}}</td>
                        <td>{{$user->UGLEVE_NAME}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->remarks}}</td>
                        <td>
                            @if($user->active_status == 1)
                                <span class="label label-sm label-info arrowed arrowed-righ">Active</span>
                            @else
                                <span class="label label-sm label-danger arrowed arrowed-righ">Inactive</span>
                            @endif
                        </td>
                        <td class="row{{ $user->id }}">
                            <div class="hidden-sm hidden-xs action-buttons">
                                @php
                                    $editPermissionLevel = $previllage->UPDATE;
                                    $viewPermissionLevel = $previllage->READ;
                                @endphp
                                @if($viewPermissionLevel == 1)
                                    <a href="#" id="{{ 'users/'.$user->id }}" class="blue showModalGlobal" data-target=".modal" data-toggle="modal" role="button" data-permission="{{ $viewPermissionLevel }}" modal-size="modal-lg" title="{{ trans('user.view_user') }}">
                                            <span class="blue">
                                                <i class="ace-icon fa fa-eye bigger-130"></i>
                                            </span>
                                    </a>
                                @else
                                    <a href="#" id="{{ 'users/'.$user->id }}" class="blue showModalGlobal" data-target=".modal" data-toggle="modal" role="button" data-permission="{{ $viewPermissionLevel }}" modal-size="modal-lg" title="{{ trans('user.view_user') }}" style="display: none;">
                                        <span class="blue">
                                            <i class="ace-icon fa fa-eye bigger-130"></i>
                                        </span>
                                    </a>
                                @endif
                                @if($editPermissionLevel == 1)
                                    <a class="green showModalGlobal" id="{{ 'users/'.$user->id.'/edit' }}" data-target=".modal" role="button"  data-toggle="modal" data-permission="{{ $editPermissionLevel }}" modal-size="modal-lg" title="{{ trans('user.edit_user') }}">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>
                                @else
                                    <a class="green showModalGlobal" id="{{ 'users/'.$user->id.'/edit' }}" data-target=".modal" role="button"  data-toggle="modal" data-permission="{{ $editPermissionLevel }}" modal-size="modal-lg" title="{{ trans('user.edit_user') }}" style="display: none;">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>
                                @endif
                                {{--@if($bank->checkDelete == 0)--}}
                                @if($previllage->DELETE == 1)
                                    <a class="red clickForDelete row{{ $user->id }}" data-token="{{ csrf_token() }}" data-action="{{ 'users/'.$user->id }}" role="button" title="{{ trans('user.delete_user') }}">
                                            <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                        </a>
                                @endif
                                {{--@endif--}}
                            </div>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <!--Add New Group Modal Start-->

    @include('masterGlobal.deleteScript')
    @include('masterGlobal.ajaxFormSubmit')
    <!-- Add New Group Modal End -->


@endsection
