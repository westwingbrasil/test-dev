cp ./src/.env.example ./src/.env
git submodule update laradock
cd ./laradock
cp env-example .env
docker-compose up composer


