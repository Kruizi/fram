@extends('appHome')

@section('contentHome')
    <!-- BEGIN BODY -->
    <body class="fixed-top">
    <!-- BEGIN HEADER -->
    @include('header')
    <!-- END HEADER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container row-fluid">
        <!-- BEGIN SIDEBAR -->
        @include('menu')
        <!-- END SIDEBAR -->
        <!-- BEGIN PAGE -->
        <div class="page-content">
            <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <div id="portlet-config" class="modal hide">
                <div class="modal-header">
                    <button data-dismiss="modal" class="close" type="button"></button>
                    <h3>Widget Settings</h3>
                </div>
                <div class="modal-body">
                    <p>Here will be a configuration form</p>
                </div>
            </div>
            <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <!-- BEGIN PAGE CONTAINER-->
            <div class="container-fluid">
                <!-- BEGIN PAGE HEADER-->
                <div class="row-fluid">
                    <div class="span12">
                    </div>
                </div>
                <!-- END PAGE HEADER-->
                <div id="dashboard">
                    <!-- BEGIN DASHBOARD STATS -->
                    <div class="row-fluid">
                    @foreach($client as $clin)                    
                        <div class="span3 responsive" data-tablet="span6" data-desktop="span3">
                            <div class="dashboard-stat 
                                    @if($clin->status == '0')
                                        green
                                    @elseif($clin->status == '1')
                                        yellow
                                    @else
                                        red
                                    @endif "> 
                                <div class="details">
                                    <div class="desc">
                                        {{$clin->name_clients}}
                                    </div>
                                </div>
                                <a class="more" href="/static-{{$clin->indeficators}}">
                                    Просмотреть статистику <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach                        
                    </div>
                    <!-- END DASHBOARD STATS -->
                    <div class="clearfix"></div>
                    <div class="row-fluid">
                        <div class="span6">
                            <!-- BEGIN PORTLET-->
                            <div class="portlet solid bordered light-grey">
                                <div class="portlet-title">
                                    <h4><i class="icon-bar-chart"></i>Site Visits</h4>
                                    <div class="tools">
                                        <div class="btn-group pull-right" data-toggle="buttons-radio">
                                            <a href="javascript:;" class="btn mini">Users</a>
                                            <a href="javascript:;" class="btn mini active">Feedbacks</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div id="site_statistics_loading">
                                        <img src="{{ asset('public/assets/img/loading.gif') }}" alt="loading" />
                                    </div>
                                    <div id="site_statistics_content" class="hide">
                                        <div id="site_statistics" class="chart"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- END PORTLET-->
                        </div>
                        <div class="span6">
                            <!-- BEGIN PORTLET-->
                            <div class="portlet solid light-grey bordered">
                                <div class="portlet-title">
                                    <h4><i class="icon-bullhorn"></i>Activities</h4>
                                    <div class="tools">
                                        <div class="btn-group pull-right" data-toggle="buttons-radio">
                                            <a href="javascript:;" class="btn blue mini active">Users</a>
                                            <a href="javascript:;" class="btn blue mini">Orders</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div id="site_activities_loading">
                                        <img src="{{ asset('public/assets/img/loading.gif') }}" alt="loading" />
                                    </div>
                                    <div id="site_activities_content" class="hide">
                                        <div id="site_activities" style="height:100px;"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- END PORTLET-->
                            <!-- BEGIN PORTLET-->
                            <div class="portlet solid bordered light-grey">
                                <div class="portlet-title">
                                    <h4><i class="icon-signal"></i>Server Load</h4>
                                    <div class="tools">
                                        <div class="btn-group pull-right" data-toggle="buttons-radio">
                                            <a href="javascript:;" class="btn red mini active">
                                                <span class="hidden-phone">Database</span>
                                                <span class="visible-phone">DB</span></a>
                                            <a href="javascript:;" class="btn red mini">Web</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div id="load_statistics_loading">
                                        <img src="{{ asset('public/assets/img/loading.gif') }}" alt="loading" />
                                    </div>
                                    <div id="load_statistics_content" class="hide">
                                        <div id="load_statistics" style="height:108px;"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- END PORTLET-->
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row-fluid">
                        <div class="span6">
                            <!-- BEGIN REGIONAL STATS PORTLET-->
                            <div class="portlet">
                                <div class="portlet-title">
                                    <h4><i class="icon-globe"></i>Regional Stats</h4>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"></a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"></a>
                                        <a href="javascript:;" class="reload"></a>
                                        <a href="javascript:;" class="remove"></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div id="region_statistics_loading">
                                        <img src="{{ asset('public/assets/img/loading.gif') }}" alt="loading" />
                                    </div>
                                    <div id="region_statistics_content" class="hide">
                                        <div class="btn-toolbar">
                                            <div class="btn-group " data-toggle="buttons-radio">
                                                <a href="javascript:;" class="btn mini active">Users</a>
                                                <a href="javascript:;" class="btn mini">Orders</a>
                                            </div>
                                            <div class="btn-group pull-right">
                                                <a href="javascript:;" class="btn mini dropdown-toggle" data-toggle="dropdown">
                                                    Select Region <span class="icon-angle-down"></span>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="javascript:;" id="regional_stat_world">World</a></li>
                                                    <li><a href="javascript:;" id="regional_stat_usa">USA</a></li>
                                                    <li><a href="javascript:;" id="regional_stat_europe">Europe</a></li>
                                                    <li><a href="javascript:;" id="regional_stat_russia">Russia</a></li>
                                                    <li><a href="javascript:;" id="regional_stat_germany">Germany</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div id="vmap_world" class="vmaps chart hide"></div>
                                        <div id="vmap_usa" class="vmaps chart hide"></div>
                                        <div id="vmap_europe" class="vmaps chart hide"></div>
                                        <div id="vmap_russia" class="vmaps chart hide"></div>
                                        <div id="vmap_germany" class="vmaps chart hide"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- END REGIONAL STATS PORTLET-->
                        </div>
                        <div class="span6">
                            <!-- BEGIN PORTLET-->
                            <div class="portlet paddingless">
                                <div class="portlet-title line">
                                    <h4><i class="icon-bell"></i>Feeds</h4>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"></a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"></a>
                                        <a href="javascript:;" class="reload"></a>
                                        <a href="javascript:;" class="remove"></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <!--BEGIN TABS-->
                                    <div class="tabbable tabbable-custom">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#tab_1_1" data-toggle="tab">System</a></li>
                                            <li><a href="#tab_1_2" data-toggle="tab">Activities</a></li>
                                            <li><a href="#tab_1_3" data-toggle="tab">Recent Users</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1_1">
                                                <div class="scroller" data-height="290px" data-always-visible="1" data-rail-visible1="1">
                                                    <ul class="feeds">
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-success">
                                                                            <i class="icon-bell"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc">
                                                                            You have 4 pending tasks.
																			<span class="label label-important label-mini">
																			Take action
																			<i class="icon-share-alt"></i>
																			</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date">
                                                                    Just now
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <div class="col1">
                                                                    <div class="cont">
                                                                        <div class="cont-col1">
                                                                            <div class="label label-success">
                                                                                <i class="icon-bell"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="cont-col2">
                                                                            <div class="desc">
                                                                                New version v1.4 just lunched!
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col2">
                                                                    <div class="date">
                                                                        20 mins
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-important">
                                                                            <i class="icon-bolt"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc">
                                                                            Database server #12 overloaded. Please fix the issue.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date">
                                                                    24 mins
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-info">
                                                                            <i class="icon-bullhorn"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc">
                                                                            New order received. Please take care of it.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date">
                                                                    30 mins
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-success">
                                                                            <i class="icon-bullhorn"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc">
                                                                            New order received. Please take care of it.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date">
                                                                    40 mins
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-warning">
                                                                            <i class="icon-plus"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc">
                                                                            New user registered.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date">
                                                                    1.5 hours
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-success">
                                                                            <i class="icon-bell-alt"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc">
                                                                            Web server hardware needs to be upgraded.
                                                                            <span class="label label-inverse label-mini">Overdue</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date">
                                                                    2 hours
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label">
                                                                            <i class="icon-bullhorn"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc">
                                                                            New order received. Please take care of it.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date">
                                                                    3 hours
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-warning">
                                                                            <i class="icon-bullhorn"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc">
                                                                            New order received. Please take care of it.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date">
                                                                    5 hours
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-info">
                                                                            <i class="icon-bullhorn"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc">
                                                                            New order received. Please take care of it.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date">
                                                                    18 hours
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label">
                                                                            <i class="icon-bullhorn"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc">
                                                                            New order received. Please take care of it.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date">
                                                                    21 hours
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-info">
                                                                            <i class="icon-bullhorn"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc">
                                                                            New order received. Please take care of it.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date">
                                                                    22 hours
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label">
                                                                            <i class="icon-bullhorn"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc">
                                                                            New order received. Please take care of it.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date">
                                                                    21 hours
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-info">
                                                                            <i class="icon-bullhorn"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc">
                                                                            New order received. Please take care of it.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date">
                                                                    22 hours
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label">
                                                                            <i class="icon-bullhorn"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc">
                                                                            New order received. Please take care of it.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date">
                                                                    21 hours
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-info">
                                                                            <i class="icon-bullhorn"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc">
                                                                            New order received. Please take care of it.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date">
                                                                    22 hours
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label">
                                                                            <i class="icon-bullhorn"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc">
                                                                            New order received. Please take care of it.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date">
                                                                    21 hours
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-info">
                                                                            <i class="icon-bullhorn"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc">
                                                                            New order received. Please take care of it.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date">
                                                                    22 hours
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab_1_2">
                                                <div class="scroller" data-height="290px" data-always-visible="1" data-rail-visible1="1">
                                                    <ul class="feeds">
                                                        <li>
                                                            <a href="#">
                                                                <div class="col1">
                                                                    <div class="cont">
                                                                        <div class="cont-col1">
                                                                            <div class="label label-success">
                                                                                <i class="icon-bell"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="cont-col2">
                                                                            <div class="desc">
                                                                                New user registered
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col2">
                                                                    <div class="date">
                                                                        Just now
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <div class="col1">
                                                                    <div class="cont">
                                                                        <div class="cont-col1">
                                                                            <div class="label label-success">
                                                                                <i class="icon-bell"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="cont-col2">
                                                                            <div class="desc">
                                                                                New order received
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col2">
                                                                    <div class="date">
                                                                        10 mins
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-important">
                                                                            <i class="icon-bolt"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc">
                                                                            Order #24DOP4 has been rejected.
                                                                            <span class="label label-important label-mini">Take action <i class="icon-share-alt"></i></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date">
                                                                    24 mins
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <div class="col1">
                                                                    <div class="cont">
                                                                        <div class="cont-col1">
                                                                            <div class="label label-success">
                                                                                <i class="icon-bell"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="cont-col2">
                                                                            <div class="desc">
                                                                                New user registered
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col2">
                                                                    <div class="date">
                                                                        Just now
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <div class="col1">
                                                                    <div class="cont">
                                                                        <div class="cont-col1">
                                                                            <div class="label label-success">
                                                                                <i class="icon-bell"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="cont-col2">
                                                                            <div class="desc">
                                                                                New user registered
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col2">
                                                                    <div class="date">
                                                                        Just now
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <div class="col1">
                                                                    <div class="cont">
                                                                        <div class="cont-col1">
                                                                            <div class="label label-success">
                                                                                <i class="icon-bell"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="cont-col2">
                                                                            <div class="desc">
                                                                                New user registered
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col2">
                                                                    <div class="date">
                                                                        Just now
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <div class="col1">
                                                                    <div class="cont">
                                                                        <div class="cont-col1">
                                                                            <div class="label label-success">
                                                                                <i class="icon-bell"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="cont-col2">
                                                                            <div class="desc">
                                                                                New user registered
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col2">
                                                                    <div class="date">
                                                                        Just now
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <div class="col1">
                                                                    <div class="cont">
                                                                        <div class="cont-col1">
                                                                            <div class="label label-success">
                                                                                <i class="icon-bell"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="cont-col2">
                                                                            <div class="desc">
                                                                                New user registered
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col2">
                                                                    <div class="date">
                                                                        Just now
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <div class="col1">
                                                                    <div class="cont">
                                                                        <div class="cont-col1">
                                                                            <div class="label label-success">
                                                                                <i class="icon-bell"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="cont-col2">
                                                                            <div class="desc">
                                                                                New user registered
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col2">
                                                                    <div class="date">
                                                                        Just now
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <div class="col1">
                                                                    <div class="cont">
                                                                        <div class="cont-col1">
                                                                            <div class="label label-success">
                                                                                <i class="icon-bell"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="cont-col2">
                                                                            <div class="desc">
                                                                                New user registered
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col2">
                                                                    <div class="date">
                                                                        Just now
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab_1_3">
                                                <div class="scroller" data-height="290px" data-always-visible="1" data-rail-visible1="1">
                                                    <div class="row-fluid">
                                                        <div class="span6 user-info">
                                                            <img alt="" src="{{ asset('public/assets/img/avatar.png') }}" />
                                                            <div class="details">
                                                                <div>
                                                                    <a href="#">Robert Nilson</a>
                                                                    <span class="label label-success">Approved</span>
                                                                </div>
                                                                <div>29 Jan 2013 10:45AM</div>
                                                            </div>
                                                        </div>
                                                        <div class="span6 user-info">
                                                            <img alt="" src="{{ asset('public/assets/img/avatar.png') }}" />
                                                            <div class="details">
                                                                <div>
                                                                    <a href="#">Lisa Miller</a>
                                                                    <span class="label label-info">Pending</span>
                                                                </div>
                                                                <div>19 Jan 2013 10:45AM</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row-fluid">
                                                        <div class="span6 user-info">
                                                            <img alt="" src="{{ asset('public/assets/img/avatar.png') }}" />
                                                            <div class="details">
                                                                <div>
                                                                    <a href="#">Eric Kim</a>
                                                                    <span class="label label-info">Pending</span>
                                                                </div>
                                                                <div>19 Jan 2013 12:45PM</div>
                                                            </div>
                                                        </div>
                                                        <div class="span6 user-info">
                                                            <img alt="" src="{{ asset('public/assets/img/avatar.png') }}" />
                                                            <div class="details">
                                                                <div>
                                                                    <a href="#">Lisa Miller</a>
                                                                    <span class="label label-important">In progress</span>
                                                                </div>
                                                                <div>19 Jan 2013 11:55PM</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row-fluid">
                                                        <div class="span6 user-info">
                                                            <img alt="" src="{{ asset('public/assets/img/avatar.png') }}" />
                                                            <div class="details">
                                                                <div>
                                                                    <a href="#">Eric Kim</a>
                                                                    <span class="label label-info">Pending</span>
                                                                </div>
                                                                <div>19 Jan 2013 12:45PM</div>
                                                            </div>
                                                        </div>
                                                        <div class="span6 user-info">
                                                            <img alt="" src="{{ asset('public/assets/img/avatar.png') }}" />
                                                            <div class="details">
                                                                <div>
                                                                    <a href="#">Lisa Miller</a>
                                                                    <span class="label label-important">In progress</span>
                                                                </div>
                                                                <div>19 Jan 2013 11:55PM</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row-fluid">
                                                        <div class="span6 user-info">
                                                            <img alt="" src="{{ asset('public/assets/img/avatar.png') }}" />
                                                            <div class="details">
                                                                <div><a href="#">Eric Kim</a> <span class="label label-info">Pending</span>
                                                                </div>
                                                                <div>19 Jan 2013 12:45PM</div>
                                                            </div>
                                                        </div>
                                                        <div class="span6 user-info">
                                                            <img alt="" src="{{ asset('public/assets/img/avatar.png') }}" />
                                                            <div class="details">
                                                                <div>
                                                                    <a href="#">Lisa Miller</a>
                                                                    <span class="label label-important">In progress</span>
                                                                </div>
                                                                <div>19 Jan 2013 11:55PM</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row-fluid">
                                                        <div class="span6 user-info">
                                                            <img alt="" src="{{ asset('public/assets/img/avatar.png') }}" />
                                                            <div class="details">
                                                                <div><a href="#">Eric Kim</a> <span class="label label-info">Pending</span>
                                                                </div>
                                                                <div>19 Jan 2013 12:45PM</div>
                                                            </div>
                                                        </div>
                                                        <div class="span6 user-info">
                                                            <img alt="" src="{{ asset('public/assets/img/avatar.png') }}" />
                                                            <div class="details">
                                                                <div>
                                                                    <a href="#">Lisa Miller</a>
                                                                    <span class="label label-important">In progress</span>
                                                                </div>
                                                                <div>19 Jan 2013 11:55PM</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row-fluid">
                                                        <div class="span6 user-info">
                                                            <img alt="" src="{{ asset('public/assets/img/avatar.png') }}" />
                                                            <div class="details">
                                                                <div>
                                                                    <a href="#">Eric Kim</a>
                                                                    <span class="label label-info">Pending</span>
                                                                </div>
                                                                <div>19 Jan 2013 12:45PM</div>
                                                            </div>
                                                        </div>
                                                        <div class="span6 user-info">
                                                            <img alt="" src="{{ asset('public/assets/img/avatar.png') }}" />
                                                            <div class="details">
                                                                <div>
                                                                    <a href="#">Lisa Miller</a>
                                                                    <span class="label label-important">In progress</span>
                                                                </div>
                                                                <div>19 Jan 2013 11:55PM</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--END TABS-->
                                </div>
                            </div>
                            <!-- END PORTLET-->
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row-fluid">
                        <div class="span6">
                            <!-- BEGIN PORTLET-->
                            <div class="portlet box blue calendar">
                                <div class="portlet-title">
                                    <h4><i class="icon-calendar"></i>Calendar</h4>
                                </div>
                                <div class="portlet-body light-grey">
                                    <div id="calendar">
                                    </div>
                                </div>
                            </div>
                            <!-- END PORTLET-->
                        </div>
                        <div class="span6">
                            <!-- BEGIN PORTLET-->
                            <div class="portlet">
                                <div class="portlet-title line">
                                    <h4><i class="icon-comments"></i>Chats</h4>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"></a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"></a>
                                        <a href="javascript:;" class="reload"></a>
                                        <a href="javascript:;" class="remove"></a>
                                    </div>
                                </div>
                                <div class="portlet-body" id="chats">
                                    <div class="scroller" data-height="343px" data-always-visible="1" data-rail-visible1="1">
                                        <ul class="chats">
                                            <li class="in">
                                                <img class="avatar" alt="" src="{{ asset('public/assets/img/avatar1.jpg') }}" />
                                                <div class="message">
                                                    <span class="arrow"></span>
                                                    <a href="#" class="name">Bob Nilson</a>
                                                    <span class="datetime">at Jul 25, 2012 11:09</span>
													<span class="body">
													Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
													</span>
                                                </div>
                                            </li>
                                            <li class="out">
                                                <img class="avatar" alt="" src="{{ asset('public/assets/img/avatar2.jpg') }}" />
                                                <div class="message">
                                                    <span class="arrow"></span>
                                                    <a href="#" class="name">Lisa Wong</a>
                                                    <span class="datetime">at Jul 25, 2012 11:09</span>
													<span class="body">
													Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
													</span>
                                                </div>
                                            </li>
                                            <li class="in">
                                                <img class="avatar" alt="" src="{{ asset('public/assets/img/avatar2.jpg') }}" />
                                                <div class="message">
                                                    <span class="arrow"></span>
                                                    <a href="#" class="name">Bob Nilson</a>
                                                    <span class="datetime">at Jul 25, 2012 11:09</span>
													<span class="body">
													Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
													</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="chat-form">
                                        <div class="input-cont">
                                            <input class="m-wrap" type="text" placeholder="Type a message here..." />
                                        </div>
                                        <div class="btn-cont">
                                            <span class="arrow"></span>
                                            <a href="javascript:;" class="btn blue icn-only"><i class="icon-ok icon-white"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END PORTLET-->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTAINER-->
        </div>
        <!-- END PAGE -->
    </div>
    <!-- END CONTAINER -->


@endsection
