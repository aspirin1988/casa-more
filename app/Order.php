<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function addProduct($id, $count)
    {
        $input = [
            'order_id' => $this->id,
            'product_id' => $id,
            'count' => $count,
        ];

        return OrderList::create($input);
    }

    public function getProductList()
    {
        $order_list = OrderList::where('order_id', $this->id)->get();
        foreach ($order_list as $key => $item) {
            $count = $item->count;
            $product = $item->getProduct();
            if($product) {
                $order_list[$key] = $item->getProduct();
                $order_list[$key]->count = $count;
            }
        }

        return $order_list;
    }

    public function getUser()
    {
        return User::where('id', $this->user_id)->first();
    }
}
