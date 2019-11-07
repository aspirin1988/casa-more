<div style="color:#333333;font-family:Arial,sans-serif;font-size:14px;line-height:1.429">
    <table cellpadding="0" cellspacing="0" width="100%"
           style="border-collapse:collapse;background-color:#f5f5f5;border-collapse:collapse" bgcolor="#f5f5f5">
        <tbody>
        <tr>
            <td style="padding:0px;border-collapse:collapse;padding:10px 20px">
                <table cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse">
                    <tbody>
                    <tr>
                        <td style="padding:0px;border-collapse:collapse;vertical-align:middle;font-family:Arial,sans-serif;font-size:18px;line-height:20px">
                            <strong>У Вас новая заявка!</strong><br>
                            <div style="margin-top:10px; color:#3b73af;text-decoration:none">
                                <a href="{{url('/')}}" style="color:#3b73af;text-decoration:none">{{url('/')}}</a>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding:0px;border-collapse:collapse;padding:0 20px">
                <table cellspacing="0" cellpadding="0" border="0" width="100%"
                       style="border-collapse:collapse;border-spacing:0;border-collapse:separate">
                    <tbody>
                    <tr>
                        <td style="padding:0px;border-collapse:collapse;color:#ffffff;padding:0 15px 0 16px;height:15px;background-color:#ffffff;border-left:1px solid #cccccc;border-top:1px solid #cccccc;border-right:1px solid #cccccc;border-bottom:0;border-top-right-radius:5px;border-top-left-radius:5px;height:10px;line-height:10px;padding:0 15px 0 16px"
                            height="10" bgcolor="#ffffff"></td>
                    </tr>
                    <tr>
                        <td style="padding:0px;border-collapse:collapse;border-left:1px solid #cccccc;border-right:1px solid #cccccc;border-top:0;border-bottom:0;padding:0 15px 0 16px;background-color:#ffffff"
                            bgcolor="#ffffff">
                            <table cellspacing="0" cellpadding="0" border="0" width="100%"
                                   style="    border-collapse: collapse; border-spacing: 0; width: 100%; margin-bottom: 20px;">
                                <tbody>
                                <tr>
                                    <td style="vertical-align:top;padding:0px;border-collapse:collapse;padding-right:5px;font-size:20px;line-height:30px">
                                        <span style="font-family:Arial,sans-serif;padding:0;font-size:20px;line-height:30px;vertical-align:middle">
                                            <p style="color:#3b73af;text-decoration:none">
                                                <strong>№ {{$order->id}} заказ:</strong>
                                                @if($order->status)
                                                    <span style="margin-left: 10px;background: #0d8c00;color: #fff;padding: 5px 10px;">Оплачен</span>
                                                @endif
                                                @if(!$order->status)
                                                    <span style="margin-left: 10px;background: #f0506e;color: #fff;padding: 5px 10px;">Не оплачен</span>
                                                @endif
                                            </p>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p style="color:#3b73af;text-decoration:none; margin-top:20px">
                                            <strong>Условия доставки:</strong>
                                        </p>
                                        @if($order->delivery == 0)
                                            <p style="font-weight: bold;">Самовывоз</p>
                                        @endif
                                        @if($order->delivery == 1)
                                            <p style="font-weight: bold;">Доставка по Алматы: <span
                                                        style="color:#3b73af">{{$order->address}}</span></p>
                                        @endif
                                        @if($order->delivery == 2)
                                            <p style="font-weight: bold;">Доставка по Казахстану
                                                <strong>({{$order->city}})</strong>: <span
                                                        style="color:#3b73af">{{$order->address}}</span></p>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><br></td>
                                </tr>
                                <tr>
                                    <td>
                                        <p style="color:#3b73af;text-decoration:none; margin-top:20px">
                                            <strong>Контактная информация:</strong>
                                        </p>
                                        <p style="font-weight: bold;">Имя: <span style="color:#3b73af">{{$user->first_name}} {{$user->last_name}}</span></p>
                                        <p style="font-weight: bold;">Телефон: <a href="tel:{{$user->phone}}" style="color:#3b73af">{{$user->phone}}</a></p>
                                        <p style="font-weight: bold;">Email: <a href="mailto:{{$user->email}}" style="color:#3b73af">{{$user->email}}</a></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><br></td>
                                </tr>
                                <tr>
                                    <td style="vertical-align:top;padding:10px 0;border-collapse:collapse;padding-right:5px;font-size:20px;line-height:30px">
                                        <table class="uk-table uk-table-divider"
                                               style="border-collapse: collapse; border-spacing: 0; width: 100%; margin-bottom: 20px;">
                                            <thead>
                                            <tr>
                                                <th style="padding: 16px 12px; text-align: left; vertical-align: bottom; font-size: 12px; font-weight: normal; color: #999; text-transform: uppercase;">
                                                    Название
                                                </th>
                                                <th style="padding: 16px 12px; text-align: left; vertical-align: bottom; font-size: 12px; font-weight: normal; color: #999; text-transform: uppercase;">
                                                    Цена за (ед.т)
                                                </th>
                                                <th style="padding: 16px 12px; text-align: left; vertical-align: bottom; font-size: 12px; font-weight: normal; color: #999; text-transform: uppercase;">
                                                    Количество
                                                </th>
                                                <th style="padding: 16px 12px; text-align: left; vertical-align: bottom; font-size: 12px; font-weight: normal; color: #999; text-transform: uppercase;">
                                                    Сумма
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($order->getProductList() as $product)
                                                <tr style="border-top: 1px solid #e5e5e5;">
                                                    <td style="padding: 16px 12px; vertical-align: top;">{{$product->name}}</td>
                                                    <td style="padding: 16px 12px; vertical-align: top;">{{($product->discount?($product->price-(($product->price/100)*$product->discount)):$product->price)}}</td>
                                                    <td style="padding: 16px 12px; vertical-align: top;">{{$product->count}}</td>
                                                    <td style="padding: 16px 12px; vertical-align: top;">{{$product->price*$product->count}}</td>
                                                </tr>
                                            @endforeach
                                            <tr style="background: #f8f8f8;">
                                                <td style="padding: 16px 12px; vertical-align: top;">Итого:</td>
                                                <td style="padding: 16px 12px; vertical-align: top;"></td>
                                                <td style="padding: 16px 12px; vertical-align: top;"></td>
                                                <td style="padding: 16px 12px; vertical-align: top;"></td>
                                                <td style="padding: 16px 12px; vertical-align: top;">{{$order->price}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0px;border-collapse:collapse;border-left:1px solid #cccccc;border-right:1px solid #cccccc;border-top:0;border-bottom:0;padding:0 15px 0 16px;background-color:#ffffff;border-bottom:none;padding-bottom:0"
                            bgcolor="#ffffff">
                            <table border="0" width="100%"
                                   style="border-collapse:collapse;font-family:Arial,sans-serif;font-size:14px;line-height:20px">
                                <tbody>
                                <tr>
                                    <td style="padding:0px;border-collapse:collapse;padding:0 0 10px 0">
                                        <p style="margin:10px 0 0;">
                                            <a style="font-size: 20px; margin-left: 20px; text-decoration: none; color:#3b73af"
                                               href="{{url('/login')}}">Личный кабинет</a>
                                        </p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0px;border-collapse:collapse;color:#ffffff;padding:0 15px 0 16px;height:5px;line-height:5px;background-color:#ffffff;border-top:0;border-left:1px solid #cccccc;border-bottom:1px solid #cccccc;border-right:1px solid #cccccc;border-bottom-right-radius:5px;border-bottom-left-radius:5px"
                            height="5" bgcolor="#ffffff">&nbsp;
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding:0px;border-collapse:collapse;padding:12px 20px">
                <table cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse">
                    <tbody>
                    <tr>
                        <td style="padding:0px;border-collapse:collapse;padding-left:20px;vertical-align:top">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
</div>
