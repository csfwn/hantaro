FROM php:8.4-fpm

RUN apt update && apt install -y \
    git zip unzip curl supervisor \
    libpng-dev libonig-dev libxml2-dev libzip-dev libicu-dev \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        mbstring \
        zip \
        gd \
        intl \
	exif

# Node.js (needed for Vite build only)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt install -y nodejs

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN echo "upload_max_filesize=50M\npost_max_size=50M\nmemory_limit=256M\nmax_execution_time=300\nmax_input_time=300" \
    > /usr/local/etc/php/conf.d/zz-upload.ini

WORKDIR /var/www

# Copy Supervisor configs
COPY docker/supervisor/*.conf /etc/supervisor/conf.d/

# Permissions
RUN chown -R www-data:www-data /var/www \
   && chmod -R 775 storage bootstrap/cache || true

# Start Supervisor (it will start php-fpm + queue)
CMD ["/usr/bin/supervisord", "-n"]

