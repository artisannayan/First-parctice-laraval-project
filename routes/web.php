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
  

//User Route
Route::group(['prefix'=> 'user'],function(){
      Route::get('/token/{token}','Frontend\VarificationController@varify')->name('user.varification');
      Route::get('/dashbord','Frontend\UsersController@dashboard')->name('user.dashboard');
      Route::get('/profile','Frontend\UsersController@profile')->name('user.profile');
      Route::post('/update','Frontend\UsersController@profileUpadate')->name('user.profileUpdate');
});



//Cart route page
Route::group(['prefix'=> 'cart'],function(){
  Route::get('/','Frontend\CartController@index')->name('carts');
  Route::post('/store','Frontend\CartController@store')->name('carts.store');
  Route::post('/update/{id}','Frontend\CartController@update')->name('carts.update');
  Route::post('/destroy/{id}','Frontend\CartController@destroy')->name('carts.destroy');
});

//Check Out route page
Route::group(['prefix'=> 'checkout'],function(){
  Route::get('/','Frontend\CheckoutController@index')->name('chekouts');
  Route::post('/store','Frontend\CheckoutController@store')->name('chekouts.store');

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

     //Admin Login Route
     Route::get('/login','Auth\Admin\LoginController@showLoginForm')->name('admin.login');
     Route::post('/login/submit','Auth\Admin\LoginController@login')->name('admin.login.submit');



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




 /*--------------------------------------------------------------------------    
 Division Back End Pages Routs Start
 --------------------------------------------------------------------------*/
 Route::group(['prefix' =>'division'],function(){

  Route::get('/manage','Backend\DivisionController@index')->name('admin.division');

  Route::get('/division/create','Backend\DivisionController@division_create')->name('admin.division.create');
  Route::get('/division/edit/{id}','Backend\DivisionController@division_edit')->name('admin.division.edit');

 //Add Brands form  Create page
  Route::post('/division/crteatedivision','Backend\DivisionController@division_store')->name('admin.division.store');
  Route::post('/division/edit/{id}','Backend\DivisionController@division_update')->name('admin.division.update');
  Route::post('/division/delete/{id}','Backend\DivisionController@division_delete')->name('admin.division.delete');

  });
 
/*--------------------------------------------------------------------------    
Division Back End Pages Routs End
--------------------------------------------------------------------------*/


/*--------------------------------------------------------------------------    
 Division Back End Pages Routs Start
 --------------------------------------------------------------------------*/
 Route::group(['prefix' =>'district'],function(){

  Route::get('/manage','Backend\DistrictController@index')->name('admin.district');

  Route::get('/district/create','Backend\DistrictController@district_create')->name('admin.district.create');
  Route::get('/district/edit/{id}','Backend\DistrictController@district_edit')->name('admin.district.edit');

 //Add district form  Create page
  Route::post('/district/crteatedistrict','Backend\DistrictController@district_store')->name('admin.district.store');
  Route::post('/district/edit/{id}','Backend\DistrictController@district_update')->name('admin.district.update');
  Route::post('/district/delete/{id}','Backend\DistrictController@district_delete')->name('admin.district.delete');

  });
 
/*--------------------------------------------------------------------------    
Division Back End Pages Routs End
--------------------------------------------------------------------------*/

 
  });




/*Login Register Forgot Password Routes->user auth */

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
