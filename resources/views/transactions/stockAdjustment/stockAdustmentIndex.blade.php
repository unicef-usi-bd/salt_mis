@extends('master')

@section('mainContent')

    <div class="page-header">
        <h1>
            Transaction
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Stock Adjustment
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
            <table class="table table-striped table-bordered table-hover gridTable" data-tools="false" title="Bank List">
                <thead>
                <tr>
                    <th rowspan="2" class="fixedWidth">{{ trans('dashboard.sl') }}</th>
                    <th colspan="3" class="text-center">Wash and Crashing Stock (KG)</th>
                    <th colspan="3" class="text-center">Iodized Stock (KG)</th>
                    <th rowspan="2" width="50px;">Date</th>
                    <th rowspan="2" class="fixedWidth">{{ trans('dashboard.action') }}</th>
                </tr>
                <tr>
                    <td><b>System&nbsp;Stock</b></td>
                    <td><b>Physical&nbsp;Stock</b></td>
                    <td><b>Stock&nbsp;After&nbsp;Adjustment</b></td>
                    <td><b>System&nbsp;Stock</b></td>
                    <td><b>Physical&nbsp;Stock</b></td>
                    <td><b>Stock&nbsp;After&nbsp;Adjustment</b></td>
                </tr>
                </thead>

                <tbody>
                <?php $sl=0;?>
                @foreach($stockAdjustmentData as $row)
                    <tr>
                        <td class="center">{{ ++$sl }}</td>
                        <td>{{ number_format($row->system_wc_stock, 2) }}</td>
                        <td>{{ number_format($row->wc_stock, 2) }}</td>
                        <td>{{ number_format($row->wc_stock, 2) }}</td>
                        <td>{{ number_format($row->system_iodize_stock, 2) }}</td>
                        <td>{{ number_format($row->iodize_stock, 2) }}</td>
                        <td>{{ number_format($row->iodize_stock, 2) }}</td>
                        <td>{{ date('d-m-Y', strtotime($row->UPDATE_TIMESTAMP)) }}</td>
                        <td class="row{{ $row->stock_id }}">
                            <div class="hidden-sm hidden-xs action-buttons">
                                @php
                                    $editPermissionLevel = $previllage->UPDATE;
                                    $viewPermissionLevel = $previllage->READ;
                                @endphp

                                @if($editPermissionLevel == 1)
                                    <a class="green showModalGlobal" id="{{ 'stock-adjustment/'.$row->stock_id.'/edit' }}" data-target=".modal" modal-size="modal-lg" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Stock Adjustment">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>
                                @else
                                    <a class="green showModalGlobal" id="{{ 'stock-adjustment/'.$row->stock_id.'/edit' }}" data-target=".modal" modal-size="modal-lg" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Stock Adjustment" style="display: none;">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>
                                @endif
                                @if($previllage->DELETE == 1)
                                    <a class="red clickForDelete row{{ $row->stock_id }}" data-token="{{ csrf_token() }}" data-action="{{ 'stock-adjustment/'.$row->stock_id }}" role="button" title="{{ trans('bank.delete_bank') }}">
                                        <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach

                {{--</tbody>--}}
            </table>
        </div><!-- /.col -->

    </div><!-- /.row -->

    <!--Add New Group Modal Start-->
    @include('masterGlobal.deleteScript')
    <!-- Add New Group Modal End -->

@endsection

