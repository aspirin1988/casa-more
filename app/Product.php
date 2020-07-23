<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    protected $type_ = [
        "0" => 'Не назначен',
        "massage_chairs" => 'Массажные кресла',
        "massagers" => 'Массажеры',
        "fitness_equipment" => 'Фитнес оборудование',
        "household_products" => 'Товары для дома',
        "Massagers_for_legs" => 'Массажеры для ног',
        "Massage_wraps" => 'Массажные накидки',
        "Massage_pillows" => 'Массажные подушки',
    ];

    public function getTags()
    {
        $relation = ProdictTagRelation::where('product_id', $this->id)->get();

        foreach ($relation as $key => $value) {
            $relation[$key]->data = $value->getTag();
        }

        return $relation;
    }

    public function getImage()
    {
        $image = Image::where('object_id', $this->id)->first();

        if ($image) {
            return $image->image;
        } else {
            return null;
        }
    }

    public function getImages()
    {
        return Image::where('object_id', $this->id)->get();
    }

    public function getUrl()
    {
        if ($this->color) {
            return "/{$this->type_of_product}/" . $this->keyword . '/' . $this->color . '/';
        } else {
            return "/{$this->type_of_product}/" . $this->keyword . '/';
        }
    }

    public function getChild()
    {
        $child = Product::where('parent_id', $this->id)->get();
        return $child;
    }

    public function getParent()
    {
        return Product::where('id', $this->parent_id)->first();
    }

    public static function getBestsellers($count = 4)
    {
        $tag = Tag::where('keyword', 'hit')->first();

        $products = [];

        if ($tag) {
            $products = $tag->getProducts($count);
        }

        return $products;
    }

    public static function getNewItems($count = 4)
    {
        $tag = Tag::where('keyword', 'new')->first();

        $products = [];
        if ($tag) {
            $products = $tag->getProducts($count);
        }

        return $products;
    }

    public static function getPromotions($count = 4)
    {
        $products_id =[];
        $tag = Tag::where('keyword', 'discount')->first();

        $relations = ProdictTagRelation::where('tag_id', $tag->id)->get();

        dd($relations);

        foreach ($relations as $relation){
            $products_id[] = $relation->product_id;
        }

        $products = Product::whereIn('id',$products_id)->paginate(20);

        return $products;
    }

    public static function getRecommend($count = 4, $exclude = [])
    {
        $tag = Tag::where('keyword', 'recommended')->first();

        $products = [];

        if ($tag) {
            $products = $tag->getProducts($count, $exclude);
        }

        return $products;
    }

    public function getPrice()
    {
        if ($this->discount) {
            return $this->price - (($this->price / 100) * $this->discount);
        } else {
            return $this->price;
        }
    }

    public function getOldPrice()
    {
        if ($this->discount) {
            return $this->price;
        }
        return  null;
    }

    public static function getPresent($count = 4, $exclude = [])
    {
        $tag = Tag::where('keyword', 'present')->first();

        $products = [];

        if ($tag) {
            $products = $tag->getProducts($count, $exclude);
        }

        return $products;
    }

    public function getType()
    {
        if (isset($this->type_[strtolower($this->type_of_product)])) {
            return $this->type_[strtolower($this->type_of_product)];
        } else {
            return $this->type_[0];
        }
    }

    public function getBackground()
    {
        if ($this->background) {
            $image = Image::where('id', $this->background)->first();
            if ($image) {
                return $image->image;
            } else {
                return null;
            }
        }
        return null;
    }

    public function getBrand()
    {
        return Brand::where('id', $this->brand)->first();
    }

    public function getColors()
    {
        $color = [];

        if (!$this->parent_id) {
            $color[] = $this;
            foreach ($this->getChild() as $item) {
                $color[] = $item;
            }
        } else {
            $parent = $this->getParent();
            $color[] = $parent;
            $child_list = $parent->getChild();
            foreach ($child_list as $item) {
                $color[] = $item;
            }
        }

        return $color;
    }

    public function present()
    {
        $present = Present::where('id', $this->present)->first();

        return $present;
    }

    public function getBrochure()
    {
        if($this->brochure){
            return $this->brochure;
        }else{
            $parent = $this->getParent();
            if($parent){
                return $parent->brochure;
            }else{
                return null;
            }
        }
    }
}
