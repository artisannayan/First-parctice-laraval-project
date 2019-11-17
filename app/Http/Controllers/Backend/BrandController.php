<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Brand;
use File;
use Image; //interventtion Class name
use App\Models\ProductImage;


class BrandController extends Controller
{
//To Call CreateCategory form page
  public function brands_create()
  {
  
    return view('Backend.pages.brands.createbrands');
  }

 // To call Manage Brand page
  public function index()
  {
    
    $brands = Brand::orderBy('id', 'desc')->get();
    return view('Backend.pages.brands.manage',compact('brands'))
;
  }

//Category Store korar jonno
  public function brands_store(Request $request)
  {
    // Validate The Form Data
    $request->validate(
      [
        'name'              => 'required|max:255',
        'desc'              => 'required|max:1200',
        'image'             => 'nullable|image',
      ],
      [
        'name.required'     => 'Please Provide Category Name',
        'desc.required'     => 'Please Provide Description of the Category',
        'image.image'       => 'Please Provide a Valid image with .jpg, .jpeg, .png extension..',
      ]
    );

    $brand = new Brand();
    $brand->name = $request->name;
    $brand->desc = $request->desc;


//Image Uplod dewar jonno 
    if ($request->image) {
      $image = $request->file('image');
      $img = time() . '.' . $image->getClientOriginalExtension();
      $location = public_path('image/brand-image/' . $img);
      Image::make($image)->save($location);
      $brand->image = $img;
    }

    $brand->save();

    session()->flush('success', 'A New brand Has Been Added Successfully');
    return redirect()->route('admin.brands');
  }



//Category Edit korar jonno ei code use kiora hoyche

  public function edit_brand($id)
  {
   
    $brand = Brand::find($id);
    if(!is_null($brand)){
         return view('Backend.pages.brands.editbrands', compact('brand'));
    }else{
      return route('admin.brands');
    }
  }

//Cetagory Delete Korar jonno ei code use kora hoy

public function brands_delete($id)

//If It is Parent Category , Then we will delete all its sub Category

  {
    $brand = Brand::find($id);
    if (!is_null($brand)) {

      
      // if(File::exists('image/category-image/' .$category->image)){
      //     File::delete('image/category-image /'.$category->image);
      // }
      $brand->delete();
      return back();
    }
  }


 public function brands_update(Request $request, $id)
  {
    // Validate The Form Data
    $request->validate(
      [
        'name'              => 'required|max:255',
        'desc'              => 'required|max:1200',
        'image'             => 'nullable|image',
      ],
      [
        'name.required'     => 'Please Provide Category Name',
        'desc.required'     => 'Please Provide Description of the Category',
        'image.image'       => 'Please Provide a Valid image with .jpg, .jpeg, .png extension..',
      ]
    );

    $brand = Brand::find($id);
    $brand->name = $request->name;
    $brand->desc = $request->desc;


//Image Uplod dewar jonno 
    if ($request->image) {

      if(File::exists('image/brand-image/' .$brand->image)){
          File::delete('image/brand-image /'.$brand->image);
      }
      $image = $request->file('image');
      $img = time() . '.' . $image->getClientOriginalExtension();
      $location = public_path('image/brand-image/' . $img);
      Image::make($image)->save($location);
      $brand->image = $img;
    }

    $brand->save();

    session()->flush('success', 'A New brands Has Been Added Successfully');
    return redirect()->route('admin.brands');
  }



}
