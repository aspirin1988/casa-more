<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

class Brand extends Model
{
    protected $guarded = [];

    public static $alphabet = [
        'a',
        'b',
        'c',
        'd',
        'e',
        'f',
        'g',
        'h',
        'i',
        'j',
        'k',
        'l',
        'm',
        'n',
        'o',
        'p',
        'q',
        'r',
        's',
        't',
        'u',
        'v',
        'w',
        'x',
        'y',
        'z',

    ];

    public static function getByAlphabet()
    {
        $result = [];

        foreach (static::$alphabet as $item) {
            $result[$item] = Brand::where('letter', $item)->get();
        }

        return $result;
    }

    public static function getAlphabet()
    {
        $result = [];

        foreach (static::$alphabet as $item) {
            $brands = Brand::where('letter', $item)->orderBy('name', 'asc')->get();

            if (count($brands)) {
                $result[$item] = $brands;
            }
        }

        return $result;
    }

    public function getThumb()
    {
        $image = Image::where('id', $this->thumb)->first();

        if ($image) {
            return $image->image;
        } else {
            return null;
        }
    }
}
