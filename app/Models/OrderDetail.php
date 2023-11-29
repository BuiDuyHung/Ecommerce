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
        'order_id',
        'product_id',
        'product_name',
        'product_price',
        'product_sale_quantity',
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function order(){
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
