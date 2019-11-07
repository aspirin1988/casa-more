<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderList;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index($page = 1)
    {
        $page--;

        return view('admin.order.index', ['page' => $page]);
    }

    public function getList($page = 1)
    {
        $page--;

        $orders = Order::get();

        foreach ($orders as $key=>$order){
            $orders[$key]->user = $order->getUser();

            $orders[$key]->products = OrderList::where('order_id',$order->id)->get();

            foreach ($orders[$key]->products as $key_ => $value){
                $orders[$key]->products[$key_] = $value->getProduct();
            }
        }

        return response()->json(['list' => $orders]);

    }
}
