<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();

        return view('clients.index',compact('clients'));
    }

    public function deleteClient($id)
    {
        $client = Client::findOrFail($id);

        $client->delete();

        return redirect()->back()->with('success','client deleted successfully');
    }

    public function changeClientStatus(Request $request)
    {
        $client = Client::findOrFail($request->id);
        $client->is_active = !$client->is_active;
        $client->save();

        return redirect()->back();
    }

}
