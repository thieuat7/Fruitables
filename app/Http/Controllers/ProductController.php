<?php

namespace App\Http\Controllers;
use App\Services\ProductService;
use Illuminate\Http\Request;
class ProductController extends Controller{
    private $productService;

    public function __construct(ProductService $productService){
        $this->productService = $productService;
    }

    public function getAllProduct()
    {
        $products = $this->productService->getAllProduct();
        return view('admin.products.show', compact('products'));
    }

    // Hiển thị form tạo sản phẩm
    public function createProduct()
    {
        return view('admin.products.create');
    }

    // Xem chi tiết sản phẩm
    public function detailProduct($id)
    {
        $product = $this->productService->getProductById($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found!');
        }
        return view('admin.products.detail', compact('product'));
    }

    // Xử lý tạo sản phẩm
    public function handleCreateProduct(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_detailDesc' => 'required|string',
            'product_shortDesc' => 'nullable|string|max:500',
            'product_price' => 'required|numeric|min:0',
            'product_factory' => 'required|string|max:255',
            'product_target' => 'nullable|string|max:255',
            'product_type' => 'required|string|max:100',
            'product_quantity' => 'required|integer|min:0',
            'product_image_url' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        // Tạo sản phẩm qua Service
        $this->productService->handleCreateProduct($request->all());

        return redirect('/admin/product')->with('success', 'Product created successfully!');
    }

    // Hiển thị form chỉnh sửa sản phẩm
    public function updateProduct($id)
    {
        $product = $this->productService->getProductById($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found!');
        }

        return view('admin.products.update', compact('product'));
    }

    // Xử lý cập nhật sản phẩm
    public function handleUpdateProduct(Request $request, $id)
    {
        // Validate dữ liệu
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_detailDesc' => 'required|string',
            'product_shortDesc' => 'nullable|string|max:500',
            'product_price' => 'required|numeric|min:0',
            'product_factory' => 'required|string|max:255',
            'product_target' => 'nullable|string|max:255',
            'product_type' => 'required|string|max:100',
            'product_quantity' => 'required|integer|min:0',
            'product_image_url' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        // Cập nhật thông tin sản phẩm qua Service
        $this->productService->handleUpdateProduct($id, $validatedData);

        return redirect('/admin/product')->with('success', 'Product updated successfully!');
    }

    // Xóa sản phẩm
    public function deleteProduct($id)
    {
        $product = $this->productService->getProductById($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found!');
        }

        return view('admin.products.delete', compact('product'));
    }

    // Xử lý xóa sản phẩm
    public function handleDeleteProduct($id)
    {
        // Xóa sản phẩm qua Service
        $this->productService->deleteByProduct($id);

        return redirect('/admin/product')->with('success', 'Product deleted successfully!');
    }
}