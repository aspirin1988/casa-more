<?php

namespace App\Http\Controllers;

use App\Image;
use App\Present;
use App\ProdictTagRelation;
use App\Product;
use App\Rubric;
use Aspirin1988\Ruslug\Slug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPresentController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index($page = 0)
    {
        return view('admin.present.index', ['page' => $page]);
    }

    public function add()
    {
        return view('admin.present.add');
    }

    public function edit($id)
    {
        return view('admin.present.edit', ['id' => $id]);
    }

    public function getList(Request $request)
    {
        $page = $request->input('page', 1);
        $sort = $request->input('sort', 1);

        $present = Present::get();

        return response()->json(['list' => $present, 'page_list' => [], 'page' => $page, 'menu' => []]);
    }

    public function getEdit($id)
    {
        $present = Present::where('id', $id)->first();
        return response()->json(['list' => $present, 'image_list' => [], 'child_list' => [], 'type_of_product_list' => []]);
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $present = Present::create($data);

        return response()->json($present);
    }

    public function save($id, Request $request)
    {
        $data = $request->all();
        $present = Present::where('id', $id)->update($data);
        return response()->json($present);
    }

    public function delete($id)
    {
        $present = Present::where('id', $id)->delete();
        return response()->json($present);
    }

    public function uploadImage($product_id = 0, Request $request)
    {
        $files = $request->file('file');

        $result = '';

        $product = Present::where('id', $product_id)->first();

        if ($product) {

            foreach ($files as $file) {

                $file->getClientOriginalName();

                $name = $file->getClientOriginalName();

                $file_path = '/img/present_' . $product_id . '/' . date('Y-m-d') . '/';

                if (!file_exists(public_path() . $file_path)) {
                    mkdir(public_path() . $file_path, 0777, true);
                }

                Storage::put($file_path . $name, file_get_contents($file->getRealPath()));

                $result = $file_path . $name;

                $product->image = $result;
                $product->save();

            }
        }

        return response()->json(['result' => $result]);
    }
}
