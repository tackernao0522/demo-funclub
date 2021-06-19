<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Cart;
use Session;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function orders(Request $request)
    {
        $query = Order::query();
        // $orders = Order::all();

        if ($request->filled('keyword')) {
            $keyword = '%' . $this->escape($request->input('keyword')) . '%';
            $query->where(function ($query) use ($keyword) {
                // $query->where('payer_id', 'LIKE', $keyword);
                $query->orWhere('name', 'LIKE', $keyword);
                $query->orWhere('status', 'LIKE', $keyword);
            });
        }

        $defaults = [
            'keyword' => $request->input('keyword'),
        ];

        $orders = $query->orderBy('created_at', 'asc')->paginate(20);

        $orders->transform(function ($order, $key) {
            $order->cart = unserialize($order->cart);

            return $order;
        });

        // dd($orders);
        // $orders = $query->orderBy('created_at', 'desc')->get();

        return view('admin.ec.order_list')
            ->with('orders', $orders)
            ->with('defaults', $defaults);
    }

    public function orderEditForm($id)
    {
        Session::put('id', $id);

        $orders = Order::where('id', Session::get('id'))->get();

        foreach ($orders as $order) {
            $payer_id = $order->payer_id;
            $name = $order->name;
            $zip_code = $order->zip_code;
            $address = $order->address;
            $phone_number = $order->phone_number;
            $date = $order->created_at;
        }

        $orders->transform(function ($order, $key) {
            $order->cart = unserialize($order->cart);

            return $order;
        });

        return view(
            'admin.ec.order_edit_form',
            [
                'payer_id' => $payer_id,
                'date' => $date,
                'name' => $name,
                'orders' => $orders,
                'zip_code' => $zip_code,
                'address' => $address,
                'phone_number' => $phone_number,
            ]
        );
    }

    public function EditStatus(Request $request, Order $order)
    {
        $order->status = $request->status;
        $order->save();

        return redirect()->route('item.orders')
            ->with('status', '状態を更新しました。');
    }

    public function destroy(Order $id)
    {
        if ($id->status == '2') {
            $id->delete();

            return redirect()->route('item.orders')
                ->with('status', $id->name . 'さんのリストを削除しました。');
        } else {
            return redirect()->route('item.orders')
                ->with('status', '未発送リストは削除できません。');
        }
    }

    private function escape(string $value)
    {
        return str_replace(
            ['\\', '%', '_'],
            ['\\\\', '\\%', '\\_'],
            $value
        );
    }
}
