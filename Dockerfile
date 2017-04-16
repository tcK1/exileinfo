FROM php:5.6-apache
MAINTAINER ticokaic

ARG mongodburi

RUN pecl install mongodb
RUN echo "export MONGODBURI="$mongodburi"" >> ~/.bashrc

COPY ./php.ini /usr/local/etc/php/
COPY ./ /var/www/html/
