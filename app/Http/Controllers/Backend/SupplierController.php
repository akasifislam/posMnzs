<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function view()
    {
        $allData = Supplier::all();
        return view('backend.supplier.view-supplier', compact('allData'));
    }


    public function edit(Request $request)
    {
        return $request;
    }
    public function add(Request $request)
    {
        return view('backend.supplier.add-supplier');
    }

    public function store(Request $request)
    {
        return $request;
    }
}
