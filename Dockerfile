FROM    php:7.3-apache AS laravel-base
COPY    --from=composer:1.9 /usr/bin/composer /usr/bin/composer

RUN     apt-get update && apt-get install --no-install-recommends -y \
            libxml2-dev \
            openssl \
            unzip \
            libzip-dev \
            zip \
        && rm -rf /var/lib/apt/lists/*

RUN     docker-php-ext-install \
            bcmath \
            ctype \
            json \
            mbstring \
            pdo \
            pdo_mysql \
            tokenizer \
            xml \
            zip


FROM    node:12-slim AS webpack
WORKDIR /usr/src/westwing
COPY    package.json package-lock.json ./
RUN     npm install
COPY    . .
RUN     npm run production


FROM    laravel-base AS development
RUN     pecl install xdebug-2.7.2 \
        && docker-php-ext-enable xdebug
ENV     COMPOSER_ALLOW_SUPERUSER=1


FROM    laravel-base AS production
WORKDIR /etc/apache2/
COPY    westwing.apache.conf sites-available/westwing.conf
RUN     sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf \
        && a2dissite 000-default.conf \
        && a2ensite westwing.conf \
        && a2enmod rewrite \
        && mv "${PHP_INI_DIR}"/php.ini-production "${PHP_INI_DIR}"/php.ini

# Docker doesn't create the WORKDIR with the correct USER, so we must do it
USER    www-data:www-data
RUN     mkdir /var/www/html/westwing

WORKDIR /var/www/html/westwing
COPY    --chown=www-data:www-data composer.json composer.lock ./
RUN     composer install --no-dev --no-autoloader

COPY    --chown=www-data:www-data . .
RUN     composer dump-autoload --optimize --no-dev

COPY    --chown=www-data:www-data --from=webpack /usr/src/westwing/public/css/app.css public/css/app.css

RUN     mv .env.production .env \
        && php artisan key:generate \
        && php artisan config:cache \
        && php artisan route:cache
