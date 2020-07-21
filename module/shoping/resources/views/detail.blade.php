@extends('nqadmin-dashboard::master')

@section('js-init')

    <script type="text/javascript">
        $('.product-icon-container').find('a').click(function (event){
            event.preventDefault();
            $.ajax({
                url: $(this).attr('href')
                ,success: function(response) {
                    $('#tonghang').html(response)
                    window.location.reload();
                }
            });
            return false; //for good measure
        });
        //del cart
        $('.btndelCart').find('a').click(function (e) {
            e.preventDefault();
            confirm('Xác nhận xóa [ok] để xóa');
            $.ajax({
                url: $(this).attr('href'),
                success: function (res) {
                    //$('#mesAlert').html(res);
                    console.log(res);
                    window.location.reload();
                }
            });
            return false;
        });
        //update cart
        $('.qtyclss').on('change',function (e) {
            e.preventDefault();
            let _this = $(e.currentTarget);
            let qty = _this.val();
            let id = _this.attr('data-cartid');
            let url = _this.attr('data-url');
            $.ajax({
                url: url,
                data: {id,qty}
            }).done(function(res){
                window.location.reload();
                })
        });
        //confirm order
        $('#btnOrder').on('click',function (e) {
            e.preventDefault();
            let packageid = $('#btnOrder').attr('data-package');
            let url = $('#btnOrder').attr('data-url');
            $.ajax({
                url: url,
                data: {packageid}
            }).done(function (res) {
                $('#messOrder').html(res);
                $('#btnOrder').hide(500);
                $('.qtyclss').attr({
                    'disabled': 'disabled'
                });
            })
        })
    </script>
@endsection

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
                                {!! $data->content !!}


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-16 col-sm-16 col-lg-6 col-xl-6">
                <div class="list-unstyled comment-list" style="">
                    <h4>DANH SÁCH SẢN PHẨM</h4>
                    <p>Danh sách các sản phẩm được triết khấu theo gói</p>
                    @foreach($product as $row)
                        <div class="media">
                        <span class="message_userpic">
                            @if (!empty($row->thumbnail))
                                <img src="{{ asset($row->thumbnail) }}" alt="{{ $row->name }}" class="d-flex">
                            @else
                                <img src="{{ asset('adminux/img/advertise_maxartkiller_ui-ux.png') }}" class="d-flex">
                            @endif
                        </span>
                            <div class="media-body">
                                <h6 class="mt-0 mb-1">{{$row->name}}</h6>
                                <div class="price-pro">
                                    <p>Giá gốc : <span class="giagoc">{{number_format($row->price)}}</span> đ</p>
                                    <p>Giá theo gói : <span class="giaban">{{number_format($row->getPackage->first()->pivot->package_price)}}</span> đ / hộp</p>
                                    <div class="product-icon-container">
                                        <a href="{{route('nqadmin::shoping.add.get',['product_id'=>$row->id,'package_id'=>$data->id])}}" class="btn btn-warning"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i> Chọn sản phẩm</a></div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            <div class="col-md-16 col-sm-16 col-lg-10 col-xl-10">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#information" role="tab">Đơn hàng của bạn</a> </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="information" role="tabpanel">
                        <div id="mesAlert"></div>
                        <table class="table  dataTable no-footer dtr-inline">
                            <tr>
                                <td>TT</td>
                                <td>Sản phẩm</td>
                                <td>Giá</td>
                                <td>Số lượng</td>
                                <td>Thành tiền</td>
                                <td></td>
                            </tr>
                            @if(!empty($cartProduct))
                                @php
                                $i = 1;
                                $totalamount = 0;
                                @endphp
                                @foreach($cartProduct as $row)
                                    @php
                                    $totalamount = $totalamount + ($row->qty*$row->price)
                                    @endphp
                            <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $row->name }}</td>
                                <td>{{ number_format($row->price) }} đ</td>
                            <td>x <input data-url="{{route('nqadmin::shoping.update.get')}}" data-cartid="{{$row->id}}" class="qtyclss" style="width: 40px;" min="1" type="number" name="qty_{{$row->id}}" value="{{ $row->qty }}"></td>
                            <td>{{ number_format($row->qty*$row->price) }} đ</td>
                                <td>
                                    <div class="btndelCart">
                                    <a href="{{route('nqadmin::shoping.del.get',$row->id)}}"><img src="{{asset('adminux/img/del.png')}}"></a>
                                    </div>
                                </td>
                            </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4">Tổng số lượng</td>
                                    <td ><strong>{{ $tongSoluong }} SP</strong></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="5">Tổng tiền</td>
                                    <td ><strong>{{ number_format($totalamount) }} đ</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="6">
                                        <div class="messOrder" id="messOrder"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="4"></td>
                                    <td colspan="2">
                                        @if(!empty($cartProduct) && count($cartProduct)>0)
                                        <div class="card-body justify-content-between">
                                            <button data-url="{{route('nqadmin::shoping.order.get')}}" data-package="{{$data->id}}" id="btnOrder" class="btn btn-lg btn-success">Xác nhận đặt hàng</button>
                                        </div>
                                        @endif
                                    </td>
                                </tr>

                                @endif

                        </table>
                    </div>

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
                        <h5 class="card-title text-white">{{ $row->name }} </h5>
                        <h3>{{ number_format($row->price) }} đ</h3>
                        <p class="card-text">{{ $row->description }}</p>
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