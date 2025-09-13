<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Settings;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function offers(Request $request)
    {
        $id = $request->user()->id;
        $offers = Offer::where('restaurant_id',$id)->get();

        return responseJson(true,'success',$offers);
    }

    public function products()
    {
        $products = Product::all();

        return responseJson(true,'success',$products);
    }

    public function orders(Request $request)
    {
        $orders = Order::where('restaurant_id',$request->user()->id)->get();

        return responseJson(true,'success',$orders);
    }

    public function commissions(Request $request)
    {
        $price = $request->user()->orders()->sum('price');
     //   $total = $request->user()->orders()->sum('total');
        $commission = $request->user()->orders()->sum('commission');
        $payments = $request->user()->payments()->sum('cost');

        $remainder = $commission - $payments;

        $data = [
            'price' => $price,
            'commission' => $commission,
            'payments' => $payments,
            'remainder' => $remainder
        ];

        return responseJson(true,'success',$data);
    }

    public function settings($id)
    {
        $setting = Settings::findOrFail($id);

        $data = [
            'phone' => $setting->phone,
            'email' => $setting->email,
            'commission' => $setting->commission,
        ];

        return responseJson(true,'success',$data);
    }
}
