@extends('nqadmin-dashboard::master')
@section('content')

<div class="wrapper-content">
	<div class="container">
		<div class="row  align-items-center justify-content-between">
			<div class="col-11 col-sm-12 page-title">
				<h3>Dashboard</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 col-lg-8 col-xl-4">
				<div class="activity-block success">
					<div class="media">
						<div class="media-body">
							<h5>$ <span>20</span></h5>
							<p>Month Profit</p>
						</div>
						<i class="fa fa-cubes"></i> </div>
					<br>

					<div class="row">
						<div class="progress ">
							<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"><span class="trackerball"></span></div>
						</div>
					</div>
					<i class="bg-icon text-center fa fa-cubes"></i> </div>
			</div>

            <div class="col-md-8 col-lg-8 col-xl-4">
                <div class="activity-block danger">
                    <div class="media">
                        <div class="media-body">
                            <h5><span class="spincreament">50</span></h5>
                            <p>Active Users in month</p>
                        </div>
                        <i class="fa fa-users"></i> </div>
                    <br>

                    <div class="row">
                        <div class="progress ">
                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"><span class="trackerball"></span></div>
                        </div>
                    </div>
                    <i class="bg-icon text-center fa fa-users"></i> </div>
            </div>
            <div class="col-md-8 col-lg-8 col-xl-4">
                <div class="activity-block warning">
                    <div class="media">
                        <div class="media-body">
                            <h5><span class="spincreament">1000</span></h5>
                            <p>Total Orders in month</p>
                        </div>
                        <i class="fa fa-cart-arrow-down"></i> </div>
                    <br>

                    <div class="row">
                        <div class="progress ">
                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 45%;"><span class="trackerball"></span></div>
                        </div>
                    </div>
                    <i class="bg-icon text-center fa fa-cart-arrow-down"></i> </div>
            </div>
            <div class="col-md-8 col-lg-8 col-xl-4">
                <div class="activity-block primary">
                    <div class="media">
                        <div class="media-body">
                            <h5><span class="spincreament">6000</span></h5>
                            <p>Total Contacts in month</p>
                        </div>
                        <i class="fa fa-envelope"></i> </div>
                    <br>

                    <div class="row">
                        <div class="progress ">
                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"><span class="trackerball"></span></div>
                        </div>
                    </div>
                    <i class="bg-icon text-center fa fa-envelope"></i> </div>
            </div>
		</div>

		<div class="row">
			<div class="col-md-16">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title  pull-left">Revenue <small> by months in {{intval(date("Y"))}} </small></h5>
					</div>
					<div class="card-body">
                        <canvas id="bar-single" height="300"></canvas>
					</div>
					<div class="card-footer"></div>
				</div>
			</div>
		</div>
	</div>
	<footer class="footer-content ">
		<div class="container ">
			<div class="row align-items-center justify-content-between">
				<div class="col-md-16 col-lg-8 col-xl-8">This template is designed by Alusoft</div>
			</div>
		</div>
	</footer>
</div>

@endsection

@section('js')
<!-- Morris Charts JavaScript -->
<script src="{{asset('adminux/vendor/Chart.js/Chart.min.js')}}"></script>
<script type="text/javascript">

    /**
     Template Name: Ubold Dashboard
     Author: CoderThemes
     Email: coderthemes@gmail.com
     File: Chartjs
     */

    !function($) {
        "use strict";

        var ChartJs = function() {};

        ChartJs.prototype.respChart = function respChart(selector,type,data, options) {
            // get selector by context
            var ctx = selector.get(0).getContext("2d");
            // pointing parent container to make chart js inherit its width
            var container = $(selector).parent();

            // enable resizing matter
            $(window).resize( generateChart );

            // this function produce the responsive Chart JS
            function generateChart(){
                // make chart width fit with its container
                var ww = selector.attr('width', $(container).width() );
                switch(type){
                    case 'Line':
                        new Chart(ctx).Line(data, options);
                        break;
                    case 'Doughnut':
                        new Chart(ctx).Doughnut(data, options);
                        break;
                    case 'Pie':
                        new Chart(ctx).Pie(data, options);
                        break;
                    case 'Bar':
                        new Chart(ctx).Bar(data, options);
                        break;
                    case 'Radar':
                        new Chart(ctx).Radar(data, options);
                        break;
                    case 'PolarArea':
                        new Chart(ctx).PolarArea(data, options);
                        break;
                }
                // Initiate new chart or Redraw

            };
            // run function - render chart at first load
            generateChart();
        },
            //init
            ChartJs.prototype.init = function() {
                //creating lineChart

                //barchart-Single
                var BarChartSingle = {
                    labels : ["January","February","March","April","May","June","July","August","September","October","November","December"],
                    datasets : [
                        {
                            fillColor: '#ebeff2',
                            strokeColor: '#ebeff2',
                            highlightFill: '#5fbeaa',
                            highlightStroke: '#ebeff2',
                            data : [

                            ]
                        }
                    ]
                }
                this.respChart($("#bar-single"),'Bar',BarChartSingle);

            },
            $.ChartJs = new ChartJs, $.ChartJs.Constructor = ChartJs
    }(window.jQuery),

    jQuery(document).ready(function($) {
        //initializing
        setTimeout(function () {
            $.ChartJs.init()
        }, 1500)

    })
</script>

<script type="text/javascript" src="{{ asset('adminux/js/dashboard.js') }}"></script>
@endsection