#!/bin/bash

# Laravel deployment script untuk Railway
# Menjalankan setup otomatis saat container start

# Generate APP_KEY jika belum ada
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Menjalankan database migrations
echo "Running database migrations..."
php artisan migrate --force

# Seed database jika diperlukan
if [ "$SEED_DATABASE" = "true" ]; then
    echo "Seeding database..."
    php artisan db:seed --force
fi

# Clear caches
echo "Clearing caches..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo "Setup complete! Starting Apache..."
apache2-foreground
