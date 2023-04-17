<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShopRequest;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Reservation;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ShopUserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // $shop = null;
        // $shop = Shop::where('user_id',$user->id)->first();
        $areas = Area::all();
        $genres = Genre::all();
        $reservations = Reservation::where('shop_id',$user->id)->get();
        return view('shop-user.index',['user' => $user,'areas' => $areas,'genres' => $genres,'reservations' => $reservations]); //'shop' => $shop,
    }

    public function shopCreate(ShopRequest $request)
    {
        $form = $request->except('image_url');
        // $path = $request->file('image_url')->store('images');
        $image = $request->file('image_url');
        // $url = '';
        $path = '';
        // if ($image) {
            // $filename = $image->getClientOriginalName();
            // Storage::put('images',$image);
            // $url = Storage::url($image);
            $path = Storage::path($image);
        // };
        $data = array_merge($form,['image_url' => $path]);
        Shop::create($data);
        return redirect('/shop-user');
    }
}
