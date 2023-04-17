<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminUserRequest;
use App\Models\ShopUser;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $shop_users = ShopUser::all();
        return view('admin.index',['shop_users' => $shop_users]);
    }

    public function shopUserCreate(AdminUserRequest $request)
    {
        $form = $request->all();
        ShopUser::create($form);
        return redirect('/admin');
    }
}
