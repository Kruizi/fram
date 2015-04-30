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
                        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                        <h3 class="page-title">
                            Статистика вашего сайта
                        </h3>
                        <ul class="breadcrumb">
                            <li>
                                <i class="icon-home"></i>
                                <a href="/">Главная</a>
                                <i class="fa fa-arrow-circle-o-right"></i>
                            </li>
                            <li><a href="#">Статистика сайта: {{$info_clients->web_clients}}</a></li>
                            <li class="pull-right no-text-shadow">
                                <div id="dashboard-report-range" class="dashboard-date-range tooltips no-tooltip-on-touch-device responsive" data-tablet="" data-desktop="tooltips" data-placement="top" data-original-title="Change dashboard date range">
                                    <i class="icon-calendar"></i>
                                    <span></span>
                                    <i class="icon-angle-down"></i>
                                </div>
                            </li>
                        </ul>
                        <div class="row">
                          <div class="col-md-4" style="float: left;"><img src="/public/sceenshots/{{$info_clients->name_clients}}.png" /></div>
                          <table class="table table-hover" style="width:63.6%;float: left;">
                            <thead>
                                <tr>
                                  <th>Сайт доступен ?</th>
                                  <th>Время соединение с сайтом ?</th>
                                  <th>За какое время загрузилась страница ?</th>
                                  <th>Размер страницы ?</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                            <td class="info">@if($dd[0] == 'доступен')<b style="color: green;">Доступен</b>
                                @elseif($dd[0] == 'недоступен')
                                <b style="color: red;">Недоступен</b>@endif</td>
                            <td class="info"><b>{{$dd[1]}} секунд</b></td>
                            <td class="info"><b>{{$dd[2]}} секунд</b></td>
                            <td class="info"><b>{{$format_size}}</b></td>
                                </tr>
                            </tbody>
                          </table>
                          <h3 style="text-align: center;">Доступность сайта</h3>
                          <div class="ct-chart ct-golden-section" style="height: 250px;width: 63.3%;float:left;"></div>
                          <div id="content">
			                 <form class="form-horizontal">
			                     <fieldset>
		                          <div class="input-prepend">
		                              <span class="add-on"><i class="icon-calendar"></i></span>
                                        <input type="text" name="range" id="range" />
		                          </div>
			                     </fieldset>
			                 </form>
                    			<div id="placeholder">
				                    <figure id="chart"></figure>
			                     </div>
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                          </div>
                        </div>
                        <!-- END PAGE TITLE & BREADCRUMB-->
                        
                    </div>
                </div>
                <!-- END PAGE HEADER-->
                
            </div>
            <!-- END PAGE CONTAINER-->
        </div>
        <!-- END PAGE -->
    </div>

		<!-- xcharts includes -->
		<script src="//cdnjs.cloudflare.com/ajax/libs/d3/2.10.0/d3.v2.js"></script>
		<script src="public/assets/js/xcharts.min.js"></script>

		<!-- The daterange picker bootstrap plugin -->
		<script src="public/assets/js/sugar.min.js"></script>
		<script src="public/assets/js/daterangepicker.js"></script>

		<!-- Our main script file -->
		<script src="public/assets/js/script.js"></script>
    <!-- END CONTAINER -->


@endsection
