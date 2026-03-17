# Laravel Helpers Package

A minimal Laravel helper package that provides generic utility functions for strings, arrays, and dates. It is compatible with Laravel 9, 10, 11, 12, and 13.

## Installation

You can install the package via composer:

```bash
composer require najmul-hasan-sobuj/my-helpers
```

The package will automatically register its service provider.

## Available Helpers

### `str_slugify`
Slugifies a string. Returns an empty string for null/empty values.

```php
use function Najmul\Helpers\str_slugify;

str_slugify('Hello World'); // 'hello-world'
```

### `array_filter_null`
Removes only `null` values from an array (preserves `false`, `0`, and empty strings).

```php
use function Najmul\Helpers\array_filter_null;

array_filter_null(['a' => 1, 'b' => null, 'c' => 0]); // ['a' => 1, 'c' => 0]
```

### `array_get_nested`
Gets a value from a deeply nested array using dot notation.

```php
use function Najmul\Helpers\array_get_nested;

array_get_nested(['user' => ['name' => 'John']], 'user.name'); // 'John'
```

### `format_date`
Safely formats a date string or Carbon instance. Returns an empty string on invalid dates.

```php
use function Najmul\Helpers\format_date;

format_date('2026-03-17'); // '2026-03-17'
```

### `optional_trim`
Trims a string. Returns `null` if the string is empty or was originally `null`.

```php
use function Najmul\Helpers\optional_trim;

optional_trim('  hello  '); // 'hello'
optional_trim('   '); // null
```

## Supported Laravel Versions
- Laravel 9
- Laravel 10
- Laravel 11
- Laravel 12
- Laravel 13

## Supported PHP Versions
- PHP 8.0 or higher

## License

The MIT License (MIT).
