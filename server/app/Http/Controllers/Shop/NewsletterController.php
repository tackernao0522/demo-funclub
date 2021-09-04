<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Newsletter;
use App\Models\ShopNewsletter;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|unique:shop_newsletters',
        ], [
            'email.required' => 'メールアドレスは必須です。',
            'email.unique' => 'このメールアドレスは既に登録されています。'
        ]);

        Newsletter::subscribe($request->email);

        ShopNewsletter::insert([
            'email' => $request->email,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'メールマガジン登録完了しました。',
            'alert-type' => 'success',
        );

        return redirect()->back()
            ->with($notification);
    }
}
