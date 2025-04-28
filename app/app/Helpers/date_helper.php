<?php

if (!function_exists('format_created_at')) {
    function format_created_at($createdAt) {
        $dateTime = new DateTime($createdAt);
        return $dateTime->format('F j, Y');
    }
}