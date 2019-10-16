@extends('master')

@section('mainContent')

    <div class="page-header">
        <h1>
            All Setup
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Certificate Issuer Setup
            </small>
        </h1>
    </div><!-- /.page-header -->
    <div class="row">
        <div class="col-xs-12">

            <table class="table table-striped table-bordered table-hover gridTable" title="Bank List">
                <thead>
                <tr>
                    <th class="fixedWidth">{{ trans('dashboard.sl') }}</th>
                    <th>Certificate Name</th>
                    <th>Issuer Name</th>
                    <th>Certificate Type</th>
                    <th>Status </th>
                    <th class="fixedWidth">{{ trans('dashboard.action') }}</th>
                </tr>
                </thead>


                <tbody>
                <?php $sl=0;?>
                @foreach($issuerData as $row)
                    <tr>
                        <td class="center">{{ ++$sl }}</td>
                        <td>{{$row->CERTIFICATE_NAME}}</td>
                        <td>{{$row->LOOKUPCHD_NAME}}</td>

                        <td>
                            @if($row->CERTIFICATE_TYPE == 1)
                                <span class="label label-sm label-info arrowed arrowed-righ">Mandatory</span>
                            @else
                                <span class="label label-sm label-danger arrowed arrowed-righ">Not Mandatory</span>
                            @endif
                        </td>

                        <td>
                            @if($row->ACTIVE_FLG == 1)
                                <span class="label label-sm label-info arrowed arrowed-righ">Active</span>
                            @else
                                <span class="label label-sm label-danger arrowed arrowed-righ">Inactive</span>
                            @endif
                        </td>
                        <td class="row{{ $row->CERTIFICATE_ID }}">
                            @php
                                $editPermissionLevel = $previllage->UPDATE;
                                $viewPermissionLevel = $previllage->READ;
                            @endphp
                            @if($viewPermissionLevel == 1)
                                <a href="#" id="{{ 'certificate/'.$row->CERTIFICATE_ID }}" class="blue showModalGlobal" data-target=".modal" data-permission="{{ $viewPermissionLevel }}" data-toggle="modal" role="button" title="View Certificate Issuer">
                        <span class="blue">
                            <i class="ace-icon fa fa-eye bigger-130"></i>
                        </span>
                                </a>
                            @else
                                <a href="#" id="{{ 'certificate/'.$row->CERTIFICATE_ID }}" class="blue showModalGlobal" data-target=".modal" data-permission="{{ $viewPermissionLevel }}" data-toggle="modal" role="button" title="View Certificate Issuer" style="display: none;">
                        <span class="blue">
                            <i class="ace-icon fa fa-eye bigger-130"></i>
                        </span>
                                </a>
                            @endif
                            @if($editPermissionLevel == 1)
                                <a class="green showModalGlobal" id="{{ 'certificate/'.$row->CERTIFICATE_ID.'/edit' }}" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Certificate Issuer">
                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                </a>
                            @else
                                <a class="green showModalGlobal" id="{{ 'certificate/'.$row->CERTIFICATE_ID.'/edit' }}" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Certificate Issuer" style="display: none;">
                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                </a>
                            @endif
                            @if($previllage->DELETE == 1)
                                <a class="red clickForDelete row{{ $row->CERTIFICATE_ID }}" data-token="{{ csrf_token() }}" data-action="{{ 'certificate/'.$row->CERTIFICATE_ID }}" role="button" title="Delete Certificate Issuer">
                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div><!-- /.col -->

    </div><!-- /.row -->

    @include('masterGlobal.deleteScript')

@endsection

