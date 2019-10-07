<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Call The Product Model To Show Product into Product Page
//Platform Front End View Files Locatation
use App\Models\Product;

class PagesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //This is Our Home page
    public function index()
    {
        $products = Product::orderBy('id','desc')->get();
        return view('Frontend.pages.homepage',compact('products'));
    }
    //To Call The Login Page
    public function login()
    {
        return view('Frontend.pages.login');
    }
    //To Call The Register Page
    public function register()
    {
        return view('Frontend.pages.register');
    }
    public function show($slug)
     {
     $Product = Product::where('slug',$slug->first());
     if(!is_null($Product)){
        return view('Frontend.pages.show', compact('Product'));
     }
     else{
        session()->flash('Errors','No Product Found!!!');
        redirect()->route('products');
     }
  }

   
}
