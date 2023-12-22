<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;
use App\Models\Order;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'tbl_order_detail';

    protected $fillable = [
        'order_code',
        'product_id',
        'product_title',
        'product_price',
        'product_sale_quantity',
        'product_coupon',
        'product_feeship',
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

}
