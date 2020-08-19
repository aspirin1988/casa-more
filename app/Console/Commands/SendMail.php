<?php

namespace App\Console\Commands;

use App\Order;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $order = Order::where('id', 386)->first();
        $product_list = $order->getProductList();
        $order->prodicts = $product_list;
//        $order->status = 1;
//        $order->save();

        $user = User::where('id', 1)->first();

        Mail::send('emails.for_the_seller', ['order' => $order, 'user' => $user], function ($m) {
            $m->from('info@casada.kz', 'Casada Kazakhstan');
            $m->to('info@casada.kz', 'Casada Kazakhstan')->subject('Новый заказ "" ');
        });
    }
}
