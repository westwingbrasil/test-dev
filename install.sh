cp ./src/.env.example ./src/.env
git submodule update --init laradock
cd ./laradock
cp env-example .env
docker-compose up -d mysql
docker-compose up composer
docker-compose exec mysql mysql -u root -proot -e "alter user 'default'@'%' identified with mysql_native_password by 'secret';"
docker-compose up -d php-fpm
docker-compose exec php-fpm php artisan migrate
