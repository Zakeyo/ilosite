FROM php:8.2-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libpq-dev \
    libzip-dev \
    && docker-php-ext-configure zip \
    && docker-php-ext-install -j$(nproc) \
    pdo \
    pdo_pgsql \
    mbstring \
    zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Configurar el directorio de trabajo
WORKDIR /var/www

# Copiar archivos del proyecto
COPY . .

# Instalar dependencias de Composer
RUN composer install --ignore-platform-reqs --no-dev --no-interaction

# Generar clave de aplicación
RUN php artisan key:generate --show

# Configurar permisos
RUN chmod -R 755 storage bootstrap/cache

# Puerto y comando de inicio
EXPOSE 8000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]