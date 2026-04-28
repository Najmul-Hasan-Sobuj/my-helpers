<?php

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

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

if (!function_exists('slugify_text')) {
    /**
     * Create a URL-friendly slug from a string.
     *
     * @param string $text
     * @param string $separator
     * @return string
     */
    function slugify_text(string $text, string $separator = '-'): string
    {
        return Str::slug($text, $separator);
    }
}

if (!function_exists('truncate_text')) {
    /**
     * Truncate a string to a given length.
     *
     * @param string $text
     * @param int $limit
     * @param string $end
     * @return string
     */
    function truncate_text(string $text, int $limit = 120, string $end = '...'): string
    {
        return Str::limit(strip_tags($text), $limit, $end);
    }
}

if (!function_exists('human_file_size')) {
    /**
     * Convert bytes into a human-readable file size.
     *
     * @param int|float $bytes
     * @param int $precision
     * @return string
     */
    function human_file_size(int|float $bytes, int $precision = 1): string
    {
        $bytes = max(0, (float) $bytes);
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
        $unitIndex = 0;

        while ($bytes >= 1024 && $unitIndex < count($units) - 1) {
            $bytes /= 1024;
            $unitIndex++;
        }

        return number_format($bytes, $precision) . ' ' . $units[$unitIndex];
    }
}

if (!function_exists('human_time_diff')) {
    /**
     * Convert a date or timestamp to a relative time string.
     *
     * @param DateTimeInterface|string|int|null $value
     * @return string
     */
    function human_time_diff(DateTimeInterface|string|int|null $value): string
    {
        if ($value === null || $value === '') {
            return '';
        }

        $date = $value instanceof DateTimeInterface
            ? Carbon::instance($value)
            : (is_int($value) ? Carbon::createFromTimestamp($value) : Carbon::parse($value));

        return $date->diffForHumans();
    }
}

if (!function_exists('generate_uuid')) {
    /**
     * Generate a UUID string.
     *
     * @return string
     */
    function generate_uuid(): string
    {
        return (string) Str::uuid();
    }
}

if (!function_exists('generate_ulid')) {
    /**
     * Generate a ULID string.
     *
     * @return string
     */
    function generate_ulid(): string
    {
        return (string) Str::ulid();
    }
}

if (!function_exists('estimate_ai_tokens')) {
    /**
     * Estimate the number of tokens in a text string.
     *
     * @param string $text
     * @param int $charsPerToken
     * @return int
     */
    function estimate_ai_tokens(string $text, int $charsPerToken = 4): int
    {
        $length = mb_strlen(trim($text), 'UTF-8');

        if ($length === 0) {
            return 0;
        }

        return (int) ceil($length / max(1, $charsPerToken));
    }
}

if (!function_exists('sanitize_ai_prompt')) {
    /**
     * Normalize text before sending it to an AI model.
     *
     * @param string $text
     * @return string
     */
    function sanitize_ai_prompt(string $text): string
    {
        $text = strip_tags($text);
        $text = preg_replace('/\s+/u', ' ', $text);

        return trim($text ?? '');
    }
}

if (!function_exists('chunk_text_for_ai')) {
    /**
     * Split text into chunks that are easier to send to an AI model.
     *
     * @param string $text
     * @param int $maxCharacters
     * @param string $separator
     * @return array<int, string>
     */
    function chunk_text_for_ai(string $text, int $maxCharacters = 4000, string $separator = "\n\n"): array
    {
        $text = trim($text);

        if ($text === '') {
            return [];
        }

        if (mb_strlen($text, 'UTF-8') <= $maxCharacters) {
            return [$text];
        }

        $chunks = [];
        $parts = explode($separator, $text);
        $currentChunk = '';

        foreach ($parts as $part) {
            $candidate = $currentChunk === '' ? $part : $currentChunk . $separator . $part;

            if (mb_strlen($candidate, 'UTF-8') <= $maxCharacters) {
                $currentChunk = $candidate;
                continue;
            }

            if ($currentChunk !== '') {
                $chunks[] = $currentChunk;
                $currentChunk = '';
            }

            if (mb_strlen($part, 'UTF-8') <= $maxCharacters) {
                $currentChunk = $part;
                continue;
            }

            $segment = '';

            foreach (preg_split('//u', $part, -1, PREG_SPLIT_NO_EMPTY) as $character) {
                $segmentCandidate = $segment . $character;

                if (mb_strlen($segmentCandidate, 'UTF-8') > $maxCharacters && $segment !== '') {
                    $chunks[] = $segment;
                    $segment = $character;
                    continue;
                }

                $segment = $segmentCandidate;
            }

            if ($segment !== '') {
                $currentChunk = $segment;
            }
        }

        if ($currentChunk !== '') {
            $chunks[] = $currentChunk;
        }

        return $chunks;
    }
}

if (!function_exists('extract_json_from_ai_output')) {
    /**
     * Extract and decode JSON from an AI response.
     *
     * @param string $text
     * @param bool $associative
     * @return array|object|null
     */
    function extract_json_from_ai_output(string $text, bool $associative = true): array|object|null
    {
        $text = trim($text);

        if ($text === '') {
            return null;
        }

        if (preg_match('/```(?:json)?\s*(.*?)```/is', $text, $matches)) {
            $text = trim($matches[1]);
        }

        $decoded = json_decode($text, $associative);

        if (json_last_error() === JSON_ERROR_NONE) {
            return $decoded;
        }

        if (preg_match('/\{.*\}|\[.*\]/s', $text, $matches)) {
            $decoded = json_decode($matches[0], $associative);

            if (json_last_error() === JSON_ERROR_NONE) {
                return $decoded;
            }
        }

        return null;
    }
}

