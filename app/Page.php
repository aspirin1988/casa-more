<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $guarded = [];

    public function getThumb()
    {
        $image = Image::where('id', $this->thumb)->first();
        if ($image) {
            $this->thumb_image = $image->image;
        } else {
            $this->thumb_image = '/img/empty.png';
        }

        return $this->thumb_image;
    }

    public function getUrl()
    {
        return $this->slug;
    }
}
