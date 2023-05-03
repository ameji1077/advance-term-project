<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Http\Requests\ShopRequest;
use App\Models\Area;
use App\Models\Course;
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
        $shop = null;
        $shop = Shop::where('shop_user_id',$user->id)->first();
        $course = null;
        if ($shop !== null) {
            $course = Course::where('shop_id', $shop->id)->first();
        };
        $areas = Area::all();
        $genres = Genre::all();
        $reservations = Reservation::where('shop_id',$user->id)->get();
        return view('shop-user.index',['user' => $user,'shop' => $shop,'areas' => $areas,'genres' => $genres,'reservations' => $reservations,'course' => $course]);
    }

    public function shopCreate(ShopRequest $request)
    {
        $form = $request->except('image_url');
        $path = '';

        if ($request->hasFile('image_url')) {
            // 画像がアップロードされた場合
            $image = $request->file('image_url');
            $path = Storage::putFile('public/images',$image);
            $url = str_replace('public/', 'storage/', $path);
        } else {
            // デフォルトの画像を使用する場合
            $url = 'storage/images/default.jpg';
        }
        $data = array_merge($form, ['image_url' => $url]);
        Shop::create($data);
        return redirect('/shop-user');
    }

    public function shopUpdate(ShopRequest $request)
    {
        $form = $request->except('image_url');
        $shop = Shop::find($request->id);
        $image_url = $shop->image_url;
        unset($form['_token']);
        if ($request->hasFile('image_url')) {
            if ($image_url !== 'storage/images/default.jpg') {
                $image_url = substr($image_url,15);
                Storage::disk('public')->delete('images/' . $image_url);
            };
            $image = $request->file('image_url');
            $path = Storage::putFile('public/images',$image);
            $url = str_replace('public/', 'storage/', $path);
            $form['image_url'] = $url;
        };
        Shop::where('id', $request->id)->update($form);
        return redirect('/shop-user');
    }

    public function courseCreate(CourseRequest $request)
    {
        $form = $request->all();
        Course::create($form);
        return redirect('/shop-user');
    }

    public function courseUpdate(CourseRequest $request)
    {
        $form = $request->all();
        unset($form['_token']);
        Course::where('shop_id',$request->shop_id)->update($form);
        return redirect('/shop-user');
    }

    public function reservationConfirm($id)
    {
        $reservation = Reservation::find($id);
        return view('shop-user.reservation-detail',['reservation' => $reservation]);
    }
}
