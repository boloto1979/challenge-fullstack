<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\ProductService;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->listAll();
        return response()->json($products, Response::HTTP_OK);
    }

    public function show(int $id)
    {
        $product = $this->productService->getProductById($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($product, Response::HTTP_OK);
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $product = $this->productService->createProduct($data);

        return response()->json($product, Response::HTTP_CREATED);
    }

    public function update(UpdateProductRequest $request, int $id)
    {
        $data = $request->validated();
        $product = $this->productService->updateProduct($id, $data);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($product, Response::HTTP_OK);
    }

    public function destroy(int $id)
    {
        $deleted = $this->productService->deleteProduct($id);

        if (!$deleted) {
            return response()->json(['message' => 'Product not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
