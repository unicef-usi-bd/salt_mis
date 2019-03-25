@extends('master')

@section('mainContent')

    <div class="page-header">
        <h1>
            {{ trans('module.access_control') }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('organizationModule.organization_module') }}
            </small>
        </h1>
    </div><!-- /.page-header -->
    <div class="row">
        <div class="col-xs-12">

            <table class="table table-striped table-bordered table-hover gridTable" title="{{ trans('organizationModule.org_list') }}">
                <thead>
                <tr>

                    <th>#</th>
                    <th>{{ trans('organizationModule.logo') }}</th>
                    <th>{{ trans('organizationModule.organization') }}</th>
                    <th>{{ trans('organizationModule.org_status') }}</th>
                    <th>{{ trans('organizationModule.org_group') }}</th>
                    <th>{{ trans('organizationModule.org_user') }}</th>
                    <th>{{ trans('organizationModule.org_modules') }}</th>
                    <th>{{ trans('organizationModule.org_pages') }}</th>
                </tr>
                </thead>


                <tbody>
                <?php $sl=0;?>
                <?php $organizations = DB::table('organizations')->get(); ?>
                <?php foreach($organizations as $organization){ ?>
                    <tr>
                        <td>{{ ++$sl }}</td>
                        <td><img src="{{ asset('/'.$organization->org_logo) }}" class="image-responsive" height="40px" width="40px"></td>
                        <td>{{ $organization->org_name }}</td>
                        <td><span class="label label-sm label-info arrowed arrowed-righ">@if($organization->active_status==1) Active @else Inactive @endif</span></td>
                        <td><button class="btn btn-danger btn-xs">{{ trans('organizationModule.create_group') }}</button></td>
                        <td><button class="btn btn-default btn-xs">{{ trans('organizationModule.create_user') }}</button></td>
                        <td>
                            @php
                                $createPermissionLevel = $previllage->CREATE;
                            @endphp
                            <a class="btn btn-danger btn-xs showModalGlobal" id="{{ 'org-asign-modules/'.$organization->org_id }}" data-target=".modal" role="button" data-permission="{{ $createPermissionLevel }}" modal-size="modal-lg"  data-toggle="modal" title="Organization Modules">
                                {{ trans('organizationModule.assign_modules') }}
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-danger btn-xs showModalGlobal" id="{{ 'org-add-pages/'.$organization->org_id }}" data-id="{{ $organization->org_id }}" data-target=".modal" role="button" data-permission="{{ $createPermissionLevel }}"  data-toggle="modal" title="Organization Pages">
                                {{ trans('organizationModule.add_pages') }}
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <!--Add New Group Modal Start-->
    @include('masterGlobal.deleteScript')
    <!-- Add New Group Modal End -->
    <script>
        $(document).on("click", ".chkAssignPage", function () {
            var value = $(this).val();
            var checked = ($($(this)).is(':checked')) ? 1 : 0;
            $.ajax({
                type : "get",
                url  : "add-remove-pages",
                data: {values:value, is_checked:checked},
                success:function (data) {
                    //console.log(JSON.parse(data));
//                console.log(data);
                }
            });
        });
    </script>


@endsection
