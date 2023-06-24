<?php

namespace App\Http\Controllers\Landing;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['supplier', 'category'])
            ->search('name')
            ->latest()
            ->get();

        return view('landing.product.index',compact('products'));
    }

    public function show(Product $product)
    {
        return view('landing.product.show', compact('product'));
    }
}