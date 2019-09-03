@extends('master')

@section('mainContent')

    <div class="page-header">
        <h1>
            Transaction
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Washing And Crushing (Industrial)
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
                    <th>Batch No</th>
                    <th>Salt Name</th>
                    <th>Date</th>
                    <th>Salt Amount (KG)</th>
                    <th>Wastage Amount (%)</th>
                    <th>Salt Processed in stock (KG)</th>
                    <th class="fixedWidth">{{ trans('dashboard.action') }}</th>
                </tr>
                </thead>

                <tbody>
                <?php $sl=0;?>
                @foreach($washingAndCrushingData as $row)
                <tr>
                    <td class="center">{{ ++$sl }}</td>
                    <td>{{$row->BATCH_NO}}</td>
                    <td>{{$row->ITEM_NAME}}</td>
                    <td>{{ date('d-M-Y', strtotime($row->BATCH_DATE)) }}</td>
                    <td>{{ ($row->REQ_QTY*100)/(100-$row->WASTAGE) }}</td>
                    <td>{{$row->WASTAGE}} ( {{ ($row->WASTAGE*$row->REQ_QTY)/(100-$row->WASTAGE) }} KG)</td>
                    <td>{{$row->REQ_QTY}}</td>
                    <td class="row{{ $row->WASHCRASHMST_ID }}">
                    <div class="hidden-sm hidden-xs action-buttons">
                    @php
                    $editPermissionLevel = $previllage->UPDATE;
                    $viewPermissionLevel = $previllage->READ;
                    @endphp
                    @if($viewPermissionLevel == 1)
                    <a href="#" id="{{ 'washing-crushing/'.$row->WASHCRASHMST_ID }}" class="blue showModalGlobal" data-target=".modal" data-permission="{{ $viewPermissionLevel }}" data-toggle="modal" role="button" title="View Washing And Crushing (Industrial)">
                    <span class="blue">
                    <i class="ace-icon fa fa-eye bigger-130"></i>
                    </span>
                    </a>
                    @else
                    <a href="#" id="{{ 'washing-crushing/'.$row->WASHCRASHMST_ID }}" class="blue showModalGlobal" data-target=".modal" data-permission="{{ $viewPermissionLevel }}" data-toggle="modal" role="button" title="View Washing And Crushing (Industrial)" style="display: none;">
                    <span class="blue">
                    <i class="ace-icon fa fa-eye bigger-130"></i>
                    </span>
                    </a>
                    @endif
                    @if($editPermissionLevel == 1)
                    <a class="green showModalGlobal" id="{{ 'washing-crushing/'.$row->WASHCRASHMST_ID.'/edit' }}" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Washing And Crushing (Industrial)">
                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                    </a>
                    @else
                    <a class="green showModalGlobal" id="{{ 'washing-crushing/'.$row->WASHCRASHMST_ID.'/edit' }}" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Washing And Crushing (Industrial)" style="display: none;">
                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                    </a>
                    @endif
                    @if($previllage->DELETE == 1)
                    <a class="red clickForDelete row{{ $row->WASHCRASHMST_ID }}" data-token="{{ csrf_token() }}" data-action="{{ 'washing-crushing/'.$row->WASHCRASHMST_ID }}" role="button" title="{{ trans('bank.delete_bank') }}">
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

@endsection

