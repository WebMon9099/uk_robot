<?php

use Illuminate\Support\Facades\Cache;
use App\Models\Settings;
use Illuminate\Support\Str;

if (!function_exists('getPayPalCredentials')) {
    function getPayPalCredentials() {
        return Cache::remember('paypal_credentials', 60, function () {
            return Settings::where('payment_type', 'paypal')->first();
        });
    }
}
if (!function_exists('getWordRange')) {
    /**
     * Extract a specific range of words from a string.
     *
     * @param string $text
     * @param int $start
     * @param int $end
     * @return string
     */
    function getWordRange($text, $start, $end) {
        $words = Str::words($text, $end, '');
        $wordArray = explode(' ', $words);

        // Adjust for 0-based index and slice the desired range
        $range = array_slice($wordArray, $start - 1, $end - $start + 1);

        return implode(' ', $range);
    }
}
