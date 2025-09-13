<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DistrictController extends Controller
{

    public function index()
    {
        $districts = District::all();

        return view('districts.index',compact('districts'));
    }

    public function create()
    {
        $cities = City::all();

        return view('districts.create',compact('cities'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'city_id' => 'required'
        ],
        [
            'name.required' => 'ادخل اسم الحى',
            'city_id.required' => 'ادخل المدينة'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        District::create($request->all());

        return redirect()->route('districts.index')->with('success','district created successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $district = District::findOrFail($id);
        $cities = City::all();

        return view('districts.edit',compact('district','cities'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'city_id' => 'required'
        ],
            [
                'name.required' => 'ادخل اسم الحى',
                'city_id.required' => 'ادخل المدينة'
            ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $district = District::findOrFail($id);
        $district->update($request->all());

        return redirect()->route('districts.index')->with('success','district updated successfully');

    }

    public function destroy($id)
    {
        $district = District::findOrFail($id);

        $district->delete();

        return redirect()->route('districts.index')->with('success','district deleted successfully');

    }
}
