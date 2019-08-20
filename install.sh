cp ./src/.env.example ./src/.env
git submodule update --init laradock
cd ./laradock
cp env-example .env
docker-compose up composer


