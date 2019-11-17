<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Order extends Model
{
    public $fillable = [
        'user_id',
         'ip_address',
         'name',
         'phone_no',
         'shipping_address',
         'email',
         'message',
         'is_paid',
         'is_complete',
         'seen_by_admin'
        ];

       public function user()
       {
           return $this->belongdTo(User::class);
       }
       public function cart()
       {
           return $this->belongdTo(Cart::class);
       }
}
