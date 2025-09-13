<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\userMailable;
use App\Models\Client;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function registerClient(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'confirmation_password' => 'required|same:password',
            'phone' => 'required',
            'district_id' => 'required'
        ]);

        if ($validator->fails())
        {
            return responseJson(false,$validator->errors()->first(),$validator->errors());
        }

        $request->merge(['password' => bcrypt($request->password)]);
        $client = Client::create($request->all());
        $client->save();

        return responseJson(true,'data created successfully',$client);
    }

    public function loginClient(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return responseJson(false,$validator->errors()->first(),$validator->errors());
        }

        $client = Client::where('email',$request->email)->first();
        if ($client)
        {
            if(Hash::check($request->password,$client->password))
            {
                $token = $client->createToken('api_token')->plainTextToken;
                $client->api_token = $token;

                return responseJson(true,'تم تسجيل الدخول',$client);
            }
            else{
                return responseJson(false,'بيانات الدخول غير صحيحة',null);
            }
        }
        else {
            return responseJson(false,'حدث خطأ ما',null);
        }
    }

    public function registerRestaurant(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'confirmation_password' => 'required|same:password',
            'phone' => 'required',
            'district_id' => 'required',
            'cat_id' => 'required',
            'minimum_order' => 'required',
            'delivery_fees' => 'required',
            'phone_contact' => 'required',
            'phone_whatsapp' => 'required',
            'image' => 'required',
        ]);

        if ($validator->fails())
        {
            return responseJson(false,$validator->errors()->first(),$validator->errors());
        }

        $request->merge(['password' => bcrypt($request->password)]);
        $restaurant = Restaurant::create($request->all());

        $restaurant->image = uploadImage($request,'image','restaurants');

        $restaurant->save();

        return responseJson(true,'data created successfully',$restaurant);
    }

    public function loginRestaurant(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return responseJson(false,$validator->errors()->first(),$validator->errors());
        }

        $restaurant = Restaurant::where('email',$request->email)->first();
        if ($restaurant)
        {
            if(Hash::check($request->password,$restaurant->password))
            {
                $token = $restaurant->createToken('api_token')->plainTextToken;
                $restaurant->api_token = $token;

                return responseJson(true,'تم تسجيل الدخول',$restaurant);
            }
            else {
                return responseJson(false,'بيانات الدخول غير صحيحة',null);
            }
        }
        else {
            return responseJson(false,'لا يوجد مطاعم',null);
        }
    }

    public function resetRestaurantPassword(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'phone' => 'required'
        ]);

        if ($validator->fails())
        {
            return responseJson(true,$validator->errors()->first(),$validator->errors());
        }

        $restaurant = Restaurant::where('phone',$request->phone)->first();
        if($restaurant)
        {
            $code = rand(1111,9999);
            $update = $restaurant->update(['pin_code' => $code]);

            if ($update)
            {
                return responseJson(true,'success','pin code is '.$code);
            }
            else {
                return responseJson(false,'حدث خطأ ما',null);
            }
        }
        else {
            return responseJson(false,'حدث خطأ ما',null);
        }
    }

    public function updateRestaurantPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pin_code' => 'required',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return responseJson(false,$validator->errors()->first(),$validator->errors());
        }

        $restaurant = Restaurant::where('pin_code',$request->pin_code)->first();
        if($restaurant)
        {
            $restaurant->update(['password' => bcrypt($request->password)]);

            return responseJson(true,'تم التحديث بنجاح',null);
        }
        else {
            return responseJson(false,'حدث خطأ ما',null);
        }
    }

    public function resetClientPassword(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'phone' => 'required'
        ]);

        if ($validator->fails())
        {
            return responseJson(true,$validator->errors()->first(),$validator->errors());
        }

        $client = Client::where('phone',$request->phone)->first();
        if($client)
        {
            $code = rand(1111,9999);
            $update = $client->update(['pin_code' => $code]);

            if($update)
            {
                return responseJson(true,'success','pin code is '.$code);
            }
            else {
                return responseJson(false,'حدث خطأ ما',null);
            }
        }
        else {
            return responseJson(false,'حدث خطأ ما',null);
        }
    }

    public function updateClientPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pin_code' => 'required',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return responseJson(false,$validator->errors()->first(),$validator->errors());
        }

        $client = Client::where('pin_code',$request->pin_code)->first();
        if($client)
        {
            $client->update(['password' => bcrypt($request->password)]);

            return responseJson(true,'تم التحديث بنجاح',null);
        }
        else {
            return responseJson(false,'حدث خطأ ما',null);
        }
    }

    public function sendEmail()
    {
        Mail::to(Auth::user()->email)->send(new userMailable());

        return responseJson(true,'email sent',null);
    }


}
