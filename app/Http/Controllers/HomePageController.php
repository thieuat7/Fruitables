<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
class HomePageController extends Controller{

    public function getHomePage(){
        return view("client.homePage.homePage");
    }

}