<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function view()
    {
        $allData = Customer::orderBy('id', "DESC")->get();
        return view('backend.customer.view-customer', compact('allData'));
    }
    public function add(Request $request)
    {
        return view('backend.customer.add-customer');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'mobile_no' => 'required',
        ]);
        $supplier = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'created_by' => Auth::user()->id,
            'mobile_no' => $request->mobile_no,
        ]);

        return redirect()->route('customers.view')->with('sfhjvggd', 'dsbhfjdrjsf');
    }

    public function edit($id)
    {
        $editData = Customer::find($id);
        return view('backend.customer.edit-customer', compact('editData'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'mobile_no' => 'required',
        ]);
        $supplier = Customer::find($id);
        $supplier->update([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'updated_by' => Auth::user()->id,
            'mobile_no' => $request->mobile_no,
        ]);

        return redirect()->route('customers.view')->with('sfhjvggd', 'dsbhfjdrjsf');
    }


    public function destroy(Request $request, $id)
    {
        $supplier = Customer::find($id);
        $supplier->delete();
        return redirect()->route('customers.view')->with('sfhjvggd', 'dsbhfjdrjsf');
    }
}
