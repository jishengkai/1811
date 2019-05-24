<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\admin\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //echo 'index';
        $query=request()->all();
        $where=[];
        if($query['cate_name']??''){
            $where[]=['cate_name','like',"%$query[cate_name]%"];
        }

        $pageSize=config('app.pageSize');
        $data=category::where($where)->paginate($pageSize);
        //dd($data);
        return view('admin/category/index',['data'=>$data,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //echo 'create';
        return view('admin/category/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //echo 'store';
        $data=request()->except('_token');
        //dd($data);
//        $category=new Category;
        $res=category::create($data);
        //dd($res);
        if($res){
            echo json_encode(['font'=>'添加成功','code'=>1]);
        }else{
            echo json_encode(['font'=>'添加失败','code'=>0]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo 'show';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
       // echo 'edit';
        $cate_id=request()->input('cate_id');
        //dd($cate_id);
        $res=category::where('cate_id',$cate_id)->first();
        //dd($res);
        return view('admin/category/edit',['res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //echo 'update';
        $cate_id=request()->post('cate_id');
        $data=request()->except(['_token','n_id']);
        $res=category::where('cate_id',$cate_id)->update($data);
        //dd($res);
        if($res){
            return redirect('/category/index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //echo 'destroy';
        $cate_id=request()->cate_id;
        //dd($data);
        $res=category::where('cate_id',$cate_id)->delete();
        //dd($res);
        if($res){
            echo json_encode(['font'=>'删除成功','code'=>1]);
        }else{
            echo json_encode(['font'=>'删除失败','code'=>0]);
        }
    }
}
