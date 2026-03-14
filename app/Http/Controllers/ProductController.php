<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        // $products = Product::all();
        $query = Product::query();

        if($request->has('min_price')) {
            $query->where('price', '>', $request->min_price);
        }

        if($request->has('in_stock')) {
            $query->where('stock', '>', $request->in_stock);
        }

        $products = $query->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Products retrieved successfully',
            'data' => $products->items(),
            'meta' => [
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
            ]
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        // 1. validasi input
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
        ], [
            'name.required' => 'Tolong dong nama produknya diisi',
            'name.min' => 'Tolong dong minimal 3 karakter untuk nama produk',
        ]);
        
        // 2. simpan data ke database
        $product = Product::create($validated);
        
        // 3. return response JSON
        return response()->json([
            'success' => true,
            'message' => 'Product created successfully',
            'data' => $product
        ]);
    }
}
