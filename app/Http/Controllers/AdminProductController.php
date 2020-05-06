<?php

namespace App\Http\Controllers;

use App\Image;
use App\ProdictTagRelation;
use App\Product;
use App\Rubric;
use App\Tag;
use Aspirin1988\Ruslug\Slug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index($method = 'massage_chairs', $page = 0)
    {
        return view('admin.product.index', ['method' => $method, 'page' => $page]);
    }

    public function add()
    {
        return view('admin.product.add');
    }

    public function edit($id)
    {
        return view('admin.product.edit', ['id' => $id]);
    }

    public function getList($method = 'massage_chairs', Request $request)
    {
        $page = $request->input('page', 1);
        $sort = $request->input('sort', 1);
        $sort_method = $request->input('sort_method', 1);

        $page--;

        $limit = 20;
        $offset = $limit * $page;

        $product_count = Product::where('type_of_product', $method)->where('parent_id', false)->count();
        $product = Product::where('type_of_product', $method)->where('parent_id', false)->limit($limit)->offset($offset)->orderBy($sort, $sort_method)->get();

        $page_count = ceil($product_count / $limit);

        $type_of_product_list = Rubric::orderBy('order')->get();

        $menu = [];
        foreach ($type_of_product_list as $item) {
            $menu[] = ["id" => $item->id, "url" => "/admin/product/{$item->slug}", "text" => $item->name, "alias" => ["/admin/product/{$item->slug}"]];
        }


        return response()->json(['list' => $product, 'page_list' => range(1, $page_count), 'page' => $page, 'menu' => $menu]);
    }

    public function getEdit($id)
    {
        $product = Product::where('id', $id)->first();
        $product->url = $product->getUrl();
        $child_list = Product::where('parent_id', $product->id)->get();
        $image_list = $product->getImages();
        $image_list['background'] = Image::where('id', $product->background)->first();
        $type_of_product_list = Rubric::where('show_index',1)->orderBy('order')->get();
        return response()->json(['list' => $product, 'image_list' => $image_list, 'child_list' => $child_list, 'type_of_product_list' => $type_of_product_list]);
    }

    public function getChildList($id)
    {
        $product = Product::where('id', $id)->first();
        $child_list = Product::where('parent_id', $product->id)->get();
        return response()->json($child_list);
    }

    public function create(Request $request)
    {
        $parent_id = $request->input('parent_id');
        $data = $request->all();
        $tags = [];
        if (isset($data['tags'])) {
            $tags = $data['tags'];
            unset($data['tags']);
        }
        if ($parent_id) {
            $parent = Product::where('id', $parent_id)->first();
            $parent = $parent->toArray();
            unset($parent['id']);
            unset($parent['created_at']);
            unset($parent['updated_at']);
            unset($parent['parent_id']);
            unset($parent['color']);
            foreach ($parent as $key => $value) {
                $data[$key] = $value;
            }
        }
        $keyword = Slug::make($data['name']);
        $data['keyword'] = str_replace(".", "-", str_replace(" ", "_", strtolower($keyword)));
        $product = Product::create($data);

        foreach ($tags as $tag) {
            ProdictTagRelation::create(['product_id' => $product->id, 'tag_id' => $tag['tag_id']]);
        }

        return response()->json($product);
    }

    public function save($id, Request $request)
    {
        $data = $request->all();
        unset($data['url']);
//        $data['icons'] = json_encode($data['icons']);
        $keyword = Slug::make($data['name']);
        $data['keyword'] = str_replace(".", "-", str_replace(" ", "_", strtolower($keyword)));
        $brand = Product::where('id', $id)->update($data);
        return response()->json($brand);
    }

    public function delete($id)
    {
        $brand = Product::where('id', $id)->delete();
        return response()->json($brand);
    }

    public function setTag(Request $request)
    {
        $product_id = $request->input('product_id');
        $tag = $request->input('tag');

        $result = ProdictTagRelation::create(['product_id' => $product_id, 'tag_id' => $tag['id']]);

        return response()->json($result);
    }

    public function getTags($id)
    {
        $product = Product::where('id', $id)->first();
        $tags = $product->getTags();

        return response()->json($tags);
    }

    public function unsetTag($id)
    {
        $_tag = ProdictTagRelation::where('id', $id)->delete();

        return response()->json($_tag);
    }

    public function getImages($id)
    {
        $product = Product::where('id', $id)->first();

        $image_list = $product->getImages();
        $image_list['background'] = Image::where('id', $product->background)->first();

        return response()->json(['images' => $image_list]);

    }

    public function uploadBrochure($product_id = 0, Request $request)
    {
        $files = $request->file('file');

        $result = '';

        $product = Product::where('id', $product_id)->first();

        if ($product) {

            foreach ($files as $file) {

                $file->getClientOriginalName();

                $name = $file->getClientOriginalName();

                $file_path = '/doc/product_' . $product_id . '/' . date('Y-m-d') . '/';

                if (!file_exists(public_path() . $file_path)) {
                    mkdir(public_path() . $file_path, 0777, true);
                }

                Storage::put($file_path . $name, file_get_contents($file->getRealPath()));

                $result = $file_path . $name;

                $product->brochure = $result;
                $product->save();

            }
        }

        return response()->json(['result' => $result]);
    }

}
