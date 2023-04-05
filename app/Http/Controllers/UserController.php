<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Like;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function GuzzleHttp\Promise\all;

class UserController extends Controller
{
    public function thanks()
    {
        return view('thanks');
    }

    public function mypage()
    {
        $user = Auth::user();
        $reservations = Reservation::where('user_id',$user->id)->get();
        $likes = Like::where('user_id',$user->id)->get();
        return view('mypage',['user' => $user,'reservations' => $reservations,'likes' => $likes]);
    }
}
