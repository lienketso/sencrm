@extends('nqadmin-dashboard::master')

@section('content')
    <div class="wrapper-content">
        <div class="container">
            <div class="row  align-items-center justify-content-between">
                <div class="col-11 col-sm-12 page-title">
                    <h3>Đơn hàng</h3>
                    <p>Chi tiết đơn hàng</p>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-16">
                    <div class="card invoice status-danger">
                        <div class="card-header ">
                            <h2 class=" mb-0">Hóa đơn số <small class="pull-right">HD #{{$data->id}}</small> </h2>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-8"> <a class="" href="#">
                                        <h2><span class="fa fa-trophy"></span> Sendatviet</h2>
                                    </a> <br>
                                    <address>
                                        <strong>Người đặt:</strong><br>
                                        {{$data->getUser->fullname}}<br>
                                        Địa chỉ : {{$data->getUser->address}}<br>
                                        Email : {{$data->getUser->email}}<br>
                                        Điện thoại : {{$data->getUser->phone}}
                                    </address>
                                    <br>

                                </div>
                                <div class="col-sm-8 text-right">
                                    <address>
                                        <strong>Ngày đặt :</strong><br>
                                        {{showdate_vn($data->created_at)}}<br>
                                        <p class="text-danger">Trạng thái : {{ ($data->status=='active') ? 'Đã duyệt' : 'Đang xử lý' }}</p>
                                        <br>
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-16">
                                    <h2 class="text-center">Hóa đơn bán hàng</h2>
                                    <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-16">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <td><strong>Sản phẩm</strong></td>
                                                <td class="text-center"><strong>Giá</strong></td>
                                                <td class="text-center"><strong>Số lượng</strong></td>
                                                <td class="text-right"><strong>Thành tiền</strong></td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                            @php
                                            $totalAmount = 0;
                                            @endphp
                                            @foreach($order as $item)
                                                @php
                                                $totalAmount = $totalAmount + ($item->qty*$item->price);
                                                @endphp
                                            <tr>
                                                <td><b>{{$item->getProduct->name}}</b><br>
                                                    {{$item->getProduct->description}}</td>
                                                <td class="text-center">{{number_format($item->price)}} đ</td>
                                                <td class="text-center">{{$item->qty}}</td>
                                                <td class="text-right">{{number_format($item->amount)}} đ</td>
                                            </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-16">
                                    <hr>
                                </div>
                                <div class="col-sm-8"> Thông tin đơn hàng </div>
                                <div class="col-sm-8 text-right"> Tổng tiền<br>
                                    <b>{{number_format($totalAmount)}} đ</b> </div>
                            </div>
                            <br>
                            <br>
                            <br>
                        </div>
                        <div class="card-footer align-items-center justify-content-between d-flex">
                            <button class="btn btn-outline-white pull-right">Quay lại</button>
                            <button class="btn btn-white"><i class="fa fa-print"></i> In đơn hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection