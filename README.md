php -S localhost:3000 -t public

php bin/console doctrine:database:create
php bin/console --env=test doctrine:database:create
php bin/console --env=test doctrine:schema:create

php bin/console doctrine:fixtures:load
php bin/console --env=test doctrine:fixtures:load


