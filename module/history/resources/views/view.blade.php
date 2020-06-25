@extends('nqadmin-dashboard::master')

@section('content')
    <div class="wrapper-content">
        <div class="container">
            <div class="row  align-items-center justify-content-between">
                <div class="col-11 col-sm-12 page-title">
                    <h3><i class="fa fa-sitemap "></i> Lịch sử</h3>
                    <p>Chi tiết lịch sử</p>
                </div>
            </div>
            <div class="list-logs">
                @php
                    $decodeData = json_decode($data->request_data);
                @endphp
                @foreach($decodeData as $key=>$val)
                    <p><span>{{$key}}</span> : {{ $val }}</p>
                @endforeach
            </div>

        </div>
    </div>
@endsection