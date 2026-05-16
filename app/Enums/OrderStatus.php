<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PENDING = 'Pending';
    case CONFIRMED = 'Confirmed';
    case PROCESSING = 'Processing';
    case SHIPPED = 'Shipped';
    case OUT_FOR_DELIVERY = 'Out for Delivery';
    case DELIVERED = 'Delivered';
    case CANCELLED = 'Cancelled';

    public function badge(): string
    {
        return match ($this) {
            self::PENDING => 'bg-warning',
            self::CONFIRMED => 'bg-info',
            self::PROCESSING => 'bg-primary',
            self::SHIPPED => 'bg-info',
            self::OUT_FOR_DELIVERY => 'bg-primary',
            self::DELIVERED => 'bg-success',
            self::CANCELLED => 'bg-danger',
        };
    }

    public function text(): string
    {
        return match ($this) {
            self::PENDING => 'text-warning',
            self::CONFIRMED => 'text-info',
            self::PROCESSING => 'text-primary',
            self::SHIPPED => 'text-info',
            self::OUT_FOR_DELIVERY => 'text-primary',
            self::DELIVERED => 'text-success',
            self::CANCELLED => 'text-danger',
        };
    }
}
