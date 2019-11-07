<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index($page = 0)
    {
        return view('admin.page.index', ['page' => $page]);
    }

    public function add()
    {
        return view('admin.page.add');
    }

    public function edit($id)
    {
        return view('admin.page.edit', ['id' => $id]);
    }

    public function getList($page = 0)
    {
        $product = Page::get();
        return response()->json(['list' => $product]);
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $product = Page::create($data);

        return response()->json($product);
    }

    public function getEdit($id)
    {
        $product = Page::where('id', $id)->first();

        return response()->json($product);
    }

    public function save($id, Request $request)
    {
        $data = $request->all();
        $brand = Page::where('id', $id)->update($data);
        return response()->json($brand);
    }

    public function delete($id)
    {
        $brand = Page::where('id', $id)->delete();
        return response()->json($brand);
    }

}
