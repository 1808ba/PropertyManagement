<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'type',
        'number_of_units',
        'rental_cost',
    ];
    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }
}
