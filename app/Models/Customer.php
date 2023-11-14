<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Order;

class Customer extends Model
{
    use HasFactory;

    public $table = 'tbl_customers';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
