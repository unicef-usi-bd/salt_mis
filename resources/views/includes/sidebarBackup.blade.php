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
        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-lock"></i>
                <span class="menu-text">
								Access Control
							</span>
                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="">
                    <a href="{{ url('/user-groups') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        User Group
                    </a>
                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="{{ url('/modules') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        <span class="menu-text">
								Modules
                        </span>
                    </a>
                </li>
                <li class="">
                    <a href="{{ url('/module-links') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        <span class="menu-text">
								Module Links
                        </span>
                    </a>
                </li>
                <li class="">
                    <a href="{{ url('/organization-modules') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        <span class="menu-text">
								Organization Modules
                        </span>
                    </a>
                </li>
                <li class="">
                    <a href="{{ url('/user-modules') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        <span class="menu-text">
								User Modules
                        </span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-pencil"></i>
                <span class="menu-text">
								All Setup
							</span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="">
                    <a href="#" class="dropdown-toggle">
                        <i class="menu-icon fa fa-caret-right"></i>
                        <span class="menu-text">
								General Setup
							</span>
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>
                    <ul class="submenu">
                        <li class="">
                            <a href="{{ url('/lookup-groups') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Base Setup
                            </a>

                            <b class="arrow"></b>
                        </li>
                        <li class="">
                            <a href="{{ url('/budgets') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Budget
                            </a>

                            <b class="arrow"></b>
                        </li>
                        <li class="">
                            <a href="{{ url('/farmers') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Farmer
                            </a>

                            <b class="arrow"></b>
                        </li>
                        <li class="">
                            <a href="{{ url('/fiac') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Fiac
                            </a>
                            <b class="arrow"></b>
                        </li>
                        <li class="">
                            <a href="{{ url('/financial-years') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Financial Year
                            </a>

                            <b class="arrow"></b>
                        </li>
                        <li class="">
                            <a href="{{ url('/lender-funds') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Lender Fund
                            </a>

                            <b class="arrow"></b>
                        </li>
                        <li class="">
                            <a href="{{ url('/organizations') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Organizations
                            </a>

                            <b class="arrow"></b>
                        </li>
                        <li class="">
                            <a href="{{ url('/unions') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Unions
                            </a>

                            <b class="arrow"></b>
                        </li>
                        <li class="">
                            <a href="{{ url('/users') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Users Setup
                            </a>

                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>

                <li class="">
                    <a href="#" class="dropdown-toggle">
                        <i class="menu-icon fa fa-caret-right"></i>
                        <span class="menu-text">
								Crops Setup
							</span>
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>
                    <ul class="submenu">
                        <li class="">
                            <a href="{{ url('/crop-varieties') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Crops Varietie
                            </a>

                            <b class="arrow"></b>
                        </li>
                        <li class="">
                            <a href="{{ url('/crops') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Crops
                            </a>

                            <b class="arrow"></b>
                        </li>
                        <li class="">
                            <a href="{{ url('/crops-problem') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Crops Problem
                            </a>

                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>

                <li class="">
                    <a href="#" class="dropdown-toggle">
                        <i class="menu-icon fa fa-caret-right"></i>
                        <span class="menu-text">
								Bank Setup
							</span>
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>
                        <ul class="submenu">
                                <li class="">
                                    <a href="{{ url('/banks') }}">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Bank
                                    </a>

                                    <b class="arrow"></b>
                                </li>
                        <li class="">
                            <a href="{{ url('/bank-branches') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Bank Branch
                            </a>

                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>

                <li class="">
                    <a href="#" class="dropdown-toggle">
                        <i class="menu-icon fa fa-caret-right"></i>
                        <span class="menu-text">
								CIG Setup
							</span>
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>
                    <ul class="submenu">
                        <li class="">
                            <a href="{{ url('/cigs') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                CIGs
                            </a>

                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="{{ url('/cig-gradings') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                CIG Grading
                            </a>

                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>

                <li class="">
                    <a href="#" class="dropdown-toggle">
                        <i class="menu-icon fa fa-caret-right"></i>
                        <span class="menu-text">
								Mail Setup
							</span>
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>
                    <ul class="submenu">
                        <li class="">
                            <a href="{{ url('/email-templates') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Email Template
                            </a>
                            <b class="arrow"></b>
                        </li>
                        <li class="">
                            <a href="{{ url('/send-mails') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Send Mail
                            </a>
                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>

        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-sitemap"></i>
                <span class="menu-text">
								Mapping
							</span>
                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="">
                    <a href="{{ url('/economic-code') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Economic Code
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="{{ url('/technologies') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Technologies
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="{{ url('/ecode-techs') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        E.Code Tech
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="{{ url('/cost-center-types') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Cost Center Type
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="{{ url('/cost-center') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Cost Center
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="{{ url('/technology-unit-cost') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Technology Unit Cost
                    </a>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>

        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-exchange"></i>
                <span class="menu-text">
								Transaction
							</span>
                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="">
                    <a href="#" class="dropdown-toggle">
                        <i class="menu-icon fa fa-caret-right"></i>
                        <span class="menu-text">
								Fund Allocations
							</span>
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>
                    <ul class="submenu">
                        <li class="">
                            <a href="{{ url('fund-allocations/create') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Add Allocation
                            </a>

                            <b class="arrow"></b>
                        </li>
                        <li class="">
                            <a href="{{ url('/fund-allocations') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                View Allocations
                            </a>

                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>
                <li class="">
                    <a href="#" class="dropdown-toggle">
                        <i class="menu-icon fa fa-caret-right"></i>
                        <span class="menu-text">
								Approve Allocations
							</span>
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>
                    <ul class="submenu">
                        <li class="">
                            <a href="{{ url('/approve-allocations') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                View Request
                            </a>

                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>

        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon glyphicon glyphicon-euro"></i>
                <span class="menu-text">
								SOE
							</span>
                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="">
                    <a href="{{ url('/') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Add Soe
                    </a>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>

        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon glyphicon glyphicon-file"></i>
                <span class="menu-text">
								Report
							</span>
                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="">
                    <a href="{{ url('/report-fund-allocations') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Fund-Allocations
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="{{ url('/report-soe') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        SOE
                    </a>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>


        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-flask"></i>
                <span class="menu-text">
								Test
							</span>
                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="">
                    <a href="{{ url('/demonstrations') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Demonstration
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="{{ url('/field-day') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Field Day
                    </a>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>

        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-building"></i>
                <span class="menu-text">
                                Upazila Agri. Office
							</span>
                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="">
                    <a href="{{ url('/upazila-agriculture-training') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Training Schedule
                    </a>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>


    </ul><!-- /.nav-list -->

    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
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
