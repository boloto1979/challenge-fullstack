<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     *
     * @return \Illuminate\Database\Eloquent\Collection|Product[]
     */
    public function getAll()
    {
        return Product::all();
    }

    /**
     *
     * @param int $id
     * @return Product|null
     */
    public function getById(int $id): ?Product
    {
        return Product::find($id);
    }

    /**
     *
     * @param array $data
     * @return Product
     */
    public function create(array $data): Product
    {
        return Product::create($data);
    }

    /**
     *
     * @param int $id
     * @param array $data
     * @return Product|null
     */
    public function update(int $id, array $data): ?Product
    {
        $product = Product::find($id);
        if ($product) {
            $product->update($data);
        }
        return $product;
    }

    /**
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $product = Product::find($id);
        if ($product) {
            return (bool)$product->delete();
        }
        return false;
    }
}
