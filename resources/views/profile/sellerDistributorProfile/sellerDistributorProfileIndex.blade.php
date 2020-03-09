@extends('master')

@section('mainContent')

    <div class="page-header">
        <h1>
            All Setup
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Seller & Distributor Profile
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
                    <th>Trader Name</th>
                    <th class="hidden-480">Trading Name</th>
                    <th class="hidden-480">Trade Licence no</th>
                    <th class="hidden-480">Email</th>
                    <th class="hidden-480">Phone Number</th>
                    <th class="fixedWidth">{{ trans('dashboard.action') }}</th>
                </tr>
                </thead>


                <tbody>
                <?php $sl=0;?>
                @foreach($sellerDitributorProfile as $row)
                <tr>
                <td class="center">{{ ++$sl }}</td>
                <td>{{$row->TRADER_NAME}}</td>
                <td class="hidden-480">{{$row->TRADING_NAME}}</td>
                <td class="hidden-480">{{$row->LICENCE_NO}}</td>
                <td class="hidden-480">{{$row->EMAIL}}</td>
                <td class="hidden-480">{{$row->PHONE}}</td>
                <td class="">
                    <div class="hidden-sm hidden-xs action-buttons">
                        @php
                            $editPermissionLevel = $previllage->UPDATE;
                            $viewPermissionLevel = $previllage->READ;
                        @endphp
                        @if($viewPermissionLevel == 1)
                            <a href="#" id="{{ 'seller-distributor-profile/'.$row->CUSTOMER_ID }}" class="blue showModalGlobal" modal-size="modal-lg" data-target=".modal" data-permission="{{ $viewPermissionLevel }}" data-toggle="modal"  role="button" title="View Seller/Distributor Profile">
                                <span class="blue">
                                <i class="ace-icon fa fa-eye bigger-130"></i>
                                </span>
                            </a>
                            @else
                            <a href="#" id="{{ 'seller-distributor-profile/'.$row->CUSTOMER_ID }}" class="blue showModalGlobal" data-target=".modal" data-permission="{{ $viewPermissionLevel }}" data-toggle="modal"  role="button" title="View Seller/Distributor Profile" style="display: none;">
                                <span class="blue">
                                <i class="ace-icon fa fa-eye bigger-130"></i>
                                </span>
                            </a>
                            @endif
                            @if($editPermissionLevel == 1)
                                <a class="green showModalGlobal" id="{{ 'seller-distributor-profile/'.$row->CUSTOMER_ID.'/edit' }}" data-target=".modal" modal-size="modal-bg" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Seller/Distributor Profile">
                                <i class="ace-icon fa fa-pencil bigger-130"></i>
                                </a>
                            @else
                                <a class="green showModalGlobal" id="{{ 'seller-distributor-profile/'.$row->CUSTOMER_ID.'/edit' }}" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Seller/Distributor Profile" style="display: none;">
                                <i class="ace-icon fa fa-pencil bigger-130"></i>
                                </a>
                            @endif
                            @if($previllage->DELETE == 1)
                                <a class="red clickForDelete row{{ $row->CUSTOMER_ID }}" data-token="{{ csrf_token() }}" data-action="{{ 'seller-distributor-profile/'.$row->CUSTOMER_ID }}" role="button" title="{{ trans('bank.delete_bank') }}">
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
    @include('masterGlobal.locationMapping')


@endsection

