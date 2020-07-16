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
                    <p>Danh sách các gói sản phẩm tại Sen Đất Việt</p>
                </div>
            </div>
            <div class="row">
                @foreach($listPackage  as $row)
                <div class="col-md-8 col-sm-16 col-lg-8 col-xl-4">
                    <div class="card product">
                        <figure class="product_img  align-items-center justify-content-between d-flex">
                            <a href="{{route('nqadmin::shoping.detail.get',['id'=>$row->id])}}">
                                <img class="" src="{{ asset('adminux/img/package.png') }}">
                            </a>
                        </figure>
                        <div class="card-body"> <a href="#">
                                <h5 class="card-title ">{{ $row->name }}</h5>
                            </a>
                            <h3 class="price-package">{{ number_format($row->price) }} đ</h3>
                            <p class="card-text">{{ $row->description }}</p>
                        </div>

                        <div class="card-body justify-content-between d-flex">
                            <a href="#" class="btn btn-primary">Đặt mua gói</a>
                            <a href="{{route('nqadmin::shoping.detail.get',['id'=>$row->id])}}" class="btn btn-link ">Chi tiết gói</a> </div>
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