<?php


namespace Shoping\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Package\Repositories\PackageRepositories;
use Product\Repositories\ProductRepositories;
use Shoping\Repositories\OrderRepositories;
use Shoping\Repositories\TransactionRepositories;

class ShopingController extends BaseController
{
    protected $pa;
    protected $po;
    protected $ta;
    protected $or;

    public function __construct(PackageRepositories $packageRepositories, ProductRepositories $productRepositories,TransactionRepositories $transactionRepositories, OrderRepositories $orderRepositories)
    {
        $this->pa = $packageRepositories;
        $this->po = $productRepositories;
        $this->ta = $transactionRepositories;
        $this->or = $orderRepositories;
    }

    public function getIndex(){
        $listPackage = $this->pa->orderBy('is_order','asc')->findWhere(['status'=>'active'])->all();
        return view('nqadmin-shoping::index',['listPackage'=>$listPackage]);
    }

    public function getDetail($id){
        $data = $this->pa->find($id);
        $diferencePackage = $this->pa->orderBy('is_order','asc')->scopeQuery(function ($q) use($id){
            return $q->where('id','!=',$id);
        })->all();
        //get product with packet
//        $product = $this->po->whereHas('getPackage',function ($e) use($id){
//            $e->where('package_id','=',$id);
//        })->get();
        $product = $this->po->with(['getPackage'=>function($e) use($id){
            $e->where('package_id',$id);
        }])->get();

        //cart
        $cartProduct = Cart::content();
            $tongTien = 0;
        foreach($cartProduct as $row){
            $tongTien = $tongTien + ($row->qty*$row->price);
        }
        $tongSoluong = Cart::count();
        return view('nqadmin-shoping::detail',['data'=>$data,'diferencePackage'=>$diferencePackage,'product'=>$product,'cartProduct'=>$cartProduct,'tongTien'=>$tongTien,'tongSoluong'=>$tongSoluong]);
    }

    function getAdd($id, Request $request){
        $user = Auth::id();
        $package_id = $request->get('package_id');
        $product = $this->po->with(['getPackage'=>function($e) use($package_id){
            $e->where('package_id',$package_id);
        }])->find($id);
        $cartInfo = [
            'id'=>$product->id,
            'name'=>$product->name,
            'price'=>$product->getPackage->first()->pivot->package_price,
            'options'=>['thumbnail'=>$product->thumbnail],
            'qty'=>1
        ];
        Cart::add($cartInfo);
        $cart = Cart::content();
        $cartTotal = Cart::total();
        $cartCount = Cart::count();
        echo $cartCount;
    }

    function postAdd(Request $request){
        $cart = Cart::content();
        $user = Auth::id();
        $package_id = $request->get('packageid');
        $totalAmount = 0;
        foreach($cart as $item){
            $totalAmount = $totalAmount + ($item->qty*$item->price);
        }
        $data = [
            'user_id'=>$user,
            'package_id'=>$package_id,
            'amount'=>$totalAmount
       ];
        try {
            $tran = $this->ta->create($data);
            foreach ($cart as $row) {
                $subtotal = ($row->qty * $row->price);
                $dataCart = [
                    'transaction_id' => $tran->id,
                    'product_id' => $row->id,
                    'price' => $row->price,
                    'qty' => $row->qty,
                    'amount' => $subtotal
                ];
                $this->or->create($dataCart);
            }
            echo 'Đơn hàng đã được gửi đến Sendatviet ! Chúng tôi sẽ liên hệ sớm nhất';
            Cart::destroy();
        }catch (\Exception $e){
            return $e->getMessage();
        }

    }

    function getUpdate(Request $request){
        $qty = $request->get('qty');
        $id = $request->get('id');
        $cart = Cart::search(function ($key,$val) use($id){
            return $key->id == $id;
        })->first();
        Cart::update($cart->rowId,$qty);

    }

    public function getDel($id){
        $rowId = Cart::search(function($key,$value) use($id){
            return $key->id == $id;
        })->first();
        Cart::remove($rowId->rowId);
        echo 'Đã xóa sản phẩm !';
    }

}