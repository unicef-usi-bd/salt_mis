@extends('master')

@section('mainContent')

    <div class="page-header">
        <h1>
            All Setup
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Item Setup
            </small>
        </h1>
    </div><!-- /.page-header -->
    <div class="row">
        <div class="col-xs-12">

            <table class="table table-striped table-bordered table-hover gridTable"  data-tools="false">
                <thead>
                <tr>
                    <th class="fixedWidth">{{ trans('dashboard.sl') }}</th>
                    <th>Item Type</th>
                    <th>Item Name</th>
                    <th>Status </th>
                    <th class="fixedWidth">{{ trans('dashboard.action') }}</th>
                </tr>
                </thead>


                <tbody>
                <?php $sl=0;?>
                @foreach($items as $item)
                    <tr>
                        <td class="center">{{ ++$sl }}</td>
                        <td>{{$item->LOOKUPCHD_NAME}}</td>
                        <td>{{$item->ITEM_NAME}}</td>

                        <td>
                            @if($item->ACTIVE_FLG == 1)
                                <span class="label label-sm label-info arrowed arrowed-righ">Active</span>
                            @else
                                <span class="label label-sm label-danger arrowed arrowed-righ">Inactive</span>
                            @endif
                        </td>
                        <td class="row{{ $item->ITEM_NO }}">
                            @php
                                $editPermissionLevel = $previllage->UPDATE;
                                $viewPermissionLevel = $previllage->READ;
                            @endphp
                            @if($viewPermissionLevel == 1)
                                <a href="#" id="{{ 'item/'.$item->ITEM_NO }}" class="blue showModalGlobal" data-target=".modal" data-permission="{{ $viewPermissionLevel }}" data-toggle="modal" role="button" title="View Item">
                        <span class="blue">
                            <i class="ace-icon fa fa-eye bigger-130"></i>
                        </span>
                                </a>
                            @else
                                <a href="#" id="{{ 'item/'.$item->ITEM_NO }}" class="blue showModalGlobal" data-target=".modal" data-permission="{{ $viewPermissionLevel }}" data-toggle="modal" role="button" title="View Item" style="display: none;">
                        <span class="blue">
                            <i class="ace-icon fa fa-eye bigger-130"></i>
                        </span>
                                </a>
                            @endif
                            @if($editPermissionLevel == 1)
                                <a class="green showModalGlobal" id="{{ 'item/'.$item->ITEM_NO.'/edit' }}" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Item">
                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                </a>
                            @else
                                <a class="green showModalGlobal" id="{{ 'item/'.$item->ITEM_NO.'/edit' }}" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Item" style="display: none;">
                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                </a>
                            @endif
                            {{--@if($previllage->DELETE == 1)--}}
                                {{--<a class="red clickForDelete row{{ $item->ITEM_NO }}" data-token="{{ csrf_token() }}" data-action="{{ 'item/'.$item->ITEM_NO }}" role="button" title="Delete CRUDE SALT Details">--}}
                                    {{--<i class="ace-icon fa fa-trash-o bigger-130"></i>--}}
                                {{--</a>--}}
                            {{--@endif--}}
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div><!-- /.col -->

    </div><!-- /.row -->

    @include('masterGlobal.deleteScript')

@endsection

