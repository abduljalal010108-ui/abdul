
FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    git unzip libsqlite3-dev libonig-dev libzip-dev \
    && docker-php-ext-install pdo_mysql pdo_sqlite mbstring bcmath zip \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/000-default.conf \
    && sed -ri 's!/var/www/!${APACHE_DOCUMENT_ROOT}/!g' \
    /etc/apache2/apache2.conf \
    && sed -i 's/Listen 80/Listen 10000/' /etc/apache2/ports.conf \
    && sed -i 's/:80>/:10000>/' /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN mkdir -p database \
    && touch database/database.sqlite \
    && chown -R www-data:www-data storage bootstrap/cache database

EXPOSE 10000
CMD ["sh", "-c", "php artisan migrate --force && php artisan db:seed --force && apache2-foreground"]
