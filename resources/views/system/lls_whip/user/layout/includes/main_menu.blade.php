    <!-- Main Menu area start-->
    <div class="main-menu-area mg-tb-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 first_col_lls" >
                    <div class="row d-flex text-center">
                        <h1>LLS</h1>
                    </div>
                    <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro first">
                        <li ><a data-toggle="tab" href="#Home" class="active"><i class="notika-icon notika-house"></i> Home</a>
                        </li>
                        <li><a data-toggle="tab" href="#mailbox"><i class="notika-icon notika-mail"></i>Establishments</a>
                        </li>
                      
                        
        
                    </ul>
                    <div class="tab-content custom-menu-content">
                        <div id="Home" class="tab-pane in active notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown active">
                                <li><a href="{{url('admin/lls/dashboard')}}">Dashboard</a>
                                </li>
                                <li><a href="analytics.html">Analytics</a>
                                </li>

                            </ul>
                        </div>
                        <div id="mailbox" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="{{url('admin/lls/add-new-establishment')}}">Add New</a>
                                </li>
                                <li><a href="{{url('admin/lls/establishments-list')}}">Establishments List</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="row d-flex text-center">
                        <h1>WHIP</h1>
                    </div>
                    <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                        <li ><a data-toggle="tab" href="#Home1"><i class="notika-icon notika-house"></i> Home</a>
                        </li>
                        <li><a data-toggle="tab" href="#mailbox1"><i class="notika-icon notika-mail"></i>Contractors</a>
                        </li>
                        <li><a data-toggle="tab" href="#all_projects"><i class="notika-icon notika-mail"></i>Projects</a>
                        </li>
        
                    </ul>
                    <div class="tab-content custom-menu-content">
                        <div id="Home1" class="tab-pane in active notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="{{url('admin/whip/dashboard')}}">Dashboard</a>
                                </li>
                                <li><a href="analytics.html">Analytics</a>
                                </li>

                            </ul>
                        </div>
                        <div id="mailbox1" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="{{url('admin/whip/add-new-contractor')}}">Add New</a>
                                </li>
                                <li><a href="{{url('admin/whip/contractors-list')}}">Contractors List</a>
                                </li>
                            </ul>
                        </div>
                        <div id="all_projects" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="{{url('admin/whip/projects-list')}}">Projects List</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>

    <!-- Main Menu area End-->