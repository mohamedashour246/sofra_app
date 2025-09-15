<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    public function index(Category $category)
    {
       // $this->authorize('viewAny',$category);

        $categories = Category::all();
        return view('categories.index',compact('categories'));
    }

    public function create()
    {
        $this->authorize('create', Category::class);

        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required'
        ],
        [
            'name.required' => 'ادخل اسم التصنيف'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
      //  $this->authorize('create',Category::class);

        Category::create($request->all());

        return redirect()->route('categories.index')->with('success','Category created successfully');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('categories.edit',compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ],
        [
            'name.required' => 'ادخل اسم التصنيف'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with($validator)->withInput();
        }

        $category = Category::findOrFail($id);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('success','Category updated successfully');

    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success','Category deleted successfully');

    }
}
