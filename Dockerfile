FROM php:8.2-fpm-alpine

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apk add --no-cache \
    libzip-dev \
    zip \
    libpng-dev \
    oniguruma-dev \
    libxml2-dev \
    icu-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    curl

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install \
    pdo_mysql \
    zip \
    gd \
    mbstring \
    opcache \
    bcmath \
    intl \
    exif \
    pcntl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www/html

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Run post-install scripts
RUN composer run-script post-autoload-dump 2>/dev/null || true

# Set permissions
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html/storage && \
    chmod -R 755 /var/www/html/bootstrap/cache && \
    mkdir -p /var/www/html/storage/logs && \
    chown -R www-data:www-data /var/www/html/storage/logs

# Configure PHP
COPY --chown=www-data:www-data docker/php/php.ini /usr/local/etc/php/php.ini
COPY --chown=www-data:www-data docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# Expose port
EXPOSE 9000

# Health check
HEALTHCHECK --interval=30s --timeout=3s --start-period=10s --retries=3 \
  CMD curl -f http://localhost:9000/ping || exit 1

# Start PHP-FPM as www-data user
USER www-data
CMD ["php-fpm"]
