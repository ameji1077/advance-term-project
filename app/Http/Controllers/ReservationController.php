<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function reserve(ReservationRequest $request)
    {
        $user = Auth::user();
        $date = $request->date;
        $time = $request->time;
        $start_at = \Carbon\Carbon::createFromFormat('Y-m-d H:i',$date . ' ' . $time);
        $reservation = new Reservation;
        $reservation->user_id = Auth::id();
        $reservation->shop_id = $request->shop_id;
        $reservation->start_at = $start_at;
        $reservation->num_of_users = $request->num_of_users;
        $reservation->course_id = $request->course_id;
        $reservation->save();
        if ($reservation->course_id !== null) {
            session()->put('course_id',$request->course_id);
            return redirect('/pay/' . $reservation->id);
        };
        return view('done',['user' => $user]);
    }

    public function reserveDelete(Request $request)
    {
        Reservation::where('id', $request->shop_id)->delete();
        return back();
    }

    public function reserveUpdate(ReservationRequest $request)
    {
        $date = $request->date;
        $time = $request->time;
        $start_at = \Carbon\Carbon::createFromFormat('Y-m-d H:i', $date . ' ' . $time);
        $num_of_users = $request->num_of_users;
        Reservation::where('id',$request->id)->update(['start_at' => $start_at,'num_of_users' => $num_of_users]);
        return redirect('/mypage');
    }
}
