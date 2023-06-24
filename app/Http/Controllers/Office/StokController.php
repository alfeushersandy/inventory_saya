<?php

namespace App\Http\Controllers\Office;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function index()
    {
        $products = Product::with(['supplier', 'category'])
            ->search('name')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('office.stock.index', compact('products'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update([
            'quantity' => $request->quantity,
        ]);

        return back()->with('toast_success', 'Stok berhasil disimpan');
    }
}
