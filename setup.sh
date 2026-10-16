#!/usr/bin/env bash
set -e
composer install
[ -f .env ] || cp .env.example .env
grep -q '^APP_KEY=base64' .env || php artisan key:generate
php artisan optimize:clear
php artisan route:list
php artisan serve --port=8120
