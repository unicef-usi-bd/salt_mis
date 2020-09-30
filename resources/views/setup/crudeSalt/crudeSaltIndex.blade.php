@extends('master')

@section('mainContent')

    <div class="page-header">
        <h1>
            Crude Salt
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Crude Salt Details
            </small>
        </h1>
    </div><!-- /.page-header -->
    <div class="row">
        <div class="col-xs-12">

            <table class="table table-striped table-bordered table-hover gridTable" data-tools="false">
                <thead>
                <tr>
                    <th class="fixedWidth">{{ trans('dashboard.sl') }}</th>
                    <th>Crude Salt Type</th>
                    <th>Chloride content (as NaCl), %m/m</th>
                    <th>Moisture, %m/m</th>
                    <th>Iodine content, mg/kg</th>
                    <th>pH Value</th>
                    <th>Status </th>
                    <th class="fixedWidth">{{ trans('dashboard.action') }}</th>
                </tr>
                </thead>


                <tbody>
                <?php $sl=0;?>
                @foreach($crudeSalts as $crudeSalt)
                <tr>
                    <td class="center">{{ ++$sl }}</td>
                    <td>{{$crudeSalt->ITEM_NAME}}</td>
                    <td>{{$crudeSalt->SODIUM_CHLORIDE}}</td>
                    <td>{{$crudeSalt->MOISTURIZER}}</td>
                    <td>{{$crudeSalt->PPM}}</td>
                    <td>{{$crudeSalt->PH}}</td>
                    <td>
                        @if($crudeSalt->ACTIVE_FLG == 1)
                            <span class="label label-sm label-info arrowed arrowed-righ">Active</span>
                        @else
                            <span class="label label-sm label-danger arrowed arrowed-righ">Inactive</span>
                        @endif
                    </td>
                    <td class="row{{ $crudeSalt->CRUDSALTDETAIL_ID }}">
                    @php
                    $editPermissionLevel = $previllage->UPDATE;
                    $viewPermissionLevel = $previllage->READ;
                    @endphp
                    @if($viewPermissionLevel == 1)
                    <a href="#" id="{{ 'crude-salt-details/'.$crudeSalt->CRUDSALTDETAIL_ID }}" class="blue showModalGlobal" data-target=".modal" data-permission="{{ $viewPermissionLevel }}" data-toggle="modal" role="button" title="View Crude Salt Details">
                        <span class="blue">
                            <i class="ace-icon fa fa-eye bigger-130"></i>
                        </span>
                    </a>
                    @else
                    <a href="#" id="{{ 'crude-salt-details/'.$crudeSalt->CRUDSALTDETAIL_ID }}" class="blue showModalGlobal" data-target=".modal" data-permission="{{ $viewPermissionLevel }}" data-toggle="modal" role="button" title="View Crude Salt Details" style="display: none;">
                        <span class="blue">
                            <i class="ace-icon fa fa-eye bigger-130"></i>
                        </span>
                    </a>
                    @endif
                    @if($editPermissionLevel == 1)
                    <a class="green showModalGlobal" id="{{ 'crude-salt-details/'.$crudeSalt->CRUDSALTDETAIL_ID.'/edit' }}" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Crude Salt Details">
                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                    </a>
                    @else
                    <a class="green showModalGlobal" id="{{ 'crude-salt-details/'.$crudeSalt->CRUDSALTDETAIL_ID.'/edit' }}" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Crude Salt Details" style="display: none;">
                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                    </a>
                    @endif
                    @if($previllage->DELETE == 1)
                    <a class="red clickForDelete row{{ $crudeSalt->CRUDSALTDETAIL_ID }}" data-token="{{ csrf_token() }}" data-action="{{ 'crude-salt-details/'.$crudeSalt->CRUDSALTDETAIL_ID }}" role="button" title="Delete Crude Salt Details">
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

