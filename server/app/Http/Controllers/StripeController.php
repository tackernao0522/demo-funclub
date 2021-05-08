<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Premium;
use Laravel\Cashier\Cashier;
use Stripe\Stripe;
use Stripe\Charge;
use App\User;

class StripeController extends Controller
{
    public function subscription(Request $request)
    {
        if (Auth::check() && Auth::user()->role === 'member') {
            $user = Auth::user();
            return view('stripe.form', [
                'intent' => $user->createSetupIntent()
            ]);
        } else {
            return redirect()->route('top')
                ->with('status', 'お客様は既にPrmium会員です');
        }
    }

    public function afterpay(Request $request)
    {
        // ログインユーザーを$userとする
        $user = Auth::user();
        if (Auth::check() && Auth::user()->role === 'member') {
            // またStripeの顧客でなければ、新規顧客にする
            $stripeCustomer = $user->createOrGetStripeCustomer();

            // フォーム送信の情報から$paymentMethodを作成する
            $paymentMethod = $request->input('stripePaymentMethod');

            // プランはconfigに設定したbasic_plan_idとする
            $plan = config('services.stripe.basic_plan_id');

            // 上記のプランと支払い方法で、サブスクを新規作成する
            $user->newSubscription('default', $plan)
                ->create($paymentMethod);

            Mail::to(Auth::user()->email)->send(new Premium());

            $user = Auth::user();
            $user->role = 'premium';
            $user->save();
        }

        return redirect()->route('top')
            ->with('status', 'プレミアム会員に加入完了しました');
    }

    public function cancelForm(User $user)
    {
        if (Auth::check() && Auth::user()->role === 'premium') {

            return view('stripe.cancel_form', ['user' => $user]);
        } else {
            return redirect()->route('top')
                ->with('status', 'お客様は既に解約済みです');
        }
    }

    public function cancelSubscription(User $user, Request $request)
    {
        if (Auth::check() && Auth::user()->role === 'premium') {
            $user->subscription('default')->cancelNow();
            $user = Auth::user();
            $user->role = 'member';
            $user->save();
        }
        return redirect()->route('top')
            ->with('status', 'プレミアム会員の解約が完了しました');
    }
}
