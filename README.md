## Synopsis and Motivation
This project is a simple ticket system.

It is a challenge created by Westwing for a Back-end developer position, which I've applayed, so Westwing can evaluate my programming skills.

## Stack
- [Laravel](https://laravel.com/)
- [Docker](https://www.docker.com/)
- [MySQL](https://www.mysql.org/)

## How to run

On src folder, run:

```bash
cp .env.example .env
```

Then, on root folder, run:

```bash
docker-compose up -d
docker exec -it westwing-php-fpm /bin/bash
php artisan migrate
```

Then open on browser on "localhost:8888".
