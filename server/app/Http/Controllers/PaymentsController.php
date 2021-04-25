<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;

class PaymentsController extends Controller
{
    public function payment(Request $request)
    {
        if (Auth::check() && Auth::user()->role === 'member') {
            try {
                Stripe::setApiKey(env('STRIPE_SECRET'));

                $customer = Customer::create(array(
                    'email' => $request->stripeEmail,
                    'source' => $request->stripeToken
                ));

                $charge = Charge::create(array(
                    'customer' => $customer->id,
                    'amount' => 1000,
                    'currency' => 'jpy'
                ));

                $user = Auth::user();
                $user->role = 'premium';
                $user->save();

                return redirect()->back()
                    ->with('status', '有料会員に加入しました!');
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }
    }

    public function complete()
    {
        return view('complete');
    }
}
