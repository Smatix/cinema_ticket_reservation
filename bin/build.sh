docker-compose build
docker-compose up -d
docker exec cinema_web composer install
docker exec cinema_web php bin/console doctrine:database:create --if-not-exists
docker exec cinema_web php bin/console doctrine:migrations:migrate --no-interaction
echo "Application is ready"