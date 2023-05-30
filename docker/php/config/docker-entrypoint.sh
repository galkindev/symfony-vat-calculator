#!/bin/sh

set -e

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
	set -- php-fpm "$@"
fi

if [ "$1" = 'php-fpm' ]; then
    # Composer install on service run
    composer install --prefer-dist --no-interaction --optimize-autoloader
fi

cp /var/www/.env.local /var/www/app/.env.local
cp /var/www/.env.test.local /var/www/app/.env.test.local

php bin/console cache:clear

php bin/console doctrine:database:drop --force
php bin/console doctrine:database:drop --env=test --force

php bin/console doctrine:database:create --if-not-exists --no-interaction
php bin/console doctrine:database:create --env=test --if-not-exists --no-interaction

php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration
php bin/console doctrine:migrations:migrate --env=test --no-interaction --allow-no-migration

php bin/console doctrine:fixtures:load --no-interaction
php bin/console doctrine:fixtures:load --env=test --no-interaction

exec docker-php-entrypoint "$@"