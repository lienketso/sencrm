<?php

namespace Package\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Base\Supports\FlashMessage;
use Illuminate\Http\Request;
use Package\Http\Requests\PackageValidate;
use Package\Repositories\PackageRepositories;

class PackageController extends BaseController
{
    protected $p;
    public function __construct(PackageRepositories $packageRepositories)
    {
        $this->p = $packageRepositories;
    }
    public function getIndex(Request $request){
        $type = $request->get('type');
        $data = $this->p->scopeQuery(function ($e) use($type){
           return $e->orderBy('created_at','desc')->where('type',$type);
        })->paginate(10);
        return view('nqadmin-package::index',['data'=>$data,'type'=>$type]);
    }
    public function getCreate(){
        return view('nqadmin-package::create');
    }
    public function postCreate(PackageValidate $request){
        $input = $request->except(['_token']);
        try{
            $this->p->create($input);
        }catch (\Exception $e){
            return $e->getMessage();
        }
        return redirect()->route('nqadmin::package.index.get')->with(FlashMessage::returnMessage('create'));
    }

    public function getEdit($id){
        $data = $this->p->find($id);
        if(empty($data)){
            return redirect()->route('nqadmin::package.index.get')->with(['message'=>'No database !']);
        }
        return view('nqadmin-package::edit',['data'=>$data]);
    }

    public function postEdit($id,PackageValidate $request){
        $input = $request->except(['_token']);
        try {
            $this->p->update($input,$id);
        }catch (\Exception $e){
            return $e->getMessage();
        }
        return redirect()->back()->with(['message'=>'Cập nhật dữ liệu thành công']);
    }

    public function getDelete($id){
        return getDelete($id,$this->p);
    }

}