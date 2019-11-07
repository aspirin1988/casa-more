<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class AdminTagController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index($page = 0)
    {
        return view('admin.tag.index', ['page' => $page]);
    }

    public function add()
    {
        return view('admin.tag.add');
    }

    public function edit($id)
    {
        return view('admin.tag.edit', ['id' => $id]);
    }

    public function getList($page = 0)
    {
        $tag = Tag::get();
        return response()->json(['list' => $tag]);
    }

    public function getEdit($id)
    {
        $tag = Tag::where('id', $id)->first();

        return response()->json($tag);
    }

    public function save($id, Request $request)
    {
        $data = $request->all();
        $tag = Tag::where('id', $id)->update($data);
        return response()->json($tag);
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $tag = Tag::create($data);

        return response()->json($tag);
    }

    public function delete($id)
    {
        $tag = Tag::where('id', $id)->delete();
        return response()->json($tag);
    }
}
