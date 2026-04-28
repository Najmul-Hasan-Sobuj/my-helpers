# Project Instructions

This repository is a Laravel helper package, not a full Laravel app.

When making changes here:

- Keep edits focused and minimal.
- Preserve the existing helper style in `src/helpers.php`.
- Keep helper functions wrapped in `if (!function_exists(...))` guards.
- Update `README.md` when release or usage behavior changes.
- Use semantic versioning for releases and publish new tags for Packagist updates.
- Prefer changes that work with Laravel 9, 10, 11, 12, and 13.

Package layout:

- `src/helpers.php` contains the helper functions.
- `src/HelpersServiceProvider.php` registers the package.
- `composer.json` defines autoloading and package metadata.

Release guidance:

- Commit code changes first.
- Create a new Git tag for the release, such as `v1.0.1`, `v1.1.0`, or `v2.0.0`.
- Push the branch and tags to the remote repository.
- If Packagist does not refresh automatically, use the package page update action or the repository webhook integration.
