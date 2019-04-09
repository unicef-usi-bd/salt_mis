@extends('master')

@section('mainContent')

    <div class="page-header">
        <h1>
            Transaction
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Washing And Crushing
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
            <table class="table table-striped table-bordered table-hover gridTable" title="Bank List">
                <thead>
                <tr>
                    <th class="fixedWidth">{{ trans('dashboard.sl') }}</th>
                    <th>Chemical Type Name</th>
                    <th>Salt Amount</th>
                    <th>Chemical Amount</th>
                    <th>Wastage Amount</th>
                    <th>Status</th>
                    <th class="fixedWidth">{{ trans('dashboard.action') }}</th>
                </tr>
                </thead>

                <tbody>
                {{--<?php $sl=0;?>--}}
                {{--@foreach($requiredPerkgs as $row)--}}
                {{--<tr>--}}
                {{--<td class="center">{{ ++$sl }}</td>--}}
                {{--<td>{{$row->ITEM_NAME}}</td>--}}
                {{--<td>{{$row->SALT_AMOUNT}}</td>--}}
                {{--<td>{{$row->CHEMICAL_AMOUNT}}</td>--}}
                {{--<td>{{$row->WASTAGE_AMOUNT}}</td>--}}
                {{--<td>--}}
                {{--@if($row->ACTIVE_FLG == 1)--}}
                {{--<span class="label label-sm label-info arrowed arrowed-righ">Active</span>--}}
                {{--@else--}}
                {{--<span class="label label-sm label-danger arrowed arrowed-righ">Inactive</span>--}}
                {{--@endif--}}
                {{--</td>--}}
                {{--<td class="row{{ $row->REQUIRE_CHEMICAL_ID }}">--}}
                {{--<div class="hidden-sm hidden-xs action-buttons">--}}
                {{--@php--}}
                {{--$editPermissionLevel = $previllage->UPDATE;--}}
                {{--$viewPermissionLevel = $previllage->READ;--}}
                {{--@endphp--}}
                {{--@if($viewPermissionLevel == 1)--}}
                {{--<a href="#" id="{{ 'require-chemical-per-kg/'.$row->REQUIRE_CHEMICAL_ID }}" class="blue showModalGlobal" data-target=".modal" data-permission="{{ $viewPermissionLevel }}" data-toggle="modal" role="button" title="{{ trans('bank.view_bank') }}">--}}
                {{--<span class="blue">--}}
                {{--<i class="ace-icon fa fa-eye bigger-130"></i>--}}
                {{--</span>--}}
                {{--</a>--}}
                {{--@else--}}
                {{--<a href="#" id="{{ 'require-chemical-per-kg/'.$row->REQUIRE_CHEMICAL_ID }}" class="blue showModalGlobal" data-target=".modal" data-permission="{{ $viewPermissionLevel }}" data-toggle="modal" role="button" title="{{ trans('bank.view_bank') }}" style="display: none;">--}}
                {{--<span class="blue">--}}
                {{--<i class="ace-icon fa fa-eye bigger-130"></i>--}}
                {{--</span>--}}
                {{--</a>--}}
                {{--@endif--}}
                {{--@if($editPermissionLevel == 1)--}}
                {{--<a class="green showModalGlobal" id="{{ 'require-chemical-per-kg/'.$row->REQUIRE_CHEMICAL_ID.'/edit' }}" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="{{ trans('bank.edit_bank') }}">--}}
                {{--<i class="ace-icon fa fa-pencil bigger-130"></i>--}}
                {{--</a>--}}
                {{--@else--}}
                {{--<a class="green showModalGlobal" id="{{ 'require-chemical-per-kg/'.$row->REQUIRE_CHEMICAL_ID.'/edit' }}" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="{{ trans('bank.edit_bank') }}" style="display: none;">--}}
                {{--<i class="ace-icon fa fa-pencil bigger-130"></i>--}}
                {{--</a>--}}
                {{--@endif--}}
                {{--@if($previllage->DELETE == 1)--}}
                {{--<a class="red clickForDelete row{{ $row->REQUIRE_CHEMICAL_ID }}" data-token="{{ csrf_token() }}" data-action="{{ 'require-chemical-per-kg/'.$row->REQUIRE_CHEMICAL_ID }}" role="button" title="{{ trans('bank.delete_bank') }}">--}}
                {{--<i class="ace-icon fa fa-trash-o bigger-130"></i>--}}
                {{--</a>--}}
                {{--@endif--}}
                {{--</div>--}}
                {{--</td>--}}
                {{--</tr>--}}
                {{--@endforeach--}}

                </tbody>
            </table>
        </div><!-- /.col -->

    </div><!-- /.row -->

    <!--Add New Group Modal Start-->
    @include('masterGlobal.deleteScript')
    <!-- Add New Group Modal End -->

@endsection

