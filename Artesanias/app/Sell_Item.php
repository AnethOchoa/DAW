<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sell_Item extends Model
{
    protected $fillable = [
        'id_sell', 'id_product',
        'price', 'quantity'
    ];
}
