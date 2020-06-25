<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderList;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index($method = 'all', $page = 1)
    {
        $page--;

        return view('admin.order.index', ['method' => $method, 'page' => $page]);
    }

    public function getList($method = 'all', $page = 1)
    {
        $page--;

        $status = null;

        switch ($method) {

            case 'all':
                $status = null;
                break;
            case 'new':
                $status = 0;
                break;
            case 'in-process':
                $status = 1;
                break;
            case 'complete':
                $status = 2;
                break;
            case 'reject':
                $status = 3;
                break;
        }

        if ($status !== null) {
            $orders = Order::where('status', $status)->orderBy('id', 'desc')->get();
        } else {
            $orders = Order::orderBy('id', 'desc')->get();
        }


        foreach ($orders as $key => $order) {
            $orders[$key]->user = $order->getUser();

            $orders[$key]->products = OrderList::where('order_id', $order->id)->get();

            foreach ($orders[$key]->products as $key_ => $value) {
                $orders[$key]->products[$key_] = $value->getProduct();
            }
        }

        return response()->json(['list' => $orders]);

    }

    public function update($id, Request $request)
    {
        $status = $request->input('status');

        $result = Order::where('id', $id)->update(['status' => $status]);

        return response()->json(['result' => $result]);

    }
}

