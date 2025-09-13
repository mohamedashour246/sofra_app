<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();

        return view('restaurants.index',compact('restaurants'));
    }

    public function deleteRestaurant($id)
    {
        $restaurant = Restaurant::findOrFail($id);

        $restaurant->delete();

        return redirect()->back()->with('success','restaurant deleted successfully');
    }

    public function changeRestaurantStatus(Request $request)
    {
        $restaurant = Restaurant::findOrFail($request->id);
        $restaurant->is_available = !$restaurant->is_available;
        $restaurant->save();

        return redirect()->back();
    }
}
