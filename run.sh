cd ./laradock
cp env-example .env

cd ../src
mv env-example .env

docker-compose up nginx php-fpm mysql