<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rubric extends Model
{
    protected $guarded = [];

    public function getUrl()
    {
        return "/{$this->slug}/";
    }

    public function getThumb()
    {
        $this->thumb_image = Image::where('id', $this->thumb)->first();
        return ($this->thumb_image? $this->thumb_image->image: "/img/chairs.png" );

    }
}
