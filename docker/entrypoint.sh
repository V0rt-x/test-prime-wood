#!/bin/bash

printf "\n\nStarting PHP daemon...\n\n"
php-fpm --daemonize

printf "Starting Nginx...\n\n"
set -e

if [[ "$1" == -* ]]; then
    set -- nginx -g daemon off; "$@"
fi

exec "$@"
