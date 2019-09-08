FROM    php:7.3-apache
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

RUN     pecl install xdebug-2.7.2 \
        && docker-php-ext-enable xdebug

ENV     COMPOSER_ALLOW_SUPERUSER=1
