@extends('nqadmin-dashboard::master')
@section('js')

    <script type="text/javascript" src="{{asset('assets/jorg-charts/jquery.jOrgChart.js')}}"></script>
    <link type="text/css" href="{{asset('assets/jorg-charts/tree.css')}}" rel="stylesheet">
    <script type="text/javascript" src="{{asset('assets/jorg-charts/tree.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/jquery-kinetic/jquery.kinetic.js')}}"></script>

@endsection
@section('js-init')
    <script type="text/javascript">
        // var $jq = jQuery.noConflict();
        $(document).ready(function () {

            $("#org").jOrgChart({
                chartElement: '#chart',
                dragAndDrop: false,
                slider: true
            });

            $('#chart .cgsnode').tooltip();

            $('#chart').kinetic();
        });
    </script>
@endsection
@section('content')
    <style type="text/css">
        .jOrgChart {
            margin: 10px;
            padding: 20px;
        }

        .jOrgChart .node {
            font-size: 14px;
            background-color: #35363B;
            border-radius: 8px;
            border: 5px solid white;
            color: #F38630;
            -moz-border-radius: 8px;
        }

        .node label {
            font-family: tahoma;
            font-size: 14px;
            line-height: 11px;
            padding-top: 30px;
        }
    </style>
    <div class="wrapper-content">
        <div class="container">
            <div class="row  align-items-center justify-content-between">
                <div class="col-11 col-sm-12 page-title">
                    <h3><i class="fa fa-sitemap "></i> Thành viên nhóm</h3>
                    <p>Danh sách thành viên trong nhóm</p>
                </div>
            </div>
            <div class="personal_contain">
                <ul id="org" style="display:none">
                    <li>
                        <label>{{$user_online->fullname}}</label>
                        {!! $tree !!}
                    </li>
                </ul>


                <div id="chart" style="height:500px;padding-bottom: 80px;" class="orgChart">
                    <div class="zoom">
                        <span class="zoom_control">+</span>

                        <div id="zoom_slider"></div>
                        <span class="zoom_control">-</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection