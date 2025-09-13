<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
     public function addProduct(Request $request)
     {
         $validator = Validator::make($request->all(),[
             'name' => 'required',
             'image' => 'required',
             'description' => 'required',
             'price' => 'required',
             'price_offer' => 'required',
         ]);

         if($validator->fails())
         {
             return responseJson(false,$validator->errors()->first(),$validator->errors());
         }

         $product = Product::create($request->all());

         $product->image = uploadImage($request,'image','products');
         $product->save();

         return responseJson(true,'product created successfully',$product);
     }

     public function updateProduct(Request $request,$id)
     {
         $validator = Validator::make($request->all(),[
             'name' => 'required',
             'image' => 'required',
             'description' => 'required',
             'price' => 'required',
             'price_offer' => 'required',
         ]);

         if($validator->fails())
         {
             return responseJson(false,$validator->errors()->first(),$validator->errors());
         }

         $product = Product::findOrFail($id);
         if(!$product)
         {
             return responseJson(false,'لا توجد منتجات',null);
         }

         $product->name = $request->name;
         $product->description = $request->description;
         $product->price = $request->price;
         $product->price_offer = $request->price_offer;
         $product->order_time = $request->order_time;

         if($request->hasFile('image'))
         {
             deleteImage($product->image,'products');

             uploadImage($request,'image','products');

             $filename = $request->file('image')->getClientOriginalName();
             $product->image = $product->image != $filename ? $filename : $product->image;
         }

         $product->update();

         return responseJson(true,'product updated successfully',$product);
     }

     public function deleteProduct($id)
     {
         $product = Product::findOrFail($id);
         if(!$product)
         {
             return responseJson(false,'لا توجد عروض',null);
         }
         deleteImage($product->image,'products');

         $product->delete();

         return responseJson(true,'تم الحذف بنجاح',null);
     }
}
