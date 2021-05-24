<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
{
    public function view()
    {
        $allData = Unit::orderBy('id', "DESC")->get();
        return view('backend.unit.view-unit', compact('allData'));
    }
    public function add(Request $request)
    {
        return view('backend.unit.add-unit');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
        ]);
        $supplier = Unit::create([
            'name' => $request->name,
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->route('units.view')->with('sfhjvggd', 'dsbhfjdrjsf');
    }

    public function edit($id)
    {
        $editData = Unit::find($id);
        return view('backend.unit.edit-unit', compact('editData'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
        ]);
        $supplier = Unit::find($id);
        $supplier->update([
            'name' => $request->name,
            'updated_by' => Auth::user()->id,
        ]);

        return redirect()->route('units.view')->with('sfhjvggd', 'dsbhfjdrjsf');
    }


    public function destroy(Request $request, $id)
    {
        $supplier = Unit::find($id);
        $supplier->delete();
        return redirect()->route('units.view')->with('sfhjvggd', 'dsbhfjdrjsf');
    }
}
