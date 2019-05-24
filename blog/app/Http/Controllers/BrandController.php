<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Brand;
use Illuminate\Support\Facades\Auth;//手动认证需要添加这句

class BrandController extends Controller
{
    //发送登录
    public function logindo()
    {
        $email=request()->email;
        $password=request()->password;
        //echo $email;
        //echo $password;
        if( Auth::attempt(['email'=>$email,'password'=>$password])){
        //认证通过
            //dump(Auth::user());
            //dd(Auth::id());
            echo '登录成功';
        }else{
            echo '登录失败';
        }
    }

    //发送邮件
    public function sendemail()
    {
        $email=request()->email;
        $this->send($email);
    }

    public function send($email)
    {
        \Mail::raw('恭喜你中了五百万',function($message)use($email){
           //设置主题
            $message->subject('欢迎注册凯歌有限公司');
            //设置接收方
            $message->to($email);
        });
    }

    /**
     * Display a listing of the resource.
     *展示页面
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //接受搜索条件
        $query=request()->all();
//         dd($query);
            $where=[];
            if($query['name']??''){
                $where[]=['name','like',"%$query[name]%"];
            }
            if($query['url']??''){
                $where['url']=$query['url'];
            }
        //接受分页
        $pageSize=config('app.pageSize');
//            DB::connection()->enableQueryLog();
        $data=DB::table('brand')->where($where)->paginate($pageSize);
//        $logs = DB::getQueryLog();
//        dd($logs);
        // dd($data);
        return view('brand/list',['data'=>$data,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brand/add');
        // echo 'add';
    }

    /**
     * Store a newly created resource in storage.
     *执行添加页面
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //第二种方式验证
        //public function store(\App\Http\Requests\StoreBrandPost $request)
        

        //第三种手动创建方式验证
//        $validator =\Validator::make($request->all(), [
//            'name' => 'required|unique:brand|max:255',
//            'logo' => 'required',
//            'url' => 'required',
//            'desc' => 'required',
//        ]);
//        // dd($validator->fails());
//        if ($validator->fails()) {
//            return redirect('brand/add')->withErrors($validator)
//            ->withInput();
//        }
        

        $data=request()->except('_token');
        // dd($data);
        


        // 第一种验证方式
         $validatedData = $request->validate([
          'name' => 'required|unique:brand|max:255',
          'logo' => 'required',
          'url' => 'required',
          'desc' => 'required',
         ],[
          'name.required' => '品牌名称必填',
          'name.unique' => '品牌名称不能唯一',
          'name.max' => '品牌名称最长为255',
          'logo.required' => '品牌logo必填',
          'url.required' => '品牌地址必填',
          'desc.required' => '品牌介绍必填',
         ]);

        //判断文件在请求中是否存在
        if($request->hasFile('logo')){
            $res=$this->uploads('logo');
            if($res){
                $data['logo']=$res['imgurl'];
            }
        }
        //DB数据库方法添加
        //$res=DB::table('brand')->insert($data);
        //insert方法添加
        //$res=Brand::insert($data);
        //create方法添加
         $data['created_at']=time();
          $res=Brand::create($data);
        //用save方法添加
        // $Brand = new Brand;
        // $Brand->name = $data['name'];
        // $Brand->logo = $data['logo'];
        // $Brand->url = $data['url'];
        // $Brand->desc = $data['desc'];
        // $Brand->save($data);

//          dd($res);
        if($res){
            return redirect('/brand/list');
        }
    }

    public function uploads($file)
    {
        //验证文件是否上传成功
        if(request()->file($file)->isValid()){
            $photo=request()->file($file);
            // dd($photo);
            $store_result = $photo->store(date('Ymd'));
            // $store_result = $photo->storeAs('photo', 'test.jpg');
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
        echo 'show';
    }

    /**
     * Show the form for editing the specified resource.
     *修改页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $id=request()->input('id');
        // dd($id);
        $res=DB::table('brand')->find($id);
        // dd($res);
        return view('/brand/update',['res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *执行修改
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
       
        $data=request()->except(['_token','id']);
        // dd($data);
        $id=request()->post('id');
        $where=[
            ['id','=',$id]
        ];
        $res=Db::table('brand')->where($where)->update($data);
        if($res){
            return redirect('/brand/list');
        }
    }

    /**
     * Remove the specified resource from storage.
     *删除页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        
        $id=request()->input('id');
        // dd($id);
        $res=DB::table('brand')->delete($id);

        if($res){
            return redirect('/brand/list');
        }
    }
}
