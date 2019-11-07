<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = [];

    public function getProducts($count = 10, $exclude =[])
    {
        $result = [];
        $relations = ProdictTagRelation::where('tag_id', $this->id)->where(function ($query) use($exclude){
            if($exclude) {
                $query->whereNotIn('product_id', $exclude);
            }
        })->limit($count)->get();

        foreach ($relations as $key => $relation) {
            $product = $relation->getProduct();
            if ($product && $product->status) {
                $product->child = [];
//            $product->child = $product->getChild();
                $result[] = $product;
            }
        }

        return $result;
    }
}
