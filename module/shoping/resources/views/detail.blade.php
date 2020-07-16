@extends('nqadmin-dashboard::master')

@section('content')
<div class="wrapper-content">
    <div class="container">
        <div class="row  align-items-center justify-content-between">
            <div class="col-11 col-sm-12 page-title">
                <h3>Chi tiết  <b>{{ $data->name }}</b> </h3>
                <p>Thông tin chi tiết gói sản phẩm tại Sen Đất Việt</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-16">
                <div class="card product ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-16 col-sm-16 col-lg-8 col-xl-8">
                                <div class="img-package m-0">
                                    <img src="{{ asset('adminux/img/package.png') }}">
                                </div>
                            </div>
                            <div class="col-md-16 col-sm-16 col-lg-8 col-xl-8">
                                <h2 class="card-title">{{ $data->name }} </h2>
                                <h3 class="display-4">{{ number_format($data->price) }} </h3>
                                <hr>
                                <p class="card-text">{{ $data->description }}</p>

                                <div class="card-body justify-content-between d-flex pl-0">
                                    <a href="#" class="btn btn-lg btn-success">Đặt hàng</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-16 col-sm-16 col-lg-8 col-xl-8">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#information" role="tab">Thông tin chi tiết gói</a> </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="information" role="tabpanel">
                    {!! $data->content !!}
                    </div>

                </div>
            </div>
            <div class="col-md-16 col-sm-16 col-lg-8 col-xl-8">
                <div class="list-unstyled comment-list" style="">
                    <h4>DANH SÁCH SẢN PHẨM</h4>
                    <p>Danh sách các gói sản phẩm được triết khấu theo gói</p>
                    @foreach($product as $row)
                    <div class="media">
                        <div class="media-body">
                            <h6 class="mt-0 mb-1">{{$row->name}}</h6>
                            <div class="price-pro">
                                <p>Giá gốc : <span class="giagoc">{{number_format($row->price)}}</span> đ</p>
                                <p>Giá theo gói : <span class="giaban">{{number_format($row->getPackage->first()->pivot->package_price)}}</span> đ / hộp</p>
                            </div>
                        </div>
                    </div>
                        @endforeach

                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-md-16">
                <p class="page_subtitles">Gói sản phẩm khác</p>
            </div>
        </div>
        <div class="row">
            @foreach($diferencePackage as $row)
            <div class="col-md-8 col-sm-8 col-lg-8 col-xl-4">
                <div class="card product">

                    <figure class="product_img  align-items-center justify-content-between d-flex">
                        <img class="" src="{{ asset('adminux/img/package.png') }}" alt=""></figure>
                    <div class="card-body">
                        <h5 class="card-title text-white">{{ $data->name }} </h5>
                        <h3>{{ number_format($data->price) }}</h3>
                        <p class="card-text">{{ $data->description }}</p>
                    </div>
                    <div class="card-body justify-content-between d-flex">
                        <a href="#" class="btn btn-primary">Đặt hàng</a>
                        <a href="{{ route('nqadmin::shoping.detail.get',['id'=>$row->id]) }}" class="btn btn-link ">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>

</div>
@endsection