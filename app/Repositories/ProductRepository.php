<?php

namespace App\Repositories;

use App\Models\Product;
use App\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * Fetch All Products
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function list()
    {
        return Product::all();
    }

    /**
     * Store new product
     *
     * @param array $data
     * @return Product
     */
    public function create($data)
    {
        return Product::create($data);
    }

    /**
     * Update a product
     *
     * @param array $data
     * @param Product $product
     * @return boolean
     */
    public function update($data, Product $product)
    {
        return $product->update($data);
    }

    /**
     * Delete a product
     *
     * @param Product $product
     * @return boolean
     */
    public function delete(Product $product)
    {
        return $product->delete();
    }
}
