#!/bin/sh
set -x
echo "Starting server on port ${PORT:-8000}"
php artisan serve --host=0.0.0.0 --port=${PORT}
