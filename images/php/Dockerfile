FROM php:7.2-fpm-alpine
RUN apk add --no-cache bash
RUN apk add --no-cache libpng-dev
# lumen packages
RUN docker-php-ext-install mbstring tokenizer mysqli pdo_mysql gd
