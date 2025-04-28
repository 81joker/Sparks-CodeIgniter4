<?php

use App\Enums\OrderStatus;

if (!function_exists('getOrderStatusBadge')) {
    function getOrderStatusBadge(string $status): array
    {
        $statusEnum = OrderStatus::class;

        switch ($status) {
            case $statusEnum::Paid->value:
                return ['label' => $statusEnum::Paid->value, 'class' => 'badge px-4 py-2 text-bg-success  bg-transparent border border-success text-success'];
            case $statusEnum::Completed->value:
                return ['label' => $statusEnum::Completed->value, 'class' => 'badge px-2 py-2 text-bg-success  bg-transparent border border-success text-success'];
            case $statusEnum::Pending->value:
                return ['label' => $statusEnum::Pending->value, 'class' => 'badge px-2 py-2 text-bg-secondary bg-transparent border border-secondary text-secondary'];

            case $statusEnum::Unpaid->value:
                return ['label' => $statusEnum::Unpaid->value, 'class' => 'badge px-3 py-2 text-bg-warning bg-transparent border border-warning text-warning'];

            case $statusEnum::Cancelled->value:
                return ['label' => $statusEnum::Cancelled->value, 'class' => 'badge p-2 text-bg-danger bg-transparent border border-danger text-danger'];   

            case $statusEnum::Processing->value:
                return ['label' => $statusEnum::Processing->value, 'class' => 'badge px-2 py-2 text-bg-primary bg-transparent border border-primary text-primary'];

            default:
                return ['label' => $statusEnum::Unpaid->value, 'class' => 'badge px-2 py-2 text-bg-secondary bg-transparent border border-secondary text-secondary'];
        }
    }
}

