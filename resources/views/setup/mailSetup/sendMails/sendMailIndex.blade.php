@extends('master')

@section('mainContent')

    <div class="page-header">
        <h1>
            {{ trans('breadcrumb.all_setup') }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('breadcrumb.send_emil') }}
            </small>
        </h1>
    </div><!-- /.page-header -->
    <div class="row">
        <div class="col-xs-12">

            <table class="table table-striped table-bordered table-hover gridTable" title="Bank List">
                <thead>
                <tr>

                    <th class="fixedWidth">{{ trans('dashboard.sl') }}</th>
                    <th>{{ trans('bank.bank_name') }}</th>
                    <th class="hidden-480">{{ trans('sendEmail.address') }}</th>
                    <th class="hidden-480">{{ trans('sendEmail.email') }}</th>
                    <th class="hidden-480">{{ trans('sendEmail.phone') }}</th>
                    <th>{{ trans('sendEmail.status') }}</th>
                    <th>{{trans('dashboard.action')}}</th>
                </tr>
                </thead>


                <tbody>
                <?php $sl=0;?>
                {{--@foreach($banks as $bank)--}}
                    {{--<tr>--}}
                        {{--<td class="center">{{ ++$sl }}</td>--}}
                        {{--<td>{{$bank->bank_name}}</td>--}}
                        {{--<td class="hidden-480">{{$bank->bank_address}}</td>--}}
                        {{--<td class="hidden-480">{{$bank->email}}</td>--}}
                        {{--<td class="hidden-480">{{$bank->phone}}</td>--}}
                        {{--<td>--}}
                            {{--@if($bank->active_status == 1)--}}
                                {{--<span class="label label-sm label-info arrowed arrowed-righ">Active</span>--}}
                            {{--@else--}}
                                {{--<span class="label label-sm label-danger arrowed arrowed-righ">Inactive</span>--}}
                            {{--@endif--}}
                        {{--</td>--}}
                        {{--<td class="row{{ $bank->bank_id }}">--}}
                            {{--<div class="hidden-sm hidden-xs action-buttons">--}}


                                {{--<a href="#" id="{{ 'banks/'.$bank->bank_id }}" class="blue showModalGlobal" data-target=".modal" data-toggle="modal" role="button" title="View Bank">--}}
                                        {{--<span class="blue">--}}
                                            {{--<i class="ace-icon fa fa-eye bigger-130"></i>--}}
                                        {{--</span>--}}
                                {{--</a>--}}


                                {{--<a class="green showModalGlobal" id="{{ 'banks/'.$bank->bank_id.'/edit' }}" data-target=".modal" role="button"  data-toggle="modal" title="Edit Bank">--}}
                                    {{--<i class="ace-icon fa fa-pencil bigger-130"></i>--}}
                                {{--</a>--}}
                                {{--@if($bank->checkDelete == 0)--}}

                                    {{--<a class="red clickForDelete row{{ $bank->bank_id }}" data-token="{{ csrf_token() }}" data-action="{{ 'banks/'.$bank->bank_id }}" role="button">--}}
                                        {{--<i class="ace-icon fa fa-trash-o bigger-130"></i>--}}
                                    {{--</a>--}}

                                {{--@endif--}}


                            {{--</div>--}}

                            {{--<div class="hidden-md hidden-lg">--}}
                                {{--<div class="inline pos-rel">--}}
                                    {{--<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">--}}
                                        {{--<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>--}}
                                    {{--</button>--}}

                                    {{--<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">--}}
                                        {{--<li>--}}
                                            {{--<a href="#" id="{{ 'banks/'.$bank->bank_id }}" class="blue showModalGlobal" data-target=".modal" data-toggle="modal" role="button" title="View Bank">--}}
                                                {{--<span class="blue">--}}
                                                    {{--<i class="ace-icon fa fa-eye bigger-130"></i>--}}
                                                {{--</span>--}}
                                            {{--</a>--}}

                                        {{--</li>--}}

                                        {{--<li>--}}
                                            {{--<a class="green showModalGlobal" id="{{ 'banks/'.$bank->bank_id.'/edit' }}" data-target=".modal" role="button"  data-toggle="modal" title="Edit Bank">--}}
                                                {{--<i class="ace-icon fa fa-pencil bigger-130"></i>--}}
                                            {{--</a>--}}
                                        {{--</li>--}}

                                        {{--<li>--}}
                                            {{--@if($bank->checkDelete == 0)--}}
                                                {{--<a class="red clickForDelete row{{ $bank->bank_id }}" data-token="{{ csrf_token() }}" data-action="{{ 'banks/'.$bank->bank_id }}" role="button">--}}
                                                    {{--<i class="ace-icon fa fa-trash-o bigger-130"></i>--}}
                                                {{--</a>--}}
                                            {{--@endif--}}

                                        {{--</li>--}}
                                    {{--</ul>--}}

                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                {{--@endforeach--}}

                </tbody>
            </table>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <!--Add New Group Modal Start-->
    @include('masterGlobal.deleteScript')
    <!-- Add New Group Modal End -->


@endsection
