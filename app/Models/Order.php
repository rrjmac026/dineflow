<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'menu_id',
        'order_number',
        'table_number',
        'status',
        'payment_status', 
        'total_price',
        'special_instructions',
        
    ];

    public static function getDefaultStatus()
    {
        return 'pending';
    }

    public static function getDefaultPaymentStatus()
    {
        return 'unpaid';
    }

    public static function generateOrderNumber()
    {
        $lastOrder = self::orderBy('id', 'desc')->first();
        $nextOrderNumber = $lastOrder ? intval(substr($lastOrder->order_number, 4)) + 1 : 1;
        return 'ORD-' . str_pad($nextOrderNumber, 6, '0', STR_PAD_LEFT);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
