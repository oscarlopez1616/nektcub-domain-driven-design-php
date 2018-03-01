FROM php:7.2-fpm

RUN apt-get update && apt-get install -y git unzip openssl procps acl zlib1g-dev

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install pdo pdo_mysql bcmath zip

WORKDIR /var/www/nektcub