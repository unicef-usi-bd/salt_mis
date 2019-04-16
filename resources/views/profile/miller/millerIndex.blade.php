@extends('master')

@section('mainContent')
    {{--@include('masterGlobal.datePicker')--}}
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

    <style>
        .table th{
            text-align: center;
        }

        .chosen-container { width: 100% !important; }

        .select2{
            width:100% !important;
        }
        .disabledTab{
            pointer-events: none;

        }
        li .disabledTab:hover{
           cursor:not-allowed
        }

        /*.nav-tabs>li.active>a{*/
            /*background-color: #1CABE2;*/
        /*}*/

        </style>

    <div class="page-header">
        <h1>
            {{--{{ trans('soeReport.report') }}--}}
            Setup
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{--{{ trans('soeReport.report_dashboard') }}--}}
                Miller Profie
            </small>
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-md-12" style="width: 1040px;">
            <div class="col-sm-12">
                <div class="tabbable">
                    <ul class="nav nav-tabs" id="myTab">

                            <li class="active"> <a data-toggle="tab" href="#mill"> Mill Information </a> </li>
                            <li class="disabled disabledTab"> <a class="disabled" data-toggle="tab" href="#entrepreneur"> Entrepreneur Information  </a> </li>
                            <li class="disabled disabledTab"> <a data-toggle="tab" href="#certificate">  Certificate Information </a> </li>
                            <li class="disabled disabledTab"> <a data-toggle="tab" href="#qc"> QC Information </a> </li>
                            <li class="disabled disabledTab"> <a data-toggle="tab" href="#employee"> Employee Information </a> </li>
                    </ul>

                    <div class="tab-content">
                        {{--Mill Info--}}
                        @include('profile.miller.millInformation')
                        {{--/-Miller Info--}}
                        {{--Entrepreneur Information--}}
                        @include('profile.miller.enterpreneurInformation')
                        {{--/-Entrepreneur Information--}}

                        {{--Certificate Info--}}
                        @include('profile.miller.certificateInformation')
                        {{--/-Certificate Info--}}

                        {{--QC Info--}}
                        @include('profile.miller.qcInformation')
                        {{--/- QC Info--}}

                        {{--Employee Info--}}
                        @include('profile.miller.employeeInformation')
                        {{--/- Employee Info--}}


                    </div>
                </div>

                <br><br>
                <table class="table table-striped table-bordered table-hover gridTable" title="{{ trans('module.module_list') }}">
                    <thead>
                    <tr>
                        <th class="fixedWidth" style="width: 5px;">Sl</th>
                        <th class="center fixedWidth">Mill Name</th>
                        <th class="center fixedWidth">Type</th>
                        <th class="center fixedWidth">Certificate Renewing Date</th>
                        <th class="center fixedWidth">Full Time Employee</th>
                        <th class="center fixedWidth">Active Status</th>
                        <th class="center fixedWidth">Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php $sl=0;?>
                    @foreach( $millerList as $row)
                        <tr>
                            <td class="center" >  {{ ++$sl }} </td>
                            <td> {{ $row->MILL_NAME }} </td>
                            <td> {{ $row->LOOKUPCHD_NAME }} </td>
                            <td> {{ $row->RENEWING_DATE }} </td>
                            <td> {{ $row->FULLTIMEMALE_EMP+$row->FULLTIMEFEM_EMP }} </td>
                            <td class="hidden-480">
                                <?php  if($row->ACTIVE_FLG == 0){ ?>
                                <span class="label label-sm label-danger arrowed arrowed-righ">Inactive</span>
                                <?php }else{ ?>
                                <span class="label label-sm label-info arrowed arrowed-righ">Active</span>
                                <?php } ?>

                            </td>

                            <td class="">
                                <div class="hidden-sm hidden-xs action-buttons">
                                    {{--<a class="blue showModalGlobal" id='{{ "monitoring/$row->MILLMONITORE_ID" }}' data-target=".modal" role="button"  data-toggle="modal" title="View Modules">--}}
                                    {{--<i class="ace-icon fa fa fa-eye bigger-130"></i>--}}
                                    {{--</a>--}}

                                    @php
                                        $editPermissionLevel = $previllage->UPDATE;
                                        $viewPermissionLevel = $previllage->READ;
                                    @endphp
                                    @if($viewPermissionLevel == 1)
                                        <a href="#" id='{{ "mill-info/$row->MILL_ID" }}' class="blue showModalGlobal" modal-size="modal-lg" data-target=".modal" data-toggle="modal" data-permission="{{ $viewPermissionLevel }}" role="button" title="View Miller Profile Details">
                                                        <span class="blue">
                                                            <i class="ace-icon fa fa-eye bigger-130"></i>
                                                        </span>
                                        </a>
                                    @else
                                        <a href="#" id="" class="blue showModalGlobal" data-target=".modal" data-toggle="modal" modal-size="modal-lg" role="button" data-permission="{{ $viewPermissionLevel }}" title="View Miller Profile Details" style="display: none;">
                                                        <span class="blue">
                                                            <i class="ace-icon fa fa-eye bigger-130"></i>
                                                        </span>
                                        </a>
                                    @endif
                                    @if($editPermissionLevel == 1)
                                        <a class="green showModalGlobal" id='{{ "mill-info/$row->MILL_ID/edit" }}' data-target=".modal" modal-size="modal-bg" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Miller Profile Details">
                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                        </a>


                                    @else
                                        <a class="green showModalGlobal" id='{{ "mill-info/$row->MILL_ID/edit" }}' data-target=".modal" modal-size="modal-lg" role="button" data-permission="{{ $editPermissionLevel }}"  data-toggle="modal" title="Edit Miller Profile Details" style="display: none;">
                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                        </a>

                                    @endif
                                    @if($previllage->DELETE == 1)

                                        <a class="red clickForDelete row{{ $row->MILL_ID }}" data-token="{{ csrf_token() }}" data-action="{{ 'mill-info/'.$row->MILL_ID }}"  role="button" title="Delete Miller Profile Details">
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

            <div class="space"></div>
        </div>
    </div><!-- /.row -->



    @include('masterGlobal.chosenSelect')
    @include('masterGlobal.getDistrict')
    @include('masterGlobal.getUpazila')
    @include('masterGlobal.getUnion')
    @include('masterGlobal.getMillersId')
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    {{--<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>--}}

    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script>

        $(document).ready(function(){
            $('.rowAdd').click(function(){
                var getTr = $('tr.rowFirst:first');
//            alert(getTr.html());
                $("select.chosen-select").chosen('destroy');
                $('tbody.newRow').append("<tr class='removableRow'>"+getTr.html()+"</tr>");
                var defaultRow = $('tr.removableRow:last');
                defaultRow.find(' input.OWNER_NAME').attr('disabled', false);
                defaultRow.find('select.DIVISION_ID').prop('disabled', false);
                defaultRow.find('select.DISTRICT_ID').prop('disabled', false);
                defaultRow.find('select.UPAZILA_ID').prop('disabled', false);
                defaultRow.find('select.UNION_ID').prop('disabled', false);
//            For Ignore array Conflict
                defaultRow.find('input.NID').attr('NID', false);
                defaultRow.find('input.MOBILE_1').attr('MOBILE_1', false);
                defaultRow.find('input.MOBILE_2').attr('disabled', false);
                defaultRow.find('input.EMAIL').attr('disabled', false);
                defaultRow.find('input.REMARKS').attr('disabled', false);
                defaultRow.find('span.budget_against_code').text('');
                defaultRow.find('span.errorMsg').text('');
                $('.chosen-select').chosen(0);
            });
        });
        // Fore Remove Row By Click
        $(document).on("click", "span.rowRemove ", function () {
            $(this).closest("tr.removableRow").remove();
        });




    </script>



    <!--Add New Group Modal Start-->
    @include('masterGlobal.deleteScript')
    @include('masterGlobal.getDistrictUpazilaUnion')
    @include('masterGlobal.ajaxFormSubmit')

@endsection
