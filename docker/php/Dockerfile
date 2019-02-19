# ./docker/php/Dockerfile
FROM php:7.3.2-fpm-alpine3.8

# RUN docker-php-ext-install pdo_mysql

# RUN pecl install apcu-5.1.8
# RUN docker-php-ext-enable apcu
    
RUN docker-php-ext-install pdo pdo_mysql

RUN php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/bin --version=1.8.4 --filename=composer

WORKDIR /usr/src/app


COPY ./assets /usr/src/app
COPY ./bin /usr/src/app
COPY ./config /usr/src/app
COPY ./public /usr/src/app
COPY ./src /usr/src/app
COPY ./templates /usr/src/app
COPY ./composer.json /usr/src/app
COPY ./composer.lock /usr/src/app
COPY ./package.json /usr/src/app/package.jsondo

RUN composer install



RUN PATH=$PATH:/usr/src/apps/vendor/bin:bin

RUN apk add --update nodejs 

RUN apk add yarn

RUN yarn install

RUN yarn run encore dev