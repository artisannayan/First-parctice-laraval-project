<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\cetagory;
use File;
use Image; //interventtion Class name
use App\Models\ProductImage;


class CetagoriesController extends Controller
{
//To Call CreateCategory form page
  public function createcetegories()
  {
    $primary_cetagories = cetagory::orderBy('name', 'asc')->where('parent_id', NULL)->get();
    return view('Backend.pages.cetegories.createcategories', compact('primary_cetagories'));
  }

 // To call Manage CategoryPge
  public function manage_category()
  {
    $cetagories = cetagory::with('products')->get();
    // return $cetagory;
    
    // $cetagories = cetagory::orderBy('id', 'desc')->get();
    return view('Backend.pages.cetegories.manage')->with('cetagories', $cetagories);
  }

 
//Category Store korar jonno
  public function category_store(Request $request)
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

    $category = new cetagory();
    $category->name = $request->name;
    $category->desc = $request->desc;
    $category->parent_id = $request->parent_id;


//Image Uplod dewar jonno 
    if ($request->image) {
      $image = $request->file('image');
      $img = time() . '.' . $image->getClientOriginalExtension();
      $location = public_path('image/category-image/' . $img);
      Image::make($image)->save($location);
      $category->image = $img;
    }



    $category->save();

    session()->flush('success', 'A New Category Has Been Added Successfully');
    return redirect()->route('managecategory');
  }



//Category Edit korar jonno ei code use kiora hoyche

  public function edit_category($id)
  {
    $primary_cetagories = Cetagory::orderBy('name','asc')->where('parent_id',NULL)->get();
    $category = Cetagory::find($id);
    if(!is_null($category)){
      return view('Backend.pages.cetegories.editcategory', compact('category','primary_cetagories'));
    }else{
      return route('managecategory');
    }
  }

//Cetagory Delete Korar jonno ei code use kora hoy

public function category_delete($id)

//If It is Parent Category , Then we will delete all its sub Category

  {
    $category = Cetagory::find($id);
    if (!is_null($category)) {

      if($category->parent_id == NULL){
        //Delete Sub Category
        $sub_cetagories = cetagory::orderBy('name', 'asc')->where('parent_id', $category->id)->get();
        foreach ($sub_cetagories as $sub) {
          if(File::exists('image/category-image/' .$sub->image)){
          File::delete('image/category-image /'.$sub->image);
        }
           $sub->delete();
        }

      }
      if(File::exists('image/category-image/' .$category->image)){
          File::delete('image/category-image /'.$category->image);
      }
      $category->delete();
      return back();
    }
  }





 public function category_update(Request $request, $id)
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

    $category = cetagory::find($id);
    $category->name = $request->name;
    $category->desc = $request->desc;
    $category->parent_id = $request->parent_id;


//Image Uplod dewar jonno 
    if ($request->image) {

      if(File::exists('image/category-image/' .$category->image)){
          File::delete('image/category-image /'.$category->image);
      }
      $image = $request->file('image');
      $img = time() . '.' . $image->getClientOriginalExtension();
      $location = public_path('image/category-image/' . $img);
      Image::make($image)->save($location);
      $category->image = $img;
    }



    $category->save();

    session()->flush('success', 'A New Category Has Been Added Successfully');
    return redirect()->route('managecategory');
  }



}
