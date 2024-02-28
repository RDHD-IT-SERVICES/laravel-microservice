<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    public function store(Request $request)
    {
        $product = Product::create($request->all());

        // return response()->json($product, 201);
        return response()->json($product->only(['name', 'price', 'created_at']), 201);
        // return new ProductResource($product);
    }

    /**
     * Add products from the POST request.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addProducts(Request $request)
    {
        $products = $request->all();
        $createdProducts = [];

        foreach ($products as $productData) {
            $createdProducts[] = Product::create([
                'name' => $productData['name'],
                'price' => $productData['price'],
            ]);
        }

        // Return a collection of ProductResource instances
        return ProductResource::collection(collect($createdProducts))
            ->response()
            ->setStatusCode(201);
    }

    // Add this method to your ProductController
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }

    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }
}
