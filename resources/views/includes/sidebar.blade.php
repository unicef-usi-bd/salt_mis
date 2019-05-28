<div id="sidebar" class="sidebar responsive  ace-save-state">
    <script type="text/javascript">
        try{ace.settings.loadState('sidebar')}catch(e){}
    </script>

    <ul class="nav nav-list">
        <li class="">
            <a href="{{ url('/dashboard') }}">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Dashboard </span>
            </a>
            <b class="arrow"></b>
        </li>
        <?php
        $sessionInfo = Auth::user();
        $userId = $sessionInfo['id'];
        $groupId = $sessionInfo['user_group_id'];
        $levelId = $sessionInfo['user_group_level_id'];
        $orgId = Session::get('orgId');
        /*        if($userId==1){
                    $orgMLink = DB::table('sa_module_links')
                        ->leftJoin('sa_modules', 'sa_module_links.MODULE_ID', '=', 'sa_modules.MODULE_ID')
                        ->distinct()
                        ->orderBy('sa_modules.SL_NO', 'ASC')
                        ->get(['sa_modules.MODULE_ID', 'sa_modules.MODULE_NAME','sa_modules.MODULE_ICON','sa_modules.SL_NO']);
                } else{*/
        $orgMLink = DB::table('sa_uglw_mlink')
            ->leftJoin('sa_modules', 'sa_uglw_mlink.MODULE_ID', '=', 'sa_modules.MODULE_ID')
            ->where('sa_uglw_mlink.ORG_ID', $orgId)
            ->where('sa_uglw_mlink.USERGRP_ID', $groupId)
            ->where('sa_uglw_mlink.UG_LEVEL_ID', $levelId)
//        ->Where('sa_uglw_mlink.USER_ID', $userId)
            ->orWhere('sa_uglw_mlink.CREATE', "1")
            ->orWhere('sa_uglw_mlink.READ', "1")
            ->orWhere('sa_uglw_mlink.UPDATE', "1")
            ->orWhere('sa_uglw_mlink.DELETE', "1")
            ->orWhere('sa_uglw_mlink.STATUS', "1")
            ->distinct()
            ->orderBy('sa_modules.SL_NO', 'ASC')
            ->get(['sa_modules.MODULE_ID', 'sa_modules.MODULE_NAME','sa_modules.MODULE_ICON']);
        /*  }*/

        foreach ($orgMLink as $key =>$value) {
        $moduleId = $value->MODULE_ID;
        if ($groupId != "") {
            /*            if($userId==1){
                            $links = DB:: table('sa_module_links')
                                ->where('MODULE_ID', '=', $moduleId)
                                ->orderBy('SL_NO', 'ASC')
                                ->get(['LINK_NAME', 'LINK_URI']);
                        } else{*/
            $links = DB:: table('sa_uglw_mlink')
                ->leftJoin('sa_module_links', 'sa_uglw_mlink.LINK_ID', '=', 'sa_module_links.LINK_ID')
                ->where('sa_uglw_mlink.ORG_ID', $orgId)
                ->where('sa_uglw_mlink.USERGRP_ID', $groupId)
                ->where('sa_uglw_mlink.UG_LEVEL_ID', $levelId)
//                ->Where('sa_uglw_mlink.USER_ID', $userId)
                ->where('sa_uglw_mlink.MODULE_ID', '=', $moduleId)
                ->where(function($query) {
                    return $query
                        ->where('sa_uglw_mlink.CREATE', '=', 1)
                        ->orWhere('sa_uglw_mlink.READ', '=', 1)
                        ->orWhere('sa_uglw_mlink.UPDATE', '=', 1)
                        ->orWhere('sa_uglw_mlink.DELETE', '=', 1)
                        ->orWhere('sa_uglw_mlink.STATUS', '=', 1);
                })
                ->orderBy('sa_module_links.SL_NO', 'ASC')
                ->get(['sa_uglw_mlink.LINK_ID', 'sa_module_links.LINK_NAME', 'sa_module_links.LINK_URI']);
            /* }*/
        }
        if(count($links)>0){
        ?>
        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon {{ $value->MODULE_ICON ?: '' }}"></i>
                <span class="menu-text">
								{{ $value->MODULE_NAME }}
							</span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>

            <ul class="submenu">
                @foreach ($links as $key =>$link)
                    <li class="">
                        <a href="{{ url($link->LINK_URI) }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            {{ $link->LINK_NAME }}
                        </a>
                        <b class="arrow"></b>
                    </li>
                @endforeach
            </ul>
        </li>
        <?php }
        }
        ?>

    </ul><!-- /.nav-list -->

    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>

    @if(Session::get('MILL_ID'))
        {{--QR code Here--}}
        <img src="{{ asset("image/qrcode.png") }}" width="130" height="130" style="margin-left: 30px;margin-top: 45px;"/>
        <div style="margin-top: 10px;margin-left: 10px;">
            {{--APK Here--}}
            <a href="{{ asset("image/apk/unicef_salt_aa1_v1.0.0.apk") }}" class="btn btn-success"><i class="fa fa-android" style="font-size: 18px;"></i> Download App <i class="fa fa-arrow-circle-o-down " style="font-size: 18px;"></i></a>
        </div>
    @endif

    <script type="text/javascript">

        //########### Sidebar menu selected start ###############
        var path = window.location.href;
        path = path.replace(/\/$/, "");
        path = decodeURIComponent(path);
        $(".submenu a").each(function () {
            var href = $(this).attr('href');
            if (path === href) {
                $(this).parents('li').addClass('active open');
                //$(this).parents('ul').addClass('in');
                /*$(this).parents('ul').prev('li').removeClass('collapsed');*/
            }
        });
        //########### Sidebar menu selected end ###############
    </script>
</div>
