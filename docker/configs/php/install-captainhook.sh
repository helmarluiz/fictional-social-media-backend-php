#!/bin/sh

cd /var/www/src/

./vendor/bin/captainhook install \
    --no-interaction \
    --force \
    --configuration="captainhook.json" \
    --git-directory=".git" \
    --run-mode="docker" \
    --run-exec="docker exec -w /var/www/src fsm-backend" \
    --run-path="vendor/bin/captainhook"