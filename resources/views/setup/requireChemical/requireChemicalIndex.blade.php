@extends('master')

@section('mainContent')

    <div class="page-header">
        <h1>
            All Setup
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Require Chemical Per KG
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
                    <th>Chemical Type</th>
                    <th class="hidden-480">Salt Name</th>
                    <th class="hidden-480">Amount</th>
                    <th class="fixedWidth">{{ trans('dashboard.action') }}</th>
                </tr>
                </thead>


                <tbody>
                {{--<?php $sl=0;?>--}}
                {{--@foreach($banks as $bank)--}}
                    {{--<tr>--}}
                        {{--<td class="center">{{ ++$sl }}</td>--}}
                        {{--<td>{{$bank->bank_name}}</td>--}}
                        {{--<td class="hidden-480">{{$bank->bank_address}}</td>--}}
                        {{--<td class="hidden-480">{{$bank->email}}</td>--}}
                        {{--<td class="hidden-480">{{$bank->phone}}</td>--}}
                        {{--<td>--}}
                            {{--@if($bank->active_status == 1)--}}
                                {{--<span class="label label-sm label-info arrowed arrowed-righ">Active</span>--}}
                            {{--@else--}}
                                {{--<span class="label label-sm label-danger arrowed arrowed-righ">Inactive</span>--}}
                            {{--@endif--}}
                        {{--</td>--}}
                        {{--<td class="row{{ $bank->bank_id }}">--}}
                            {{--<div class="hidden-sm hidden-xs action-buttons">--}}
                                {{--@php--}}
                                    {{--$editPermissionLevel = $previllage->UPDATE;--}}
                                    {{--$viewPermissionLevel = $previllage->READ;--}}
                                {{--@endphp--}}
                                {{--@if($viewPermissionLevel == 1)--}}
                                    {{--<a href="#" id="{{ 'banks/'.$bank->bank_id }}" class="blue showModalGlobal" data-target=".modal" data-permission="{{ $viewPermissionLevel }}" data-toggle="modal" role="button" title="{{ trans('bank.view_bank') }}">--}}
                                            {{--<span class="blue">--}}
                                                {{--<i class="ace-icon fa fa-eye bigger-130"></i>--}}
                                            {{--</span>--}}
                                    {{--</a>--}}
                                {{--@else--}}
                                    {{--<a href="#" id="{{ 'banks/'.$bank->bank_id }}" class="blue showModalGlobal" data-target=".modal" data-permission="{{ $viewPermissionLevel }}" data-toggle="modal" role="button" title="{{ trans('bank.view_bank') }}" style="display: none;">--}}
                                        {{--<span class="blue">--}}
                                            {{--<i class="ace-icon fa fa-eye bigger-130"></i>--}}
                                        {{--</span>--}}
                                    {{--</a>--}}
                                {{--@endif--}}
                                {{--@if($editPermissionLevel == 1)--}}
                                    {{--<a class="green showModalGlobal" id="{{ 'banks/'.$bank->bank_id.'/edit' }}" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="{{ trans('bank.edit_bank') }}">--}}
                                        {{--<i class="ace-icon fa fa-pencil bigger-130"></i>--}}
                                    {{--</a>--}}
                                {{--@else--}}
                                    {{--<a class="green showModalGlobal" id="{{ 'banks/'.$bank->bank_id.'/edit' }}" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="{{ trans('bank.edit_bank') }}" style="display: none;">--}}
                                        {{--<i class="ace-icon fa fa-pencil bigger-130"></i>--}}
                                    {{--</a>--}}
                                {{--@endif--}}
                                {{--@if($previllage->DELETE == 1)--}}
                                    {{--<a class="red clickForDelete row{{ $bank->bank_id }}" data-token="{{ csrf_token() }}" data-action="{{ 'banks/'.$bank->bank_id }}" role="button" title="{{ trans('bank.delete_bank') }}">--}}
                                        {{--<i class="ace-icon fa fa-trash-o bigger-130"></i>--}}
                                    {{--</a>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                {{--@endforeach--}}
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <div class="hidden-sm hidden-xs action-buttons">
                        {{--@php--}}
                        {{--$editPermissionLevel = $previllage->UPDATE;--}}
                        {{--$viewPermissionLevel = $previllage->READ;--}}
                        {{--@endphp--}}
                        {{--@if($viewPermissionLevel == 1)--}}
                        <a href="#" id="" class="blue showModalGlobal" data-target=".modal" data-permission="" data-toggle="modal" role="button" title="{{ trans('bank.view_bank') }}">
                        <span class="blue">
                        <i class="ace-icon fa fa-eye bigger-130"></i>
                        </span>
                        </a>
                        {{--@else--}}
                        {{--<a href="#" id="{{ 'banks/'.$bank->bank_id }}" class="blue showModalGlobal" data-target=".modal" data-permission="{{ $viewPermissionLevel }}" data-toggle="modal" role="button" title="{{ trans('bank.view_bank') }}" style="display: none;">--}}
                        {{--<span class="blue">--}}
                        {{--<i class="ace-icon fa fa-eye bigger-130"></i>--}}
                        {{--</span>--}}
                        {{--</a>--}}
                        {{--@endif--}}
                        {{--@if($editPermissionLevel == 1)--}}
                        <a class="green showModalGlobal" id="" data-target=".modal" role="button" data-permission=""  data-toggle="modal" title="{{ trans('bank.edit_bank') }}">
                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                        </a>
                        {{--@else--}}
                        {{--<a class="green showModalGlobal" id="{{ 'banks/'.$bank->bank_id.'/edit' }}" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="{{ trans('bank.edit_bank') }}" style="display: none;">--}}
                        {{--<i class="ace-icon fa fa-pencil bigger-130"></i>--}}
                        {{--</a>--}}
                        {{--@endif--}}
                        {{--@if($previllage->DELETE == 1)--}}
                        <a class="red clickForDelete row" data-token="{{ csrf_token() }}" data-action="" role="button" title="{{ trans('bank.delete_bank') }}">
                        <i class="ace-icon fa fa-trash-o bigger-130"></i>
                        </a>
                        {{--@endif--}}
                        </div>
                    </td>
                </tr>

</tbody>
</table>
</div><!-- /.col -->

</div><!-- /.row -->
<script> //This script use for prevent back button after logout to login
// window.onload = function () {
//     if (typeof history.replaceState === "function") {
//         history.replaceState(null, null, "/");
//         window.onpopstate = function () {
//             history.replaceState( null, null,"/");
//         };
//     } else {
//         var ignoreHashChange = true;
//         window.onhashchange = function () {
//             if (!ignoreHashChange) {
//                 ignoreHashChange = true;
//                 window.location.hash = Math.random();
//             } else {
//                 ignoreHashChange = false;
//             }
//         };
//     }
// }
</script>

<!--Add New Group Modal Start-->
@include('masterGlobal.deleteScript')
<!-- Add New Group Modal End -->
@include('masterGlobal.ajaxFormSubmit')


@endsection

