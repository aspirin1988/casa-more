<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class HelpController extends Controller
{
    public function find(Request $request)
    {
        $search = $request->input('search');

        $products = Product::where('status', true)->where('name', 'like', '%' . $search . '%')->distinct()->limit(4)->get();

        $result = [];


        foreach ($products as $product) {
            $result[] = [
                'name' => __('product.' . $product->type_of_product) . " " . $product->name,
                'url' => $product->getUrl(),
                'thumb' => $product->getBackground(),
                'price' => $product->getPrice(),
            ];
        }

        return response()->json($result);
    }

    public function cart()
    {
        return view('product.cart');
    }

    public function getCart(Request $request)
    {
        $data = $request->all();

        $result = [];

        foreach ($data as $datum) {
            $product = Product::where('id', $datum['id'])->first();

            $image = $product->getImage('thumb_bottle');

            $input = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => ($product->discount ? ($product->price - (($product->price / 100) * $product->discount)) : $product->price),
                'discount' => $product->discount,
                'volume' => $product->volume,
                'count' => $datum['count'],
                'present' => $product->present,
                'image' => $image,
            ];

            $result[] = $input;
        }

        $user = [];
        if ($usr = Auth::user()) {
            $user['email'] = $usr->email;
            $user['phone'] = $usr->phone;
            $user['name'] = $usr->first_name . ' ' . $usr->last_name;
        }

        return response()->json(['list' => $result, 'user' => $user]);


    }

    protected function testPay($email, $phone, $amount, $order)
    {
        $request = [
            'amount' => $amount,
            'back_link' => url('http://casa-more.kz/cart/'),
            'payment_webhook' => url("/pay/success/{$order}"),
            'phone_number' => $phone,
            'language' => 'ru',
            'email' => $email,
        ];

//        file_put_contents('create_pay.txt', json_encode($request));


        $url = env('PAY_URL') . '/api/v0/orders/payment/';
        $pay_token = env('PAY_TOKEN');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: Application/json', 'Authorization: Token '.$pay_token, 'Accept-Language: ru']);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($result, true);

        return $result;

//        $request['pg_testing_mode'] = 1; //add this parameter to request for testing payments
// $request['pg_payment_system'] = 'TEST'; //add this parameter to request for testing payments

//if you pass any of your parameters, which you want to get back after the payment, then add them. For example:
// $request['client_name'] = 'My Name';
// $request['client_address'] = 'Earth Planet';

//generate a signature and add it to the array
//        ksort($request); //sort alphabetically
//        array_unshift($request, 'payment.php');
//        array_push($request, 'wBFMcje8gJJhyQwT'); //add your secret key (you can take it in your personal cabinet on paybox system)


//        $request['pg_sig'] = md5(implode(';', $request));

//        unset($request[0], $request[1]);

//        $query = http_build_query($request);

//redirect a customer to payment page
//        return 'https://api.paybox.money/payment.php?' . $query;


    }

    public function success($id, Request $request)
    {
        $order = Order::where('id', $id)->first();

        $url = env('PAY_URL') . "/api/v0/orders/payment/{$order->payment_id}/";
        $pay_token = env('PAY_TOKEN');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 0);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: Application/json', 'Authorization: Token '.$pay_token, 'Accept-Language: ru']);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($result, true);

        if ($result['success']) {

            if ($result['result']['status'] == 4) {
                $order->status = 1;
                $order->save();

                $user = User::where('id', $order->user_id)->first();

                Mail::send('emails.for_the_seller', ['order' => $order, 'user' => $user], function ($m) use ($order) {
                    $m->from('styalmaty@gmail.com', 'Casada Kazakhstan');
                    $m->to('styalmaty@gmail.com', 'Casada Kazakhstan')->subject('Новый заказ "' . $order->id . '" ');
                });

                Mail::send('emails.order_success', ['order' => $order, 'user' => $user], function ($m) use ($user) {
                    $m->from('styalmaty@gmail.com', 'Casada Kazakhstan');
                    $m->to($user->email, $user->first_name . ' ' . $user->last_name)->subject('Отчёт о Вашем заказе "" ');
                });

            } else {
                $order->status = 0;
                $order->save();
            }

        } else {
            $order->status = 0;
            $order->save();
        }

        return response()->json($result);

//        file_put_contents('pay_post.txt', json_encode($_POST));
//        file_put_contents('pay_input.txt', file_get_contents("php://input"));


//        $result = intval($request->input('pg_result'));
//        $order_id = intval($request->input('pg_order_id'));
//        if ($result) {
//            $order = Order::where('id', $order_id)->first();
//
//            $order->status = 1;
//            $order->save();
//
//            $product_list = $order->getProductList();
//            $order->prodicts = $product_list;
//
//            $user = User::where('id', $order->user_id)->first();
//
//            Mail::send('emails.for_the_seller', ['order' => $order, 'user' => $user], function ($m) {
//                $m->from('aspirin_1988@mail.ru', 'Sergey Demidov');
//
//                $m->to('aspirin_1988@mail.ru', 'Sergey Demidov')->subject('Новый заказ "" ');
//                $m->to('aspirins24@gmail.com', 'Sergey Demidov')->subject('Новый заказ "" ');
////                $m->to('vladimir.aiki@gmail.com', 'Владимир Булавин')->subject('Новый заказ "http://laguna-parfumes.kz" ');
//            });
//
//            Mail::send('emails.order_success', ['order' => $order, 'user' => $user], function ($m) use ($user) {
//                $m->from('aspirin_1988@mail.ru', 'Sergey Demidov');
//                $m->to($user->email, $user->first_name . ' ' . $user->last_name)->subject('Отчёт о Вашем заказе "" ');
//            });

//        }

//        return response()->json(['pg_result' => 1]);
    }

    public function refund(Request $request)
    {
        $data = $request->all();

//        file_put_contents('refund.txt', json_encode($data));

//        $result = intval($request->input('pg_result'));
        $order_id = intval($request->input('pg_order_id'));
//        if ($result) {
        $order = Order::where('id', $order_id)->first();

        $order->status = 0;
        $order->save();
//        }

        return response()->json(['pg_result' => 1]);
    }

    public function check(Request $request)
    {
        $data = $request->all();

//        file_put_contents('check.txt', json_encode($data));
    }

    public function orderRePay($id)
    {
        $order = Order::where('id', $id)->first();

        $user = Auth::user();

        $pay_link = $this->testPay($user->email, $user->phone, $order->price, $order->id);

        if ($pay_link['success']) {

            $order->payment_id = $pay_link['result']['payment'];
            $order->save();

            return response()->json(['result' => true, 'redirect_to' => $pay_link['result']['url']]);
        } else {
            return response()->json(['result' => false, 'errors' => $pay_link['errors']]);
        }

    }

    public function createOrder(Request $request)
    {
        $data = $request->all();
        $email = $request->input('email');
        $phone = $request->input('phone');
        if ($email) {
            $list_product = $data['list_product'];
            $summ = 0;
            unset($data['list_product']);

            foreach ($list_product as $item) {
                $product = Product::where('id', $item['id'])->first();
                if ($product->discount) {
                    $summ += ($product->price - (($product->price / 100) * $product->discount)) * $item['count'];
                } else {
                    $summ += $product->price * $item['count'];
                }
            }

            $order = [
                'price' => $summ,
            ];

            if ($user = User::where('email', $email)->first()) {
                $user_id = $user->id;
                $order['user_id'] = $user_id;
            } else {
                $name = explode(' ', $data['name']);
                $password = $this->randomPassword();

                $user = [
                    'first_name' => $name[0],
                    'last_name' => (isset($name[1]) ? $name[1] : null),
                    'email' => $email,
                    'password' => Hash::make($password),
                    'phone' => $phone,
                ];
                $user = User::create($user);
                $user_id = $user->id;
                $order['user_id'] = $user_id;

                Mail::send('emails.register', ['password' => $password, 'user' => $user], function ($m) use ($user) {
                    $m->from('styalmaty@gmail.com', 'Casada Kazakhstan');
                    $m->to($user->email, $user->first_name . ' ' . $user->last_name)->subject('Регистрация на сайте "" ');
                });

                Auth::login($user);

            }

            $order['delivery'] = $data['delivery'];
//            $order['city'] = (isset($data['city']) ? $data['city'] : null);
            $order['address'] = (isset($data['address']) ? $data['address'] : null);

            $order = Order::create($order);

            foreach ($list_product as $item) {
                $order->addProduct($item['id'], $item['count']);
            }

            $pay_link = $this->testPay($email, $phone, $summ, $order->id);

            if (isset($pay_link['result'])) {
                $order->payment_id = $pay_link['result']['payment'];
                $order->save();

                return response()->json(['result' => true, 'redirect_to' => $pay_link['result']['url']]);
            } else {
                return response()->json(['result' => false, 'link' => $pay_link]);
            }

        } else {
            return response()->json(['result' => false]);
        }
    }

    public function testMail()
    {
        $order = Order::where('id', 3)->first();
        $product_list = $order->getProductList();
        $order->prodicts = $product_list;
//        $order->status = 1;
//        $order->save();

        $user = User::where('id', 1)->first();

        Mail::send('emails.for_the_seller', ['order' => $order, 'user' => $user], function ($m) {
            $m->from('styalmaty@gmail.com', 'Casada Kazakhstan');
            $m->to('styalmaty@gmail.com', 'Casada Kazakhstan')->subject('Новый заказ "" ');
        });
    }

    protected function randomPassword()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = []; //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
}
