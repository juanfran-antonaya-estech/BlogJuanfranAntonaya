<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all()->sortByDesc('created_at');
        return view('product.products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sellers = User::all();
        return view('product.newproduct', compact('sellers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->only('name', 'description', 'quantity','seller_id', 'status', 'image');

        $validations = [
            'name' => 'required|min:5|max:255',
            'description' => 'required|min:5|max:255',
            'quantity' => 'required|numeric',
            'seller_id' => 'required',
            'status' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];

        $messages = [
            'required' => 'El campo :attribute es obligatorio',
            'min' => 'El campo :attribute debe tener al menos :min caracteres',
            'max' => 'El campo :attribute no debe superar los :max caracteres',
            'image' => 'El campo :attribute debe ser una imagen'
        ];

        $this->validate($request, $validations, $messages);

        if($request -> hasFile('image')){
            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $data['image'] = 'images/'.$imageName;
        }

        $prod = Product::create($data);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        return view('product.product', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sellers = User::all();
        $product = Product::find($id);
        return view('product.editproduct', compact('product', 'sellers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->only('name', 'description', 'quantity', 'seller_id', 'status');

        // Validaciones
        $validations = [
            'name' => 'required|min:5|max:255',
            'description' => 'required|min:5|max:255',
            'quantity' => 'required|numeric',
            'seller_id' => 'required',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:2048'
        ];

        $this->validate($request, $validations);

        // Si se sube una nueva imagen, reemplazar la existente
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $data['image'] = 'images/' . $imageName;
        }

        // Actualizar el producto
        $product->update($data);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('products.index');
    }
}
