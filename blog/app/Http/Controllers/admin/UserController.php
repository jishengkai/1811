<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\User;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query=request()->all();
//        dd($query);
        $where=[];
        if($query['user_name']??''){
            $where[]=['user_name','like',"%$query[user_name]%"];
        }
        $pageSize=config('app.pageSize');
        $data=User::where($where)->paginate($pageSize);

//        dd($data);
        return view('admin/user/index',['data'=>$data,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //echo "add";
        return view('admin/user/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $data=$request->except('_token');
        $data=$request->all();
//        dd($data);
        $validatedData=$request->validate([
            'user_name' => 'required',
            'user_pwd' => 'required',
            'user_repwd' => 'required',

        ],[
            'user_name.required' => '商品名称必填',
            'user_pwd.required' => '商品价格必填',
            'user_repwd.required' => '商品数量必填',

        ]);
        $data['user_pwd']=md5($data['user_pwd']);
        $res=User::create($data);
        //  dd($res);
        if($res){
            echo json_encode(['font'=>'添加成功','code'=>1]);
        }
    }

    /**
     * Display the specified resource.
     *验证唯一性
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unique()
    {
        $user_name=request()->user_name;
        $count = User::where(['user_name'=>$user_name])->count();
        if($count >= 1){
            echo json_encode(['code'=>1]);
        }else{
            echo json_encode(['code'=>0]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        echo "edit";
    }

    /**
     * Update the specified resource in storage.
     *
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        echo "destroy";
    }
}
