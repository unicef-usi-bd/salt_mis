@extends('master')

@section('mainContent')

    <div class="page-header">
        <h1>
            All Setup
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Brand
            </small>
        </h1>
    </div><!-- /.page-header -->
    <div class="row">
        <div class="col-xs-12">

            <table class="table table-striped table-bordered table-hover gridTable" data-tools="false" title="Bank List">
                <thead>
                <tr>
                    <th class="fixedWidth">{{ trans('dashboard.sl') }}</th>
                    <th>Brand Name</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th class="fixedWidth">{{ trans('dashboard.action') }}</th>
                </tr>
                </thead>


                <tbody>
                <?php $sl=0;?>
                @foreach($brands as $brand)
                    <tr>
                        <td class="center">{{ ++$sl }}</td>
                        <td>{{$brand->brand_name}}</td>
                        <td>{{ date('d-M-Y', strtotime($brand->ENTRY_TIMESTAMP)) }}</td>
                        <td>@if(isset($brand->UPDATE_TIMESTAMP)) {{ date('d-M-Y', strtotime($brand->UPDATE_TIMESTAMP)) }} @endif</td>
                        <td class="row{{ $brand->brand_id }}">
                            @php
                                $editPermissionLevel = $previllage->UPDATE;
                                $viewPermissionLevel = $previllage->READ;
                            @endphp
                            @if($editPermissionLevel == 1)
                                <a class="green showModalGlobal" id="{{ 'brand/'.$brand->brand_id.'/edit' }}" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Item">
                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                </a>
                            @else
                                <a class="green showModalGlobal" id="{{ 'brand/'.$brand->brand_id.'/edit' }}" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Brand" style="display: none;">
                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                </a>
                            @endif
                            @if($previllage->DELETE == 1)
                                <a class="red clickForDelete row{{ $brand->brand_id }}" data-token="{{ csrf_token() }}" data-action="{{ 'brand/'.$brand->brand_id }}" role="button" title="Delete CRUDE SALT Details">
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
    @include('masterGlobal.ajaxFormSubmit')

@endsection

