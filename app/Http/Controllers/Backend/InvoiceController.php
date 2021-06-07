<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Customer;
use App\Model\Invoice;
use App\Model\Product;
use App\Model\Purchase;
use App\Model\Supplier;
use App\Model\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function view()
    {
        $allData = Invoice::orderBy('id', "DESC")->get();
        return view('backend.invoice.view-invoice', compact('allData'));
    }
    public function add(Request $request)
    {
        $data['categories'] = Category::orderBy('id', 'DESC')->get();
        $data['suppliers'] = Supplier::orderBy('id', 'DESC')->get();
        $data['units'] = Unit::orderBy('id', 'DESC')->get();
        $data['customers'] = Customer::orderBy('id', 'DESC')->get();
        $invoice_data = Invoice::orderBy('id', 'DESC')->first();
        if ($invoice_data == null) {
            $firstReg = 0;
            $data['invoice_no'] = $firstReg + 1;
        } else {
            $invoice_data = Invoice::orderBy('id', 'DESC')->first()->invoice_no;
            $data['invoice_no'] = $invoice_data + 1;
        }
        return view('backend.invoice.add-invoice', $data);
    }

    public function store(Request $request)
    {
        if ($request->category_id == null) {
            dd('eeee');
        }else{
            dd('sfjgkbd');
        }
        return redirect()->route('purchase.view')->with('sfhjvggd', 'dsbhfjdrjsf');
    }

    public function destroy(Request $request, $id)
    {
        $purchase = Purchase::find($id);
        $purchase->delete();
        return redirect()->route('purchase.view')->with('sfhjvggd', 'dsbhfjdrjsf');
    }


    public function pending()
    {
        $allData = Purchase::orderBy('id', "DESC")->where('status', 0)->get();
        return view('backend.purchase.pending.view-pending', compact('allData'));
    }

    public function approve($id)
    {
        $purchase = Purchase::find($id);
        $product = Product::where('id', $purchase->product_id)->first();
        $purchase_qty = ((float)($purchase->buying_qty)) + ((float)($product->quentity));
        $product->quentity = $purchase_qty;
        if ($product->save()) {
            DB::table('purchases')
                ->where('id', $id)
                ->update(['status' => 1]);
        }
        return redirect()->route('purchase.pending.list');
    }
}
