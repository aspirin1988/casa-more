<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;

class AdminBrandController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index($page = 0)
    {
        return view('admin.brand.index', ['page' => $page]);
    }

    public function add()
    {
        return view('admin.brand.add');
    }

    public function edit($id)
    {
        return view('admin.brand.edit', ['id' => $id]);
    }

    public function getList($page = 0)
    {
        $brand = Brand::get();
        return response()->json(['list' => $brand]);
    }

    public function getEdit($id)
    {
        $brand = Brand::where('id', $id)->first();
        $brand->thumb_image = $brand->getThumb();
        return response()->json($brand);
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $data['letter'] = strtoupper($data['name'][0]);
        $data['keyword'] = str_replace(".", "-", str_replace(" ", "_", strtolower($data['name'])));
        $brand = Brand::create($data);

        return response()->json($brand);
    }

    public function save($id, Request $request)
    {
        $data = $request->all();
        unset($data['thumb_image']);
        $data['letter'] = strtoupper($data['name'][0]);
        $data['keyword'] = str_replace(".", "-", str_replace(" ", "_", strtolower($data['name'])));
        $data['keyword'] = str_replace("'", "-", $data['keyword']);
        $brand = Brand::where('id', $id)->update($data);
        return response()->json($brand);
    }

    public function delete($id)
    {
        $brand = Brand::where('id', $id)->delete();
        return response()->json($brand);
    }
}
