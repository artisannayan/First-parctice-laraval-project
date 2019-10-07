<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Models\Cetagory;
use App\Models\Product;
use App\Models\Brand;

class CategoriesCotroller extends Controller
{
  public function index()
  {

  }
  public function show($id)
  {

    // $Cetagory = Product::where('catagory_id', $id)->get();
    // return $Cetagory;
 
   $category = Cetagory::find($id);
   if(!is_null($category)){
  
     return view('Frontend.pages.categories.show', compact('category'));
    // return view('Frontend.pages.products.show',compact('category'));
   }else{
   	session()->flash('errors','Sorry, No Product Found');
   	return redirect('/');
   }
  }
 


}
