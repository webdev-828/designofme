<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'zipcode', 'city', 'country', 'address', 'product_id', 'color', 'size', 'saler_id', 'prize'];
}
