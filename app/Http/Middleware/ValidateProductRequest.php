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
        $rules = [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            // Add any other product-specific validation rules here
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            // Return a JSON response with errors
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422); // HTTP status code 422 indicates unprocessable entity
        }

        return $next($request);
    }
}
