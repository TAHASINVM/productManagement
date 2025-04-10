<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the product.
     *
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        $products = ProductResource::collection(
            app(ProductRepositoryInterface::class)->list()
        );
        return response()->json([
            'status' => true,
            'data' => $products
        ]);
    }

    /**
     * Store a newly created product in storage.
     *
     * @param ProductRequest $request
     * @return JsonResponse
     */
    public function store(ProductRequest $request) : JsonResponse
    {
        try {
            $product = new ProductResource(
                app(ProductRepositoryInterface::class)->create($request->validated())
            );
            return response()->json([
                'status' => true,
                'message' => "Product Created Successfully!",
                'data' => $product
            ], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'error' => $th->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * Display the specified product.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function show(Product $product) : JsonResponse
    {
        return response()->json([
            'status' => true,
            'data' => new ProductResource($product)
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified product in storage.
     *
     * @param ProductRequest $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(ProductRequest $request, Product $product) : JsonResponse
    {
        try {
            app(ProductRepositoryInterface::class)->update($request->validated(), $product);
            return response()->json([
                'status' => true,
                'message' => "Product Updated Successfully!",
                'data' =>  new ProductResource($product)
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'error' => $th->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * Remove the specified product from storage.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product) : JsonResponse
    {
        try {
            app(ProductRepositoryInterface::class)->delete($product);
            return response()->json([
                'status' => true,
                'message' => "Product Deleted Successfully!",
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'error' => $th->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
