<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    protected $guarded = [];

    public function getProduct()
    {
        $product = Product::where('id', $this->product_id)->first();
        return $product;
    }
}
