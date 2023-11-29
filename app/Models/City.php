<?php

namespace App\Models;

use App\Models\District;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'tbl_tinhthanhpho';
    public $timestamps = false;

    protected $fillable = [
        'matp',
        'name',
        'type',
    ];

    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
