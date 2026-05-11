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
}
