<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function editSetting()
    {
        $setting = Settings::find(1);

        return view('setting.edit',compact('setting'));
    }

    public function updateSetting(Request $request)
    {
        $setting = Settings::findOrFail($request->id)->first();

        $setting->update($request->all());

        return redirect()->back()->with('success','تم التعديل بنجاح');
    }
}
