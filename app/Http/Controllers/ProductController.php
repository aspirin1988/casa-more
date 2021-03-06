<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Product;
use App\Rubric;
use App\SelectedProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function single($brand_k, $product_k, $color = null, Request $request)
    {
        $rubric = Rubric::where('slug', $brand_k)->first();

        $product = Product::where('keyword', $product_k);
        if ($color) {
            $product->where('color', $color);
        }
        $product = $product->first();

        if ($product) {

            $liked = [];
            $select_products = SelectedProduct::where('user_id', Auth::id())->orderBy('created_at', 'asc')->get();
            foreach ($select_products as $key => $order) {
                $liked[] = $order->product_id;
            }

            return view('product.single', ['object' => $product, 'brand_k' => $brand_k, 'liked' => $liked, 'rubric' => $rubric]);
        } else {
            return response(view('page.404'), 404);
        }

    }

    public function massageChairs()
    {
        $title = "Массажные кресла";

        $filter = [
            'price',
            'color',
            'weight',
            'remote_controller',
            'zero_g',
            'timer',
            'type_controller',
            'count_program',
            'warming_up',
            'available',
            'massage_area',
        ];


        $method = 'massage_chairs';

        $rubric = Rubric::where('slug', $method)->first();

        $max_price = Product::select('price')->where('type_of_product', $method)->max('price');
        $min_price = Product::select('price')->where('type_of_product', $method)->min('price');
        $colors = Product::distinct()->select('color')->where('type_of_product', $method)->get();

        $weights = Product::distinct()->select('weight')->where('type_of_product', $method)->get();
        $programs = Product::distinct()->select('count_program')->where('type_of_product', $method)->get();
        $massage_areas = Product::distinct()->select('massage_area')->where('type_of_product', $method)->get();

        $liked = [];
        $select_products = SelectedProduct::where('user_id', Auth::id())->orderBy('created_at', 'asc')->get();
        foreach ($select_products as $key => $order) {
            $liked[] = $order->product_id;
        }

        $result = [];

        foreach ($massage_areas as $massage_area) {
            if ($massage_area->massage_area) {
                $result_ = explode(',', $massage_area->massage_area);
                foreach ($result_ as $area) {
                    $area = trim($area);
                    if (!in_array($area, $result)) {
                        $result[] = $area;
                    }
                }
            }
        }

        $products = Product::where('type_of_product', $method)->where('status', true)->where('parent_id', false)->paginate(20);

        return view('product.massage_chairs', [
            'title' => $title,
            'products' => $products,
            'min_price' => $min_price,
            'max_price' => $max_price,
            'colors' => $colors,
            'method' => $method,
            'filter' => $filter,

            'weights' => $weights,
            'programs' => $programs,
            'massage_areas' => $result,
            'liked' => $liked,
            'rubric' => $rubric,
        ]);
    }

    public function sales()
    {
        $title = "Скидки";

        $filter = [

        ];


        $method = 'sales';

        $rubric = Rubric::where('slug', $method)->first();


        $products = \App\Product::getPromotions(8);

        return view('product.massage_chairs', [
            'title' => $title,
            'products' => $products,
            'min_price' => 0,
            'max_price' => 0,
            'colors' => [],
            'method' => $method,
            'filter' => $filter,

            'weights' => [],
            'programs' => [],
            'massage_areas' => [],
            'liked' => [],
            'rubric' => $rubric,
        ]);
    }

    public function new()
    {
        $title = "Новинки";

        $filter = [

        ];


        $method = 'new';

        $rubric = Rubric::where('slug', $method)->first();


        $products = \App\Product::getNewItems(8);

        return view('product.massage_chairs', [
            'title' => $title,
            'products' => $products,
            'min_price' => 0,
            'max_price' => 0,
            'colors' => [],
            'method' => $method,
            'filter' => $filter,

            'weights' => [],
            'programs' => [],
            'massage_areas' => [],
            'liked' => [],
            'rubric' => $rubric,
        ]);
    }

    public function hit()
    {
        $title = "Хиты продаж";

        $filter = [];


        $method = 'hit';

        $rubric = Rubric::where('slug', $method)->first();


        $products = \App\Product::getBestsellers(8);

        return view('product.massage_chairs', [
            'title' => $title,
            'products' => $products,
            'min_price' => 0,
            'max_price' => 0,
            'colors' => [],
            'method' => $method,
            'filter' => $filter,

            'weights' => [],
            'programs' => [],
            'massage_areas' => [],
            'liked' => [],
            'rubric' => $rubric,
        ]);
    }

    public function present()
    {
        $title = "Подароки";

        $filter = [];


        $method = 'present';

        $rubric = Rubric::where('slug', $method)->first();


        $products = \App\Product::where('present')->paginate(20);

        return view('product.massage_chairs', [
            'title' => $title,
            'products' => $products,
            'min_price' => 0,
            'max_price' => 0,
            'colors' => [],
            'method' => $method,
            'filter' => $filter,

            'weights' => [],
            'programs' => [],
            'massage_areas' => [],
            'liked' => [],
            'rubric' => $rubric,
        ]);
    }

    public function massagers()
    {

        $title = 'Массажеры';

        $filter = [
            'price',
            'color',
            'remote_controller',
            'timer',
            'type_controller',
            'count_program',
            'warming_up',
            'available',
            'massage_area',
        ];


        $method = 'massagers';

        $rubric = Rubric::where('slug', $method)->first();

        $max_price = Product::select('price')->where('type_of_product', $method)->max('price');
        $min_price = Product::select('price')->where('type_of_product', $method)->min('price');
        $colors = Product::distinct()->select('color')->where('type_of_product', $method)->get();
        $programs = Product::distinct()->select('count_program')->where('type_of_product', $method)->get();
        $massage_areas = Product::distinct()->select('massage_area')->where('type_of_product', $method)->get();

        $liked = [];
        $select_products = SelectedProduct::where('user_id', Auth::id())->orderBy('created_at', 'asc')->get();
        foreach ($select_products as $key => $order) {
            $liked[] = $order->product_id;
        }

        $result = [];

        foreach ($massage_areas as $massage_area) {
            if ($massage_area->massage_area) {
                $result_ = explode(',', $massage_area->massage_area);
                foreach ($result_ as $area) {
                    $area = trim($area);
                    if (!in_array($area, $result)) {
                        $result[] = $area;
                    }
                }
            }
        }


        $products = Product::where('type_of_product', $method)->where('status', true)->where('parent_id', false)->paginate(20);


        return view('product.massage_chairs', [
            'title' => $title,
            'products' => $products,
            'min_price' => $min_price,
            'max_price' => $max_price,
            'colors' => $colors,
            'method' => $method,
            'filter' => $filter,
            'programs' => $programs,
            'massage_areas' => $result,
            'liked' => $liked,
            'rubric' => $rubric,
        ]);
    }

    public function fitnessQquipment()
    {
        $title = 'Фитнес оборудование';

        $filter = [
            'price',
            'available',
            'timer',
            'type_controller',
            'remote_controller',
        ];


        $method = 'fitness_equipment';

        $rubric = Rubric::where('slug', $method)->first();

        $max_price = Product::select('price')->where('type_of_product', $method)->max('price');
        $min_price = Product::select('price')->where('type_of_product', $method)->min('price');
        $colors = Product::distinct()->select('color')->where('type_of_product', $method)->get();

        $liked = [];
        $select_products = SelectedProduct::where('user_id', Auth::id())->orderBy('created_at', 'asc')->get();
        foreach ($select_products as $key => $order) {
            $liked[] = $order->product_id;
        }

        $products = Product::where('type_of_product', $method)->where('status', true)->where('parent_id', false)->paginate(20);

        return view('product.massage_chairs', [
            'title' => $title,
            'products' => $products,
            'min_price' => $min_price,
            'max_price' => $max_price,
            'colors' => $colors,
            'method' => $method,
            'filter' => $filter,
            'liked' => $liked,
            'rubric' => $rubric,
        ]);
    }

    public function householdProducts()
    {
        $title = 'Товары для дома';

        $filter = [
            'price',
            'sub_type_of_product',
        ];

        $method = 'household_products';

        $rubric = Rubric::where('slug', $method)->first();

        $max_price = Product::select('price')->where('type_of_product', $method)->max('price');
        $min_price = Product::select('price')->where('type_of_product', $method)->min('price');
        $colors = Product::distinct()->select('color')->where('type_of_product', $method)->get();

        $liked = [];
        $select_products = SelectedProduct::where('user_id', Auth::id())->orderBy('created_at', 'asc')->get();
        foreach ($select_products as $key => $order) {
            $liked[] = $order->product_id;
        }

        $products = Product::where('type_of_product', $method)->where('status', true)->where('parent_id', false)->paginate(20);

        return view('product.massage_chairs', [
            'title' => $title,
            'products' => $products,
            'min_price' => $min_price,
            'max_price' => $max_price,
            'colors' => $colors,
            'method' => $method,
            'filter' => $filter,
            'liked' => $liked,
            'rubric' => $rubric,
        ]);
    }

    public function filterProduct(Request $request)
    {
        $method = $request->input('method');
        $color = $request->input('color');
        $weight = $request->input('weight');
        $price_from = $request->input('price_from');
        $price_to = $request->input('price_to');

        $remote_controller = $request->input('remote_controller');
        $type_controller = $request->input('type_controller');
        $sub_type_of_product = $request->input('sub_type_of_product');
        $count_program = $request->input('count_program');
        $massage_area = $request->input('massage_area');
        $zero_g = $request->input('zero_g');
        $timer = $request->input('timer');
        $warming_up = $request->input('warming_up');
        $available = $request->input('available');
        $sort_field = $request->input('sort_field', 'name');
        $sort_method = $request->input('sort_method', 'ASC');

        $products = Product::where('type_of_product', $method)
            ->where('status', true)
            ->where(function ($query) use ($color, $price_to, $price_from, $remote_controller, $type_controller, $count_program, $zero_g, $warming_up, $available, $weight, $massage_area, $timer, $sub_type_of_product) {

                if ($color) {
                    $query->whereIn('color', $color);
                }

                if ($weight) {
                    $query->whereIn('weight', $weight);
                }

                if ($count_program) {
                    $query->whereIn('count_program', $count_program);
                }

                if ($massage_area) {
                    foreach ($massage_area as $item) {
                        $query->where('massage_area', 'like', "%$item%");
                    }
                }

                if ($type_controller) {
                    $query->whereIn('type_controller', $type_controller);
                }

                if ($price_from) {
                    $query->where('price', '>=', $price_from);
                }
                if ($price_to) {
                    $query->where('price', '<=', $price_to);
                }
                if (isset($remote_controller)) {
                    $query->where('remote_controller', $remote_controller);
                }
                if (isset($zero_g)) {
                    $query->where('zero_g', $zero_g);
                }
                if (isset($timer)) {
                    $query->where('timer', $timer);
                }
                if (isset($warming_up)) {
                    $query->where('warming_up', $warming_up);
                }
                if (isset($available)) {
                    $query->where('available', $available);
                }

                if (isset($sub_type_of_product)) {
                    $query->whereIn('sub_type_of_product', $sub_type_of_product);
                }

            })
            ->orderBy($sort_field, $sort_method)
            ->paginate(20);

        $liked = [];
        $select_products = SelectedProduct::where('user_id', Auth::id())->orderBy('created_at', 'asc')->get();
        foreach ($select_products as $key => $order) {
            $liked[] = $order->product_id;
        }

        return response()->view('product.massage_chairs_', ['products' => $products, 'liked' => $liked, 'method' => $method]);
    }

    public function addToSelect(Request $request)
    {
        $id = $request->input('id');

        if (Auth::check()) {

            $product = SelectedProduct::where('user_id', Auth::id())->where('product_id', $id)->first();

            if ($product) {
                $product->delete();
                return response()->json(['result' => true, 'auth' => true, 'message' => 'Данный товар успешно исключен из избранного!']);
            } else {
                SelectedProduct::create(['user_id' => Auth::id(), 'product_id' => $id]);
                return response()->json(['result' => true, 'auth' => true, 'message' => 'Данный товар успешно добавлен в избранное!']);
            }
        } else {
            return response()->json(['result' => false, 'auth' => false]);
        }
    }

    public function comparison()
    {
        return view('product.comparison', []);
    }

    public function comparisonGet(Request $request)
    {
        $ids = $request->input('ids', null);

        if ($ids) {
            $ids = explode(',', $ids);
            $products_ = [];

            $products = Product::whereIn('id', $ids)->get();

            foreach ($products as $object) {
                $product_ = [];
                foreach ($object->getColors() as $color) {
                    $product_['color'][] = $color->color;
                }

                $product_['id'] = $object->id;
                $product_['name'] = $object->name;
                $product_['weight'] = $object->weight;
                $product_['remote_controller'] = ($object->remote_controller ? "+" : "-");
                $product_['zero_g'] = ($object->zero_g ? "+" : "-");
                $product_['timer'] = ($object->timer ? "+" : "-");
                $product_['type_controller'] = __('site.' . $object->type_controller);
                $product_['count_program'] = $object->count_program;
                $product_['warming_up'] = ($object->warming_up ? "+" : "-");
                $product_['massage_area'] = $object->massage_area;
                $product_['available'] = ($object->available ? "+" : "-");
                $product_['price'] = number_format($object->price, 0, ",", " ");

                $product_['massage_intensity_adjustment'] = ($object->massage_intensity_adjustment ? "+" : "-");
                $product_['type_massage'] = $object->type_massage;
                $product_['massage_speed_adjustment'] = ($object->massage_speed_adjustment ? "+" : "-");
                $product_['number_rollers_back'] = $object->number_rollers_back;
                $product_['number_rollers_foot'] = $object->number_rollers_foot;
                $product_['number_airbags'] = $object->number_airbags;
                $product_['auto_shut_off'] = ($object->auto_shut_off ? "+" : "-");
                $product_['carriage_length'] = $object->carriage_length;
                $product_['carriage_type'] = $object->carriage_type;
                $product_['bluetooth'] = ($object->bluetooth ? "+" : "-");
                $product_['antistress_system_braintronics'] = ($object->antistress_system_braintronics ? "+" : "-");
                $product_['control_panel'] = ($object->control_panel ? "+" : "-");
                $product_['user_memorization'] = ($object->user_memorization ? "+" : "-");
                $product_['maximum_user_weight'] = $object->maximum_user_weight;
                $product_['backrest_angle'] = $object->backrest_angle;
                $product_['footrest_tilt_angle'] = $object->footrest_tilt_angle;
                $product_['minimum_distance_wall'] = $object->minimum_distance_wall;
                $product_['main_voltage'] = $object->main_voltage;
                $product_['power'] = $object->power;
                $product_['frequency'] = $object->frequency;
                $product_['dimensions'] = $object->dimensions;
                $product_['manufacturer_warranty'] = $object->manufacturer_warranty;


                $products_ [] = $product_;
            }


            return response()->json(['success' => true, 'result' => $products_]);
        }
        return response()->json(['success' => false]);
    }

    public function comparisonGetAll(Request $request)
    {

        $products_ = [];
        $products = Product::where('parent_id', 0)->where('type_of_product', 'massage_chairs')->get();

        foreach ($products as $object) {
            $product_ = [];
            foreach ($object->getColors() as $color) {
                $product_['color'][] = $color->color;
            }

            $product_['id'] = $object->id;
            $product_['name'] = $object->name;
            $product_['weight'] = $object->weight;
            $product_['remote_controller'] = ($object->remote_controller ? "+" : "-");
            $product_['zero_g'] = ($object->zero_g ? "+" : "-");
            $product_['timer'] = ($object->timer ? "+" : "-");
            $product_['type_controller'] = __('site.' . $object->type_controller);
            $product_['count_program'] = $object->count_program;
            $product_['warming_up'] = ($object->warming_up ? "+" : "-");
            $product_['massage_area'] = $object->massage_area;
            $product_['available'] = ($object->available ? "+" : "-");
            $product_['price'] = number_format($object->price, 0, ",", " ");

            $product_['massage_intensity_adjustment'] = ($object->massage_intensity_adjustment ? "+" : "-");
            $product_['type_massage'] = $object->type_massage;
            $product_['massage_speed_adjustment'] = ($object->massage_speed_adjustment ? "+" : "-");
            $product_['number_rollers_back'] = $object->number_rollers_back;
            $product_['number_rollers_foot'] = $object->number_rollers_foot;
            $product_['number_airbags'] = $object->number_airbags;
            $product_['auto_shut_off'] = ($object->auto_shut_off ? "+" : "-");
            $product_['carriage_length'] = $object->carriage_length;
            $product_['carriage_type'] = $object->carriage_type;
            $product_['bluetooth'] = ($object->bluetooth ? "+" : "-");
            $product_['antistress_system_braintronics'] = ($object->antistress_system_braintronics ? "+" : "-");
            $product_['control_panel'] = ($object->control_panel ? "+" : "-");
            $product_['user_memorization'] = ($object->user_memorization ? "+" : "-");
            $product_['maximum_user_weight'] = $object->maximum_user_weight;
            $product_['backrest_angle'] = $object->backrest_angle;
            $product_['footrest_tilt_angle'] = $object->footrest_tilt_angle;
            $product_['minimum_distance_wall'] = $object->minimum_distance_wall;
            $product_['main_voltage'] = $object->main_voltage;
            $product_['power'] = $object->power;
            $product_['frequency'] = $object->frequency;
            $product_['dimensions'] = $object->dimensions;
            $product_['manufacturer_warranty'] = $object->manufacturer_warranty;


            $products_ [] = $product_;
        }

        return response()->json(['success' => true, 'result' => $products_]);
    }


    public function search()
    {
        return view('product.search');
    }

    public function otherProducts($method)
    {
        $rubric = Rubric::where('slug', $method)->first();

        if ($rubric) {

            $title = $rubric->name;

            $filter = [
                'price',
            ];

            $method = $rubric->slug;

            $max_price = Product::select('price')->where('type_of_product', $method)->max('price');
            $min_price = Product::select('price')->where('type_of_product', $method)->min('price');
            $colors = Product::distinct()->select('color')->where('type_of_product', $method)->get();

            $liked = [];
            $select_products = SelectedProduct::where('user_id', Auth::id())->orderBy('created_at', 'asc')->get();
            foreach ($select_products as $key => $order) {
                $liked[] = $order->product_id;
            }

            $products = Product::where('type_of_product', $method)->where('status', true)->where('parent_id', false)->paginate(20);

            return view('product.massage_chairs', [
                'title' => $title,
                'products' => $products,
                'min_price' => $min_price,
                'max_price' => $max_price,
                'colors' => $colors,
                'method' => $method,
                'filter' => $filter,
                'liked' => $liked,
                'rubric' => $rubric,
            ]);

        } else {
            return redirect()->action(
                'PageController@index', ['page' => $method]
            );
        }
    }

}
