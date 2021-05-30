<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Product;
use App\Model\Purchase;
use App\Model\Supplier;
use App\Model\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function view()
    {
        $allData = Purchase::orderBy('id', "DESC")->get();
        return view('backend.purchase.view-purchase', compact('allData'));
    }
    public function add(Request $request)
    {
        $data['suppliers'] = Supplier::orderBy('id', 'DESC')->get();
        $data['categories'] = Category::orderBy('id', 'DESC')->get();
        $data['units'] = Unit::orderBy('id', 'DESC')->get();
        return view('backend.purchase.add-purchase', $data);
    }

    public function store(Request $request)
    {
        if ($request->category_id == null) {
            return redirect()->back()->with('error', 'you do not fuillup form');
        } else {
            $count_category = count($request->category_id);
            for ($i = 0; $i < $count_category; $i++) {
                $purchase = new Purchase();
                $purchase->date = date('Y-m-d', strtotime($request->date[$i]));
                $purchase->purchase_no = $request->purchase_no[$i];
                $purchase->supplier_id = $request->supplier_id[$i];
                $purchase->category_id = $request->category_id[$i];
                $purchase->product_id = $request->product_id[$i];
                $purchase->buying_qty = $request->buying_qty[$i];
                $purchase->unit_price = $request->unit_price[$i];
                $purchase->buying_price = $request->buying_price[$i];
                $purchase->description = $request->description[$i];
                $purchase->status = '0';
                $purchase->created_by = Auth::user()->id;
                $purchase->save();
            }
        }




        // return $request;
        // $this->validate($request, [
        //     'name' => 'required|string',
        //     'supplier_id' => 'required',
        //     'category_id' => 'required',
        //     'unit_id' => 'required',
        // ]);
        // $unit = Product::create([
        //     'name' => $request->name,
        //     'supplier_id' => $request->supplier_id,
        //     'category_id' => $request->category_id,
        //     'unit_id' => $request->unit_id,
        //     'created_by' => Auth::user()->id,
        // ]);

        return redirect()->route('purchase.view')->with('sfhjvggd', 'dsbhfjdrjsf');
    }

    public function edit($id)
    {
        $data['editData'] = Product::find($id);
        $data['suppliers'] = Supplier::orderBy('id', 'DESC')->get();
        $data['categories'] = Category::orderBy('id', 'DESC')->get();
        $data['units'] = Unit::orderBy('id', 'DESC')->get();
        return view('backend.purchase.edit-purchase', $data);
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
