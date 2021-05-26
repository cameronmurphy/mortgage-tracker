# syntax=docker/dockerfile:1
FROM php:8-fpm

# Extensions to speed up Symfony
RUN pecl install xdebug && docker-php-ext-enable xdebug
RUN pecl install apcu && docker-php-ext-enable apcu --ini-name 10-docker-php-ext-apcu.ini
RUN docker-php-ext-install opcache
RUN apt-get update && apt-get install -y libicu-dev && docker-php-ext-install intl && docker-php-ext-configure intl

# App extensions
RUN apt-get install -y libpq-dev && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && docker-php-ext-install pdo pdo_pgsql pgsql

WORKDIR /var/www
