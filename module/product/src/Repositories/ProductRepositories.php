<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 8/29/2018
 * Time: 11:24 AM
 */

namespace Product\Repositories;

use Product\Model\Product;
use Prettus\Repository\Eloquent\BaseRepository;

class ProductRepositories extends BaseRepository
{
    public function model()
    {
        return Product::class;
    }

    /**
     * @param $limit
     * @return mixed
     */
    public function getProductNew($limit = null)
    {
        $language = \Session::get('lang',config('app.locale'));
        return $this->orderBy('id', 'desc')->scopeQuery(function ($q) use ($limit,$language) {
            $query = $q->select('id', 'name', 'slug', 'thumbnail', 'price', 'discount','status','lang_code')
                ->where(['status'=>'new','lang_code'=>$language]);
            if (!empty($limit)) {
                return $query->limit($limit);
            } else {
                return $query;
            }
        })->all();
    }

    public function getProductSale($limit=null){
        $language = \Session::get('lang',config('app.locale'));
        return $this->orderBy('id','desc')->scopeQuery(function($e) use($limit,$language){
            $query = $e->select('id','name','slug','thumbnail','price','discount','status','lang_code')
                ->where(['status'=>'hot','lang_code'=>$language]);
            if(!empty($limit)){
                return $query->limit($limit);
            }else{
                return $query;
            }
        })->all();
    }

    public function getProductHotSale($limit){
        $language = \Session::get('lang',config('app.locale'));
        return $this->orderBy('created_at','desc')->scopeQuery(function ($e) use($limit,$language){
            $query = $e->select('id','name','slug','thumbnail','price','discount','status')->where(['status'=>'sale','lang_code'=>$language]);
            if(!empty($limit)){
                return $query->limit($limit);
            }else{
                return $query;
            }
        })->all();
    }

    public function getPopularProduct($limit){
        $language = \Session::get('lang',config('app.locale'));
        try{
            $product = $this->findWhere(['label'=>'yes','status'=>'active','lang_code'=>$language])->take($limit)->all();
            return $product;
        }catch (\Exception $e){
            return $e->getMessage();
        }

    }

    /**
     * @param $slug
     * @return mixed
     */
    public function getListenCategory($slug)
    {
        return $this->findWhere([
            'slug' => $slug,
            'status' => 'active'
        ], ['id', 'name', 'content', 'thumbnail', 'slug'])->first();
    }
}