<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class LoginController extends Controller
{
    //登录视图层
    public function index()
    {
        return view('index/login/index');
    }

    //执行登录
    public function loginDo()
    {
        $data=request()->except('_token');
        //dd($data);
        //$r_pwd=request()->r_pwd;
        $email=request()->email;

        $res=DB::table('register')->where('email',$email)->first();
        //dd($res);
        if(!$res){
            return redirect('/login/index');
        }
            $r_pwd=md5($data['r_pwd']);
            $res1=DB::table('register')->where('r_pwd',$r_pwd)->first();
            //dd($res1);
            if($res1){
                session(['r_id'=>$res->r_id]);
                echo json_encode(['font'=>'登录成功','code'=>1]);
            }else{
                echo json_encode(['font'=>'登录失败','code'=>0]);die;
            }
    }

    //退出
    public function loginOut()
    {
        //清除
        session('r_id',null);
        return redirect('/Login/index');
    }



}
