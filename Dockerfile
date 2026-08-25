FROM php:8.4-cli-alpine

RUN apk add --no-cache git unzip postgresql-dev libzip-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN chmod -R 775 storage bootstrap/cache

EXPOSE 8080

CMD php artisan migrate --force && php artisan storage:link && php artisan config:cache && php artisan serve --host=0.0.0.0 --port=${PORT:-8080}