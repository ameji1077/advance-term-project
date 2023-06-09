<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminUserRequest;
use App\Mail\SendEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminUserController extends Controller
{
    public function index()
    {
        $shop_users = User::where('user_type',5)->get();
        return view('admin.index',['shop_users' => $shop_users]);
    }

    public function shopUserCreate(AdminUserRequest $request)
    {
        $form = $request->all();
        $form['password'] = Hash::make($form['password']);
        User::create($form);
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
