FROM php:8.1-cli-alpine

RUN apk update

RUN docker-php-ext-install sockets
RUN rm /var/cache/apk/* 
RUN mkdir -p /var/www
RUN chown -R www-data:www-data /var/www

# CMD ["php-fpm"]