<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Customer;
use App\Model\Invoice;
use App\Model\InvoiceDetail;
use App\Model\Payment;
use App\Model\PaymentDetail;
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
        $data['currentDate'] = date('Y-m-d');
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
        // dd($request->all());
        if ($request->category_id == null) {
            return redirect()->back();
        } else {
            if ($request->paid_amount > $request->estimated_amount) {
                return redirect()->back();
            } else {
                $invoice = new Invoice();
                $invoice->invoice_no = $request->invoice_no;
                $invoice->date = date('Y-m-d', strtotime($request->date));
                $invoice->description = $request->description;
                $invoice->status = 0;
                $invoice->created_by = Auth::user()->id;
                DB::transaction(function () use ($request, $invoice) {
                    if ($invoice->save()) {
                        $count_category = count($request->category_id);
                        for ($i = 0; $i < $count_category; $i++) {
                            $invoice_details = new InvoiceDetail();
                            $invoice_details->date = date('Y-m-d', strtotime($request->date));
                            $invoice_details->invoice_id = $invoice->id;
                            $invoice_details->category_id = $request->category_id[$i];
                            $invoice_details->product_id = $request->product_id[$i];
                            $invoice_details->selling_qty = $request->selling_qty[$i];
                            $invoice_details->unit_price = $request->unit_price[$i];
                            $invoice_details->status = 1;
                            $invoice_details->save();
                        }
                        if ($request->customer_id == 0) {

                            $customer = new Customer();
                            $customer->name = $request->name;
                            $customer->mobile_no = $request->mobile_no;
                            $customer->address = $request->address;
                            $customer->save();
                            $customer_id = $customer->id;
                        } else {
                            $customer_id = $request->customer_id;
                        }
                        $payment_details = new PaymentDetail();
                        $payment = new Payment();
                        $payment->invoice_id = $invoice->id;
                        $payment->customer_id = $customer_id;
                        $payment->paid_status = $request->paid_status;
                        $payment->paid_amount = $request->paid_amount;
                        $payment->discount_amount = $request->discount_amount;
                        $payment->total_amount = $request->estimated_amount;
                        if ($request->paid_status == 'full_paid') {
                            $payment->paid_amount = $request->estimated_amount;
                            $payment->due_amount = '0';
                            $payment_details->current_paid_amount = $request->estimated_amount;
                        } elseif ($request->paid_status == 'full_due') {
                            $payment->paid_amount = '0';
                            $payment->due_amount = $request->estimated_amount;
                            $payment_details->current_paid_amount = '0';
                        } elseif ($request->paid_amount = 'partial_paid') {
                            $payment->paid_amount = $request->paid_amount;
                            $payment->due_amount = $request->estimated_amount->$request->paid_amount;
                            $payment_details->current_paid_amount = $request->paid_amount;
                        }
                        $payment->save();
                        $payment_details->invoice_id = $invoice->id;
                        $payment_details->date = date('Y-m-d', strtotime($request->date));
                        $payment_details->save();
                    }
                });
            }
        }

        return redirect()->route('invoice.view')->with('sfhjvggd', 'dsbhfjdrjsf');
    }

    // public function destroy(Request $request, $id)
    // {
    //     $purchase = Purchase::find($id);
    //     $purchase->delete();
    //     return redirect()->route('purchase.view')->with('sfhjvggd', 'dsbhfjdrjsf');
    // }


    // public function pending()
    // {
    //     $allData = Purchase::orderBy('id', "DESC")->where('status', 0)->get();
    //     return view('backend.purchase.pending.view-pending', compact('allData'));
    // }

    // public function approve($id)
    // {
    //     $purchase = Purchase::find($id);
    //     $product = Product::where('id', $purchase->product_id)->first();
    //     $purchase_qty = ((float)($purchase->buying_qty)) + ((float)($product->quentity));
    //     $product->quentity = $purchase_qty;
    //     if ($product->save()) {
    //         DB::table('purchases')
    //             ->where('id', $id)
    //             ->update(['status' => 1]);
    //     }
    //     return redirect()->route('purchase.pending.list');
    // }
}
