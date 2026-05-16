<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id', 'quantity', 'total_price', 'order_number', 'payment_method', 'payment_status', 'transaction_id', 'notes', 'status',
    ];

    protected $casts = [
        'status' => OrderStatus::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /* Invoice number generation */
    public static function generateInvoiceNumber()
    {
        $prefix = 'INV';
        $idLength = 10; // Length of the numeric part after prefix

        return DB::transaction(function () use ($prefix, $idLength) {
            // Get the latest order number
            $latestOrder = self::orderBy('order_number', 'DESC')->lockForUpdate()->first();
            // Initialize next number
            $nextNumber = 1;
            // If there's an existing order number, extract and increment it
            if ($latestOrder && $latestOrder->order_number) {
                $number = (int) str_replace($prefix.'-', '', $latestOrder->order_number);
                if ($number > 0) {
                    $nextNumber = $number + 1;
                }
            }

            // Generate the padded number
            return $prefix.'-'.str_pad($nextNumber, $idLength, '0', STR_PAD_LEFT);
        });
    }
}
