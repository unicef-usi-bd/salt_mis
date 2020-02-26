@extends('master')

@section('mainContent')
    {{--@include('masterGlobal.datePicker')--}}
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

    <style>
        .table th{
            text-align: center;
        }
    </style>

    <div class="page-header">
        <h1>
            {{--{{ trans('soeReport.report') }}--}}
            Setup
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{--{{ trans('soeReport.report_dashboard') }}--}}
                Miller Profile
            </small>
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-sm-12">
            <table class="table table-striped table-bordered table-hover gridTable" title="{{ trans('module.module_list') }}">
                <thead>
                <tr>
                    <th class="fixedWidth" style="width: 5px;">Sl</th>
                    <th class="center fixedWidth">Mill Name</th>
                    <th class="center fixedWidth">Owner Type</th>
                    <th class="center fixedWidth">Certificate Renewing Date</th>
                    <th class="center fixedWidth">Full Time Employee</th>
                    <th class="center fixedWidth">Active Status</th>
                    <th class="center fixedWidth">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $sl=0;?>
                @foreach( $millerList as $row)
                    <?php
                    $activeFlg = $row->ACTIVE_FLG;
                    ?>
                    <tr>
                        <td class="center" >  {{ ++$sl }}</td>
                        <td> {{ $row->MILL_NAME }} </td>
                        <td> {{ $row->LOOKUPCHD_NAME }} </td>
                        <td> {{ $row->RENEWING_DATE }} </td>
                        <td> {{ $row->FULLTIMEMALE_EMP+$row->FULLTIMEFEM_EMP }} </td>
                        <td class="hidden-480">
                            <?php if ($activeFlg == 1){ ?>
                            <span class="label label-sm label-info arrowed arrowed-righ">Active</span>
                            <?php }else{ ?>
                            <span class="label label-sm label-danger arrowed arrowed-righ">Inactive </span>
                            <?php } ?>
                        </td>

                        <td class="">
                            <div class="hidden-sm hidden-xs action-buttons">
                                @php
                                    $editPermissionLevel = $previllage->UPDATE;
                                    $viewPermissionLevel = $previllage->READ;
                                @endphp
                                @if($viewPermissionLevel == 1)
                                    <a href="#" id='{{ "mill-info/$row->MILL_ID" }}' class="blue showModalGlobal" modal-size="modal-lg" data-target=".modal" data-toggle="modal" data-permission="{{ $viewPermissionLevel }}" role="button" title="View Miller Profile Details">
                                                <span class="blue">
                                                    <i class="ace-icon fa fa-eye bigger-130"></i>
                                                </span>
                                    </a>
                                @endif
                                @if($editPermissionLevel == 1)
                                    <a class="showModalGlobal" id='{{ "mill-info/$row->MILL_ID/edit" }}' data-target=".modal" modal-size="modal-bg" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Miller Profile Details">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>
                                @endif
                                @if($previllage->DELETE == 1)
                                    <a class="red clickForDelete row{{ $row->MILL_ID }}" data-token="{{ csrf_token() }}" data-action="{{ 'mill-info/'.$row->MILL_ID }}"  role="button" title="Delete Miller Profile Details">
                                        <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                    </a>
                                @endif

                                @if($viewPermissionLevel == 1)
                                    @php $hasUpdateRequest = App\MillerInfo::millerUpdateStatus($row->MILL_ID); @endphp
                                    @if(!empty($hasUpdateRequest))
                                        <a href="#" id='{{ "miller-profile-approval/$row->MILL_ID" }}' class="blue showModalGlobal" modal-size="modal-bg" data-target=".modal" data-toggle="modal" data-permission="{{ $viewPermissionLevel }}" role="button" title="View Miller Profile Approval">
                                            <span class="blue">
                                                <i class="ace-icon fa fa-check bigger-130"></i>
                                            </span>
                                        </a>
                                    @endif
                                @endif
                            </div>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div><!-- /.col -->
        <div class="space"></div>
    </div><!-- /.row -->
    <!--Add New Group Modal Start-->
    @include('masterGlobal.deleteScript')
@endsection
