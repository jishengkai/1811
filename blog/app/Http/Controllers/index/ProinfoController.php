<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class ProinfoController extends Controller
{
    //商品展示
    public function index()
    {
        $res=DB::table('goods')->get();
        //dd($res);
        return view('index/proinfo/index',['res'=>$res]);
    }

    //商品详情
    public function detail($goods_id)
    {
        //dd($goods_id);
        $res=cache('res_'.$goods_id);
        $data=cache('data_'.$goods_id);
        //dd($res);
        if(!$res){
            echo 123456;
            $res=DB::table('goods')->where('goods_id',$goods_id)->first();
            cache(['res_'.$goods_id=>$res],0.1);
            //dd($data);
            //dd($res);
        }
        if(!$data){
            //echo 654321;
            $data=DB::table('pinglun')->orderBy('created_at','desc')->get();
            cache(['data_'.$goods_id=>$data],0.1);
        }

        return view('index/proinfo/detail',['res'=>$res,'data'=>$data]);
    }

    //商品评论
    public function pingLun(){
        $data=request()->all();
        //dd($data);
        $data['created_at']=time();
        $res=DB::table('pinglun')->orderBy('created_at','desc')->insert($data);
        //dd($res);
        if($res){
            echo json_encode(['font'=>'提交评论成功','code'=>1]);
        }else{
            echo json_encode(['font'=>'提交评论失败','code'=>0]);
        }
    }


}
