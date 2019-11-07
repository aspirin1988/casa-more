<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdictTagRelation extends Model
{
    protected $guarded =[];

    public function getTag()
    {
        $tag = Tag::where('id',$this->tag_id)->first();
        return $tag;
    }

    public function getProduct()
    {
        $product = Product::where('id',$this->product_id)->first();
        return $product;
    }
}
