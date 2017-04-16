FROM php:5.6-apache
MAINTAINER ticokaic

RUN brew install openssl
RUN brew link openssl --force

RUN brew install pkg-config

RUN pecl install mongodb

RUN a2enmod rewrite

COPY ./php.ini /usr/local/etc/php/
COPY ./ /var/www/html/

EXPOSE 80
