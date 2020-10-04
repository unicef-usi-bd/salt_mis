@extends('master')

@section('mainContent')

    <div class="page-header">
        <h1>
            Transaction
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Chemical Purchase
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
                    <th>Purchase Date</th>
                    <th class="hidden-480">Procured Chemical</th>
                    <th class="hidden-480">Amount (KG)</th>
                    <th class="hidden-480">Chemical Source</th>
                    <th class="fixedWidth">{{ trans('dashboard.action') }}</th>
                </tr>
                </thead>


                <tbody>
                <?php $sl=0;?>
                @foreach($chemicalPuchase as $row)
                    <tr>
                        <td class="center">{{ ++$sl }}</td>
                        <td>{{date("d-m-Y", strtotime($row->RECEIVE_DATE))}}</td>
                        <td class="hidden-480">{{$row->ITEM_NAME}}</td>
                        <td class="hidden-480">{{ number_format($row->RCV_QTY, 2) }}</td>
                        <td class="hidden-480">{{$row->TRADING_NAME}}</td>
                        <td class="">
                            <div class="hidden-sm hidden-xs action-buttons">
                                @php
                                    $editPermissionLevel = $previllage->UPDATE;
                                    $viewPermissionLevel = $previllage->READ;
                                @endphp
                                @if($viewPermissionLevel == 1)
                                    <a href="#" id="{{ 'chemical-purchase/'.$row->RECEIVEMST_ID }}" class="blue showModalGlobal" modal-size="modal-lg" data-target=".modal" data-permission="{{ $viewPermissionLevel }}" data-toggle="modal"  role="button" title="View Chemical Purchase">
                                <span class="blue">
                                <i class="ace-icon fa fa-eye bigger-130"></i>
                                </span>
                                    </a>
                                @else
                                    <a href="#" id="{{ 'chemical-purchase/'.$row->RECEIVEMST_ID }}" class="blue showModalGlobal" data-target=".modal" data-permission="{{ $viewPermissionLevel }}" data-toggle="modal"  role="button" title="View Chemical Purchase" style="display: none;">
                                <span class="blue">
                                <i class="ace-icon fa fa-eye bigger-130"></i>
                                </span>
                                    </a>
                                @endif
                                @if($editPermissionLevel == 1)
                                    <a class="green showModalGlobal" id="{{ 'chemical-purchase/'.$row->RECEIVEMST_ID.'/edit' }}" data-target=".modal" modal-size="modal-lg" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Chemical Purchase">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>
                                @else
                                    <a class="green showModalGlobal" id="{{ 'chemical-purchase/'.$row->RECEIVEMST_ID.'/edit' }}" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Chemical Purchase" style="display: none;">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>
                                @endif
                                @if($previllage->DELETE == 1)
                                    <a class="red clickForDelete row{{ $row->RECEIVEMST_ID }}" data-token="{{ csrf_token() }}" data-action="{{ 'chemical-purchase/'.$row->RECEIVEMST_ID }}" role="button" title="Delete Chemical Purchase">
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
    <!--Add New Group Modal Start-->
    @include('masterGlobal.deleteScript')
    <!-- Add New Group Modal End -->
    @include('masterGlobal.ajaxFormSubmit')


@endsection

