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

### `slugify_text`
Creates a URL-friendly slug from a string.

```php
slugify_text('Hello Laravel 13'); // 'hello-laravel-13'
```

### `truncate_text`
Shortens long text to a readable preview.

```php
truncate_text('This is a long article title that needs shortening', 20); // 'This is a long arti...'
```

### `human_file_size`
Converts bytes into a human-readable file size.

```php
human_file_size(1536); // '1.5 KB'
```

### `human_time_diff`
Converts a date or timestamp into a relative time string.

```php
human_time_diff(now()->subHours(3)); // '3 hours ago'
```

### `generate_uuid`
Generates a UUID string for records, tokens, and identifiers.

```php
generate_uuid(); // '550e8400-e29b-41d4-a716-446655440000'
```

### `generate_ulid`
Generates a ULID string for sortable unique identifiers.

```php
generate_ulid(); // '01HZY7A4QG9F3P9JYJ8H2Y8QZ8'
```

### `estimate_ai_tokens`
Estimates how many tokens a prompt or response may use.

```php
estimate_ai_tokens('Write a concise product summary.'); // 8
```

### `sanitize_ai_prompt`
Normalizes text before sending it to an AI model.

```php
sanitize_ai_prompt("<p>Hello</p>\n\nPlease summarize this."); // 'Hello Please summarize this.'
```

### `chunk_text_for_ai`
Splits large text into chunks that are easier to send to a model.

```php
chunk_text_for_ai(str_repeat('Laravel AI ', 1000), 2000);
```

### `extract_json_from_ai_output`
Extracts JSON from a structured AI response, including fenced code blocks.

```php
extract_json_from_ai_output("```json\n{\"status\":\"ok\"}\n```");
```

## Supported Laravel Versions
- Laravel 9
- Laravel 10
- Laravel 11
- Laravel 12
- Laravel 13

## Supported PHP Versions
- PHP 8.0 or higher

## Releasing New Changes

Packagist does not read your working tree directly. After you change this package, you need to publish the change in Git and create a new version tag so Packagist can discover it.

Use this flow for every release:

1. Finish and commit your code changes.
2. Bump the package version by creating a new Git tag.
3. Push both the commit and the tag to your remote repository.
4. Wait for Packagist to sync automatically, or trigger a manual update from the package page if automatic sync is not enabled.

Packagist will automatically pick up new versions from tags that follow Semantic Versioning. Use tags like `v1.0.1`, `v1.1.0`, or `v2.0.0` for stable releases. For pre-releases, you can use tags like `v1.2.0-beta1` or `v1.2.0-RC1`.

Recommended release commands:

```bash
git add .
git commit -m "Release v1.0.1"
git tag v1.0.1
git push origin <your-branch> --tags
```

If your GitHub account is connected to Packagist, pushes usually sync automatically. If not, open the package page on Packagist and click the update button, or set up the Packagist GitHub webhook so new tags are detected faster.

Versioning tips:

- Use `patch` releases for bug fixes, like `v1.0.1`.
- Use `minor` releases for backward-compatible features, like `v1.1.0`.
- Use `major` releases for breaking changes, like `v2.0.0`.
- Keep `composer.json` free of a hardcoded `version` field so Packagist can derive versions from your tags.

## License

The MIT License (MIT).
