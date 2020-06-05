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
use Category\Repositories\CategoryRepositories;
use Product\Repositories\ProductRepositories;
use Product\Http\Requests\ProductValidate;

class ProductController extends BaseController
{
    protected $lt;
    protected $cate;

    public function __construct(ProductRepositories $productRepositories, CategoryRepositories $categoryRepositories)
    {
        $this->lt = $productRepositories;
        $this->cate = $categoryRepositories;
    }

    public function getIndex(){
        $language = \Session::get('lang',config('app.locale'));
        $category = $this->cate->orderBy('index','asc')->findWhere(['lang_code'=>$language])->all(['id','name','parent']);
        $data = $this->lt->scopeQuery(function ($e) use($language){
            return $e->orderBy('created_at','desc')->where('lang_code',$language);
        })
            ->paginate(10);

        return view('nqadmin-product::index',['data'=>$data,'category'=>$category]);
    }
    public function getCreate(){
        $language = \Session::get('lang',config('app.locale'));
        $category = $this->cate->orderBy('index','asc')->findWhere(['lang_code'=>$language])->all(['id','name','parent']);
        return view('nqadmin-product::create',['category'=>$category,'lang'=>$language]);
    }
    public function postCreate(ProductValidate $request){
        $input = $request->except(['_token']);
        if($request->gallery){
            $gallery = \GuzzleHttp\json_encode($request->gallery);
            $input['gallery'] = $gallery;
        }
        try{
        $product = $this->lt->create($input);
        }catch (\Exception $e){
            return $e->getMessage();
        }
        return redirect()->route('nqadmin::product.index.get')->with(FlashMessage::returnMessage('create'));
    }
    public function getEdit($id){
        $category = $this->cate->orderBy('index','asc')->all(['id','name','parent']);
        $data = $this->lt->find($id);
        if(empty($data)){
            return redirect()->route('nqadmin::product.index.get')->with(['message'=>'No database !']);
        }
        return view('nqadmin-product::edit', ['data'=>$data,'category'=>$category]);
    }
    public function postEdit($id, ProductValidate $request){
        $input = $request->except(['_token']);
        if($request->gallery){
            $gallery = \GuzzleHttp\json_encode($request->gallery);
            $input['gallery'] = $gallery;
        }

        $listen = $this->lt->update($input,$id);
        return redirect()->route('nqadmin::product.index.get')->with(FlashMessage::returnMessage('create'));
    }
    public function getDelete($id){
        return getDelete($id,$this->lt);
    }

}