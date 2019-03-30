@extends('master')
@section('mainContent')

    <div class="page-header">
        {{--<h1>--}}
            {{--{{ trans('module.access_control') }}--}}
            {{--<small>--}}
                {{--<i class="ace-icon fa fa-angle-double-right"></i>--}}
                {{--{{ trans('module.module') }}--}}
            {{--</small>--}}
        {{--</h1>--}}

        <h1>
            Setup
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Basic Setup
            </small>
        </h1>
    </div><!-- /.page-header -->
    <div class="row">
        <div class="row">
        </div>
        <div class="col-xs-12">
            @if(session('message'))
                <p  class="alert alert-warning alert-dismissible">{{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </p>

            @endif
            <table class="table table-striped table-bordered table-hover gridTable" title="{{ trans('module.module_list') }}">
                <thead>
                {{--<tr>--}}
                    {{--<th class="fixedWidth" >{{ trans('dashboard.sl') }}</th>--}}
                    {{--<th>{{ trans('module.name') }}</th>--}}
                    {{--<th>{{ trans('module.icon') }}</th>--}}
                    {{--<th class="hidden-480 fixedWidth">{{ trans('module.status') }}</th>--}}
                    {{--<th class="center fixedWidth">{{ trans('dashboard.action') }}</th>--}}
                {{--</tr>--}}
                <tr>
                    <th class="fixedWidth" >Sl</th>
                    <th class="center fixedWidth">Salt Type</th>
                    <th class="center fixedWidth">Sodium chloride</th>
                    <th class="center fixedWidth">Moisturizer</th>
                    <th class="center fixedWidth">Iodine content(PPM)</th>
                    <th class="center fixedWidth">Iodine content(PPM)</th>
                    <th class="center fixedWidth"> PH</th>
                    <th class="center fixedWidth">Action</th>

                </tr>
                </thead>
                <tbody>
<!--                --><?php //$sl=0;?>
                {{--@foreach( $modules as $module)--}}
                    <tr>
                        <td class="center">
                            {{--{{ ++$sl }}--}}
                        </td>

                        <td>
                            {{--{{ $module->MODULE_NAME }}--}}
                        </td>
                        <td>
                            {{--{{ $module->MODULE_ICON }}--}}
                        </td>
                        <td>
                            {{--{{ $module->MODULE_ICON }}--}}
                        </td>
                        <td>
                            {{--{{ $module->MODULE_ICON }}--}}
                        </td>
                        <td>
                            {{--{{ $module->MODULE_ICON }}--}}
                        </td>
                        <td class="hidden-480">
                            {{--<span class="label label-sm label-info arrowed arrowed-righ">@if($module->IS_ACTIVE==1) Active @else Inactive @endif</span>--}}
                        </td>

                        {{--<td class="row{{ $module->MODULE_ID }}">--}}
                        <td class="">
                            <div class="hidden-sm hidden-xs action-buttons">
                                {{--<a class="blue showModalGlobal" id='{{ "modules/$module->MODULE_ID" }}' data-target=".modal" role="button"  data-toggle="modal" title="View Modules">--}}
                                {{--<i class="ace-icon fa fa fa-eye bigger-130"></i>--}}
                                {{--</a>--}}

                                @php
                                    $editPermissionLevel = $previllage->UPDATE;
                                    $viewPermissionLevel = $previllage->READ;
                                @endphp
                                @if($viewPermissionLevel == 1)
                                    <a href="#" id='{{ "crude-salt-details/1/" }}' class="blue showModalGlobal" data-target=".modal" data-toggle="modal" data-permission="{{ $viewPermissionLevel }}" role="button" title="View Crude Salt Details">
                                                        <span class="blue">
                                                            <i class="ace-icon fa fa-eye bigger-130"></i>
                                                        </span>
                                    </a>
                                @else
                                    <a href="#" id="" class="blue showModalGlobal" data-target=".modal" data-toggle="modal" role="button" data-permission="{{ $viewPermissionLevel }}" title="{{ trans('lookupGroupIndex.view_lookup_group_data') }}" style="display: none;">
                                                        <span class="blue">
                                                            <i class="ace-icon fa fa-eye bigger-130"></i>
                                                        </span>
                                    </a>
                                @endif
                                @if($editPermissionLevel == 1)
                                    {{--<a class="green showModalGlobal" id='{{ "modules/$module->MODULE_ID/edit" }}' data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="{{ trans('module.edit_module') }}">--}}
                                        {{--<i class="ace-icon fa fa-pencil bigger-130"></i>--}}
                                    {{--</a>--}}
                                    <a class="green showModalGlobal" id='{{ "crude-salt-details/1/edit" }}' data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Crude Salt Details">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>

                                @else
                                    {{--<a class="green showModalGlobal" id='{{ "modules/$module->MODULE_ID/edit" }}' data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="{{ trans('module.edit_module') }}" style="display: none;">--}}
                                        {{--<i class="ace-icon fa fa-pencil bigger-130"></i>--}}
                                    {{--</a>--}}
                                    <a class="green showModalGlobal" id='' data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="{{ trans('module.edit_module') }}" style="display: none;">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>
                                @endif
                                @if($previllage->DELETE == 1)
                                    {{--<a class="red clickForDelete" data-token="{{ csrf_token() }}" data-action="{{ 'modules/'.$module->MODULE_ID }}" role="button" title="{{ trans('module.delete_module') }}">--}}
                                        {{--<i class="ace-icon fa fa-trash-o bigger-130"></i>--}}
                                    {{--</a>--}}
                                    <a class="red clickForDelete" data-token="{{ csrf_token() }}" data-action="" role="button" title="{{ trans('module.delete_module') }}">
                                        <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                    </a>
                                @endif

                            </div>

                            <div class="hidden-md hidden-lg">
                                <div class="inline pos-rel">
                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                    </button>

                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                        {{--<li>--}}
                                        {{--<a class="blue showModalGlobal" id='{{ "modules/$module->MODULE_ID" }}' data-target=".modal" role="button"  data-toggle="modal" title="View Modules">--}}
                                        {{--<span class="blue">--}}
                                        {{--<i class="ace-icon fa fa-eye bigger-120"></i>--}}
                                        {{--</span>--}}
                                        {{--</a>--}}
                                        {{--</li>--}}

                                        <li>
                                            {{--<a class="green showModalGlobal" id='{{ "modules/$module->MODULE_ID/edit" }}' data-target=".modal" role="button"  data-toggle="modal" title="Edit Modules">--}}
                                                    {{--<span class="green">--}}
                                                        {{--<i class="ace-icon fa fa-pencil bigger-120"></i>--}}
                                                    {{--</span>--}}
                                            {{--</a>--}}
                                            <a class="green showModalGlobal" id='' data-target=".modal" role="button"  data-toggle="modal" title="Edit Modules">
                                                    <span class="green">
                                                        <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                    </span>
                                            </a>
                                        </li>

                                        <li>
                                            {{--<a class="red clickForDelete" data-token="{{ csrf_token() }}" data-action="{{ 'modules/'.$module->MODULE_ID }}" role="button" title="Edit Modules>--}}
                                                    {{--<span class="red">--}}
                                            {{--<i class="ace-icon fa fa-trash-o bigger-120"></i>--}}
                                            {{--</span>--}}
                                            {{--</a>--}}
                                            <a class="red clickForDelete" data-token="{{ csrf_token() }}" data-action="" role="button" title="Edit Modules>
                                                    <span class="red">
                                            <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                            </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                {{--@endforeach--}}
                @include('masterGlobal.deleteScript')
                @include('masterGlobal.ajaxFormSubmit')
                </tbody>
            </table>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
