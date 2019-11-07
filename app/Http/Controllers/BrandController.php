<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Image;
use App\Product;
use App\Tag;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index($brand_, Request $request)
    {
        $limit = 8;

        $brand = Brand::where('keyword', $brand_)->first();
        $tag = Tag::where('keyword', $brand_)->first();

        $page = intval($request->input('p'))-1;
        $offtet = $page * $limit;
        $sort = $request->input('s');


        if ($brand) {
            $products = Product::where('status',true)->where('brand', $brand->id)->where('parent_id', 0)->offset($offtet)->limit($limit)->get();
            $products_count = Product::where('status',true)->where('brand', $brand->id)->count();
            foreach ($products as $key => $product){
                $products[$key]->child = $product->getChild();
            }
            $min = Product::where('status',true)->where('brand', $brand->id)->min('price');
            $max = Product::where('status',true)->where('brand', $brand->id)->max('price');
            return view('product.brand_', ['brand' => $brand, 'products' => $products, 'max' => $max, 'min' => $min, 'current_page'=>$page]);
        }
        if($tag){
            $tags = new TagController();
            return $tags->index($brand_);
        }
        $page = new PageController();
        return $page->index($brand_);
    }

    public function allBrands()
    {
        $alphabet = Brand::getAlphabet();

        return view('product.brands', ['alphabet' => $alphabet]);
    }

    public function getProduct(Request $request)
    {
        $limit = 12;

        $keyword = $request->input('brand');
        $page = $request->input('page', 0);
        $sort = $request->input('sort', 'name');
        $sort_method = $request->input('sort_method', 'asc');
        $max_price = $request->input('max', '0');
        $min_price = $request->input('min', '0');
        $offset = $limit * $page;
        $brand = Brand::where('keyword', $keyword)->first();

        $max = Product::where('brand', $brand->id)->max('price');
        $min = Product::where('brand', $brand->id)->min('price');

        if (!$max_price) {
            $max_price = $max;
        }

        if (!$min_price) {
            $min_price = $min;
        }

        $products = Product::where('brand', $brand->id)
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

        $products_count = Product::where('brand', $brand->id)
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
            'brand_data' => $brand,
            'max' => $max,
            'min' => $min,
        ]);
    }

}
