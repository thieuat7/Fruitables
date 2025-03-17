<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class ProductService
{


    public function getAllProduct($perPage = 8)
    {
        return Product::paginate($perPage);
    }

    public function getProductById($id)
    {
        return Product::find($id);
    }

    public function deleteByProduct($id)
    {
        $product = Product::find($id);
        if ($product) {
            // Xóa ảnh cũ nếu có
            if ($product->product_image_url) {
                // Kiểm tra nếu đường dẫn ảnh có chứa thư mục 'products'
                $imagePath = 'products/' . $product->product_image_url;
                if (Storage::disk('public')->exists($imagePath)) {
                    // Xóa ảnh cũ
                    Storage::disk('public')->delete($imagePath);
                }
            }

            // Xóa sản phẩm khỏi cơ sở dữ liệu
            $product->delete();

            return true;
        }

        return false;
    }


      public function handleCreateProduct($data)
    {
        // Lưu ảnh sản phẩm (nếu có)
        $imagePath = null;
        if (isset($data['product_image_url'])) {
            $imagePath = $data['product_image_url']->store('products', 'public');
            // Lấy chỉ tên file từ đường dẫn
            $imagePath = basename($imagePath);
        }

        // Tạo sản phẩm
        return Product::create([
            'product_name' => $data['product_name'],
            'product_detailDesc' => $data['product_detailDesc'],
            'product_shortDesc' => $data['product_shortDesc'],
            'product_price' => $data['product_price'],
            'product_factory' => $data['product_factory'],
            'product_target' => $data['product_target'],
            'product_type' => $data['product_type'],
            'product_quantity' => $data['product_quantity'],
            'product_image_url' => $imagePath,  // Lưu đường dẫn ảnh
        ]);
    }


    public function handleUpdateProduct($id, $data)
    {
        $product = Product::find($id);

        if (!$product) {
            return null;
        }

        // Lưu ảnh mới (nếu có) và xóa ảnh cũ
        if (isset($data['product_image_url'])) {
            // Nếu có ảnh cũ, xóa nó
            if ($product->product_image_url) {
                Storage::disk('public')->delete('products/' . $product->product_image_url);
            }
            // Lưu ảnh mới và chỉ lưu tên file
            $data['product_image_url'] = basename($data['product_image_url']->store('products', 'public'));
        } else {
            // Nếu không có ảnh mới, giữ lại ảnh cũ
            $data['product_image_url'] = $product->product_image_url;
        }

        // Cập nhật thông tin sản phẩm
        $product->update([
            'product_name' => $data['product_name'],
            'product_detailDesc' => $data['product_detailDesc'],
            'product_shortDesc' => $data['product_shortDesc'],
            'product_price' => $data['product_price'],
            'product_factory' => $data['product_factory'],
            'product_target' => $data['product_target'],
            'product_type' => $data['product_type'],
            'product_quantity' => $data['product_quantity'],
            'product_image_url' => $data['product_image_url'],  // Cập nhật ảnh
        ]);

        return $product;
    }

}