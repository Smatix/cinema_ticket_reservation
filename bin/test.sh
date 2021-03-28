docker exec cinema_web php bin/console doctrine:database:create --env=test --if-not-exists
docker exec cinema_web php bin/phpunit