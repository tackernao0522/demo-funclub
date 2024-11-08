<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DateTime;
use App\Models\Order;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function reportView()
    {
        if (auth()->user()->reports == 1) {

            return view('admin.shop.report.report_view');
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function reportByDate(Request $request)
    {
        if (auth()->user()->reports == 1) {
            $validatedData = $request->validate([
                'date' => 'required',
            ], [
                'date.required' => '年月日を選択して下さい。',
            ]);
            // return $request->all();
            $date = new DateTime($request->date);
            $formatDate = $date->format('Y年n月j日');
            // return $formatDate;
            $orders = Order::where('order_date', $formatDate)->latest()->get();

            return view('admin.shop.report.report_show', compact('orders'));
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function reportByMonth(Request $request)
    {
        if (auth()->user()->reports == 1) {
            $validatedData = $request->validate([
                'year_name' => 'required',
                'month' => 'required',
            ], [
                'year_name.required' => '年を選択して下さい。',
                'month.required' => '月を選択して下さい。',
            ]);

            $orders = Order::where('order_year', $request->year_name)
                ->where('order_month', $request->month)
                ->latest()->get();

            return view('admin.shop.report.report_show', compact('orders'));
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function reportByYear(Request $request)
    {
        if (auth()->user()->reports == 1) {
            $validatedData = $request->validate([
                'year' => 'required',
            ], [
                'year.required' => '年を選択して下さい。',
            ]);

            $orders = Order::where('order_year', $request->year)->latest()->get();

            return view('admin.shop.report.report_show', compact('orders'));
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
