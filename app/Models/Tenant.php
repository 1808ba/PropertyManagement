<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_id',
        'name',
        'contact_details',
        'section',
    ];
    public function property(){
        return $this->belongsTo(Property::class);
    }
}
