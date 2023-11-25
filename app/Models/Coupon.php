<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    public $table = 'tbl_coupon';

    protected $fillable = [
        'name',
        'code',
        'quantity',
        'condition',
        'value'
    ];
}
