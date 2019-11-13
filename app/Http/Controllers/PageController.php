<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index($slug)
    {
        $page = Page::where('slug', $slug)->first();
        if ($page) {
            return view('page.single', ['page' => $page]);
        } else {
            return false;
        }
    }

    public function news()
    {
        $pages = Page::where('news', true)->get();
        return view('page.list', ['pages' => $pages]);
    }
}
