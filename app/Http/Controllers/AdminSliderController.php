<?php

namespace App\Http\Controllers;

use App\Image;
use App\Slider;
use App\SliderItem;
use Illuminate\Http\Request;

class AdminSliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index($page = 0)
    {
        return view('admin.slider.index', ['page' => $page]);
    }

    public function add()
    {
        return view('admin.slider.add');
    }

    public function edit($id)
    {
        return view('admin.slider.edit', ['id' => $id]);
    }

    public function getList($page = 0)
    {
        $product = Slider::get();
        return response()->json(['list' => $product]);
    }

    public function getEdit($id)
    {
        $slider = Slider::where('id', $id)->first();

        $items = SliderItem::where(['slider_id' => $id])->orderBy('sort','asc')->get();

        foreach ($items as $key => $item) {
            $input = [];
            $input['desktop'] = Image::where('id', $item->desktop)->first();
            $input['mobile'] = Image::where('id', $item->mobile)->first();
            $items[$key]->data = $input;
        }

        return response()->json(['list' => $slider, 'image_list' => $items]);
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $product = Slider::create($data);

        return response()->json($product);
    }

    public function save($id, Request $request)
    {
        $data = $request->all();
        $brand = Slider::where('id', $id)->update($data);
        return response()->json($brand);
    }

    public function delete($id)
    {
        $brand = Slider::where('id', $id)->delete();
        return response()->json($brand);
    }

    public function addSlide($id)
    {
        $item = SliderItem::create(['slider_id' => $id]);
        $items = SliderItem::where(['slider_id' => $item->slider_id])->get();

        foreach ($items as $key => $item) {
            $input = [];
            $input['desktop'] = Image::where('id', $item->desktop)->first();
            $input['mobile'] = Image::where('id', $item->mobile)->first();
            $items[$key]->data = $input;
        }

        return response()->json($items);
    }

    public function updateSlide($id, Request $request)
    {
        $desktop = $mobile = 0;

        $data = $request->input('data');
        $link = $request->input('link');
        $description = $request->input('description');
        $title = $request->input('title');
        $color = $request->input('color');
        $sort = $request->input('sort',0);

        if (isset($data['desktop']['id'])) {
            $desktop = $data['desktop']['id'];
        }
        if (isset($data['mobile']['id'])) {
            $mobile = $data['mobile']['id'];
        }

        $item = SliderItem::where(['id' => $id])->first();
        $item->update([
            'desktop' => $desktop,
            'mobile' => $mobile,
            'link' => $link,
            'description' => $description,
            'title' => $title,
            'color' => $color,
            'sort' => $sort,
        ]);

        $items = SliderItem::where(['slider_id' => $item->slider_id])->get();

        foreach ($items as $key => $item) {
            $input = [];
            $input['desktop'] = Image::where('id', $item->desktop)->first();
            $input['mobile'] = Image::where('id', $item->mobile)->first();
            $items[$key]->data = $input;
        }

        return response()->json($items);
    }

    public function deleteSlide($id)
    {
        $item = SliderItem::where(['id' => $id])->first();
        $slider_id = $item->slider_id;
        $item->delete();

        $items = SliderItem::where(['slider_id' => $slider_id])->get();

        foreach ($items as $key => $item) {
            $input = [];
            $input['desktop'] = Image::where('id', $item->desktop)->first();
            $input['mobile'] = Image::where('id', $item->mobile)->first();
            $items[$key]->data = $input;
        }

        return response()->json($items);
    }

}
