<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::all();
        return view('roles.index',compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:roles',
            'guard_name' => 'required',
            'permission_list' => 'required',
        ]);

        if ($validator->fails())
        {
            return redirect()->back()->with('fail',$validator->errors())->withInput();
        }

        $role = Role::create($request->all());
        $role->permissions()->attach($request->permission_list);

        return redirect()->route('roles.index')->with('success','تم الاضافة بنجاح');
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);

        return view('roles.edit',compact('role'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'guard_name' => 'required',
            'permission_list' => 'required',
        ]);

        if ($validator->fails())
        {
            return redirect()->back()->with('fail',$validator->errors())->withInput();
        }

        $role = Role::findOrFail($id);
        $role->update($request->all());
        $role->permissions()->sync($request->permission_list);

     //   dd($role->permissions());
        return redirect()->route('roles.index')->with('success','Role Updated successfully');
    }

    public function destroy($id)
    {

    }
}
