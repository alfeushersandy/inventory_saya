<?php

namespace App\Http\Controllers\Landing;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $products = Product::with(['supplier', 'category'])
            ->latest()
            ->paginate(6)
            ->withQueryString();

        $categories = Category::withCount('products')
            ->latest()
            ->get();

        return view('landing.welcome', compact('products', 'categories'));
    }
}