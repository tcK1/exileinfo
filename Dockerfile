FROM php:5.6-apache
MAINTAINER ticokaic

RUN apt-get update

RUN apt-get install libssl-dev -y
RUN apt-get install pkg-config -y

RUN mkdir -p /usr/local/openssl/include/openssl/ && \
    ln -s /usr/include/openssl/evp.h /usr/local/openssl/include/openssl/evp.h && \
    mkdir -p /usr/local/openssl/lib/ && \
    ln -s /usr/lib/x86_64-linux-gnu/libssl.a /usr/local/openssl/lib/libssl.a && \
    ln -s /usr/lib/x86_64-linux-gnu/libssl.so /usr/local/openssl/lib/

RUN apt-get update

RUN apt-get install -y autoconf g++ make openssl libssl-dev libcurl4-openssl-dev pkg-config libsasl2-dev libpcre3-dev

RUN pecl install mongo

RUN docker-php-ext-enable mongo

RUN a2enmod rewrite

COPY ./php.ini /usr/local/etc/php/
COPY ./ /var/www/html/

EXPOSE 80
