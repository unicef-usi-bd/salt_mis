@extends('master')

@section('mainContent')

    <div class="page-header">
        <h1>
            {{ trans('breadcrumb.all_setup') }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('breadcrumb.email_template') }}
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

            <table class="table table-striped table-bordered table-hover gridTable" title="Email Template List">
                <thead>
                <tr>

                    <th class="fixedWidth">{{ trans('dashboard.sl') }}</th>
                    <th>{{ trans('emailTemplete.email_type_name') }}</th>
                    <th class="hidden-480">{{ trans('emailTemplete.subject') }}</th>
                    <th class="hidden-480">{{ trans('lookupGroupIndex.description') }}</th>
                    <th>{{ trans('cigGroup.active_status') }}</th>
                    <th>{{ trans('dashboard.action') }}</th>
                </tr>
                </thead>


                <tbody>
                <?php $sl=0;?>
                @foreach($emailTemplates as $emailTemplate)
                    <tr>
                        <td class="center">{{ ++$sl }}</td>
                        <td>{{$emailTemplate->group_data_name}}</td>
                        <td class="hidden-480">{{$emailTemplate->email_subject}}</td>
                        <td class="hidden-480">{!! \Illuminate\Support\Str::words($emailTemplate->email_body, 15,'....') !!}</td>
                        <td>
                            @if($emailTemplate->active_status == 1)
                                <span class="label label-sm label-info arrowed arrowed-righ">Active</span>
                            @else
                                <span class="label label-sm label-danger arrowed arrowed-righ">Inactive</span>
                            @endif
                        </td>
                        <td class="row{{ $emailTemplate->email_template_id }}">

                            <div class="hidden-sm hidden-xs action-buttons">
                                @php
                                    $editPermissionLevel = $previllage->UPDATE;
                                    $viewPermissionLevel = $previllage->READ;
                                @endphp
                                @if($viewPermissionLevel == 1)
                                <a href="#" id="{{ 'email-templates/'.$emailTemplate->email_template_id }}" class="blue showModalGlobal" data-target=".modal" data-toggle="modal" modal-size="modal-lg" role="button" data-permission="{{ $viewPermissionLevel }}" title="{{ trans('emailTemplete.view_email_template') }}">
                                    <span class="blue">
                                        <i class="ace-icon fa fa-eye bigger-130"></i>
                                    </span>
                                </a>
                                @else
                                    <a href="#" id="{{ 'email-templates/'.$emailTemplate->email_template_id }}" class="blue showModalGlobal" data-target=".modal" data-toggle="modal" modal-size="modal-lg" role="button" data-permission="{{ $viewPermissionLevel }}" title="{{ trans('emailTemplete.view_email_template') }}" style="display: none;">
                                        <span class="blue">
                                            <i class="ace-icon fa fa-eye bigger-130"></i>
                                        </span>
                                    </a>
                                @endif
                                @if($editPermissionLevel == 1)
                                    <a class="green showModalGlobal" id="{{ 'email-templates/'.$emailTemplate->email_template_id.'/edit' }}" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}" data-toggle="modal" modal-size="modal-lg" title="{{ trans('emailTemplete.edit_email_template') }}">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>
                                @else
                                    <a class="green showModalGlobal" id="{{ 'email-templates/'.$emailTemplate->email_template_id.'/edit' }}" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}" data-toggle="modal" modal-size="modal-lg" title="{{ trans('emailTemplete.edit_email_template') }}" style="display: none;">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>
                                @endif
                                @if($previllage->DELETE == 1)
                                    <a class="red clickForDelete row{{ $emailTemplate->email_template_id }}" data-token="{{ csrf_token() }}" data-action="{{ 'email-templates/'.$emailTemplate->email_template_id }}" role="button" title="{{ trans('emailTemplete.delete_email_template') }}">
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
                                        <li>
                                            @if($viewPermissionLevel == 1)
                                                <a href="#" id="{{ 'email-templates/'.$emailTemplate->email_template_id }}" class="blue showModalGlobal" data-target=".modal" data-toggle="modal" modal-size="modal-lg" role="button" data-permission="{{ $viewPermissionLevel }}" title="{{ trans('emailTemplete.view_email_template') }}">
                                                    <span class="blue">
                                                        <i class="ace-icon fa fa-eye bigger-130"></i>
                                                    </span>
                                                </a>
                                            @else
                                                <a href="#" id="{{ 'email-templates/'.$emailTemplate->email_template_id }}" class="blue showModalGlobal" data-target=".modal" data-toggle="modal" modal-size="modal-lg" role="button" data-permission="{{ $viewPermissionLevel }}" title="{{ trans('emailTemplete.view_email_template') }}" style="display: none;">
                                                    <span class="blue">
                                                        <i class="ace-icon fa fa-eye bigger-130"></i>
                                                    </span>
                                                </a>
                                            @endif

                                        </li>

                                        <li>
                                            @if($editPermissionLevel == 1)
                                                <a class="green showModalGlobal" id="{{ 'email-templates/'.$emailTemplate->email_template_id.'/edit' }}" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}" data-toggle="modal" modal-size="modal-lg" title="{{ trans('emailTemplete.edit_email_template') }}">
                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                </a>
                                            @else
                                                <a class="green showModalGlobal" id="{{ 'email-templates/'.$emailTemplate->email_template_id.'/edit' }}" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}" data-toggle="modal" modal-size="modal-lg" title="{{ trans('emailTemplete.edit_email_template') }}" style="display: none;">
                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                </a>
                                            @endif
                                        </li>

                                        <li>

                                            @if($previllage->DELETE == 1)
                                                <a class="red clickForDelete row{{ $emailTemplate->email_template_id }}" data-token="{{ csrf_token() }}" data-action="{{ 'email-templates/'.$emailTemplate->email_template_id }}" role="button" title="{{ trans('emailTemplete.delete_email_template') }}">
                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                </a>
                                            @endif


                                        </li>
                                    </ul>

                                </div>
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
