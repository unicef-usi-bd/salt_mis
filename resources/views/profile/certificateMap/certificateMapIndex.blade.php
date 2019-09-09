@extends('master')
@section('mainContent')

    <div class="page-header">
        {{--<h1>--}}
        {{--{{ trans('module.access_control') }}--}}
        {{--<small>--}}
        {{--<i class="ace-icon fa fa-angle-double-right"></i>--}}
        {{--{{ trans('module.module') }}--}}
        {{--</small>--}}
        {{--</h1>--}}

        <h1>
            Profile
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Certificate Map
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
            <table class="table table-striped table-bordered table-hover gridTable" title="{{ trans('module.module_list') }}">
                <thead>
                <tr>
                    <th class="fixedWidth" style="width: 5px;">Sl</th>
                    <th class="center fixedWidth">Certificate Type Name</th>
                    <th class="center fixedWidth">Issuer Name</th>
                    <th class="center fixedWidth">Action</th>

                </tr>
                </thead>
                <tbody>
                <?php $sl=0;?>
                @foreach( $certificates as $row)
                    <tr>
                        <td class="center" >  {{ ++$sl }} </td>
                        <td> {{ $row->certificate }} </td>
                        <td> {{ $row->issuer }} </td>
                        <td class="">
                            <div class="hidden-sm hidden-xs action-buttons">
                                @php
                                    $editPermissionLevel = $previllage->UPDATE;
                                    $viewPermissionLevel = $previllage->READ;
                                @endphp

                                @if($editPermissionLevel == 1)
                                    <a class="green showModalGlobal" id='{{ "certificate-map/$row->CERTIFICATE_MAP_ID/edit" }}' data-target=".modal" modal-size="modal-md" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Supplier Profile Details">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>


                                @else
                                    <a class="green showModalGlobal" id='{{ "certificate-map/$row->CERTIFICATE_MAP_ID/edit" }}' data-target=".modal" modal-size="modal-md" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Supplier Profile Details" style="display: none;">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>

                                @endif
                                @if($previllage->DELETE == 1)
                                    <a class="red clickForDelete row{{ $row->CERTIFICATE_MAP_ID }}" data-token="{{ csrf_token() }}" data-action="{{ 'certificate-map/'.$row->CERTIFICATE_MAP_ID }}"  role="button" title="Delete Supplier Profile Details">
                                        <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                    </a>

                                @endif

                            </div>
                        </td>
                    </tr>
                @endforeach
                @include('masterGlobal.deleteScript')
                @include('masterGlobal.ajaxFormSubmit')
                </tbody>
            </table>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
