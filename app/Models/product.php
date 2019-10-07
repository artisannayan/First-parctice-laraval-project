<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
  public function images()
  {
  	   return $this->hasMany(ProductImage::class,'product_id');
  }
  public function category()
  {
    return $this->belongsTo(Cetagory::class, "catagory_id");
  }
  public function brand()
  {
  	return  $this->belongsTo(Brand::class, "brand_id");
  }
}
