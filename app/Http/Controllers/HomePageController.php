<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Services\ProductService;
use Illuminate\Http\Request;
class HomePageController extends Controller{

    private $productService;

    function __construct(ProductService $productService){
        $this->productService = $productService;
    }

    public function getHomePage(){

        $products = $this->productService->getAllProduct();
        $allproduct = $this->productService->getAllProducts();
        return view("client.homePage.homePage", compact('products','allproduct'), );
    }

    public function errorHomePage(){
        return view("client.auth.error");
    }
}