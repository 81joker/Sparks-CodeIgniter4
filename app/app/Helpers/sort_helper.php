<?php 

if (!function_exists('sortable_column')) {
    function sortable_column(string $label, string $field, string $currentField, string $currentDirection, string $search = ''): string
    {
        $direction = ($currentField === $field && $currentDirection === 'ASC') ? 'DESC' : 'ASC';
        $arrow = '';

        if ($currentField === $field) {
            $arrow = $currentDirection === 'ASC' ? '↑' : '↓';
        }

        $url = '?sort_field=' . $field . '&sort_direction=' . $direction . '&search=' . urlencode($search);

        return '<a href="' . $url . '" class="text-dark">'
            . esc($label) . ' ' . $arrow . '</a>';
    }
}

