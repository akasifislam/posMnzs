<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function view()
    {
        $allData = Supplier::orderBy('id', "DESC")->get();
        return view('backend.supplier.view-supplier', compact('allData'));
    }
    public function add(Request $request)
    {
        return view('backend.supplier.add-supplier');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'mobile_no' => 'required',
        ]);
        $supplier = Supplier::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'created_by' => Auth::user()->id,
            'mobile_no' => $request->mobile_no,
        ]);

        return redirect()->route('suppliers.view')->with('sfhjvggd', 'dsbhfjdrjsf');
    }

    public function edit($id)
    {
        $editData = Supplier::find($id);
        return view('backend.supplier.edit-supplier', compact('editData'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'mobile_no' => 'required',
        ]);
        $supplier = Supplier::find($id);
        $supplier->update([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'updated_by' => Auth::user()->id,
            'mobile_no' => $request->mobile_no,
        ]);

        return redirect()->route('suppliers.view')->with('sfhjvggd', 'dsbhfjdrjsf');
    }
}
