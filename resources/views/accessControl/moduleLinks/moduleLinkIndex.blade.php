@extends('master')

@section('mainContent')

    <div class="page-header">
        <h1>
            {{ trans('module.access_control') }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('moduleLinks.module_links') }}
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

            <table class="table table-striped table-bordered table-hover gridTable" title="{{ trans('moduleLinks.module_link_list') }}">
                <thead>
                    <tr>

                        <th class="fixedWidth">{{ trans('dashboard.sl') }}</th>
                        <th>{{ trans('module.module_name') }}</th>
                        <th>{{ trans('moduleLinks.link_name') }}</th>
                        <th>{{ trans('moduleLinks.link_url') }}</th>
                        <th>{{ trans('moduleLinks.link_serial') }}</th>
                        <th>{{ trans('module.status') }}</th>
                        <th>{{ trans('dashboard.action') }}</th>
                    </tr>
                </thead>


                <tbody>
                <?php $sl=0;?>
                @foreach($moduleLinks as $moduleLink)
                    <tr>
                        <td class="center">{{ ++$sl }}</td>
                        <td>{{$moduleLink->MODULE_NAME}}</td>
                        <td class="hidden-480">{{$moduleLink->LINK_NAME}}</td>
                        <td class="hidden-480">{{$moduleLink->LINK_URI}}</td>
                        <td class="hidden-480">{{$moduleLink->SL_NO}}</td>
                        <td>
                            @if($moduleLink->IS_ACTIVE == 1)
                                <span class="label label-sm label-info arrowed arrowed-righ">Active</span>
                            @else
                                <span class="label label-sm label-danger arrowed arrowed-righ">Inactive</span>
                            @endif
                        </td>
                        <td class="row{{ $moduleLink->LINK_ID }}">
                            <div class="hidden-sm hidden-xs action-buttons">


                                {{--<a href="#" id="{{ 'module-links/'.$moduleLink->LINK_ID }}" class="blue showModalGlobal" data-target=".modal" data-toggle="modal" role="button" title="View Link">--}}
                                        {{--<span class="blue">--}}
                                            {{--<i class="ace-icon fa fa-eye bigger-130"></i>--}}
                                        {{--</span>--}}
                                {{--</a>--}}

                                @php
                                    $editPermissionLevel = $previllage->UPDATE;
                                @endphp
                                @if($editPermissionLevel == 1)
                                    <a class="green showModalGlobal" id="{{ 'module-links/'.$moduleLink->LINK_ID.'/edit' }}" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="{{ trans('moduleLinks.edit_link') }}">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>
                                @else
                                    <a class="green showModalGlobal" id="{{ 'module-links/'.$moduleLink->LINK_ID.'/edit' }}" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="{{ trans('moduleLinks.edit_link') }}" style="display: none;">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>
                                @endif
                                {{--@if($bank->checkDelete == 0)--}}
                                @if($previllage->DELETE == 1)
                                    <a class="red clickForDelete row{{ $moduleLink->LINK_ID }}" data-token="{{ csrf_token() }}" data-action="{{ 'module-links/'.$moduleLink->LINK_ID }}" role="button" data-toggle="modal" title="{{ trans('moduleLinks.delete_link') }}">
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
