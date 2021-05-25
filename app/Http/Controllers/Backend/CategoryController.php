<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function view()
    {
        $allData = Category::orderBy('id', "DESC")->get();
        return view('backend.category.view-category', compact('allData'));
    }
    public function add(Request $request)
    {
        return view('backend.category.add-category');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
        ]);
        $unit = Category::create([
            'name' => $request->name,
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->route('categories.view')->with('sfhjvggd', 'dsbhfjdrjsf');
    }

    public function edit($id)
    {
        $editData = Category::find($id);
        return view('backend.category.edit-category', compact('editData'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
        ]);
        $unit = Category::find($id);
        $unit->update([
            'name' => $request->name,
            'updated_by' => Auth::user()->id,
        ]);

        return redirect()->route('categories.view')->with('sfhjvggd', 'dsbhfjdrjsf');
    }


    public function destroy(Request $request, $id)
    {
        $unit = Category::find($id);
        $unit->delete();
        return redirect()->route('categories.view')->with('sfhjvggd', 'dsbhfjdrjsf');
    }
}
