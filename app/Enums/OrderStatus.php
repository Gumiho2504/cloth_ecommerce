<?php

namespace App\Enums;

enum OrderStatus : string
{
    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case SHIPPED = 'shipped';
    case DELIVERED = 'delivered';
    case CANCELED = 'canceled';
    case RETURNED = 'returned';
}
