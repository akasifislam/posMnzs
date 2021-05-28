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
        $all_category = Product::where('supplier_id', $supplier_id)->get();
        return $all_category;
    }
}
