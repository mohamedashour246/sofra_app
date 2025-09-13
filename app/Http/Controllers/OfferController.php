<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::all();

        return view('offers.index',compact('offers'));
    }

    public function deleteOffer($id)
    {
        $offer = Offer::findOrFail($id);

        $offer->delete();

        return redirect()->route('offers.index')->with('success','Offer deleted successfully');
    }
}
