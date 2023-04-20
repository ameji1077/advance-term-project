<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminUserRequest;
use App\Mail\SendEmail;
use App\Models\ShopUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

    public function sendMail(Request $request)
    {
        $users = User::all();
        $title = $request->title;
        $text = $request->text;
        foreach($users as $user){
        Mail::to($user)->send(new SendEmail($title,$text));
        };
        return back();
    }
}
