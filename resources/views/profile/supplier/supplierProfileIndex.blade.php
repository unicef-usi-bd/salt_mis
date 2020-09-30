@extends('master')
@section('mainContent')

    <div class="page-header">
        <h1>
            Supplier
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Supplier Profile
            </small>
        </h1>
    </div><!-- /.page-header -->
    <div class="row">
        <div class="row">
        </div>
        <div class="col-xs-12">
                @if(session('message'))
                    <p  class="alert alert-warning alert-dismissible">{{ session('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </p>

                @endif
            <table class="table table-striped table-bordered table-hover gridTable" data-tools="false">
                <thead style="white-space: nowrap">
                <tr>
                    <th class="fixedWidth" style="width: 5px;">SL</th>
                    <th class="center fixedWidth">Trading Name</th>
                    <th class="center fixedWidth">Trader Name</th>
                    <th class="center fixedWidth">Supplier Type</th>
                    <th class="center fixedWidth">Trade licence No.</th>
                    <th class="center fixedWidth">Mobile No.</th>
                    <th class="center fixedWidth">Email</th>
                    <th class="center fixedWidth">Action</th>

                </tr>
                </thead>
                <tbody>
                <?php $sl=0;?>
                @foreach( $supplierProfile as $row)
                    <tr>
                        <td class="center" >  {{ ++$sl }} </td>
                        <td> {{ $row->TRADING_NAME }} </td>
                        <td> {{ $row->TRADER_NAME }} </td>
                        <td>{{ $row->LOOKUPCHD_NAME }}</td>
                        <td> {{ $row->LICENCE_NO }} </td>
                        <td> {{ $row->PHONE }} </td>
                        <td> {{ $row->EMAIL }} </td>

                        <td class="">
                            <div class="hidden-sm hidden-xs action-buttons">
                                @php
                                    $editPermissionLevel = $previllage->UPDATE;
                                    $viewPermissionLevel = $previllage->READ;
                                @endphp

                                @if($viewPermissionLevel == 1)
                                    <a href="#" id='{{ "supplier-profile/$row->SUPP_ID_AUTO" }}' class="blue showModalGlobal" modal-size="modal-lg" data-target=".modal" data-toggle="modal" data-permission="{{ $viewPermissionLevel }}" role="button" title="View Supplier Profile">
                                                        <span class="blue">
                                                            <i class="ace-icon fa fa-eye bigger-130"></i>
                                                        </span>
                                    </a>
                                @else
                                    <a href="#" id="" class="blue showModalGlobal" data-target=".modal" data-toggle="modal" modal-size="modal-lg" role="button" data-permission="{{ $viewPermissionLevel }}" title="View Supplier Profile" style="display: none;">
                                                        <span class="blue">
                                                            <i class="ace-icon fa fa-eye bigger-130"></i>
                                                        </span>
                                    </a>
                                @endif

                                @if($editPermissionLevel == 1)
                                    <a class="green showModalGlobal" id='{{ "supplier-profile/$row->SUPP_ID_AUTO/edit" }}' data-target=".modal" modal-size="modal-bg" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Supplier Profile">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>
                                @else
                                    <a class="green showModalGlobal" id='{{ "supplier-profile/$row->SUPP_ID_AUTO/edit" }}' data-target=".modal" modal-size="modal-lg" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Supplier Profile" style="display: none;">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>
                                @endif

                                @if($previllage->DELETE == 1)
                                    <a class="red clickForDelete row{{ $row->SUPP_ID_AUTO }}" data-token="{{ csrf_token() }}" data-action="{{ 'supplier-profile/'.$row->SUPP_ID_AUTO }}"  role="button" title="Delete Supplier Profile">
                                        <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                    </a>
                                @endif

                            </div>

                            <div class="hidden-md hidden-lg">
                                <div class="inline pos-rel">
                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                    </button>

                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">

                                        <li>
                                            <a class="green showModalGlobal" id='' data-target=".modal" role="button"  modal-size="modal-lg"  data-toggle="modal" title="Edit Modules">
                                                <span class="green">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a class="red clickForDelete" data-token="{{ csrf_token() }}" data-action="" role="button" modal-size="modal-lg" title="Edit Modules>
                                                    <span class="red">
                                            <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                            </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                @include('masterGlobal.deleteScript')
                @include('masterGlobal.ajaxFormSubmit')
                @include('masterGlobal.locationMapping')
                </tbody>
            </table>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
