# Backend Interview Starting Point (PHP / Symfony)

A bare-bones Symfony app used as a starting point for a live coding interview.

## Requirements

- PHP 8.4+
- Composer

## Getting started

```bash
composer install
php -S 127.0.0.1:8000 -t public
```

The app is now available at http://127.0.0.1:8000.

(If you have the Symfony CLI installed, `symfony serve` works too.)

## Useful commands

```bash
php bin/console debug:router   # list routes
php bin/console cache:clear    # clear the cache
```
