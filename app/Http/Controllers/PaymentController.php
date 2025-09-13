<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{

    public function index()
    {
        $payments = Payment::all();
        return view('payments.index',compact('payments'));
    }

    public function create()
    {
        $restaurants = Restaurant::all()->pluck('name','id')->toArray();
        return view('payments.create',compact('restaurants'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'cost' => 'required',
            'restaurant_id' => 'required',
            'note' => 'required',
            'date_pay' => 'required',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('fail',$validator->errors())->withInput();
        }

        $payment = Payment::create($request->all());
        $payment->save();

        return redirect()->route('payments.index')->with('success','تم الحفظ بنجاح');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        $restaurants = Restaurant::all();
        return view('payments.edit',compact('payment','restaurants'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'cost' => 'required',
            'restaurant_id' => 'required',
            'note' => 'required',
            'date_pay' => 'required',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('fail',$validator->errors())->withInput();
        }

        $payment = Payment::findOrFail($id);

        $payment->update($request->all());

        return redirect()->route('payments.index')->with('success','تم التعديل بنجاح');
    }

    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return redirect()->route('payments.index')->with('success','تم الحذف بنجاح');
    }
}
