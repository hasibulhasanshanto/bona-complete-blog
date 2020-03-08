<!-- Top Bar -->
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse"
                data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="{{ route('admin.dashboard')}}">Bona Dashboard</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right"> 
                <!-- Notifications -->
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                        <i class="material-icons">notifications</i>
                        <span class="label-count">{{ $pending_posts }}</span>
                    </a> 
                    <ul class="dropdown-menu">
                        <li class="header">NOTIFICATIONS</li>
                        <li class="body">
                            <ul class="menu">
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="icon-circle bg-light-green">
                                            <i class="material-icons">person_add</i>
                                        </div>
                                        <div class="menu-info">
                                            <h4>{{ $pending_posts }} new pending post</h4>
                                            <p>
                                                <i class="material-icons">access_time</i> Approve now ?
                                            </p>
                                        </div>
                                    </a>
                                </li>  
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="icon-circle bg-purple">
                                            <i class="material-icons">settings</i>
                                        </div>
                                        <div class="menu-info">
                                            <h4>Settings updated</h4>
                                            <p>
                                                <i class="material-icons">access_time</i> Yesterday
                                            </p>
                                        </div>
                                    </a>
                                </li>

                            </ul>
                        </li> 
                    </ul>
                </li>
                <!-- #END# Notifications -->

                <li class="pull-right">
                    <a href="javascript:void(0);" class="js-right-sidebar" data-close="true">
                        <i class="material-icons">more_vert</i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- #Top Bar -->