<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Product;
use App\Model\Supplier;
use App\Model\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function view()
    {
        $allData = Product::orderBy('id', "DESC")->get();
        return view('backend.product.view-product', compact('allData'));
    }
    public function add(Request $request)
    {
        $data['suppliers'] = Supplier::orderBy('id', 'DESC')->get();
        $data['categories'] = Category::orderBy('id', 'DESC')->get();
        $data['units'] = Unit::orderBy('id', 'DESC')->get();
        return view('backend.product.add-product', $data);
    }

    public function store(Request $request)
    {
        // return $request;
        $this->validate($request, [
            'name' => 'required|string',
            'supplier_id' => 'required',
            'category_id' => 'required',
            'unit_id' => 'required',
        ]);
        $unit = Product::create([
            'name' => $request->name,
            'supplier_id' => $request->supplier_id,
            'category_id' => $request->category_id,
            'unit_id' => $request->unit_id,
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->route('products.view')->with('sfhjvggd', 'dsbhfjdrjsf');
    }

    public function edit($id)
    {
        $data['editData'] = Product::find($id);
        $data['suppliers'] = Supplier::orderBy('id', 'DESC')->get();
        $data['categories'] = Category::orderBy('id', 'DESC')->get();
        $data['units'] = Unit::orderBy('id', 'DESC')->get();
        return view('backend.product.edit-product', $data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'supplier_id' => 'required',
            'category_id' => 'required',
            'unit_id' => 'required',
        ]);
        $unit = Product::find($id);
        $unit->update([
            'name' => $request->name,
            'supplier_id' => $request->supplier_id,
            'category_id' => $request->category_id,
            'unit_id' => $request->unit_id,
            'updated_by' => Auth::user()->id,
        ]);

        return redirect()->route('products.view')->with('sfhjvggd', 'dsbhfjdrjsf');
    }


    public function destroy(Request $request, $id)
    {
        $unit = Product::find($id);
        $unit->delete();
        return redirect()->route('products.view')->with('sfhjvggd', 'dsbhfjdrjsf');
    }
}
