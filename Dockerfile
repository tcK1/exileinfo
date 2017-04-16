FROM php:5.6-apache
MAINTAINER ticokaic

RUN brew install openssl && 
RUN brew link openssl --force

RUN brew install pkg-config

RUN mkdir -p /usr/local/openssl/include/openssl/ && \
    ln -s /usr/include/openssl/evp.h /usr/local/openssl/include/openssl/evp.h && \
    mkdir -p /usr/local/openssl/lib/ && \
    ln -s /usr/lib/x86_64-linux-gnu/libssl.a /usr/local/openssl/lib/libssl.a && \
    ln -s /usr/lib/x86_64-linux-gnu/libssl.so /usr/local/openssl/lib/

RUN pecl install mongodb

RUN a2enmod rewrite

COPY ./php.ini /usr/local/etc/php/
COPY ./ /var/www/html/

EXPOSE 80
