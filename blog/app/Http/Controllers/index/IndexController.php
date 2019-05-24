<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res=DB::table('goods')->get();
        $r_id=session('r_id');
        if($r_id){
            $data=DB::table('register')->where('r_id',$r_id)->first();
            $email=$data->email;
        }else{
            $email="请登录";
        }
        return view('index/index/index',['res'=>$res,'email'=>$email]);
    }



}
