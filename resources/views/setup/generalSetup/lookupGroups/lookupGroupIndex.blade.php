@extends('master')

@section('mainContent')
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.min.css') }}" />
    <div class="page-header">
        <h1>
            {{ trans('breadcrumb.all_setup') }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('breadcrumb.base_setup') }}
            </small>
        </h1>
    </div><!-- /.page-header -->
    <div class="row">

        <div class="col-lg-10 col-lg-offset-1 col-xs-12">
            {{--@if(session('message'))--}}
                {{--<p  class="alert alert-warning alert-dismissible">{{ session('message') }}--}}
                    {{--<button type="button" class="close" data-dismiss="alert" aria-label="Close" >--}}
                        {{--<span aria-hidden="true">&times;</span>--}}
                    {{--</button>--}}
                {{--</p>--}}

            {{--@endif--}}
            <div class="row">
                <div id="accordion" class="accordion-style2">

                    @foreach( $lookupGroups as $key => $lookupGroup)


                        <div class="group">
                            @php
                                $editPermissionLevel = $previllage->UPDATE;
                                $viewPermissionLevel = $previllage->READ;
                            @endphp
                            <h3 class="accordion-header action-buttons"> {{ ++$key }}.   {{$lookupGroup->LOOKUPMST_NAME}}
                                @if($previllage->DELETE == 1)
                                    @if( $lookupGroup->checkDelete==0)
                                        <a class="red pull-right clickForDelete row{{ $lookupGroup->LOOKUPMST_ID }}" data-token="{{ csrf_token() }}" data-action="{{ 'lookup-groups/'.$lookupGroup->LOOKUPMST_ID }}" role="button">
                                            <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                        </a>
                                     @endif
                                @endif
                                @if($editPermissionLevel == 1)
                                    <a id="{{ 'lookup-groups/'.$lookupGroup->LOOKUPMST_ID.'/edit' }}" class="green pull-right showModalGlobal" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="{{ trans('lookupGroupIndex.edit_lookup') }}">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>
                                @else
                                    <a id="{{ 'lookup-groups/'.$lookupGroup->LOOKUPMST_ID.'/edit' }}" class="green pull-right showModalGlobal" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="{{ trans('lookupGroupIndex.edit_lookup') }}" style="display: none;">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>
                                @endif
                                @if($viewPermissionLevel == 1)
                                    <a id="{{ 'lookup-groups/'.$lookupGroup->LOOKUPMST_ID }}" class="blue pull-right showModalGlobal" data-target=".modal" role="button" data-permission="{{ $viewPermissionLevel }}"  data-toggle="modal" title="{{ trans('lookupGroupIndex.view_lookup') }}">
                                        <i class="ace-icon fa fa-eye bigger-130"></i>
                                    </a>
                                @else
                                    <a id="{{ 'lookup-groups/'.$lookupGroup->LOOKUPMST_ID }}" class="blue pull-right showModalGlobal" data-target=".modal" role="button" data-permission="{{ $viewPermissionLevel }}"  data-toggle="modal" title="{{ trans('lookupGroupIndex.view_lookup') }}" style="display: none;">
                                        <i class="ace-icon fa fa-eye bigger-130"></i>
                                    </a>
                                @endif
                            </h3>

                            <div class="row">


                                <p style="margin-bottom: 30px;">
                                    @php
                                        $createPermissionLevel = $previllage->CREATE;
                                    @endphp
                                    <button id="{{ 'lookup-groups-data/create-data/'.$lookupGroup->LOOKUPMST_ID }}" data-target=".modal" data-id="{{ $lookupGroup->LOOKUPMST_ID }}" role="button" data-permission="{{ $createPermissionLevel }}" class="test btn btn-minier btn-primary pull-right showModalGlobal" data-toggle="modal" title="{{ trans('lookupGroupIndex.lookup_group_data_create') }}"> {{ trans('dashboard.add_new') }} </button>
                                </p>
                                <div class="col-lg-12">
                                    <table style="margin-bottom: 10px;" class="table table-striped table-bordered table-hover gridTable" title="{{ trans('lookupGroupIndex.lookup_group_data_list') }}">
                                        <thead>
                                        <tr>

                                            <th class="fixedWidth" >{{ trans('lookupGroupIndex.sl') }}</th>
                                            <th>{{ trans('lookupGroupIndex.name') }}</th>
                                            {{--<th class="hidden-480">User Define ID</th>--}}
                                            <th class="hidden-480">Description</th>
                                            <th class="hidden-480">Status</th>
                                            <th class="center fixedWidth" >{{ trans('lookupGroupIndex.action') }}</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php $sl=0;?>
                                        <?php $lookupGroupDatas = DB::table('ssc_lookupchd')->where('LOOKUPMST_ID','=',$lookupGroup->LOOKUPMST_ID)->get(); ?>
                                        <?php foreach($lookupGroupDatas as $lookupGroupData){ ?>


                                        <tr>
                                            <td  align="center"> {{ ++$sl }} </td>
                                            <td>{{ $lookupGroupData->LOOKUPCHD_NAME }}</td>
                                            {{--<td class="hidden-480">{{ $lookupGroupData->UD_ID }}</td>--}}
                                            <td class="hidden-480"><?php echo $lookupGroupData->DESCRIPTION; ?></td>
                                            <td class="hidden-480">
                                                <?php  if($lookupGroupData->ACTIVE_FLG == 0){ ?>
                                                <span class="label label-sm label-danger arrowed arrowed-righ">Inactive</span>
                                                <?php }else{ ?>
                                                <span class="label label-sm label-info arrowed arrowed-righ">Active</span>
                                                <?php } ?>

                                            </td>

                                            <td class="row{{ $lookupGroupData->LOOKUPCHD_ID }}">
                                                <div class="hidden-sm hidden-xs action-buttons">
                                                    @php
                                                        $editPermissionLevel = $previllage->UPDATE;
                                                        $viewPermissionLevel = $previllage->READ;
                                                    @endphp
                                                    @if($viewPermissionLevel == 1)
                                                        <a href="#" id="{{ 'lookup-groups-data/'.$lookupGroupData->LOOKUPCHD_ID }}" class="blue showModalGlobal" data-target=".modal" data-toggle="modal" data-permission="{{ $viewPermissionLevel }}" role="button" title="{{ trans('lookupGroupIndex.view_lookup_group_data') }}">
                                                        <span class="blue">
                                                            <i class="ace-icon fa fa-eye bigger-130"></i>
                                                        </span>
                                                        </a>
                                                    @else
                                                        <a href="#" id="{{ 'lookup-groups-data/'.$lookupGroupData->LOOKUPCHD_ID }}" class="blue showModalGlobal" data-target=".modal" data-toggle="modal" role="button" data-permission="{{ $viewPermissionLevel }}" title="{{ trans('lookupGroupIndex.view_lookup_group_data') }}" style="display: none;">
                                                        <span class="blue">
                                                            <i class="ace-icon fa fa-eye bigger-130"></i>
                                                        </span>
                                                        </a>
                                                    @endif
                                                    @if($editPermissionLevel == 1)
                                                        <a class="green showModalGlobal" id="{{ 'lookup-groups-data/'.$lookupGroupData->LOOKUPCHD_ID.'/edit' }}" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="{{ trans('lookupGroupIndex.edit_lookup_group_data') }}">
                                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                        </a>
                                                    @else
                                                        <a class="green showModalGlobal" id="{{ 'lookup-groups-data/'.$lookupGroupData->LOOKUPCHD_ID.'/edit' }}" data-target=".modal" role="button"  data-toggle="modal" data-permission="{{ $editPermissionLevel }}" title="{{ trans('lookupGroupIndex.edit_lookup_group_data') }}" style="display: none;">
                                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                        </a>
                                                    @endif
                                                    @if($previllage->DELETE == 1)
                                                        <a class="red clickForDelete row{{ $lookupGroupData->LOOKUPCHD_ID }}" data-token="{{ csrf_token() }}" data-action="{{ 'lookup-groups-data/'.$lookupGroupData->LOOKUPCHD_ID }}" role="button" title="{{ trans('lookupGroupIndex.delete_lookup_group_data') }}">
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
                                                                <a href="#" id="{{ 'lookup-groups-data/'.$lookupGroupData->LOOKUPCHD_ID }}" data-target=".modal" data-toggle="modal" role="button" title="View Lookup Group Data" class="blue showModalGlobal">
                                                                <span class="blue">
                                                                    <i class="ace-icon fa fa-eye bigger-120"></i>
                                                                </span>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a  id="{{ 'lookup-groups-data/'.$lookupGroupData->LOOKUPCHD_ID.'/edit' }}" class="green showModalGlobal" data-target=".modal" role="button"  data-toggle="modal" title="Edit Lookup">
                                                                <span class="green">
                                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                                </span>
                                                                </a>
                                                            </li>

                                                            <li>

                                                                <a class="red clickForDelete row{{ $lookupGroupData->LOOKUPCHD_ID }}" data-token="{{ csrf_token() }}" data-action="{{ 'lookup-groups-data/'.$lookupGroupData->LOOKUPCHD_ID }}" role="button">
                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                </a>
                                                            </li>
                                                        </ul>

                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                        <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>

            </div>
            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->

    <!--Sweet Alert Global Script Start-->
    @include('masterGlobal.deleteScript')
    @include('masterGlobal.ajaxFormSubmit')
    <!-- Sweet Alert Global Script End -->


    <script type="text/javascript">


        //jquery accordion
        $( "#accordion" ).accordion({
            active: false,
            collapsible: true ,
            heightStyle: "content",
            animate: 250,
            header: ".accordion-header"
        }).sortable({
            axis: "y",
            handle: ".accordion-header",
            stop: function( event, ui ) {
                // IE doesn't register the blur when sorting
                // so trigger focusout handlers to remove .ui-state-focus
                ui.item.children( ".accordion-header" ).triggerHandler( "focusout" );
            }
        });

    </script>

@endsection
