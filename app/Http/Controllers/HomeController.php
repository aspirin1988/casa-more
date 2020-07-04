<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderList;
use App\Product;
use App\SelectedProduct;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::id();
        $user = Auth::user();
        $orders = Order::where('user_id', $id)->orderBy('created_at', 'DESC')->get();
        $select_products = SelectedProduct::where('user_id', $id)->orderBy('created_at', 'asc')->get();
        foreach ($orders as $key => $order) {
            $order_ = $order->getProductList();
            if($order_) {
                $orders[$key]->products = $order->getProductList();
            }else{
                unset($orders[$key]);
            }
        }

        foreach ($select_products as $key => $select_product) {
            $select_products[$key]->product = Product::where('id',$select_product->product_id)->first();
        }

        return view('home',['orders'=>$orders, 'user'=>$user, 'select_products'=>$select_products]);
    }

    public function updateUser(Request $request)
    {
        $input['first_name'] = $request->input('first_name');
        $input['last_name'] = $request->input('last_name');
        $input['birthday'] = $request->input('birthday');
        $input['phone'] = $request->input('phone');
//        $input['gender'] = $request->input('gender');

        $id = Auth::id();

        $user = User::where('id', $id)->first();

        $user->update($input);

        $message['success'] = true;
        $message['message'] = 'Пользователь успешно обнавлен!';
        return response()->redirectTo('/profile/');

    }

    public function resetPassword(Request $request)
    {
        $password_old = $request->input('password');
        $password_new = $request->input('password_new');
        $password_new_c = $request->input('password_new_c');

        $message = [];

        $id = Auth::id();

        $user = User::where('id', $id)->first();

        if (Hash::check($password_old, $user->password)) {
            if ($password_new_c == $password_new) {
                $user->update(['password' => Hash::make($password_new)]);
                $message['success'] = true;
                $message['message'] = 'Пороль не успешно обнавлен!';
            } else {
                $message['success'] = false;
                $message['message'] = 'Пароли не совпадают!';
            }
        } else {
            $message['success'] = false;
            $message['message'] = 'Старый пороль не верен!';
        }


        return response()->json($message);
    }

    public function getData()
    {
        return response()->json(Auth::user());
    }

}
