<?php

function responseJson($status, $msg, $data)
{
    return response()->json([
        'status' => $status,
        'msg' => $msg,
        'data' => $data
    ]);
}

function uploadImage($request,$name,$folder)
{
    $filename = $request->file($name)->getClientOriginalName();
    $request->file($name)->storeAs('uploads/'.$folder,$request->file($name)->getClientOriginalName(),'upload_images');

    return $filename;
}

function deleteImage($name,$folder)
{
    $exists = \Illuminate\Support\Facades\Storage::disk('upload_images')->exists('uploads/'.$folder.'/'.$name);

    if($exists) {
        \Illuminate\Support\Facades\Storage::disk('upload_images')->delete('uploads/'.$folder.'/'.$name);
    }
}

function settings()
{
    $settings = \App\Models\Settings::find(1);

    if($settings)
    {
        return $settings;
    }
    else {
        return new \App\Models\Settings();
    }
}
