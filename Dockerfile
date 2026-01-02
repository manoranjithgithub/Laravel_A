### Multi-stage Dockerfile for Laravel (PHP 8.2)

FROM composer:2 AS composer
WORKDIR /app
COPY composer.json composer.lock* ./
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader --no-progress

FROM node:18-alpine AS node-builder
WORKDIR /app
COPY package.json package-lock.json* ./
RUN npm ci --silent
COPY . ./
RUN npm run build || true

FROM php:8.2-fpm

# Install system dependencies and PHP extensions (including pdo_mysql)
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
       git \
       unzip \
       zip \
       curl \
       default-mysql-client \
       libpng-dev \
       libjpeg62-turbo-dev \
       libfreetype6-dev \
       libzip-dev \
       libonig-dev \
       libicu-dev \
       ca-certificates \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) pdo_mysql gd zip bcmath intl opcache \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Copy composer vendor from composer stage
WORKDIR /var/www/html
COPY --from=composer /app/vendor /var/www/html/vendor
COPY --from=composer /app/composer.lock /var/www/html/composer.lock

# Copy application source
COPY . /var/www/html

# Copy built frontend assets (if any)
COPY --from=node-builder /app/public/build /var/www/html/public/build

# Basic OPcache tuning for production
RUN printf "[opcache]\nopcache.memory_consumption=128\nopcache.interned_strings_buffer=8\nopcache.max_accelerated_files=10000\nopcache.revalidate_freq=0\n" > /usr/local/etc/php/conf.d/opcache-recommended.ini

# Permissions
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache || true

EXPOSE 9000
CMD ["php-fpm"]
