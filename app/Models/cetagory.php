<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cetagory extends Model
{
   public function parent()
   {
      return $this->belongsTo(cetagory::class, 'parent_id');
   }

   public function products(){
   	return $this->hasMany(product::class, 'catagory_id');
   }
}

