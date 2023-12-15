<?php

namespace App\Models;

use App\Models\City;
use App\Models\District;
use App\Models\Commune;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feeship extends Model
{
    use HasFactory;
    protected $table = 'tbl_feeship';
    public $timestamps = false;

    protected $fillable = [
        'matp',
        'maqh',
        'xaid',
        'feeship'
    ];

    public function city(){
        return $this->belongsTo(City::class, 'matp', 'matp');
    }

    public function district(){
        return $this->belongsTo(District::class, 'maqh', 'maqh');
    }

    public function commune(){
        return $this->belongsTo(Commune::class, 'xaid', 'xaid');
    }
}
