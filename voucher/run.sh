#!/bin/sh

php artisan migrate
php artisan queue:listen --queue=vouchers --tries=3
