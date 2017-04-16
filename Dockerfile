FROM php:5.6-apache
MAINTAINER ticokaic

RUN pecl install mongodb

COPY ./php.ini /usr/local/etc/php/
COPY ./ /var/www/html/
