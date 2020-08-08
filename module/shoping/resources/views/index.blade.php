@extends('nqadmin-dashboard::master')

@section('js')
    @include('nqadmin-dashboard::components.datatables.source')
@endsection

@section('js-init')
    @include('nqadmin-dashboard::components.datatables.init')
@endsection

@section('content')
    <div class="wrapper-content">
        <div class="container">
            <div class="row  align-items-center justify-content-between">
                <div class="col-11 col-sm-12 page-title">
                    <h3>Shoping cart</h3>
                    <p>Danh sách các gói sản phẩm và dịch vụ tại Sen Đất Việt</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-16">
                    <h3>CÁC GÓI SẢN PHẨM</h3>
                </div>
                @foreach($listPackage  as $row)
                <div class="col-md-8 col-sm-16 col-lg-8 col-xl-4">
                    <div class="card product">
                        <figure class="product_img  align-items-center justify-content-between d-flex">
                            <a title="Xem chi tiết hoa hồng gói" href="{{route('nqadmin::shoping.detail.get',['id'=>$row->id])}}">
                                <img title="Xem chi tiết hoa hồng gói" class="" src="{{ asset('adminux/img/package.png') }}">
                            </a>
                        </figure>
                        <div class="card-body"> <a href="#">
                                <h5 class="package-title">{{ $row->name }}</h5>
                            </a>
                            <h3 class="price-package">{{ number_format($row->price) }} đ</h3>
                            <p class="card-text">{{ $row->description }}</p>
                        </div>

                        <div class="card-body justify-content-between d-flex">
                            <a href="{{route('nqadmin::shoping.detail.get',['id'=>$row->id])}}" class="btn btn-primary btnfull">Đặt mua gói</a>
                            </div>
                    </div>
                </div>
                @endforeach
                <div class="col-lg-16">
                    <h3>CÁC GÓI DỊCH VỤ</h3>
                </div>
                @foreach($listService  as $row)
                    <div class="col-md-8 col-sm-16 col-lg-8 col-xl-4">
                        <div class="card product">
                            <figure class="product_img  align-items-center justify-content-between d-flex">
                                <a title="Xem chi tiết hoa hồng gói" href="{{route('nqadmin::shoping.detail.get',['id'=>$row->id])}}">
                                    <img title="Xem chi tiết hoa hồng gói" class="" src="{{ asset('adminux/img/package.png') }}">
                                </a>
                            </figure>
                            <div class="card-body"> <a href="#">
                                    <h5 class="package-title">{{ $row->name }}</h5>
                                </a>
                                <h3 class="price-package">{{ number_format($row->price) }} đ</h3>
                                <p class="card-text">{{ $row->description }}</p>
                            </div>

                            <div class="card-body justify-content-between d-flex">
                                <a href="{{route('nqadmin::shoping.detail.get',['id'=>$row->id])}}" class="btn btn-primary btnfull">Đặt mua gói</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <br>
            <br>
            <br>
        </div>

    </div>
@endsection