@extends('master')

@section('mainContent')

    <div class="page-header">
        <h1>
            Transaction
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                 Crude Salt Procurement
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
            <table class="table table-striped table-bordered table-hover gridTable" data-tools="false">
                <thead>
                <tr>
                    <th class="fixedWidth">{{ trans('dashboard.sl') }}</th>
                    <th>Crude Salt Type</th>
                    <th class="hidden-480">Source</th>
                    <th class="hidden-480">Date</th>
                    <th class="hidden-480">Trading Name</th>
                    <th class="hidden-480">Amount (KG)</th>
                    <th class="fixedWidth">{{ trans('dashboard.action') }}</th>
                </tr>
                </thead>
                <tbody>
                <?php $sl=0;?>
                @foreach($crudeSalt as $row)
                    <tr>
                        <td class="center">{{ ++$sl }}</td>
                        <td>{{$row->ITEM_NAME}}</td>
                        <td class="hidden-480">{{$row->LOOKUPCHD_NAME}}</td>
                        <td class="hidden-480">{{ date('d-M-Y', strtotime($row->ENTRY_TIMESTAMP)) }}</td>
                        <td class="hidden-480">{{ $row->TRADING_NAME }}</td>
                        <td class="hidden-480">{{ number_format($row->RCV_QTY, 2) }}</td>
                        <td class="">
                            <div class="hidden-sm hidden-xs action-buttons">
                                @php
                                    $editPermissionLevel = $previllage->UPDATE;
                                    $viewPermissionLevel = $previllage->READ;
                                @endphp
                                @if($viewPermissionLevel == 1)
                                    <a href="#" id="{{ 'crude-salt-procurement/'.$row->RECEIVEMST_ID }}" class="blue showModalGlobal" modal-size="modal-lg" data-target=".modal" data-permission="{{ $viewPermissionLevel }}" data-toggle="modal"  role="button" title="View Crude Salt Procurement">
                                <span class="blue">
                                <i class="ace-icon fa fa-eye bigger-130"></i>
                                </span>
                                    </a>
                                @else
                                    <a href="#" id="{{ 'crude-salt-procurement/'.$row->RECEIVEMST_ID }}" class="blue showModalGlobal" data-target=".modal" data-permission="{{ $viewPermissionLevel }}" data-toggle="modal"  role="button" title="View Crude Salt Procurement" style="display: none;">
                                <span class="blue">
                                <i class="ace-icon fa fa-eye bigger-130"></i>
                                </span>
                                    </a>
                                @endif
                                @if($editPermissionLevel == 1)
                                    <a class="green showModalGlobal" id="{{ 'crude-salt-procurement/'.$row->RECEIVEMST_ID.'/edit' }}" data-target=".modal" modal-size="modal-lg" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Crude Salt Procurement">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>
                                @else
                                    <a class="green showModalGlobal" id="{{ 'crude-salt-procurement/'.$row->RECEIVEMST_ID.'/edit' }}" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Crude Salt Procurement" style="display: none;">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>
                                @endif
                                {{--@if($previllage->DELETE == 1)--}}
                                    {{--<a class="red clickForDelete row{{ $row->RECEIVEMST_ID }}" data-token="{{ csrf_token() }}" data-action="{{ 'crude-salt-procurement/'.$row->RECEIVEMST_ID }}" role="button" title="Delete Crude Salt Procurement">--}}
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

