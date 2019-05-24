<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *展示页面
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        echo "index";

        $query=request()->all();
//        dd($query);
        $where=[];
        if($query['goods_name']??''){
            $where[]=['goods_name','like',"%$query[goods_name]%"];
        }
        if($query['brand_id']??''){
            $where['brand_id']=$query['brand_id'];
        }
        $pageSize=config('app.pageSize');
        $res=Db::table('goods')->where($where)->paginate($pageSize);
//          dd($res);
        return view('goods/index',['res'=>$res,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('goods/add');
    }

    /**
     * Store a newly created resource in storage.
     *添加执行
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=request()->except('_token');

         //第一种验证方式
         $validatedData = $request->validate([
              'goods_name' => 'required',
              'goods_price' => 'required',
              'goods_number' => 'required',
              'goods_file' => 'required',

         ],[
              'goods_name.required' => '商品名称必填',
              'goods_price.required' => '商品价格必填',
              'goods_number.required' => '商品数量必填',
              'goods_file.required' => '商品图片必填',

         ]);


           //判断文件在请求中是否存在
        if($request->hasFile('goods_img')){
            $res=$this->uploads('goods_img');
            if($res){
                $data['goods_file']=$res['imgurl'];
            }
        }

//        dd($data);
            $ress=DB::table('Goods')->insert($data);
//            dd($res);
            if($ress){
                //return redirect('goods/index');
                return ['code'=>1];
            }

    }

    public function uploads($file)
    {
        //验证文件是否上传成功
        if(request()->file($file)->isvalid()){
            $photo=request()->file($file);
//             return ($photo);
//            $extension = $photo->extension();
            $store_result=$photo->store(date('Ymd'));
//            dd($store_result);
            return ['code'=>1,'imgurl'=>$store_result];
        }else{
            return ['code'=>0,'message'=>'文件上传失败'];
        }
    }

    /**
     * Display the specified resource.
     *详情页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo "show";
    }

    /**
     * Show the form for editing the specified resource.
     *修改
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        echo "edit";
    }

    /**
     * Update the specified resource in storage.
     *修改执行
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        echo "update";
    }

    /**
     * Remove the specified resource from storage.
     *删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        echo "del";
    }
}
