<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function store(Request $request)
    {
        $product = Product::create($request->all());

        // return response()->json($product, 201);
        // return response()->json($product->only(['name', 'price', 'created_at']), 201);
        return new ProductResource($product);
    }
}
