FROM php:8.2-fpm

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libicu-dev \
    mariadb-client \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd intl zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /var/www/html

COPY ./entrypoint.sh /usr/local/bin/entrypoint.sh

RUN chown -R www-data:www-data /var/www/html \
    && chmod +x /usr/local/bin/entrypoint.sh

RUN composer install --no-scripts --no-autoloader

RUN mkdir -p storage/framework/{sessions,views,cache} storage/app/public storage/logs \
    && composer dump-autoload --optimize

EXPOSE 80

CMD ["entrypoint.sh"]