<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Models\Product;
use App\Models\cetagory;
use Image; //interventtion Class name
use App\Models\ProductImage;

//Platform Admin Panel View Files Locatation
class PagesController extends Controller
{
  //To Call HomePage
  public function index()
  {
    return view('Backend.pages.index');
  }


}










