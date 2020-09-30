@extends('master')

@section('mainContent')

    <div class="page-header">
        <h1>
            Transaction
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Iodization
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
                    <th>Batch No.</th>
                    <th class="hidden-480">Date</th>
                    <th class="hidden-480">Salt Amount (KG)</th>
                    <th class="hidden-480">Wastage  (%)</th>
                    <th class="hidden-480">Processed Stock (KG)</th>
                    <th class="hidden-480"> Used Chemical Amount (KG)</th>
                    <th class="fixedWidth">{{ trans('dashboard.action') }}</th>
                </tr>
                </thead>


                <tbody>
                <?php $sl=0;?>
                @foreach($iodizeIndex as $row)
                    @php
                        $wasteAmount = ($row->WASH_CRASH_QTY*$row->WASTAGE)/(100-$row->WASTAGE);
                        $rawAmount = $wasteAmount+$row->WASH_CRASH_QTY;
                    @endphp
                    <tr>
                        <td class="center">{{ ++$sl }}</td>
                        <td>{{$row->BATCH_NO}}</td>
                        <td class="hidden-480">{{ date('d-m-Y',strtotime($row->BATCH_DATE)) }}</td>
                        <td class="hidden-480">{{ number_format($rawAmount, 2) }}</td>
                        <td class="hidden-480">{{ $row->WASTAGE }} ( {{ number_format($wasteAmount, 2) }} KG)</td>
                        <td class="hidden-480">{{ number_format($rawAmount-$wasteAmount, 2) }}</td>
                        <td class="hidden-480">{{ number_format($row->REQ_QTY, 2) }}</td>
                        <td class="">
                            <div class="hidden-sm hidden-xs action-buttons">
                                @php
                                    $editPermissionLevel = $previllage->UPDATE;
                                    $viewPermissionLevel = $previllage->READ;
                                @endphp
                                @if($viewPermissionLevel == 1)
                                    <a href="#" id="{{ 'iodized/'.$row->IODIZEDMST_ID }}" class="blue showModalGlobal" modal-size="modal-lg" data-target=".modal" data-permission="{{ $viewPermissionLevel }}" data-toggle="modal"  role="button" title="View Iodization Production">
                                <span class="blue">
                                <i class="ace-icon fa fa-eye bigger-130"></i>
                                </span>
                                    </a>
                                @else
                                    <a href="#" id="{{ 'iodized/'.$row->IODIZEDMST_ID }}" class="blue showModalGlobal" data-target=".modal" data-permission="{{ $viewPermissionLevel }}" data-toggle="modal"  role="button" title="View Iodization Production" style="display: none;">
                                <span class="blue">
                                <i class="ace-icon fa fa-eye bigger-130"></i>
                                </span>
                                    </a>
                                @endif
                                @if($editPermissionLevel == 1)
                                    <a class="green showModalGlobal" id="{{ 'iodized/'.$row->IODIZEDMST_ID.'/edit' }}" data-target=".modal" modal-size="modal-md" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Iodization Production">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>
                                @else
                                    <a class="green showModalGlobal" id="{{ 'iodized/'.$row->IODIZEDMST_ID.'/edit' }}" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Iodization Production" style="display: none;">
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
    <!--Add New Group Modal Start-->
    @include('masterGlobal.deleteScript')
    <!-- Add New Group Modal End -->
    @include('masterGlobal.ajaxFormSubmit')
    <script>
        //    Chemical Stock Handler
        function iodizeStockDisplay(scope) {
            let userAmountScope = $('.userAmount');
            let amount = parseFloat(scope.attr('data-stock') || 0);
            let userAmount = parseFloat(userAmountScope.val() || 0);
            if(userAmount!==0 && userAmount>amount) {
                displayAlertHandler(`Stock amount is not available. Current stock [${amount}KG]`, 'warning');
                userAmountScope.val('');
                userAmount = false;
            }
            if(userAmount) amount = amount - userAmount;
            if(amount) {
                return scope.html(`[Current Stock: ${amount}KG]`);
            } else{
                return scope.html(`[Current Stock: <span style="color:red">Empty</span>]`);
            }
        }

        function clearAlert() {
            $('.currentChemicalStock').empty();
            $('.recommendInfo').empty();
        }

        //    Chemical Stock Handler
        function chemicalStockDisplay(scope) {
            let message = null;
//        For Chemical recommend message
            let recommendScope = $('.recommendInfo');
            let recommendChemical = parseFloat(scope.attr('data-recommend') || 0);
            if(recommendChemical>0) message = `Warning! Recommend chemical <span style="color:green">${recommendChemical.toFixed(2)}</span>KG`;
            recommendScope.html(message);
//        For chemical stock
            let userAmountScope = $('.userChemicalAmount');
            let amount = parseFloat(scope.attr('data-stock') || 0);
            let userAmount = parseFloat(userAmountScope.val() || 0);
            if(userAmount!==0 && userAmount>amount) {
                displayAlertHandler(`Chemical stock amount is not available. Current stock [${amount}KG]`, 'warning');
                userAmountScope.val('');
                userAmount = false;
            }
            if(userAmount) amount = amount - userAmount;
            if(amount) {
                return scope.html(`[Current Stock: ${amount}KG]`);
            } else{
                return scope.html(`[Current Stock: <span style="color:red">Empty</span>]`);
            }
        }
    </script>

@endsection

