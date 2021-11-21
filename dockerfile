FROM php:7.3-fpm

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y git zip

# we should do this in dev mode only, composer should not be available in production
RUN curl --silent --show-error https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer
