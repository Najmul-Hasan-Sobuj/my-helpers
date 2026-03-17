<?php

namespace Najmul\Helpers;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Carbon\Carbon;

if (!function_exists('Najmul\Helpers\str_slugify')) {
    /**
     * Slugify string; return empty string for null/empty
     */
    function str_slugify(?string $value, string $separator = '-'): string
    {
        if (empty($value)) {
            return '';
        }
        return Str::slug($value, $separator);
    }
}

if (!function_exists('Najmul\Helpers\array_filter_null')) {
    /**
     * Remove null values from array
     */
    function array_filter_null(array $array): array
    {
        return array_filter($array, function ($value) {
            return $value !== null;
        });
    }
}

if (!function_exists('Najmul\Helpers\array_get_nested')) {
    /**
     * Dot-notation get with fallback
     */
    function array_get_nested(array $array, string $key, mixed $default = null): mixed
    {
        return Arr::get($array, $key, $default);
    }
}

if (!function_exists('Najmul\Helpers\format_date')) {
    /**
     * Format date safely
     */
    function format_date(Carbon|string|null $date, string $format = 'Y-m-d'): string
    {
        if (empty($date)) {
            return '';
        }

        try {
            $carbonDate = $date instanceof Carbon ? $date : Carbon::parse($date);
            return $carbonDate->format($format);
        } catch (\Exception $e) {
            return '';
        }
    }
}

if (!function_exists('Najmul\Helpers\optional_trim')) {
    /**
     * Trim string or return null
     */
    function optional_trim(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $trimmed = trim($value);
        return $trimmed === '' ? null : $trimmed;
    }
}
