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
        // return response()->json($product->only(['name', 'price', 'created_at']), 201);
        return new ProductResource($product);
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

    // New method for deleting multiple products
    public function destroyMultiple(Request $request)
    {
        $ids = $request->input('ids'); // Assuming 'ids' is an array of product IDs

        if (is_array($ids) && count($ids)) {
            Product::destroy($ids); // Eloquent's destroy method can accept an array of IDs
            return response()->json(['message' => 'Products deleted successfully'], 200);
        }

        return response()->json(['message' => 'No product IDs provided or invalid format'], 400);
    }

    // Method to show a single product
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // return response()->json($product, 200);
        return new ProductResource($product);
    }

    public function showMultiple(Request $request)
    {
        $ids = $request->input('ids');

        // Retrieve products that match the given IDs
        $products = Product::findMany($ids);

        // Wrap the products in the ProductResource, if you want to use resource for formatting
        return ProductResource::collection($products);
    }

    // Api method to list all products
    public function showAll()
    { 
        $products = Product::all();
        return ProductResource::collection($products);
    }

    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }
}
