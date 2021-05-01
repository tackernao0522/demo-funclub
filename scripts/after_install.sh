#!/bin/bash

set -eux

cd ~/demofun-ci/server
php artisan migrate --force
php artisan config:cache
