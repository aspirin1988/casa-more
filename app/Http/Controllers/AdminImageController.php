<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminImageController extends Controller
{
    public function index($page = 0)
    {
        return view('admin.media.index', ['page' => $page]);
    }

    public function mediaList($dir)
    {
        return view('admin.media.list', ['dir' => $dir]);
    }

    public function getImages($dir = 'image')
    {
        $img_ = public_path('img');

        $files = scandir($img_);

        $dir_list = [];

        foreach ($files as $file) {
            if (is_dir($img_ . '/' . $file) && $file != '.' && $file != '..') {
                $dir_list[] = $file;
            }
        }

        $images = Image::where('image', 'like', '%/' . $dir . '%')->get();

        return response()->json(['images' => $images, 'dir_list' => $dir_list]);
//        return response()->json($images);
    }

    public function clone(Request $request)
    {
        $data = $request->all();
        unset($data['id']);

        $result = Image::create($data);

        return response()->json($result);
    }

    public function upload($product_id = 0, Request $request)
    {

        $dir = $request->input('dir', 'image');
        $files = $request->file('file');

        $result = [];

        foreach ($files as $file) {

            $file->getClientOriginalName();

            $name = $file->getClientOriginalName();

            $file_path = '/img/' . $dir . '/' . date('Y-m-d') . '/';

            if (!file_exists(public_path() . $file_path)) {
                mkdir(public_path() . $file_path, 0777, true);
            }

            Storage::put($file_path . $name, file_get_contents($file->getRealPath()));

            $input = [
                'name' => $name,
                'image' => $file_path . $name,
                'object_id' => $product_id,
            ];

            $result[] = Image::create($input);
        }

        return response()->json(['result' => $result]);
    }

    public function addDir(Request $request)
    {
        $dir_name = $request->input('dir_name');

        $img_ = public_path('img');

        if (!file_exists($img_ . '/' . $dir_name)) {
            mkdir($img_ . '/' . $dir_name, 0777, true);
        }

        $files = scandir($img_);

        $dir_list = [];

        foreach ($files as $file) {
            if (is_dir($img_ . '/' . $file) && $file != '.' && $file != '..') {
                $dir_list[] = $file;
            }
        }

        return response()->json(['dir_list' => $dir_list]);

    }

    public function getDir($page = 0)
    {
        $img_ = public_path('img');

        $files = scandir($img_);

        $dir_list = [];

        foreach ($files as $file) {
            if (is_dir($img_ . '/' . $file) && $file != '.' && $file != '..') {
                $count = Image::where('image', 'like', '%/' . $file . '/%')->count();
                $dir_list[] = ['count_image' => $count, 'dir_name' => $file];
            }
        }

        return response()->json(['list' => $dir_list]);
    }

    public function dirDelete($dir)
    {


        $img_ = public_path('img');

        if (File::deleteDirectory($img_ . '/' . $dir)) {
            $images = Image::where('image', 'like', '%/' . $dir . '/%')->delete();
        }
        $files = scandir($img_);
        $dir_list = [];
        foreach ($files as $file) {
            if (is_dir($img_ . '/' . $file) && $file != '.' && $file != '..') {
                $count = Image::where('image', 'like', '%/' . $file . '%')->count();
                $dir_list[] = ['count_image' => $count, 'dir_name' => $file];
            }
        }
        return response()->json(['list' => $dir_list]);
    }

    public function getMediaList($dir)
    {
        $images = Image::where('image', 'like', '%/' . $dir . '/%')->get();
        return response()->json(['list' => $images]);
    }

    public function imageDelete($id)
    {
        $images = Image::where('id', $id)->update(['object_id' => 0]);
        return response()->json(['result' => $images]);
    }

    public function uploadImage(Request $request)
    {
        $dir = 'image';
        $file = $request->file('image');

        $result = [];


        $file->getClientOriginalName();

        $name = $file->getClientOriginalName();
        $ext = $file->getClientOriginalExtension();

        $file_path = '/img/' . $dir . '/' . date('Y-m-d') . '/';

        if (!file_exists(public_path() . $file_path)) {
            mkdir(public_path() . $file_path, 0777, true);
        }

        $file_path = $file_path . md5($name) . '.' . $ext;

        Storage::put($file_path, file_get_contents($file->getRealPath()));

        return response()->json(['url' => $file_path]);
    }
}


