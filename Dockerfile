FROM php:$TRAVIS_PHP_VERSION-apache
MAINTAINER ticokaic

ARG mongodburi

RUN pecl install mongodb
RUN echo "export MONGODBURI="$mongodburi"" >> ~/.bashrc

COPY ./php.ini /usr/local/etc/php/
COPY ./ /var/www/html/
