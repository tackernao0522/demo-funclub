<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Review;

class ReviewController extends Controller
{
    public function reviewStore(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        // $product = $product->id;

        $validatedData = $request->validate([
            'summary' => 'required',
            'comment' => 'required',
        ], [
            'summary.required' => '概要は必須です。',
            'comment.required' => 'レビュー内容は必須です。',
        ]);

        Review::insert([
            'product_id' => $product->id,
            'user_id' => Auth::id(),
            'summary' => $request->summary,
            'rating' => $request->quality,
            'comment' => $request->comment,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => '管理者の認証待ちです。しばらくお待ちください。',
            'alert-type' => 'success',
        );

        return redirect()->back()
            ->with($notification);
    }

    public function pendingReview()
    {
        if (Auth::check() && Auth::user()->role === 'admin' && Auth::check() && Auth::user()->review === '1') {
            $reviews = Review::where('status', 0)->orderBy('id', 'DESC')->get();

            return view('admin.shop.review.pending_review', compact('reviews'));
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function reviewApprove($id)
    {
        if (Auth::check() && Auth::user()->role === 'admin' && Auth::check() && Auth::user()->review === '1') {
            Review::where('id', $id)->update(['status' => 1]);

            $notification = array(
                'message' => 'レビューを承認しました。',
                'alert-type' => 'success',
            );

            return redirect()->back()
                ->with($notification);
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function publishReview()
    {
        if (Auth::check() && Auth::user()->role === 'admin' && Auth::check() && Auth::user()->review === '1') {
            $reviews = Review::where('status', 1)->orderBy('id', 'DESC')->get();

            return view('admin.shop.review.publish_review', compact('reviews'));
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function deleteReview($id)
    {
        if (Auth::check() && Auth::user()->role === 'admin' && Auth::check() && Auth::user()->review === '1') {
            $review = Review::findOrFail($id);
            $review->delete();

            $notification = array(
                'message' => 'レビューID：' . $review->id . 'を削除しました。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }
}
