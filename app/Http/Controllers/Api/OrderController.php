<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function addOrder(Request $request)
    {
        $validator = Validator::make($request->all(),[
              'restaurant_id' => 'required',
              'number' => 'required',
              'items.*.item_id' => 'required|exists:products,id',
              'items.*.quantity' => 'required',
              'address' => 'required',
              'payment_type' => 'required'
        ]);

        if($validator->fails())
        {
            return responseJson(false,$validator->errors()->first(),$validator->errors());
        }

        $restaurant = Restaurant::findOrFail($request->restaurant_id);
        if ($restaurant->is_available == 0)
        {
            return responseJson(false,'unavailable',null);
        }

        $order = $request->user()->orders()->create([
             'restaurant_id' => $request->restaurant_id,
             'number' => $request->number,
             'note' => $request->note,
             'order_state' => 'pending',
             'address' => $request->address,
             'payment_type' => $request->payment_type
        ]);

        $cost = 0;
        $price_delivery = $restaurant->delivery_fees;
        foreach($request->items as $i)
        {
          //  $item = Product::find($i['item_id']);
            $readyItem = [
              $i['item_id'] => [
                    'quantity' => $i['quantity'],
                    'price' => $i['price'],
                    'note' => (isset($i['note'])) ? $i['note'] : ''
              ]
            ];

            $order->products()->attach($readyItem);
            $cost += $i['price'] * $i['quantity'];
        }
        if($cost >= $restaurant->minimum_order)
        {
            $total = $cost + $price_delivery;
            $commission = settings()->commission * $cost;
            $remainder = $total - settings()->commission;
            $order->update([
                'price' => $cost,
                'price_delivery' => $price_delivery,
                'total' => $total,
                'commission' => $commission,
                'remainder' => $remainder
            ]);

            $order->notifications()->create([
                 'title' => 'new order',
                 'read_time' => Carbon::now(),
                 'order_id' => $order->id,
                 'notifiable_type' => 'App\Models\Restaurant',
                 'notifiable_id' => $restaurant->id
            ]);
            return  responseJson(true,'success',$order);
        }
        else
            {
            $order->products()->delete();
            $order->delete();

            return  responseJson(false,'order must be less than'.$restaurant->minimum_order,null);
        }
    }

    public function acceptOrder(Request $request)
    {
        $validator = Validator::make($request->all(),[
              'order_id' => 'required'
        ]);

        if($validator->fails())
        {
            return responseJson(false,$validator->errors()->first(),$validator->errors());
        }

        $order = Order::findOrFail($request->order_id);

        if(!$order)
        {
            return responseJson(false,'order not found',null);
        }

        if($order->order_state == 'pending')
        {
            $order->update([
                'order_state' => 'accepted'
            ]);

            return responseJson(true,'success',$order);
        }
        else {
            return responseJson(false,'order already accepted',null);
        }

    }

    public function rejectOrder(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'order_id' => 'required'
        ]);

        if($validator->fails())
        {
            return responseJson(false,$validator->errors()->first(),$validator->errors());
        }

        $order = Order::findOrFail($request->order_id);

        if(!$order)
        {
            return responseJson(false,'order not found',null);
        }

        if($order->order_state == 'pending')
        {
            $order->update([
                'order_state' => 'rejected'
            ]);

            return responseJson(true,'success',$order);
        }

        else {
            return responseJson(false,'order already rejected',null);
        }
    }

    public function deliverOrder(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'order_id' => 'required'
        ]);

        if($validator->fails())
        {
            return responseJson(false,$validator->errors()->first(),$validator->errors());
        }

        $order = Order::findOrFail($request->order_id);

        if(!$order)
        {
            return responseJson(false,'order not found',null);
        }

        if($order->order_state == 'accepted')
        {
            $order->update([
                'order_state' => 'delivered'
            ]);

            return responseJson(true,'success',$order);
        }

        else {
            return responseJson(false,'order not available',null);
        }
    }

    public function declineOrder(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'order_id' => 'required'
        ]);

        if($validator->fails())
        {
            return responseJson(false,$validator->errors()->first(),$validator->errors());
        }

        $order = Order::findOrFail($request->order_id);

        if(!$order)
        {
            return responseJson(false,'order not found',null);
        }

        if($order->order_state == 'accepted')
        {
            $order->update([
                'order_state' => 'decline'
            ]);

            return responseJson(true,'success',$order);
        }

        else {
            return responseJson(false,'order not available',null);
        }
    }

    public function addReview(Request $request)
    {
        $validator = Validator::make($request->all(),[
             'comment' => 'required',
             'rate' => 'required',
        ]);

        if($validator->fails())
        {
            return responseJson(false,$validator->errors()->first(),$validator->errors());
        }

        $review = $request->user()->reviews()->create([
            'comment' => $request->comment,
            'rate' => $request->rate
        ]);

        return responseJson(true,'success',$review);
    }
}
