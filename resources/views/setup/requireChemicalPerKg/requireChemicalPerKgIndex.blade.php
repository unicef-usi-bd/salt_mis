@extends('master')

@section('mainContent')
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.min.css') }}" />
    <div class="page-header">
        <h1>
            All Setup
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Require Chemical Per Kg
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

                    @foreach( $requireChemical as $key => $chemical)


                        <div class="group">
                            @php
                                $editPermissionLevel = $previllage->UPDATE;
                                $viewPermissionLevel = $previllage->READ;
                            @endphp
{{--                            <h3 class="accordion-header action-buttons"> {{ ++$key }}.   {{$chemical->LOOKUPCHD_NAME}}--}}
                            <h3 class="accordion-header action-buttons"> {{ ++$key }}.   {{$chemical->ITEM_NAME}}
                                {{--@if($previllage->DELETE == 1)--}}

                                    {{--<a class="red pull-right clickForDelete row{{ $chemical->RMALLOMST_ID }}" data-token="{{ csrf_token() }}" data-action="{{ 'require-chemical-mst/'.$chemical->RMALLOMST_ID }}" role="button">--}}
                                        {{--<i class="ace-icon fa fa-trash-o bigger-130"></i>--}}
                                    {{--</a>--}}

                                {{--@endif--}}
                                @if($editPermissionLevel == 1)
                                    <a id="{{ 'require-chemical-mst/'.$chemical->RMALLOMST_ID.'/edit' }}" class="green pull-right showModalGlobal" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Chemical Per kg">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>
                                @else
                                    <a id="{{ 'require-chemical-mst/'.$chemical->RMALLOMST_ID.'/edit' }}" class="green pull-right showModalGlobal" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Chemical Per kg" style="display: none;">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>
                                @endif
                                @if($viewPermissionLevel == 1)
                                    <a id="{{ 'require-chemical-mst/'.$chemical->RMALLOMST_ID }}" class="blue pull-right showModalGlobal" data-target=".modal" role="button" data-permission="{{ $viewPermissionLevel }}"  data-toggle="modal" title="View Chemical Per Kg">
                                        <i class="ace-icon fa fa-eye bigger-130"></i>
                                    </a>
                                @else
                                    <a id="{{ 'require-chemical-mst/'.$chemical->RMALLOMST_ID }}" class="blue pull-right showModalGlobal" data-target=".modal" role="button" data-permission="{{ $viewPermissionLevel }}"  data-toggle="modal" title="View Chemical Per Kg" style="display: none;">
                                        <i class="ace-icon fa fa-eye bigger-130"></i>
                                    </a>
                                @endif
                            </h3>
                            <div class="row">


                                <p style="margin-bottom: 30px;">
                                    @php
                                        $createPermissionLevel = $previllage->CREATE;
                                    @endphp
                                    <button id="{{ 'require-chemical-chd/create-data/'.$chemical->RMALLOMST_ID }}" data-target=".modal" data-id="{{ $chemical->RMALLOMST_ID }}" role="button" data-permission="{{ $createPermissionLevel }}" class="test btn btn-minier btn-primary pull-right showModalGlobal" data-toggle="modal" title="Require Chemical"> {{ trans('dashboard.add_new') }} </button>
                                </p>
                                <div class="col-lg-12">
                                    <table style="margin-bottom: 10px;" class="table table-striped table-bordered table-hover gridTable" title="{{ trans('lookupGroupIndex.lookup_group_data_list') }}">
                                        <thead>
                                        <tr>

                                            <th class="fixedWidth" >{{ trans('lookupGroupIndex.sl') }}</th>
                                            <th>{{ trans('lookupGroupIndex.name') }}</th>
                                            <th class="hidden-480">Chemical Type</th>
                                            <th class="hidden-480">Amount</th>
                                            <th class="center fixedWidth" >{{ trans('lookupGroupIndex.action') }}</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                            <?php $sl=0;?>
                                            <?php $requireChemicalData = DB::table('smm_rmallocationchd','smm_item.ITEM_NAME')->where('RMALLOMST_ID','=',$chemical->RMALLOMST_ID)->leftJoin('smm_item','smm_rmallocationchd.ITEM_ID','=','smm_item.ITEM_NO')->get(); ?>
                                            <?php foreach($requireChemicalData as $chemicalData){ ?>

                                            <tr>
                                                <td  align="center">
                                                    {{ ++$sl }}
                                                </td>

                                                <td>
                                                    <?php echo $chemicalData->ITEM_NAME; ?>

                                                </td>

                                                <td >
                                                    <?php echo $chemicalData->USE_QTY; ?>

                                                </td>
                                                <td >
                                                    <?php echo $chemicalData->WAST_PER; ?>

                                                </td>


                                                <td class="row{{ $chemicalData->RMALLOCHD_ID }}">
                                                    <div class="hidden-sm hidden-xs action-buttons">
                                                        @php
                                                            $editPermissionLevel = $previllage->UPDATE;
                                                            $viewPermissionLevel = $previllage->READ;
                                                        @endphp
                                                        @if($viewPermissionLevel == 1)
                                                            <a href="#" id="{{ 'require-chemical-chd/'.$chemicalData->RMALLOCHD_ID }}" class="blue showModalGlobal" data-target=".modal" data-toggle="modal" data-permission="{{ $viewPermissionLevel }}" role="button" title="View Chemical Per Kg">
                                                            <span class="blue">
                                                            <i class="ace-icon fa fa-eye bigger-130"></i>
                                                            </span>
                                                            </a>
                                                        @else
                                                            <a href="#" id="{{ 'require-chemical-chd/'.$chemicalData->RMALLOCHD_ID }}" class="blue showModalGlobal" data-target=".modal" data-toggle="modal" role="button" data-permission="{{ $viewPermissionLevel }}" title="View Chemical Per Kg" style="display: none;">
                                                            <span class="blue">
                                                            <i class="ace-icon fa fa-eye bigger-130"></i>
                                                            </span>
                                                            </a>
                                                        @endif
                                                        @if($editPermissionLevel == 1)
                                                            <a class="green showModalGlobal" id="{{ 'require-chemical-chd/'.$chemicalData->RMALLOCHD_ID.'/edit' }}" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="{{ trans('lookupGroupIndex.edit_lookup_group_data') }}">
                                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                            </a>
                                                        @else
                                                            <a class="green showModalGlobal" id="{{ 'require-chemical-chd/'.$chemicalData->RMALLOCHD_ID.'/edit' }}" data-target=".modal" role="button"  data-toggle="modal" data-permission="{{ $editPermissionLevel }}" title="{{ trans('lookupGroupIndex.edit_lookup_group_data') }}" style="display: none;">
                                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                            </a>
                                                        @endif
                                                        @if($previllage->DELETE == 1)
                                                            <a class="red clickForDelete row{{ $chemicalData->RMALLOCHD_ID }}" data-token="{{ csrf_token() }}" data-action="{{ 'require-chemical-chd/'.$chemicalData->RMALLOCHD_ID }}" role="button" title="{{ trans('lookupGroupIndex.delete_lookup_group_data') }}">
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
                                                            <a href="#" id="{{ 'require-chemical-chd/'.$chemicalData->RMALLOCHD_ID }}" data-target=".modal" data-toggle="modal" role="button" title="View Lookup Group Data" class="blue showModalGlobal">
                                                            <span class="blue">
                                                            <i class="ace-icon fa fa-eye bigger-120"></i>
                                                            </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a  id="{{ 'require-chemical-chd/'.$chemicalData->RMALLOCHD_ID.'/edit' }}" class="green showModalGlobal" data-target=".modal" role="button"  data-toggle="modal" title="Edit Lookup">
                                                            <span class="green">
                                                            <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                            </span>
                                                            </a>
                                                        </li>

                                                        <li>

                                                            <a class="red clickForDelete row{{ $chemicalData->RMALLOCHD_ID }}" data-token="{{ csrf_token() }}" data-action="{{ 'require-chemical-chd/'.$chemicalData->RMALLOCHD_ID }}" role="button">
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
