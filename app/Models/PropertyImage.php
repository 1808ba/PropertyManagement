<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    use HasFactory;

    protected $fillable = ['image_path', 'property_id']; // Add fillable property

    public function property()
{
    return $this->belongsTo(Property::class);
}

}
