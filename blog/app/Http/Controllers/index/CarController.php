<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class  CarController extends Controller
{
    //购物车展示
    public function index()
    {
        //判断是否登陆
        $r_id=request()->session()->get('r_id');
        if(empty($r_id)) {
            //未登录
            return ['code'=>2,'font'=>'请登录'];
        }
        //$data=request()->input();
        //dd($data);
        $res=DB::table('cart')->join('goods','goods.goods_id','cart.goods_id')->get();
        //dd($res);
        $count=DB::table('cart')->count();
        //dd($count);
        return view('index/car/index',['res'=>$res,'count'=>$count]);
    }

    //加入购物车
    public function add()
    {
        //接收购买数量和商品id
        $data=request()->input();
        //dd($data);
        $goods_id=$data['goods_id'];
        //dd($goods_id);
        $buy_number=$data['buy_number'];
        //$shop_price=$data['shop_price'];
        //判断是否登陆
        $r_id=request()->session()->get('r_id');
        //dd($r_id);
        if(empty($r_id)) {
            //未登录
            return ['code'=>2,'font'=>'请登录'];
        }
        if(empty($goods_id)){
            echo '商品不能为空';
        }
        $goodsWhere=[
            ['goods_id','=',$goods_id],
            ['is_on_sale','=',1]
        ];
        $goodsInfo=DB::table('goods')->where($goodsWhere)->first();
        //dd($goodsInfo);
        //$r_id=$this->rId();
        $cartWhere=[
            ['goods_id','=',$goods_id],
            ['r_id','=',$r_id],
            ['is_del','=',1]
        ];
        $cartInfo=DB::table('cart')->where($cartWhere)->first();
        //dd($cartInfo);
        if(!empty($cartInfo)){
            //检测库存     累加  修改
            $res=$this->checkGoodsNumber($buy_number,$goods_id,$cartInfo->buy_number);
            if(!$res){
                // echo '库存不足';die;
                echo '库存不足';
            }

            $where=[
                ['goods_id','=',$goods_id]
            ];
            $result=DB::table('cart')->where($where)->update(['buy_number'=>$buy_number+$cartInfo->buy_number]);
            //dd($result);
        }else{
            //检测库存     添加
            $res=$this->checkGoodsNumber($buy_number,$goods_id);
            if(!$res){
                echo '库存不足';
                //fail('库存不足');
            }
            $info=[
                'goods_id'=>$goods_id,
                'buy_number'=>$buy_number,
                //'shop_price'=>$shop_price,
                'r_id'=>$r_id
            ];
            $result=DB::table('cart')->create($info);
            //dd($result);
        }
        if($result){
            // return true;
            //success('加入购物车成功');
            echo json_encode(['font'=>'加入购物车成功','code'=>1]);
        }else{
            // return false;
            //fail('加入购物车失败');
            echo json_encode(['font'=>'加入购物车失败','code'=>0]);
        }

    }

    //检测库存
    public function checkGoodsNumber($buy_number,$goods_id,$already_number=0)
    {
        $num=$buy_number+$already_number;
        $goods_number=DB::table('goods')->where('goods_id',$goods_id)->value('goods_number');
         //echo $num;
         //dd($goods_number);
        if($num>$goods_number){
            return false;
        }else{
            return true;
        }
    }

    //点击加号
    public function num(){
        $data=request()->input();
        $goods_id=$data['goods_id'];
        $buy_number=$data['buy_number']+1;
        //dd($buy_number);
        $r_id=session('r_id');
        $where=[
            ['r_id','=',$r_id],
            ['goods_id','=',$goods_id]
        ];
        dd($buy_number);
        DB::table('cart')->where($where)->update(['buy_number'=>$buy_number]);
    }

    //点击减号
    public function nums(){
        $data=request()->input();
        $goods_id=$data['goods_id'];
        $buy_number=$data['buy_number']-1;
        $r_id=session('r_id');
        $where=[
            ['r_id','=',$r_id],
            ['goods_id','=',$goods_id]
        ];
        DB::table('cart')->where($where)->update(['buy_number'=>$buy_number]);
    }

    //获取总价
    public function price()
    {
        $goods_id=request()->goods_id;
        //dd($goods_id);

        $goods_id=explode(',',$goods_id);
        $r_id=session('r_id');
        $where=[
            ['r_id','=',$r_id]
        ];
        $data=DB::table('cart')
            ->whereIn('cart.goods_id',$goods_id)
            ->where($where)
            ->join('goods', 'cart.goods_id', '=', 'goods.goods_id')
            ->get();
        $price=0;
        foreach($data as $k=>$v){
            $price+=$v->shop_price*$v->buy_number;
        }
        return $price;
    }
}
