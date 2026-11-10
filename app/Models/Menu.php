<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'category',
        'status',
        'image'
    ];

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return global_asset('images/placeholder.png');
        }

        return url('/tenancy/assets/' . ltrim($this->image, '/'));
    }
}