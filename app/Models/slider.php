<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class slider extends Model
{
    use HasFactory;
    protected $table = 'tbl_slider';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'image',
        'status',
        'desc',
    ];
}
