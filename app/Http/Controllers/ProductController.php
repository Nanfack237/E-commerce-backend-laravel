<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Product::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric'
        ]);

        $product = Product::create($validated);

        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);

        if($product){
            return response()->json($product, 200);
        } else {
            $response = [
                'message' => 'Product not found',
            ];
            return response()->json($response);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric'
        ]);

        if($product){
            $product -> update($validated);
            return response()->json($product, 200);
        } else {
            $response = [
                'message' => 'Product not found'
            ];
            return response()->json($response, 404);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if($product){
            $product -> delete();
            return response()->json(null, 204);
        } else {
            $response = [
                'message' => 'Product not found'
            ];
            return response()->json($response, 404);
        }
    }
}
