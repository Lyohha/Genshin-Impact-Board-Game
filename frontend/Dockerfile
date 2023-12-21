FROM php:8.1-apache

RUN apt-get update
RUN apt-get update && apt install software-properties-common -y
RUN apt-get install wget -y

RUN apt-get update && apt-get install -y libmagickwand-dev --no-install-recommends && rm -rf /var/lib/apt/lists/*

RUN apt-get update && apt-get install -y curl
RUN apt-get install -y
RUN apt-get install -y libzip-dev 

RUN apt-get install -y libmcrypt-dev \
    && pecl install mcrypt-1.0.5 \
    && docker-php-ext-enable mcrypt

RUN printf "\n" | pecl install imagick
RUN docker-php-ext-enable imagick

RUN chown -R www-data:www-data /var/www

RUN a2enmod rewrite


# CMD ["php-fpm"]