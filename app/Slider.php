<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $guarded =[];

    public function getItems()
    {
        $items = SliderItem::where(['slider_id' => $this->id])->get();

        return $items;
    }

    public function getItemsWithPhoto()
    {
        $items = SliderItem::where(['slider_id' => $this->id])->get();

        foreach ($items as $key => $item) {
            $input = [];
            $input['desktop'] = Image::where('id', $item->desktop)->first();
            $input['mobile'] = Image::where('id', $item->mobile)->first();
            $items[$key]->data = $input;
        }

        return $items;
    }
}

