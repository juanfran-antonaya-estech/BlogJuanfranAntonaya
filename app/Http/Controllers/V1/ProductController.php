<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::with('seller')->get()->toArray();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5|max:255',
            'description' => 'required|min:5|max:255',
            'quantity' => 'required|numeric',
            'status' => 'required',
            'seller_id' => 'required'
        ]);

        $prod = Product::create($request->all());

        return $prod;
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
        $request->validate([
            'name' => 'required|min:5|max:255',
            'description' => 'required|min:5|max:255',
            'quantity' => 'required|numeric',
            'status' => 'required',
        ]);
        $product->update($request->all());
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            'message' => 'Producto eliminado'
        ], 204);
    }
}
