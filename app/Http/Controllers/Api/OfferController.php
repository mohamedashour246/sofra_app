<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OfferController extends Controller
{
    public function addOffer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required',
            'description' => 'required',
            'available_from' => 'required',
            'available_to' => 'required',
        ]);

        if($validator->fails())
        {
            return responseJson(false,$validator->errors()->first(),$validator->errors());
        }

        $offer = $request->user()->offers()->create([
            'name' => $request->name,
            'image'=> uploadImage($request,'image','offers'),
            'description' => $request->description,
            'available_from' => date('Y-m-d',strtotime($request->available_from)),
            'available_to' => date('Y-m-d',strtotime($request->available_to)),
        ]);

        $offer->save();

        return responseJson(true,'offer created successfully',$offer);
    }

    public function updateOffer(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'nullable',
            'description' => 'required',
            'available_from' => 'required',
            'available_to' => 'required',
        ]);

        if($validator->fails())
        {
            return responseJson(false,$validator->errors()->first(),$validator->errors());
        }

        $offer = Offer::findOrFail($id);
        if(!$offer)
        {
            return responseJson(false,'لا توجد عروض',null);
        }

        $offer->name = $request->name;
        $offer->description = $request->description;
        $offer->available_from = date('Y-m-d',strtotime($request->available_from));
        $offer->available_to = date('Y-m-d',strtotime($request->available_to));

        if($request->hasFile('image'))
        {
            deleteImage($offer->image,'offers');

            uploadImage($request,'image','offers');

            $filename = $request->file('image')->getClientOriginalName();
            $offer->image = $offer->image !=$filename ? $filename : $offer->image;
        }

        $offer->update();

        return responseJson(true,'offer updated successfully',$offer);
    }

    public function deleteOffer($id)
    {
        $offer = Offer::findOrFail($id);
        if(!$offer)
        {
            return responseJson(false,'لا توجد عروض',null);
        }
        deleteImage($offer->image,'offers');

        $offer->delete();

        return responseJson(true,'تم الحذف بنجاح',null);
    }

}
