<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    public $table = 'tbl_order_detail';

    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_price',
        'product_sale_quantity',
    ];
}
