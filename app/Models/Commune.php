<?php

namespace App\Models;

use App\Models\District;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    use HasFactory;

    protected $table = 'tbl_quanhuyen';
    public $timestamps = false;

    protected $fillable = [
        'maqh',
        'name',
        'type',
        'maqh',
    ];

    public function district(){
        return $this->belongsTo(District::class, 'maqh', 'id');
    }
}
