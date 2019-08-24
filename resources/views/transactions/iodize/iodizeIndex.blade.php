@extends('master')

@section('mainContent')

    <div class="page-header">
        <h1>
            Transaction
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Iodized
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
                    <th>Batch Number</th>
                    <th class="hidden-480">Date</th>
                    <th class="hidden-480">Salt Amount (KG)</th>
                    <th class="hidden-480">Wastage Amount (%)</th>
                    <th class="hidden-480">Iodize Process in Stock (KG)</th>
                    <th class="hidden-480">Chemical Amount in Use (KG)</th>
                    <th class="fixedWidth">{{ trans('dashboard.action') }}</th>
                </tr>
                </thead>


                <tbody>
                <?php $sl=0;?>
                @foreach($iodizeIndex as $row)
                    <tr>
                        <td class="center">{{ ++$sl }}</td>
                        <td>{{$row->BATCH_NO}}</td>
                        <td class="hidden-480">{{$row->BATCH_DATE}}</td>
                        <td class="hidden-480">{{ ($row->WASH_CRASH_QTY*100)/(100-$row->WASTAGE) }}</td>
                        <td class="hidden-480">{{ $row->WASTAGE }} ( {{ ($row->WASTAGE*$row->WASH_CRASH_QTY)/(100-$row->WASTAGE) }} KG)</td>
                        <td class="hidden-480">{{ $row->WASH_CRASH_QTY }}</td>
                        <td class="hidden-480">{{$row->REQ_QTY}}</td>
                        <td class="">
                            <div class="hidden-sm hidden-xs action-buttons">
                                @php
                                    $editPermissionLevel = $previllage->UPDATE;
                                    $viewPermissionLevel = $previllage->READ;
                                @endphp
                                @if($viewPermissionLevel == 1)
                                    <a href="#" id="{{ 'iodized/'.$row->IODIZEDMST_ID }}" class="blue showModalGlobal" modal-size="modal-lg" data-target=".modal" data-permission="{{ $viewPermissionLevel }}" data-toggle="modal"  role="button" title="View Iodize">
                                <span class="blue">
                                <i class="ace-icon fa fa-eye bigger-130"></i>
                                </span>
                                    </a>
                                @else
                                    <a href="#" id="{{ 'iodized/'.$row->IODIZEDMST_ID }}" class="blue showModalGlobal" data-target=".modal" data-permission="{{ $viewPermissionLevel }}" data-toggle="modal"  role="button" title="View Iodize" style="display: none;">
                                <span class="blue">
                                <i class="ace-icon fa fa-eye bigger-130"></i>
                                </span>
                                    </a>
                                @endif
                                @if($editPermissionLevel == 1)
                                    <a class="green showModalGlobal" id="{{ 'iodized/'.$row->IODIZEDMST_ID.'/edit' }}" data-target=".modal" modal-size="modal-md" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Iodize">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>
                                @else
                                    <a class="green showModalGlobal" id="{{ 'iodized/'.$row->IODIZEDMST_ID.'/edit' }}" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Iodize" style="display: none;">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>
                                @endif
                                @if($previllage->DELETE == 1)
                                    <a class="red clickForDelete row{{ $row->IODIZEDMST_ID }}" data-token="{{ csrf_token() }}" data-action="{{ 'iodized/'.$row->IODIZEDMST_ID }}" role="button" title="{{ trans('bank.delete_bank') }}">
                                        <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                    </a>
                                @endif
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

