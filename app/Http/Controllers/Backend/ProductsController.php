<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Models\Product;
use Image; //interventtion Class name
use App\Models\ProductImage;

class ProductsController extends Controller
{
   // To Call The Product & Show The The Product Image
     public function products()
    {
     
        $product = Product::orderBy('id','desc')->get();
        return view('pages.products')->with('products',$product);
    }

  //Product All pages Start
  //Add new product
  public function createproduct()
  {
    return view('Backend.pages.product.createproduct');
  }
  //Manage All Product
  public function manage_product()
  {
    $products = product::with("category")->get();
    // return $product;

    //  $products = product::orderBy('id', 'desc')->get();
    return view('Backend.pages.product.manage')->with('products', $products);
  }

  // Edit Product 
  public function edit_product($id)
  {
    $product = Product::find($id);
    return view('Backend.pages.product.editproduct')->with('product', $product);
  }
  //Add New product
  //Form theke Database a Data Store Kora
  public function product_store(Request $request)
  {

    //Valadate The Form Data
    $request->validate([
      'title'        => 'required|max:255',
      'desc'         =>  'required|max:1200',
      'quantity'     =>  'required',
      'price'        =>  'required',
      'catagory_id'  =>  'required|numeric',
      'brand_id'     =>  'required|numeric',
      // 'offer_price'  =>  'required'
    ]);

    // Form theke Data Insert korar process Start
    $products = new Product;

    $products->catagory_id = $request->catagory_id;
    $products->brand_id    = $request->brand_id;
    $products->title       = $request->title;
    $products->desc        = $request->desc;
    $products->slug        =  str_slug($request->title);
    $products->quantity    = $request->quantity;
    $products->price       = $request->price;
    $products->status      = 1;
    $products->offer_price = $request->offer_price;
    $products->admin_id    = 100;

    $products->save();
    // Form theke Data Insert korar process End

    if (count($request->product_image) > 0) {
      foreach ($request->product_image as $image) {
        $img = time() . '.' . $image->getClientOriginalExtension();
        //Move the Product Image into the required folder
        $location = public_path('image/product-image/' . $img);
        Image::make($image)->save($location);
        //image Resize Function
        $image = Image::make($image)->resize(700, 430);
        //Create the productImage model
        $product_image = new ProductImage;
        $product_image->product_id = $products->id;
        $product_image->image = $img;
        $product_image->save();
      }
    }
    // //Check if the product has any product thumnail image
    // if($request->hasFile('product_image')){
    //      $image = $request->file('product_image');
    //         $img = time() .'.'. $image->getClientOriginalExtension();
    //        //Move the Product Image into the required folder
    //         $location = public_path('image/product-image/'. $img);
    //         Image::make($image)->save($location);
    //        //Create the product
    //          $product_images = new ProductImage;
    //         $product_images->product_id = $products->id;
    //         $product_images->image = $img;
    //         $product_images->save();  
    //    }

    return redirect()->route('manageproduct')->with('msg', 'Product Insurt Success');
  }



  //Update Product
  public function product_update(Request $request, $id)
  {

    //Valadate The Form Data
    $request->validate([
      'title'        => 'required|max:255',
      'desc'         =>  'required|max:1200',
      'quantity'     =>  'required',
      'price'        =>  'required',
      'catagory_id'  =>  'required|numeric',
      'brand_id'     =>  'required|numeric',
      // 'offer_price'  =>  'required'
    ]);

    // Form theke Data Insert korar process Start
    $products = Product::find($id);

    $products->title       = $request->title;
    $products->desc        = $request->desc;
    $products->slug        =  str_slug($request->title);
    $products->quantity    = $request->quantity;
    $products->price       = $request->price;
    $products->offer_price = $request->offer_price;
     $products->catagory_id = $request->catagory_id;
    $products->brand_id    = $request->brand_id;

    $products->save();
    // Form theke Data Insert korar process End

    return redirect()->route('manageproduct')->with('msg', 'Product Insurt Success');
  }

//Product Delete Function
  public function product_delete($id)
  {
    $product = Product::find($id);
    if (!is_null($product)) {
      $product->delete();
      return back();
    }
  }
}
