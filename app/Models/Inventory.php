<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventory';  // Explicitly set table name

    protected $fillable = [
        'item_name',
        'quantity',
        'supplier',
        'unit_cost',
        'reorder_level'
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_cost' => 'decimal:2',
        'reorder_level' => 'integer',
    ];
}
