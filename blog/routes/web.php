<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//原始页面laravel
//Route::get('/', function () {
//    session(['user_id'=>66]);
//    return view('welcome',['name'=>'凯哥']);
////    return view('welcome',['name'=>'纪胜凯']);
//});
Route::get('/',"index\IndexController@index");

//发送邮件
 Route::get('/form',function(){
 	echo "<form action='/email' method='post'><input type='text' name='email'>".csrf_field()." <button>提交</button></form>";
 });

//发送登录页面
Route::get('/denglu',function(){
    echo "<form action='/logindo' method='post'><input type='text' name='email'><input type='password' name='password'>".csrf_field()." <button>登录</button></form>";
});

 Route::post('email','brandController@sendemail');//发送邮件
 Route::post('logindo','brandController@logindo');//发送登录页面
// Route::get('index','GoodsController@index');
// Route::post('/form',function(){
// 	return request()->name;
// });
// Route::match(['post','get'],'/form', function(){
// 	return request()->name;
// });
// Route::any('/form',function(){
// 	echo request()->name;
// });

// 路由传参
// route::get('form/{id}',function($id){
// 	echo $id;
// });

//路由传多参
// route::get('form/{id}/{name}',function($id,$name){
// 	echo $id;
// 	echo $name;
// });

//正则路由
// route::get('form/{id}',function($id){
// 	echo $id;
// })->where(['id'=>'[0-9]+']);

// route::redirect('/form','/forms',301);

// route::get('/forms',function(){
// 	echo '你好';
// });

//admin后台的前台模块
Route::prefix('/admin')->group(function(){
    Route::get('header',"admin\AdminController@header");
    Route::get('main',"admin\AdminController@main");
    Route::get('left',"admin\AdminController@left");
    Route::get('index',"admin\AdminController@index");
});


//品牌模块
Route::prefix('/brand')->group(function(){
	Route::get('add',"BrandController@create");
	Route::post('doadd',"BrandController@store");
	Route::get('list',"BrandController@index");
	Route::get('edit',"BrandController@edit");
	Route::post('update',"BrandController@update");
	Route::get('del',"BrandController@destroy");
});


//商品模块
Route::prefix('/goods')->group(function(){
    Route::get('add',"GoodsController@create");
    Route::post('doadd',"GoodsController@store");
    Route::get('index',"GoodsController@index");
    Route::get('edit',"GoodsController@edit");
    Route::post('update',"GoodsController@update");
    Route::get('del',"GoodsController@destroy");
});

//用户管理
Route::prefix('/user')->middleware('checkLogin')->group(function(){
    Route::get('add',"admin\UserController@create");
    Route::post('doadd',"admin\UserController@store");
    Route::get('index',"admin\UserController@index");
    Route::get('edit',"admin\UserController@edit");
    Route::any('unique',"admin\UserController@unique");
    Route::post('update',"admin\UserController@update");
    Route::get('del',"admin\UserController@destroy");
});

//文章利用DB数据库操作  功能还是比较全的页面
Route::prefix('/news')->group(function(){
    Route::get('add',"admin\NewsController@create");
    Route::post('doadd',"admin\NewsController@store");
    Route::get('index',"admin\NewsController@index");
    Route::get('edit',"admin\NewsController@edit");
    Route::any('check',"admin\NewsController@check");
    Route::post('update',"admin\NewsController@update");
    Route::post('del',"admin\NewsController@destroy");
    Route::get('detail/{n_id}',"admin\NewsController@detail");
});

//分类利用模型
Route::prefix('/category')->group(function(){
    Route::get('add',"admin\CategoryController@create");
    Route::post('doadd',"admin\CategoryController@store");
    Route::get('index',"admin\CategoryController@index");
    Route::get('edit',"admin\CategoryController@edit");
    Route::any('check',"admin\CategoryController@check");
    Route::post('update',"admin\CategoryController@update");
    Route::post('del',"admin\CategoryController@destroy");
});




//index前台模块
Route::prefix('/index')->group(function(){
    Route::get('header',"index\IndexController@header");
    Route::get('main',"index\IndexController@main");
    Route::get('foot',"index\IndexController@foot");
    Route::get('index',"index\IndexController@index");
});

//商品模型
Route::prefix('/proinfo')->group(function(){
    Route::get('detail/{goods_id}',"index\ProinfoController@detail");
    Route::get('index',"index\ProinfoController@index");
    Route::post('pingLun',"index\ProinfoController@pingLun");
});

//购物车模型
Route::prefix('/car')->group(function(){
    Route::post('add',"index\CarController@add");
    Route::get('index',"index\CarController@index");
    Route::post('num',"index\CarController@num");
    Route::post('nums',"index\CarController@nums");
    Route::post('price',"index\CarController@price");
    Route::post('jiesuan',"index\CarController@jiesuan");
    //Route::get('pay/{goods_id}',"index\CarController@pay");
});

//用户模型
Route::prefix('/users')->group(function(){
    Route::get('add',"index\UsersController@create");
    Route::post('doadd',"index\UsersController@store");
    Route::get('index',"index\UsersController@index");
    Route::get('edit',"index\UsersController@edit");
    Route::any('check',"index\UsersController@check");
    Route::post('update',"index\UsersController@update");
    Route::post('del',"index\UsersController@destroy");
});

//登录模型
Route::prefix('/login')->group(function(){
    Route::post('loginDo',"index\LoginController@loginDo");
    //退出登录
    Route::post('loginOut',"index\LoginController@loginOut");
    //登录页面
    Route::get('index',"index\LoginController@index");
});

//注册模型
Route::prefix('/register')->group(function(){
    //注册添加
    Route::post('add_do',"index\RegisterController@add_do");
    //注册页面
    Route::get('index',"index\RegisterController@index");
    //执行发送页面
    Route::post('sendDo',"index\RegisterController@sendDo");
    //发送邮件
    Route::post('sendEmail',"index\RegisterController@sendEmail");
    //验证唯一性
    Route::post('check',"index\RegisterController@check");
});

// 收货地址
Route::prefix('/address')->group(function(){
    Route::get('lists','index\AddressController@lists');
    Route::get('add','index\AddressController@add');
    // 获取区域
    Route::post('getArea','index\AddressController@getArea');
    //添加收货地址
    Route::post('addressDo','index\AddressController@addressDo');
});

// 确认结算
Route::prefix('/order')->group(function(){
    //订单表
    Route::get('lists','index\OrderController@lists');
    //提交订单
    Route::post('submitOrder','index\OrderController@submitOrder');
    //下单成功
    Route::get('successOrder','index\OrderController@successOrder');
    //电脑端支付
    Route::get('pcpay','index\OrderController@pcpay');
    //同步支付
    Route::get('returnpay','index\OrderController@returnpay');
    //手机端支付
    Route::get('mopay','index\OrderController@mopay');
    //异步支付
    Route::post('notifypay','index\OrderController@notifypay');
});




Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
