<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Course;
use App\Models\Genre;
use App\Models\Like;
use App\Models\Review;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $shops = Shop::all();
        $areas = Area::all();
        $genres = Genre::all();
        $likes = Like::where('user_id',Auth::id())->get();
        return view('index',['user' => $user,'shops' => $shops,'areas' => $areas,'genres' => $genres,'likes' => $likes]);
    }

    public function search(Request $request)
    {
        $areas = Area::all();
        $genres = Genre::all();
        $likes = Like::all();
        $keyword = $request['name'];
        $area_id = $request['area_id'];
        $genre_id = $request['genre_id'];
        $shops = Shop::doSearch($keyword, $area_id,$genre_id);
        return view('index', ['shops' => $shops,'areas' => $areas,'genres' => $genres,'likes' => $likes]);
    }

    public function detail($shop_id)
    {
        $user = Auth::user();
        $shop = Shop::find($shop_id);
        $course = Course::where('shop_id',$shop_id)->first();
        $reviews = Review::where('shop_id',$shop_id)->get();
        return view('shop-detail',['user' => $user,'shop' => $shop,'course' => $course,'reviews' => $reviews]);
    }

    public function favorite(Request $request)
    {
        $like = new Like;
        $like->shop_id = $request->shop_id;
        $like->user_id = Auth::id();
        $like->save();
        return back();
    }

    public function favoriteDelete(Request $request)
    {
        Like::where('shop_id',$request->shop_id)->delete();
        return back();
    }
}
