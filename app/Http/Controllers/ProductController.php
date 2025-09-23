<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //index
    public function index()
    {
        $products = Product::all();

        $data = [
            'status' => true,
            'message' => 'Products retrieved successfully',
            'data' => $products
        ];

        return response()->json($data);
    }

    // store
    public function store(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'brand_id' => 'required|integer|exists:brands,id',
            'is_active' => 'boolean'
        ]);

        // dd($validator->errors());

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

        $product = Product::create($request->all());

        $data = [
            'status' => true,
            'message' => 'Product created successfully',
            'data' => $product
        ];

        return response()->json($data, 201);
    }

    // update

    public function update(Request $request, $id)
    {
        if(!is_numeric($id)){
            return response()->json([
                'status' => false,
                'message' => 'Invalid product ID'
            ], 400);
        }


        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric',
            'stock_quantity' => 'sometimes|required|integer',
            'brand_id' => 'sometimes|required|integer|exists:brands,id',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

        $product->update($request->all());

        $data = [
            'status' => true,
            'message' => 'Product updated successfully',
            'data' => $product
        ];

        return response()->json($data);
    }


    // delete
    public function destroy($id)
    {
        if(!is_numeric($id)){
            return response()->json([
                'status' => false,
                'message' => 'Invalid product ID'
            ], 400);
        }

        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found'
            ], 404);
        }

        $product->delete();

        $data = [
            'status' => true,
            'message' => 'Product deleted successfully'
        ];

        return response()->json($data);
    }


}
