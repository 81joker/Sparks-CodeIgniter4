<?php

namespace App\Enums;

enum OrderStatus: string
{
    case Paid = 'paid';
    case Unpaid = 'unpaid';
    case Processing = 'processing';
    case Cancelled = 'cancelled';
    case Completed = 'completed';
    case Pending = 'pending';
    case Shipped = 'shipped';
    // case Delivered = 'delivered';
    public static function getStatuses()
    {
        return [
            self::Paid->value,
            self::Unpaid->value,
            self::Processing->value,
            self::Cancelled->value,
            self::Completed->value,
            self::Pending->value,
            self::Shipped->value,
        ];
    }
  
}

