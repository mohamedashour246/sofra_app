<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{

    public function index()
    {
        $cities = City::all();

        return view('cities.index',compact('cities'));
    }

    public function create()
    {
        return view('cities.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required'
        ],
        [
            'name.required' => 'ادخل اسم المدينة'
        ]
        );

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        City::create($request->all());

        return redirect()->route('cities.index')->with('success','City Created successfully');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $city = City::findOrFail($id);

        return view('cities.edit',compact('city'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $city = City::findOrFail($id);

        $city->update($request->all());

        return redirect()->route('cities.index')->with('success','City updated successfully');
    }

    public function destroy($id)
    {
        $city = City::findOrFail($id);

        $city->delete();

        return redirect()->route('cities.index')->with('success','City deleted successfully');
    }
}
