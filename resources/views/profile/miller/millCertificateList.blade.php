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
            Setup
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
            <table class="table table-striped table-bordered table-hover gridTable" title="{{ trans('module.module_list') }}">
                <thead>
                <tr>
                    <th class="fixedWidth" style="width: 5px;">Sl</th>
                    <th class="center fixedWidth">Trading Name</th>
                    <th class="center fixedWidth">Trader Name</th>
                    <th class="center fixedWidth">Supplier Type</th>
                    <th class="center fixedWidth">Trade licence No</th>
                    <th class="center fixedWidth">Phone Number</th>
                    <th class="center fixedWidth">Email</th>
                    <th class="center fixedWidth">Action</th>

                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
