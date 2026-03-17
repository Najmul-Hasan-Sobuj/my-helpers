# Laravel Helpers Package

A collection of real-world, highly useful helper functions for Laravel projects. It is compatible with Laravel 9, 10, 11, 12, and 13.

## Installation

You can install the package via composer:

```bash
composer require najmul-hasan-sobuj/my-helpers
```

The package will automatically register its service provider. These functions are globally available, just like Laravel's built-in helper functions, so you don't need to import any namespace!

## Publishing the Helpers (Optional)

If you would like to modify the helper functions or add your own, you can publish the `helpers.php` file to your project's `app/Helpers` directory.

Run the following command:

```bash
php artisan vendor:publish --tag="laravel-helpers"
```

After publishing, the file will be located at `app/Helpers/helpers.php`. You can modify it however you like. 

To ensure your Laravel application loads this file, you must add it to the `autoload -> files` array in your project's `composer.json` file:

```json
"autoload": {
    "psr-4": {
        "App\\": "app/",
        "Database\\Factories\\": "database/factories/",
        "Database\\Seeders\\": "database/seeders/"
    },
    "files": [
        "app/Helpers/helpers.php"
    ]
},
```

Then, run:
```bash
composer dump-autoload
```

Because all helper functions are wrapped in `if (!function_exists('...'))`, your local application's helper functions will take precedence over the package's defaults if your autoloader loads them first.

## Available Helpers

### `is_active_route`
Returns a string (default: `'active'`) if the current route matches the given route name(s). Perfect for setting active classes in navigation menus.

```php
// In a Blade template:
// <li class="{{ is_active_route('dashboard') }}">Dashboard</li>
// <li class="{{ is_active_route(['users.index', 'users.create']) }}">Users</li>
```

### `generate_initials`
Generates initials from a name (e.g., "John Doe" -> "JD"). Ideal for UI avatars when a user hasn't uploaded a profile picture.

```php
generate_initials('John Doe'); // 'JD'
generate_initials('Alice'); // 'AL'
```

### `estimated_read_time`
Estimates the reading time in minutes for a given text. Great for blog posts and articles.

```php
$content = "Long article content here...";
$minutes = estimated_read_time($content); // e.g., 5
```

### `api_response`
A standardized JSON response for APIs. Keeps your API responses consistent across controllers.

```php
return api_response(true, 'User created successfully', $user, 201);
// { "success": true, "message": "User created successfully", "data": { ... } }

return api_response(false, 'Validation failed', null, 422);
```

### `format_currency`
Formats a number as currency.

```php
format_currency(1250.5); // '$1,250.50'
format_currency(500, '€'); // '€500.00'
```

### `clean_phone_number`
Extracts only the digits from a phone number string. Extremely useful for sanitizing phone numbers before saving to the database.

```php
clean_phone_number('+1 (555) 123-4567'); // '15551234567'
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
