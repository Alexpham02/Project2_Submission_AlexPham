#!/usr/bin/env bash
set -euo pipefail

# If .env doesn't exist, create it and generate key
if [ ! -f .env ]; then
  cp .env.example .env
  php artisan key:generate
fi

# Install PHP dependencies
composer install --no-interaction --prefer-dist

# Run migrations + seed
php artisan migrate --force
php artisan db:seed --force

# Start Laravel dev server
php artisan serve --host=0.0.0.0 --port=8080
