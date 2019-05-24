<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Mail;
use Illuminate\Support\Facades\Cookie;
class RegisterController extends Controller
{

    public function index()
    {
        return view('index/register/index');
    }

    //发送邮箱获取验证码
    public function sendEmail()
    {
        //echo 'sendEmail';
        $email=request()->email;
        //生成随机码
        $code=rand(1000,9999);
        //判断是手机号还是邮箱注册
        if(strpos($email,'@')==false){
            //手机号
            $this->send($email,$code);
            echo json_encode(['code'=>$code,'font'=>'请查看你的短信验证码']);
        }else{
            //邮箱
            $this->sendDo($email,$code);
            echo json_encode(['font'=>'验证码已发送成功,请注意查收','code'=>1]);
        }


    }

    public function sendDo($email,$code)
    {
        \Mail::raw("你的验证码为$code", function ($message) use ($email) {
            //设置主题
            $message->subject("欢迎注册凯歌有限公司");
            //设置接收方
            $message->to($email);
        });
        Cookie::queue("code", "$code",5);
        return ['code'=>$code,'font'=>'验证码已发送'];
    }

   //验证唯一性
    public function check()
    {
        //echo 'check';
        $email=request()->post('email');
        //dd($email);
        $count=Db::table('register')->where('email',$email)->count();
        if($count){
            return ['code'=>1,'count'=>$count];
        }
    }

    //手机号验证
    public function send($mobile,$code)
    {
        //dd($mobile);
        $host = "http://dingxin.market.alicloudapi.com";
        $path = "/dx/sendSms";
        $method = "POST";
        $appcode = "78477519dadc4eadbe0b0aa25e8eacd6";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "mobile=$mobile&param=code%3A$code&tpl_id=TP1711063";
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        Cookie::queue("code", "$code",5);
        return (curl_exec($curl));

    }

    //注册
    public function add_do()
    {
        $data = request()->except('_token');
        //dd($data);
        $telcode=Cookie::get('code');
        if($data['code']!=$telcode){
           echo json_encode(['code'=>2,'font'=>'验证码错误']);die;
        }
        $data=request()->except('code');
        $data['r_pwd']=md5($data['r_pwd']);
        $data['created_at']=time();
        //dd($data);
        $res=DB::table('register')->insert($data);
        //dd($res);
        if($res){
            echo json_encode(['font'=>'注册成功','code'=>1]);
        }else{
            echo json_encode(['font'=>'注册失败','code'=>0]);
        }
    }



}
