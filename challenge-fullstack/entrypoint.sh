#!/bin/sh

composer install

sleep 3

php artisan key:generate

php artisan migrate

php artisan serve --host=0.0.0.0 --port=80