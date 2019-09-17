<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = ['username', 'cardnum', 'cardowner', 'cardmonth', 'cardyear', 'cardcvc', 'amount'];
}
