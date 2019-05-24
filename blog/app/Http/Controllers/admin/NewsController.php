<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redis;
class NewsController extends Controller
{
    //展示页面及分页搜索
    public function index()
    {
        //分页加搜索条件
        $query=request()->all();
        $page=request()->page??1;
        $where=[];
        if($query['n_name']??''){
            $where[]=['n_name','like',"%$query[n_name]%"];
        }
        if($query['c_name']??''){
            $where['c_name']=$query['c_name'];
        }
        //dd($where);
        $pageSize=config('app.pageSize');
        $n_name=$query['n_name']??'';
        $c_name=$query['c_name']??'';
        $res=DB::table('cates')->get();

        //redis缓存
        //Redis::del('news_'.$n_name.'_'.$c_name.'_'.$page);die;
        $data=Redis::get('news_'.$n_name.'_'.$c_name.'_'.$page);

            if(!$data){
                echo 'redis';
                $data=DB::table('news')->join('cates','cates.c_id','=','news.c_id')->where($where)->paginate($pageSize);
                $data=serialize($data);
                Redis::set('news_'.$n_name.'_'.$c_name.'_'.$page,$data);
            }
            $data=unserialize($data);

        //cache(['index_'.$page=>$data],0.1);
        //print_r(request()->ajax());
        if( request()->ajax()){
            return view('admin/news/ajaxindex',['data'=>$data,'query'=>$query,'res'=>$res]);
        }
        return view('admin/news/index',['data'=>$data,'query'=>$query,'res'=>$res]);

    }

    //添加
    public function create()
    {
        $res=DB::table('cates')->get();
        //dd($res);
        return view('admin/news/add',['res'=>$res]);
    }

    //执行添加
    public function store(Request $request)
    {
        //echo 'doadd';
        $data=request()->except('_token');
        //dd($data);
        $validator =\Validator::make($request->all(), [
            'n_name' => 'required|unique:news',
            'c_id' => 'required',
            'n_zhong' => 'required',
            'n_status' => 'required',
        ],[
            'n_name.required' => '文章名称必填',
            'n_name.unique' => '文章名称已存在',
            'c_id.required' => '文章分类必填',
            'n_zhong.required' => '文章重要性必填',
            'n_status.required' => '是否显示必填',
        ]);
        //dd($validator->fails());
        if ($validator->fails()) {
            return redirect('news/add')->withErrors($validator)
                ->withInput();
        }
        //上传图片
        if($request->hasFile('news_file')){
            $res=$this->uploads('news_file');
            if($res){
                $data['news_file']=$res['imgurl'];
            }
        }

        $data['created_at']=time();
        $res=DB::table('news')->insert($data);
        //dd($res);
        if($res){
            return redirect('/news/index');
        }
    }


    //上传图片
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

    //判断唯一性
    public function check()
    {
        //echo 'check';
        $n_name=request()->n_name;
        if($n_name){
            $where['n_name']=$n_name;
            $count=Db::table('news')->where($where)->count();
        //dd($count);
           return ['code'=>1,'count'=>$count];
        }

    }


     //修改
    public function edit()
    {
        //echo 'edit';
        $c=DB::table('cates')->get()->toArray();
        //调用无限极分类方法
        $c=$this->createTree($c);

        $n_id=request()->input('n_id');
        // dd($n_id);
        $res=DB::table('news')->join('cates','cates.c_id','=','news.c_id')->where('n_id',$n_id)->first();
        return view('admin/news/edit',compact('res','c'));
        //return view('admin/news/edit',['res'=>$res,'c'=>$c]);
    }

    //无限极分类创建方法
    public function createTree($res, $parent_id=0,$level=1)
    {
        if(!$res || !is_array($res) ){
            return false;
        }
        static $newres=[];
        foreach ($res as $k=>$v){
            if($v->parent_id==$parent_id){
                $v->level=$level;
                $newres[]=$v;
                $this->createTree($res,$v->c_id,$level+1);
            }
        }
        return $newres;
    }


     //执行修改
    public function update(request $request)
    {
        //echo 'update';
        $n_id=request()->post('n_id');
        $data=request()->except(['_token','n_id']);

        $validator =\Validator::make($data, [
            'n_name' => ['required',Rule::unique('news')->ignore($n_id,'n_id'),],
            'c_id' => 'required',
            'n_zhong' => 'required',
            'n_status' => 'required',
        ],[
            'n_name.required' => '文章名称必填',
            'n_name.unique' => '文章名称已存在',
            'c_id.required' => '文章分类必填',
            'n_zhong.required' => '文章重要性必填',
            'n_status.required' => '是否显示必填',
        ]);

        //dd($validator->fails());
        if ($validator->fails()) {
            return redirect("news/edit?n_id="."$n_id")->withErrors($validator)
                ->withInput();
        }
        //dd($n_id);

        //上传图片
        if($request->hasFile('news_file')){
            $res=$this->uploads('news_file');
            if($res){
                $data['news_file']=$res['imgurl'];
            }
        }

        $res=DB::table('news')->where('n_id','=',$n_id)->update($data);
      // dd($res);
        if($res){
            return redirect('/news/index');
        }
    }


     //删除
    public function destroy()
    {
       // echo 'del';die;
        $n_id=request()->post();
        $res=DB::table('news')->where('n_id',$n_id)->delete();
       // dd($res);
        if($res){
            echo json_encode(['font'=>'删除成功','code'=>1]);
        }else{
            echo json_encode(['font'=>'删除失败','code'=>0]);
        }
    }

    //详情页面
    public function detail($n_id)
    {
        if(!($id=$n_id)){
            Redis::set('key',$id);
        }else{
            Redis::get('key');
        }
        return view('admin/news/detail');
    }
}
