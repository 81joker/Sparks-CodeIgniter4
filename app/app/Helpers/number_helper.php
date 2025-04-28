<?php



if (!function_exists('format_number')) {
    function format_number($number, string $locale = 'de-DE', int $style = NumberFormatter::DECIMAL): string
    {
        // https://www.php.net/manual/en/class.numberformatter.php#numberformatter.constants.currency
        $formatter = new NumberFormatter($locale, $style);

        return $formatter->format($number);
    }
}

if (!function_exists('format_currency')) {
    function format_currency_custom($number, string $currency = 'EUR', string $locale = 'de-DE'): string
    {
        $formatter = new NumberFormatter($locale, NumberFormatter::CURRENCY);

        return $formatter->formatCurrency($number, $currency);
    }
}
