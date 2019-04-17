@extends('master')
@section('mainContent')

    <div class="page-header">
        <h1>
            {{ trans('breadcrumb.all_setup') }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('breadcrumb.organization') }}
            </small>
        </h1>
    </div><!-- /.page-header -->
    <div class="row">
        <div class="row">
        </div>
        @if(session('message'))
            <p  class="alert alert-warning alert-dismissible">{{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </p>

        @endif
        <div class="col-xs-12">
            <table class="table table-striped table-bordered table-hover gridTable" title="Organization List">
                <thead>
                <tr>
                    <th class="fixedWidth" >{{ trans('dashboard.sl') }}</th>
                    <th>{{ trans('organization.name') }}</th>
                    <th>{{ trans('organization.address') }}</th>
                    <th class="hidden-480">{{ trans('organization.email') }}</th>
                    <th class="hidden-480">{{ trans('organization.fax') }}</th>
                    <th class="hidden-480 fixedWidth">{{ trans('cigGroup.active_status') }}</th>

                    <th class="center fixedWidth">{{ trans('dashboard.action') }}</th>
                </tr>
                </thead>
                <tbody>
                <?php $sl=0;?>
                @foreach( $organizations as $organization)
                    <tr>
                        <td class="center">
                            {{ ++$sl }}
                        </td>

                        <td>{{ $organization->org_name }}</td>
                        <td>{{ $organization->org_address }}</td>
                        <td class="hidden-480">{{ $organization->email_address }}</td>
                        <td class="hidden-480">{{ $organization->fax }}</td>

                        {{--<td class="hidden-480">--}}
                        {{--<span class="label label-sm label-info arrowed arrowed-righ">@if($organization->active_status==1) Active @else Inactive @endif</span>--}}
                        {{--</td>--}}
                        <td class="hidden-480">
                            @if($organization->active_status == 0)
                                <span class="label label-sm label-danger arrowed arrowed-righ"> Inactive</span>
                            @else
                                <span class="label label-sm label-info arrowed arrowed-righ">Active</span>
                            @endif
                        </td>

                        <td class="row{{ $organization->org_id }}">
                            <div class="hidden-sm hidden-xs action-buttons">
                                @php
                                    $editPermissionLevel = $previllage->UPDATE;
                                    $viewPermissionLevel = $previllage->READ;
                                @endphp
                                @if($viewPermissionLevel == 1)
                                    <a class="blue showModalGlobal" id='{{ "organization/$organization->org_id" }}' data-target=".modal" role="button"  data-toggle="modal" data-permission="{{ $viewPermissionLevel }}" modal-size="modal-lg" title="{{ trans('organization.view_organisation') }}">
                                        <i class="ace-icon fa fa fa-eye bigger-130"></i>
                                    </a>
                                @else
                                    <a class="blue showModalGlobal" id='{{ "organization/$organization->org_id" }}' data-target=".modal" role="button"  data-toggle="modal" data-permission="{{ $viewPermissionLevel }}" modal-size="modal-lg" title="{{ trans('organization.view_organisation') }}" style="display: none;">
                                        <i class="ace-icon fa fa fa-eye bigger-130"></i>
                                    </a>
                                @endif
                                @if($editPermissionLevel == 1)
                                    <a class="green showModalGlobal" id='{{ "organization/$organization->org_id/edit" }}' data-target=".modal" role="button"  data-toggle="modal" data-permission="{{ $editPermissionLevel }}" modal-size="modal-lg" title="{{ trans('organization.edit_organisation') }}">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>
                                @else
                                    <a class="green showModalGlobal" id='{{ "organization/$organization->org_id/edit" }}' data-target=".modal" role="button"  data-toggle="modal" data-permission="{{ $editPermissionLevel }}"  modal-size="modal-lg" title="{{ trans('organization.edit_organisation') }}" style="display: none;">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>
                                @endif
                                @if($previllage->DELETE == 1)
                                    <a class="red clickForDelete" data-token="{{ csrf_token() }}" data-action="{{ 'organization/'.$organization->org_id }}" role="button" title="{{ trans('organization.delete_organisation') }}">
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
                                            <a class="blue showModalGlobal" id='{{ "organization/$organization->org_id" }}' data-target=".modal" role="button"  data-toggle="modal" modal-size="modal-lg" title="View Organization">
                                                <span class="blue">
                                                        <i class="ace-icon fa fa-eye bigger-120"></i>
                                                    </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a class="green showModalGlobal" id='{{ "organization/$organization->org_id/edit" }}' data-target=".modal" role="button"  data-toggle="modal" modal-size="modal-lg" title="Edit Organization">
                                                    <span class="green">
                                                        <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                    </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a class="red clickForDelete" data-token="{{ csrf_token() }}" data-action="{{ 'organization/'.$organization->org_id }}" role="button" title="Delete Organization">
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
                @endforeach
                @include('masterGlobal.deleteScript')
                @include('masterGlobal.ajaxFormSubmit')
                </tbody>
            </table>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
