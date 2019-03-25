<style>
    .singleHeader{
        height: 50px;
        font-weight: bold;
        font-size: 20px;
        line-height: 50px;
        /*margin-top: -25px;*/
    }

    .singleSubHeader{
        height: 30px;
        font-weight: bold;
        font-size: 16px;
        margin-top: 0px;
    }
    .viewInfo{
        margin-top: -20px;
        margin-bottom: 30px;
    }
    .viewInfo p{
        font-size: 14px;
    }
</style>
<div class="error-container">
    <div class="row center" style="margin-top: -20px;"><img src="{{ url('/'.$organization->org_logo) }}" class="image-responsive" height="100px" width="100px"></div>
    <div class="center singleHeader"> {{ $organization->org_name }} </div>
    <div class="center singleSubHeader"> {{ $organization->org_address }} </div>
    <div class="space"></div>
    <div class="col-md-5 col-md-offset-1 viewInfo">
        <p><b>{{ trans('organization.email') }}</b> : {{ $organization->email_address }}</p>
        <p><b>{{ trans('organization.fax') }}</b> : {{ $organization->fax }}</p>
        <p><b>{{ trans('organization.slogan') }}</b> : {{ $organization->org_slogan }}</p>
        <p><b>{{ trans('organization.phone') }}</b> : {{ $organization->phone }}</p>
        <p><b>{{ trans('organization.website') }}</b> : {{ $organization->website }}</p>
    </div>
    <div class="col-md-5 col-md-offset-1 viewInfo">
        <p><b>{{ trans('organization.bank_name') }}</b> : {{ $organization->bank_name }}</p>
        <p><b>{{ trans('organization.branch_name') }}</b> : {{ $organization->bank_branch_name }}</p>
        <p><b>{{ trans('organization.account_no') }}</b> : {{ $organization->account_no }}</p>
        <p><b>{{ trans('organization.route_no') }}</b> : {{ $organization->route_no }}</p>
        <p><b>{{ trans('cigGroup.active_status') }}</b> :
            @if($organization->active_status==1)
                <span class="label label-md label-info arrowed arrowed-righ"> Active </span>
            @else
                <span class="label label-md label-danger arrowed arrowed-righ"> Inactive </span>
            @endif
        </p>
    </div>

    <div class="space"></div>
</div>