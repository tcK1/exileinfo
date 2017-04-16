FROM php:5.6-apache
MAINTAINER tcK1 (kaicbastidas@gmail.com)

RUN apt-get update

RUN apt-get install -y autoconf g++ make openssl libssl-dev libcurl4-openssl-dev pkg-config libsasl2-dev libpcre3-dev

RUN pecl install mongo
RUN docker-php-ext-enable mongo

RUN a2enmod rewrite

COPY ./php.ini /usr/local/etc/php/
COPY ./ /var/www/html/

EXPOSE 80
