<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 8/29/2018
 * Time: 11:22 AM
 */

namespace Product\Http\Controllers;
use Base\Supports\FlashMessage;
use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Http\Request;
use Package\Model\Package;
use Package\Repositories\PackageRepositories;
use Product\Repositories\ProductRepositories;
use Product\Http\Requests\ProductValidate;

class ProductController extends BaseController
{
    protected $lt;
    protected $pa;

    public function __construct(ProductRepositories $productRepositories, PackageRepositories $packageRepositories)
    {
        $this->lt = $productRepositories;
        $this->pa = $packageRepositories;
    }

    public function getIndex(Request $request){
        $type = $request->get('type');
        $data = $this->lt->scopeQuery(function ($e) use($type){
            return $e->orderBy('created_at','desc')->where('status',1)->where('type',$type);
        })
            ->paginate(10);
        return view('nqadmin-product::index',['data'=>$data,'type'=>$type]);
    }
    public function getCreate(Request $request){
        $type = $request->get('type');
        $listPackage = $this->pa->findWhere(['status'=>1,'type'=>$type]);
        return view('nqadmin-product::create',['listPackage'=>$listPackage,'type'=>$type]);
    }
    public function postCreate(ProductValidate $request){
        $type = $request->get('type');
        $input = $request->except(['_token']);
        try{
        $product = $this->lt->create($input);
        $price = $request->package_price;
        $package = $request->package_id;
            $syncData = array();
            foreach($package as $key => $val){
                $syncData[$val] = array('package_price' => $price[$key]);
            }
            $product->getPackage()->sync($syncData);
        }catch (\Exception $e){
            return $e->getMessage();
        }
        return redirect()->route('nqadmin::product.index.get',['type'=>$type])->with(FlashMessage::returnMessage('create'));
    }
    public function getEdit($id, Request $request){
        $data = $this->lt->find($id);
        $type = $data->type;
        //danh sách gói
        $listPackage = Package::with(['getProduct'=>function($e) use($id){
            $e->where('product_id',$id);
        }])
            ->orderBy('is_order','asc')
            ->where('status','active')
            ->where('type',$type)
            ->get();
        //dd($listPackage);die;

        if(empty($data)){
            return redirect()->route('nqadmin::product.index.get')->with(['message'=>'No database !']);
        }
        return view('nqadmin-product::edit', ['data'=>$data,'listPackage'=>$listPackage]);
    }
    public function postEdit($id, ProductValidate $request){
        $input = $request->except(['_token']);
        $info = $this->lt->find($id);
        try{
            //edit product
            $product = $this->lt->update($input,$id);
            //sync product_package
           // $product->getPackage()->sync($request->package_id);
            $price = $request->package_price;
            $data = $request->package_id;

            $syncData = array();
            foreach($data as $key => $val){
                $syncData[$val] = array('package_price' => $price[$key]);
            }
            $product->getPackage()->sync($syncData);


        }catch (\Exception $e){
            return $e->getMessage();
        }

        return redirect()->route('nqadmin::product.index.get',['type'=>$info->type])->with(FlashMessage::returnMessage('create'));
    }
    public function getDelete($id){
        return getDelete($id,$this->lt);
    }

}