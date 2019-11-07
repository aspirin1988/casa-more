<?php

namespace App\Http\Controllers;

use App\Image;
use App\Rubric;
use Illuminate\Http\Request;

class AdminRubricController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index($page = 0)
    {
        return view('admin.rubric.index', ['page' => $page]);
    }

    public function add()
    {
        return view('admin.rubric.add');
    }

    public function edit($id)
    {
        return view('admin.rubric.edit', ['id' => $id]);
    }

    public function getList($page = 0)
    {
        $product = Rubric::get();
        return response()->json(['list' => $product]);
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $product = Rubric::create($data);

        return response()->json($product);
    }

    public function getEdit($id)
    {
        $product = Rubric::where('id', $id)->first();
        $product->thumb_image = Image::where('id', $product->thumb)->first();
        return response()->json($product);
    }

    public function save($id, Request $request)
    {
        $data = $request->all();
        unset($data['thumb_image']);
        $brand = Rubric::where('id', $id)->update($data);
        return response()->json($brand);
    }

    public function delete($id)
    {
        $brand = Rubric::where('id', $id)->delete();
        return response()->json($brand);
    }
}
