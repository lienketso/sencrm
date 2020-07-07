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

    public function getIndex(){
        $data = $this->lt->scopeQuery(function ($e){
            return $e->orderBy('created_at','desc')->where('status',1);
        })
            ->paginate(10);
        return view('nqadmin-product::index',['data'=>$data]);
    }
    public function getCreate(){
        return view('nqadmin-product::create');
    }
    public function postCreate(ProductValidate $request){
        $input = $request->except(['_token']);
        try{
        $product = $this->lt->create($input);
        }catch (\Exception $e){
            return $e->getMessage();
        }
        return redirect()->route('nqadmin::product.index.get')->with(FlashMessage::returnMessage('create'));
    }
    public function getEdit($id){

        //danh sách gói
        $listPackage = $this->pa->orderBy('is_order','asc')->findWhere(['status'=>1])->all();

        $data = $this->lt->find($id);
        if(empty($data)){
            return redirect()->route('nqadmin::product.index.get')->with(['message'=>'No database !']);
        }
        return view('nqadmin-product::edit', ['data'=>$data,'listPackage'=>$listPackage]);
    }
    public function postEdit($id, ProductValidate $request){
        $input = $request->except(['_token']);

        try{
            //edit product
            $listen = $this->lt->update($input,$id);
            //sync product_package
            $this->lt->sync($id,'getPackage',$request->package_id);
        }catch (\Exception $e){
            return $e->getMessage();
        }

        return redirect()->route('nqadmin::product.index.get')->with(FlashMessage::returnMessage('create'));
    }
    public function getDelete($id){
        return getDelete($id,$this->lt);
    }

}