<?php


namespace Shoping\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Illuminate\Http\Request;
use Package\Repositories\PackageRepositories;
use Product\Repositories\ProductRepositories;

class ShopingController extends BaseController
{
    protected $pa;
    protected $po;

    public function __construct(PackageRepositories $packageRepositories, ProductRepositories $productRepositories)
    {
        $this->pa = $packageRepositories;
        $this->po = $productRepositories;
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

        return view('nqadmin-shoping::detail',['data'=>$data,'diferencePackage'=>$diferencePackage,'product'=>$product]);
    }

}