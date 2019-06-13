FROM php:7.2-fpm-alpine

# lumen packages
RUN docker-php-ext-install mbstring tokenizer mysqli pdo_mysql

RUN apk --update add curl && rm /var/cache/apk/*
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer 

RUN apk add --no-cache bash
RUN apk add --no-cache libpng-dev
RUN docker-php-ext-install gd
