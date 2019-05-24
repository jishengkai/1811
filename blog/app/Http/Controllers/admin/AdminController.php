<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function header()
    {
        return view('admin/index/header');
    }

    public function main()
    {
        return view('admin/index/main');
    }

    public function left()
    {
        return view('admin/index/left');
    }

    public function index()
    {
        return view('admin/index/index');
    }
}
