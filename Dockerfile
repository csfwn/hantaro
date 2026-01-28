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

WORKDIR /var/www

# Copy Supervisor configs
#COPY docker/supervisor/*.conf /etc/supervisor/conf.d/

# Start Supervisor (it will start php-fpm + queue)
#CMD ["/usr/bin/supervisord", "-n"]

