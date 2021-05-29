<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Product;
use App\Model\Purchase;
use App\Model\Supplier;
use App\Model\Unit;
use Illuminate\Http\Request;

class DefaultController extends Controller
{
    public function getCategory(Request $request)
    {
        $supplier_id = $request->supplier_id;
        $all_category = Product::with(['category'])->select('category_id')->where('supplier_id', $supplier_id)->groupBy('category_id')->get();
        // dd($all_category->toArray());
        return response()->json($all_category);
    }
    public function getProduct(Request $request)
    {
        $category_id = $request->category_id;
        $all_product = Product::where('category_id', $category_id)->get();
        return response()->json($all_product);
    }
}
