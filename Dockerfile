FROM php:8.2-fpm
RUN apt-get update && apt-get install -y \
    git zip unzip libpq-dev && \
    docker-php-ext-install pdo pdo_pgsql mbstring
WORKDIR /var/www
COPY . .
RUN composer install --ignore-platform-reqs --no-dev --no-interaction && \
    php artisan key:generate --show && \
    chmod -R 755 storage bootstrap/cache
CMD php artisan serve --host=0.0.0.0 --port=8000