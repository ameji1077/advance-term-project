<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function show($reservation_id)
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        $reservation = Reservation::find($reservation_id);
        $paymentIntent = PaymentIntent::create([
            'amount' => $reservation->course->price * $reservation->num_of_users,
            'currency' => 'jpy',
            'payment_method_types' => ['card'],
            'metadata' => [
                'reservation_id' => $reservation->id,
            ],
        ]);
        $client_secret = $paymentIntent->client_secret;
        $amount = $paymentIntent->amount;
        return view('payment',['reservation' => $reservation,'client_secret' => $client_secret,'amount' => $amount]);
    }

    public function process(Request $request)
    {
        $course_id = session()->get('course_id');
        $reservation = Reservation::where('user_id', Auth::user()->id)
        ->where('course_id', $course_id)
            ->whereNull('paid_at')
            ->where('created_at', '>', Carbon::now()->subMinutes(30))
            ->first();
        if (!empty($reservation)) {
            $reservation->paid_at = Carbon::now();
            $reservation->save();
            session()->forget('course_id');
            Stripe::setApiKey(config('services.stripe.secret'));
            $stripeToken = $request->input('stripeToken');
            $customer = Customer::create([
                'email' => $request->email,
                'source' => $stripeToken,
            ]);
            $charge = Charge::create([
                'customer' => $customer->id,
                'amount' => $request->amount,
                'currency' => 'jpy',
                'description' => 'Example Payment',
            ]);
            return view('success');
        };
        $reservation = Reservation::where('user_id', Auth::user()->id)
        ->where('course_id', $course_id)
        ->whereNull('paid_at')
            ->where('created_at', '<=',
                Carbon::now()->subMinutes(30)
            )
            ->first();
        if (!empty($reservation)) {
            $reservation->delete();
            return view('error');
        }
        return view('error');
    }
}
