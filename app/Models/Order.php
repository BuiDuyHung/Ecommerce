<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Customer;
use App\Models\Payment;
use App\Models\Shipping;
use App\Models\OrderDetail;

class Order extends Model
{
    use HasFactory;

    public $table = 'tbl_order';

    protected $fillable = [
        'total',
        'status',
        'customer_id',
        'shipping_id',
        'payment_id'
    ];

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function payment(){
        return $this->belongsTo(Payment::class, 'payment_id', 'id');
    }

    public function shipping(){
        return $this->belongsTo(Shipping::class, 'shipping_id', 'id');
    }

    public function orderDetail(){
        return $this->hasMany(OrderDetail::class);
    }
}
