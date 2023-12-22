<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Customer;
use App\Models\Shipping;
use App\Models\OrderDetail;

class Order extends Model
{
    use HasFactory;

    protected $table = 'tbl_order';

    protected $fillable = [
        'status',
        'code',
        'customer_id',
        'shipping_id',
    ];

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function shipping(){
        return $this->belongsTo(Shipping::class, 'shipping_id', 'id');
    }

    public function orderDetail(){
        return $this->hasMany(OrderDetail::class);
    }
}
