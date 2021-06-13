<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


use Session;
use Cookie;

class AdminController extends Controller
{
    public function index()
    {
          return view('admin.index');
    }
}
