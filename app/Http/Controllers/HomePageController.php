<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Services\ProductService;
use App\Services\DiscountService;
use Illuminate\Http\Request;
class HomePageController extends Controller{

    private $productService;
    private $discountService;

    function __construct(ProductService $productService, DiscountService $discountService){
        $this->productService = $productService;
        $this->discountService = $discountService;
    }

    public function getHomePage(){

        $products = $this->productService->getAllProduct();
        $allproduct = $this->productService->getAllProducts();
        $productDiscounts = $this->discountService->getAllProductDiscountActive();
        return view("client.homePage.homePage", compact('products','allproduct', 'productDiscounts'), );
    }

    public function errorHomePage(){
        return view("client.auth.error");
    }
}