<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopUserController extends Controller
{
    public function index()
    {
        return view('shop-user.index');
    }
}
