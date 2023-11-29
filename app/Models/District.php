<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $table = 'tbl_xaphuongthitran';
    public $timestamps = false;

    protected $fillable = [
        'xaid',
        'name',
        'type',
        'maqh',
    ];
}
