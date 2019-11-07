<?php

namespace App\Http\Controllers;

use App\Image;
use App\ProdictTagRelation;
use App\Product;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index($keyword)
    {
        $tag = Tag::where('keyword', $keyword)->first();

        $products = $tag->getProducts(20);

        $min = 0;
        $max = 500000;
        return view('product.tag_', ['tag' => $tag, 'products' => $products, 'max' => $max, 'min' => $min]);
//        return view('product.tag', ['tag' => $tag, 'products' => $products, 'max' => $max, 'min' => $min]);
    }

    public function getProduct(Request $request)
    {
        $limit = 12;

        $keyword = $request->input('tag');
        $page = $request->input('page', 0);
        $sort = $request->input('sort', 'name');
        $sort_method = $request->input('sort_method', 'asc');
        $max_price = $request->input('max', '0');
        $min_price = $request->input('min', '0');
        $offset = $limit * $page;
        $tag = Tag::where('keyword', $keyword)->first();

        $relation = ProdictTagRelation::where('tag_id', $tag->id)->get();

        $product_id = [];

        foreach ($relation as $item) {
            $product_id[] = $item->product_id;
        }
        $max = Product::whereIn('id', $product_id)->max('price');
        $min = Product::whereIn('id', $product_id)->min('price');

        if (!$max_price) {
            $max_price = $max;
        }

        if (!$min_price) {
            $min_price = $min;
        }

        $products = Product::whereIn('id', $product_id)
            ->where(function ($query) use ($max_price, $min_price) {
                if ($max_price) {
                    $query->where('price', '<=', $max_price);
                }
                if ($min_price) {
                    $query->where('price', '>=', $min_price);
                }
            })
            ->limit($limit)
            ->offset($offset)
            ->orderBy($sort, $sort_method)
            ->get();

        $products_count = Product::whereIn('id', $product_id)
            ->where(function ($query) use ($max_price, $min_price) {
                if ($max_price) {
                    $query->where('price', '<=', $max_price);
                }
                if ($min_price) {
                    $query->where('price', '>=', $min_price);
                }
            })
            ->count();

        $pages = ceil($products_count / $limit);

        foreach ($products as $key => $product) {
            $image_list = [];
            $image_list['thumb_bottle'] = Image::where('id', $product->thumb_bottle)->first();
            if ($image_list['thumb_bottle']) {
                $image_list['thumb_bottle'] = $image_list['thumb_bottle']->image;
            }
//            $child_list = Product::where('parent_id', $product->id)->get();
            $product->image = $image_list;
//            $product->child = $child_list;
            $product->url = $product->getUrl() . "?v=" . $product->volume;
        }

        return response()->json([
            'list' => $products,
            'page_list' => range(0, $pages - 1),
            'pages' => $pages - 1,
            'tag_data' => $tag,
            'max' => $max,
            'min' => $min,
        ]);
    }
}
