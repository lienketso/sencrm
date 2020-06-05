<html>
<body>
<table cellpadding="2">

    <tr> <td>Xin chào <span style="font-weight:bold;">{{$name}}</span></td></tr>
    <tr><td>Bạn đã đặt hàng thành công tại website autolight.vn, đây là thông tin đơn hàng của bạn, chúng tôi sẽ xác nhận và liên hệ đến quý khách hàng sớm nhất, cảm ơn quý khách đã quan tâm đến sản phẩm, dịch vụ tại Autolight .</td></tr>
    <tr><td>Người mua hàng : <span style="font-weight:bold;">{{$name}}</span></td></tr>
    <tr><td>Email : <span style="font-weight:bold;">{{$email}}</span></td></tr>
    <tr><td>Số điện thoại : <span style="font-weight:bold;">{{$phone}}</span></td></tr>
    <tr><td>Địa chỉ nhận hàng : <span style="font-weight:bold;">{{$address}}</span></td></tr>

    <tr><td>
            <table rules="all" style="border:solid 1px #ccc; background-color:#F2F2F2;" cellpadding="10" cellspacing="1">
                <tr>
                    <td>Sản phẩm</td>
                    <td>Đơn giá</td>
                    <td>Số lượng</td>
                    <td>Thành tiền</td>
                </tr>
                @foreach($orderData as $d)
                <tr>
                    <td>{{$d->getProduct->name}}</td>
                    <td>{{number_format($d->getProduct->price)}} VND</td>
                    <td>{{$d->qty}}</td>
                    <td>{{number_format($d->amount)}} VND</td>
                </tr>
                    @endforeach
                <tr>
                    <td colspan="3">Tổng tiền</td>
                    <td><strong> {{number_format($amount)}} VNĐ </strong></td>
                </tr>
            </table>
        </td></tr>
    <tr><td>Đặt hàng lúc : {{datetoformat_full($order_at)}}</td></tr>
    <tr><td>Hình thức thanh toán : {{$payment_type}} </td></tr>
    <tr><td>Để được hỗ trợ thêm vui lòng liên hệ : (+84)97 97 60287</td></tr>
    <tr><td><span style="font-weight:bold;">Cảm ơn quý khách !</span></td></tr>
    </tr>
</table>
</body>
</html>