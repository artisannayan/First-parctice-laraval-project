<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
  public $fillable = [
    'name',
     'desc',
     'image'
     
     
    ];


  public function products(){
  	return $this->hasMany(cetagory::class);
  }  
}
