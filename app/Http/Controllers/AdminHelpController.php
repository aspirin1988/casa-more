<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class AdminHelpController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function findTag(Request $request)
    {
        $name = $request->input('tag');

        $data = Tag::select('id', 'name')->where('name', 'like', $name . '%')->limit(10)->get();

        return response()->json($data);
    }

}
