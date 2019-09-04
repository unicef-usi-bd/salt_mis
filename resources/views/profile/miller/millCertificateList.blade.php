@extends('master')
@section('mainContent')

    <div class="page-header">
        <h1>
            Profile
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Miller Certificate List
            </small>
        </h1>
    </div><!-- /.page-header -->
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-striped table-bordered table-hover gridTable" title="{{ trans('module.module_list') }}">
                <thead>
                <tr>
                    <th class="fixedWidth" style="width: 5px;">Sl</th>
                    <th class="center fixedWidth">Type of Certificate</th>
                    <th class="center fixedWidth">Issure Name</th>
                    <th class="center fixedWidth">Issuing Date</th>
                    <th class="center fixedWidth">Certificate Number</th>
                    <th class="center fixedWidth">Renewing Date</th>
                </tr>
                </thead>
                <tbody>
                    {{--@foreach()--}}
                    {{--@endforeach--}}
                </tbody>
            </table>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
