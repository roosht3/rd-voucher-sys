#!/bin/sh

php artisan migrate
php artisan queue:listen --queue=orders --tries=3
