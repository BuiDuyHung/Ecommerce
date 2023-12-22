<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Order;

class Shipping extends Model
{
    use HasFactory;

    protected $table = 'tbl_shipping';

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'notes',
        'method'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
