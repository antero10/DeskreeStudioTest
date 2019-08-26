FROM php
WORKDIR /usr/src/app
RUN docker-php-ext-install mysqli pdo pdo_mysql
