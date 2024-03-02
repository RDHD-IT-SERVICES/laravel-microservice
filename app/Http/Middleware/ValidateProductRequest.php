<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidateProductRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Define your validation rules here
        //using the request helper to access the current route
        if ($request->route()->getName() == 'route.add-product') {
            $rules = [
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                // Add any other product-specific validation rules here
            ];
        }

        if ($request->route()->getName() == 'route.add-products') {
            $rules = [
                '*.name' => 'required|string|max:255',
                '*.price' => 'required|numeric|min:0',
                // Add any other product-specific validation rules here
            ];
        }

        if ($request->route()->getName() == 'route.show-multiple-products' || $request->route()->getName() == 'route.delete-multiple-products') {
            $rules = [
                'ids' => 'required|array',
                'ids.*' => 'exists:products,id' // Ensure each ID in the array exists in the products table
            ];
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422);
        }

        return $next($request);
    }
}
