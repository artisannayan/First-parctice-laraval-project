<?php

/*
|--------------------------------------------------------------------------
| All Front End Page are Done here in this list
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//To The Call Home Page
  Route::get('/','Frontend\PagesController@index')->name('index');
//To The Call Login Page
  Route::get('/login','Frontend\PagesController@login')->name('login');
//To The Call Register Page
  Route::get('/register','Frontend\PagesController@register')->name('register');




/*All Product Route Functionlty*/

Route::group(['prefix'=>'products'],function(){
  //To The Call Fontend Products Pages
  Route::get('/','Frontend\ProductsController@products')->name('products');
  //To The Call Front End Slug/Product Single Page
Route::get('/{slug}','Frontend\ProductsController@show')->name('products.show');

Route::get('/categories','Frontend\CategoriesCotroller@index')->name('category.index');
Route::get('/category/{id}','Frontend\CategoriesCotroller@show')->name('category.show');
});
  

/*
|--------------------------------------------------------------------------
| All Back End Page are Done here in this list Start
|--------------------------------------------------------------------------
|
*/


/*--------------------------------------------------------------------------    
  Admin Backend Routs Pages Routs Start
 --------------------------------------------------------------------------*/
     Route::group(['prefix' => 'admin'],function(){
     Route::get('/','Backend\PagesController@index')->name('dashbord');



/*--------------------------------------------------------------------------    
  Cetegories Back End Routs Pages Routs Start
 --------------------------------------------------------------------------*/

     
     Route::group(['prefix' =>'cetegories'],function(){
     Route::get('/cetegories/createcategory','Backend\CetagoriesController@createcetegories')->name('createcategory');

     Route::get('/cetegories/manage','Backend\CetagoriesController@manage_category')->name('managecategory');
     Route::get('/cetegories/edit/{id}','Backend\CetagoriesController@edit_category')->name('editcetagory');

    //Add Product form  Create page
     Route::post('/category/createproduct','Backend\CetagoriesController@category_store')->name('admin.cetegories.crate');
     // Route::post('/category/createproduct','PagesController@category_store')->name('admin.cetegories.crate');
    Route::post('/category/edit/{id}','Backend\CetagoriesController@category_update')->name('admin.category.update');
    Route::post('/category/delete/{id}','Backend\CetagoriesController@category_delete')->name('admin.category.delete');
    
     });

 /*--------------------------------------------------------------------------    
      Cetegories  Back End Routs Pages Routs End
 --------------------------------------------------------------------------*/






 /*--------------------------------------------------------------------------    
 Product Back End Pages Routs Start
 --------------------------------------------------------------------------*/
     Route::group(['prefix' =>'product'],function(){
     Route::get('/product/createproduct','Backend\ProductsController@createproduct')->name('createproduct');
     Route::get('/product/manage','Backend\ProductsController@manage_product')->name('manageproduct');
     Route::get('/product/edit/{id}','Backend\ProductsController@edit_product')->name('editproduct');

    //Add Product form  Create page
     Route::post('/product/createproduct','Backend\ProductsController@product_store')->name('admin.product.createproduct');
     Route::post('/product/edit/{id}','Backend\ProductsController@product_update')->name('admin.product.update');
     Route::post('/product/delete/{id}','Backend\ProductsController@product_delete')->name('admin.product.delete');

     });
    
/*--------------------------------------------------------------------------    
 Product Back End Pages Routs End
 --------------------------------------------------------------------------*/
     


/*--------------------------------------------------------------------------    
 Barand Back End Pages Routs Start
 --------------------------------------------------------------------------*/
     Route::group(['prefix' =>'brand'],function(){

     Route::get('/manage','Backend\BrandController@index')->name('admin.brands');

     Route::get('/brand/create','Backend\BrandController@brands_create')->name('admin.brand.create');
     Route::get('/brand/edit/{id}','Backend\BrandController@edit_brand')->name('admin.brand.edit');

    //Add Brands form  Create page
     Route::post('/brand/crteatebrands','Backend\BrandController@brands_store')->name('admin.brand.store');
     Route::post('/brand/edit/{id}','Backend\BrandController@brands_update')->name('admin.brand.update');
     Route::post('/brand/delete/{id}','Backend\BrandController@brands_delete')->name('admin.brand.delete');

     });
    
/*--------------------------------------------------------------------------    
 Product Back End Pages Routs End
 --------------------------------------------------------------------------*/




 
  });




