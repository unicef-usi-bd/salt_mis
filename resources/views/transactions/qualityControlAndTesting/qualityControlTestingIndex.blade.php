@extends('master')

@section('mainContent')

    <div class="page-header">
        <h1>
            Transaction
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Quality Control & Testing
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
                    <th>Purchase Date</th>
                    <th class="hidden-480">Batch No</th>
                    <th class="hidden-480">Test Name</th>
                    <th class="hidden-480">Result</th>
                    <th class="hidden-480">Result Download</th>
                    <th class="fixedWidth">{{ trans('dashboard.action') }}</th>
                </tr>
                </thead>


                <tbody>
                <?php $sl=0;?>
                @foreach($qualityControl as $row)
                    <tr>
                        <td class="center">{{ ++$sl }}</td>
                        <td>{{$row->QC_DATE}}</td>
                        {{--<td class="hidden-480">{{$row->qc}}</td>--}}
                        {{--<td class="hidden-480">{{ $row->agency }}</td>--}}
                        <td class="hidden-480">{{$row->BATCH_NO}}</td>
                        <td class="hidden-480">{{$row->QC_TESTNAME}}</td>

                        <td>
                            @if($qualityControlResultRange->SODIUM_CHLORIDE_MAX >= $row->SODIUM_CHLORIDE && $qualityControlResultRange->SODIUM_CHLORIDE_MIN <= $row->SODIUM_CHLORIDE && $qualityControlResultRange->MOISTURIZER_MAX >= $row->MOISTURIZER && $qualityControlResultRange->MOISTURIZER_MIN <= $row->MOISTURIZER && $qualityControlResultRange->PPM_MAX >= $row->IODINE_CONTENT && $qualityControlResultRange->PPM_MIN <= $row->IODINE_CONTENT && $qualityControlResultRange->PH_MAX >= $row->PH && $qualityControlResultRange->PH_MIN <= $row->PH)
                                <span >Pass</span>
                            @else
                                <span>Fail</span>
                            @endif
                        </td>
                        <td class="hidden-480"><a href="{{ $row->QUALITY_CONTROL_IMAGE }}"  role="button" class="btn btn-primary" download="download">Download</a> </td>
                        <td class="">
                            <div class="hidden-sm hidden-xs action-buttons">
                                @php
                                    $editPermissionLevel = $previllage->UPDATE;
                                    $viewPermissionLevel = $previllage->READ;
                                @endphp
                                @if($viewPermissionLevel == 1)
                                    <a href="#" id="{{ 'quality-control-testing/'.$row->QUALITYCONTROL_ID }}" class="blue showModalGlobal" modal-size="modal-lg" data-target=".modal" data-permission="{{ $viewPermissionLevel }}" data-toggle="modal"  role="button" title="View Quality Control & Testing">
                                <span class="blue">
                                <i class="ace-icon fa fa-eye bigger-130"></i>
                                </span>
                                    </a>
                                @else
                                    <a href="#" id="{{ 'quality-control-testing/'.$row->QUALITYCONTROL_ID }}" class="blue showModalGlobal" data-target=".modal" data-permission="{{ $viewPermissionLevel }}" data-toggle="modal"  role="button" title="View Quality Control & Testing" style="display: none;">
                                <span class="blue">
                                <i class="ace-icon fa fa-eye bigger-130"></i>
                                </span>
                                    </a>
                                @endif
                                @if($editPermissionLevel == 1)
                                    <a class="green showModalGlobal" id="{{ 'quality-control-testing/'.$row->QUALITYCONTROL_ID.'/edit' }}" data-target=".modal" modal-size="modal-bg" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Quality Control & Testing">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>
                                @else
                                    <a class="green showModalGlobal" id="{{ 'quality-control-testing/'.$row->QUALITYCONTROL_ID.'/edit' }}" data-target=".modal" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Quality Control & Testing" style="display: none;">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>
                                @endif
                                @if($previllage->DELETE == 1)
                                    <a class="red clickForDelete row{{ $row->QUALITYCONTROL_ID }}" data-token="{{ csrf_token() }}" data-action="{{ 'quality-control-testing/'.$row->QUALITYCONTROL_ID }}" role="button" title="{{ trans('bank.delete_bank') }}">
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
    <script> //This script use for prevent back button after logout to login
        // window.onload = function () {
        //     if (typeof history.replaceState === "function") {
        //         history.replaceState(null, null, "/");
        //         window.onpopstate = function () {
        //             history.replaceState( null, null,"/");
        //         };
        //     } else {
        //         var ignoreHashChange = true;
        //         window.onhashchange = function () {
        //             if (!ignoreHashChange) {
        //                 ignoreHashChange = true;
        //                 window.location.hash = Math.random();
        //             } else {
        //                 ignoreHashChange = false;
        //             }
        //         };
        //     }
        // }
    </script>

    <!--Add New Group Modal Start-->
    @include('masterGlobal.deleteScript')
    <!-- Add New Group Modal End -->
    @include('masterGlobal.ajaxFormSubmit')


@endsection

