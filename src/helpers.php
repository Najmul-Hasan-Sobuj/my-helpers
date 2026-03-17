<?php

use Illuminate\Http\JsonResponse;

if (!function_exists('is_active_route')) {
    /**
     * Return a string (like 'active') if the current route matches the given route name(s).
     * Useful for setting active classes in navigation menus.
     *
     * @param string|array $routeNames
     * @param string $output
     * @return string
     */
    function is_active_route(string|array $routeNames, string $output = 'active'): string
    {
        if (request()->routeIs($routeNames)) {
            return $output;
        }

        return '';
    }
}

if (!function_exists('generate_initials')) {
    /**
     * Generate initials from a name (e.g., "John Doe" -> "JD").
     * Ideal for UI avatars.
     *
     * @param string $name
     * @return string
     */
    function generate_initials(string $name): string
    {
        $words = explode(' ', trim($name));
        if (count($words) >= 2) {
            return mb_strtoupper(mb_substr($words[0], 0, 1, 'UTF-8') . mb_substr(end($words), 0, 1, 'UTF-8'), 'UTF-8');
        }
        
        $initials = mb_substr($name, 0, 2, 'UTF-8');
        return mb_strtoupper($initials, 'UTF-8');
    }
}

if (!function_exists('estimated_read_time')) {
    /**
     * Estimate reading time in minutes for a given text (e.g., blog posts).
     *
     * @param string $text
     * @param int $wordsPerMinute
     * @return int
     */
    function estimated_read_time(string $text, int $wordsPerMinute = 200): int
    {
        $wordCount = str_word_count(strip_tags($text));
        $minutes = (int) ceil($wordCount / $wordsPerMinute);

        return $minutes > 0 ? $minutes : 1;
    }
}

if (!function_exists('api_response')) {
    /**
     * Standardized JSON response for APIs.
     *
     * @param bool $success
     * @param string $message
     * @param mixed $data
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    function api_response(bool $success, string $message, mixed $data = null, int $statusCode = 200): JsonResponse
    {
        $response = [
            'success' => $success,
            'message' => $message,
        ];

        if ($data !== null) {
            $response['data'] = $data;
        }

        return response()->json($response, $statusCode);
    }
}

if (!function_exists('format_currency')) {
    /**
     * Format a number as currency.
     *
     * @param float $amount
     * @param string $currencySymbol
     * @param int $decimals
     * @return string
     */
    function format_currency(float $amount, string $currencySymbol = '$', int $decimals = 2): string
    {
        return $currencySymbol . number_format($amount, $decimals);
    }
}

if (!function_exists('clean_phone_number')) {
    /**
     * Extract only the digits from a phone number string.
     * Useful before saving to the database.
     *
     * @param string $phone
     * @return string
     */
    function clean_phone_number(string $phone): string
    {
        return preg_replace('/[^0-9]/', '', $phone);
    }
}

