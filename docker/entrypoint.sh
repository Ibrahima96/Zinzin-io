#!/bin/bash

# Exécuter les migrations en production
echo "Running migrations..."
php artisan migrate --force

# Lancer le serveur
echo "Starting server..."
php artisan serve --host=0.0.0.0 --port=${PORT:-10000}
