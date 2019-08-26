FROM php
WORKDIR /usr/src/app
RUN apt-get update && apt-get install -y libmagickwand-dev --no-install-recommends && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN pecl install imagick && docker-php-ext-enable imagick
