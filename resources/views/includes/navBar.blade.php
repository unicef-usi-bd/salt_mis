<style>
    .ace-nav>li.light-blue>a {
        background-color: #006699;
        color: #FFFFFF;
    }
</style>
{{--<div id="navbar" class="navbar navbar-default ace-save-state" style="background-color: #1CABE2;">--}}
<div id="navbar" class="navbar navbar-default ace-save-state" style="background-image: url('assets/images/app-images/banner.png');background-repeat: no-repeat;background-size: cover;background-size: 100% 100%;">
    <div class="navbar-container ace-save-state" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <div class="navbar-header pull-left">
            <a href="#" class="navbar-brand" style="margin-left: 400px;">
                <div id="ajax-loader" style="display: none;">
                    <div class="ajax-loader inline"></div>
                </div>
            </a>
        </div>

        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">
                <li class="light-blue dropdown-modal">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle col-md-12" style="background-color: #96C3EF!important;">
                        <div class="col-md-3" style="padding-left: 0 !important;">
                            @php
                                $defaultImage = asset('assets/images/avatars/user.png');
                                $uploadedImage = Auth::user()->user_image;
                                if(file_exists($uploadedImage)) $defaultImage = $uploadedImage;
                            @endphp
                            <img class="nav-user-photo" src="{{ $defaultImage }}" alt="" />
                        </div>
                        <div class="col-md-9">
                            <div class="row" style="line-height: 35px;height: 20px;margin-top: 3px;">
                                @php
                                $sessionInfo = Auth::user();
                                $organizationType = '';
                                $centerId = $sessionInfo->center_id;
                                    if($centerId!=null) {
                                    $associationInfo = DB::table('ssm_associationsetup')->where('ASSOCIATION_ID', '=', $centerId)->first();
                                    if($associationInfo) $organizationType = "[ $associationInfo->ASSOCIATION_NAME ]";
                                }
                                @endphp
                                <span style="font-weight: bold;color: #FFFFFF;">{{ $sessionInfo->username }} {{ $organizationType }}</span>
                                <i class="ace-icon fa fa-caret-down" style="margin-left: 10px;"></i>
                            </div>
                            {{--<div class="row" style="line-height: 25px;height: 20px;">--}}
                                {{--{{ Session::get('user_level_name') }}--}}
                            {{--</div>--}}
                        </div>
                    </a>

                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li>
                            <a href="#" id="{{ 'users-change-password'  }}" class="showModalGlobal" data-target=".modal" data-toggle="modal" data-permission="1" role="button" title="Change Password">
                                <i class="ace-icon fa fa-key"></i>
                                Change Password
                            </a>
                        </li>

                        <li>
                            <a href="#" id="{{ 'users/'.Auth::user()->id }}" class="showModalGlobal" data-target=".modal" data-toggle="modal" data-permission="1" role="button" title="View Profile">
                                <i class="ace-icon fa fa-user"></i>
                                Profile
                            </a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="ace-icon fa fa-power-off"></i>
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        {{--Language Div--}}
        {{--<div class="navbar-header pull-right" style="margin-top: 8px;margin-right: 20px;">--}}
            {{--<form action="dashboard" method="post">--}}
                {{--{{ csrf_field() }}--}}
                {{--<button type="submit" class="btn btn-primary btn-xs banglaLanguage" name="locale" value="bn">--}}
                    {{--<i class="flag-icon flag-icon-bd"></i>--}}
                    {{--Bangla (BN)</button>--}}
                {{--<button type="submit" class="btn btn-primary btn-xs englishLanguage" name="locale" value="en">--}}
                    {{--<i class="flag-icon flag-icon-gb"></i>--}}
                    {{--English (EN)</button>--}}
            {{--</form>--}}
        {{--</div>--}}

    </div><!-- /.navbar-container -->
</div>

