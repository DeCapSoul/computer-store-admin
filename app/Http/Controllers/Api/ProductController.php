<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //index all products
        $products = Product::all();
        return responseSuccess($products, 'Products retrieved successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'description' => 'required',
            'price' => 'required',
            'code' => 'required'
        ]);

        DB::beginTransaction();

        try {
            $product = new Product();
            $product->name = $request->name;
            $product->image = $request->image;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->code = $request->code;
            $product->save();

            DB::commit();

            return responseSuccess($product, 'Product created successfully', 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return responseFailed('Product creation failed: ' . $e->getMessage(), 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $product = Product::find($request->id);
        if (!$product) {
            return responseFailed('Product not found', 404);
        }

        return responseSuccess($product, 'Product retrieved successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'description' => 'required',
            'price' => 'required',
            'code' => 'required'
        ]);

        DB::beginTransaction();

        try {
            $product->name = $request->name;
            $product->image = $request->image;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->code = $request->code;
            $product->save();

            DB::commit();

            return responseSuccess($product, 'Product updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return responseFailed('Product update failed: ' . $e->getMessage(), 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //delete a product by id
        DB::beginTransaction();

        try {
            $product->delete();
            DB::commit();

            return responseSuccess([], 'Product deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return responseFailed('Product deletion failed: ' . $e->getMessage(), 500);
        }
    }
}
