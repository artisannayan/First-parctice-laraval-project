<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Models\Product;

class ProductsController extends Controller
{
   // To Call The Product & Show The The Product Image
     public function products()
    {
        $product = Product::orderBy('id','desc')->paginate(20);
        return view('Frontend.pages.products.products')->with('products',$product);
    }

    public function show($slug)
    {

        $product = Product::where('slug', $slug)->first();

      if(!is_null($product)){
              return view('Frontend.pages.products.show',compact('product'));
      }else{
          session()->flash('Errors','No Product Found !!!!!');
                return redirect()->route('products');
      }
    }
}


