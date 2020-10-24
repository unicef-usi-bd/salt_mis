@extends('master')

@section('mainContent')

    <style>
        .stockLebel{
            margin-bottom: 30px;
        }
    </style>

    <div class="page-header">
        <h1>
            Transaction
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Sales & Distribution
            </small>
        </h1>
    </div><!-- /.page-header -->
    <h4 class="pull-left stockLebel">Wash and Crushing Salt Stock : <span style="color:red;">{{ number_format($washingStock, 2) }}</span> KG</h4>
    <h4 class="pull-right stockLebel">Iodized Salt Stock : <span style="color:red;">{{ number_format($iodizeStock, 2) }}</span> KG</h4>
    {{--<div class="clearfix"></div>--}}
    <div class="row">
        <div class="col-xs-12">
            @if(session('message'))
                <p  class="alert alert-warning alert-dismissible">{{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </p>

            @endif
            <table class="table table-striped table-bordered table-hover gridTable" data-tools="false">
                <thead>
                <tr>
                    <th class="fixedWidth">{{ trans('dashboard.sl') }}</th>
                    <th> Processed Salt Type</th>
                    <th class="hidden-480">Date</th>
                    <th class="hidden-480">Pack Measurement</th>
                    <th class="hidden-480">Pack Quantity</th>
                    <th class="hidden-480">Total Amount</th>
                    <th class="fixedWidth">{{ trans('dashboard.action') }}</th>
                </tr>
                </thead>


                <tbody>
                <?php $sl=0;?>
                @foreach($salesDistInfo as $row)
                    <tr>
                        <td class="center">{{ ++$sl }}</td>
                        <td>{{$row->ITEM_NAME}}</td>
                        <td class="hidden-480">{{date( 'd-m-Y',strtotime($row->SALES_DATE))}}</td>
                        <td class="hidden-480">{{ $row->LOOKUPCHD_NAME }}</td>
                        <td class="hidden-480">{{$row->PACK_QTY}} pcs</td>
                        <td class="hidden-480">{{ number_format($row->DESCRIPTION*$row->PACK_QTY, 2)}} KG</td>
                        <td class="">
                            <div class="hidden-sm hidden-xs action-buttons">
                                @php
                                    //$editPermissionLevel = $previllage->UPDATE;
                                    $viewPermissionLevel = $previllage->READ;
                                    $editPermissionLevel = $previllage->UPDATE;
                                @endphp
                                @if($viewPermissionLevel == 1)
                                    <a href="#" id="{{ 'sales-distribution/'.$row->SALESCHD_ID }}" class="blue showModalGlobal" modal-size="modal-lg" data-target=".modal" data-permission="{{ $viewPermissionLevel }}" data-toggle="modal"  role="button" title="View Sales & Distribution">
                                <span class="blue">
                                <i class="ace-icon fa fa-eye bigger-130"></i>
                                </span>
                                    </a>
                                @else
                                    <a href="#" id="{{ 'sales-distribution/'.$row->SALESCHD_ID }}" class="blue showModalGlobal" data-target=".modal" data-permission="{{ $viewPermissionLevel }}" data-toggle="modal"  role="button" title="View Sales & Distribution" style="display: none;">
                                <span class="blue">
                                <i class="ace-icon fa fa-eye bigger-130"></i>
                                </span>
                                    </a>
                                @endif
                                {{--@if($editPermissionLevel == 1)--}}
                                    {{--<a class="green showModalGlobal" id="{{ 'sales-distribution/'.$row->SALESCHD_ID.'/edit' }}" data-target=".modal" modal-size="modal-bg" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Sales & Distribution">--}}
                                        {{--<i class="ace-icon fa fa-pencil bigger-130"></i>--}}
                                    {{--</a>--}}
                                {{--@else--}}
                                    {{--<a class="green showModalGlobal" id="{{ 'sales-distribution/'.$row->SALESCHD_ID.'/edit' }}" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Sales & Distribution" style="display: none;">--}}
                                        {{--<i class="ace-icon fa fa-pencil bigger-130"></i>--}}
                                    {{--</a>--}}
                                {{--@endif--}}
                                {{--@if($previllage->DELETE == 1)--}}
                                    {{--<a class="red clickForDelete row{{ $row->SALESMST_ID }}" data-token="{{ csrf_token() }}" data-action="{{ 'sales-distribution/'.$row->SALESMST_ID }}" role="button" title="Delete Sales & Distribution">--}}
                                        {{--<i class="ace-icon fa fa-trash-o bigger-130"></i>--}}
                                    {{--</a>--}}
                                {{--@endif--}}
                            </div>
                        </td>
                    </tr>
                @endforeach
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

