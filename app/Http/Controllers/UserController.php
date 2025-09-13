<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('users.index',compact('users'));
    }

    public function create()
    {
        $roles = Role::all()->pluck('name','id')->toArray();
        return view('users.create',compact('roles'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ]);

        if ($validator->fails())
        {
            return redirect()->back()->with('fail',$validator->errors())->withInput();
        }

        $request->merge(['password' => bcrypt($request->password)]);
        $user = User::create($request->all());
        $user->roles()->attach($request->roles_list);

        return redirect()->route('users.index')->with('success','User created successfully');
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all()->pluck('name','id')->toArray();
       // dd($user->roles()->name);
        return view('users.edit',compact('user','roles'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'roles_list' => 'required'
        ]);

        if ($validator->fails())
        {
            return redirect()->back()->with('fail',$validator->errors())->withInput();
        }

        $user = User::findOrFail($id);

        $user->password = bcrypt($request->password);

        $user->update($request->all());
        $user->roles()->sync($request->roles_list);

        return redirect()->route('users.index')->with('success','User updated successfully');
    }

    public function destroy($id)
    {

    }
}
