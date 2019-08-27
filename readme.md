# Deskree Test

This is a test for evaluate skills of programmer


# How to use it

* First make sure you have [Docker](https://docs.docker.com/install/), [docker-compose](https://docs.docker.com/compose/install/) and [Composer](https://getcomposer.org/doc/00-intro.md), this tools are essential to make this app run.
* Install all the dependencies running `composer install` or `composer.phar install` (depends how you installed).
* Then run the containers using `docker-compose up -d` this might take a while the first time, because docker needs to create the container the first time.
* Then copy the `.env.example` as the main `.env` using `cp .env.example .env`
* Create the keys running `docker-compose exec app php artisan key:generate`
* Run the migrations `docker-compose exec app php artisan migrate`
* Open the browser and go to `localhost:8000`
