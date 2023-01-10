# symfony-vue

Simple playground/sandbox setup for containerized Symfony/PHP/mySQL setup, with persistent volumes for Symfony code and mySQL database(s).

## Installation
From the project's root directory:
```
cd symfony
composer install
npm install
npm run dev
cd ..
```
Copy sample environment:
```
cp .env.sample .env
```
Run the Docker Compose setup:
```
docker compose up --build
```
In container 'php' run:
```
php bin/console doctrine:migrations:migrate
```
That'll create a MySQL table named 'person' and fill it with some test data.

Visit http://127.0.0.1:8080 and http://127.0.0.1:8080/person to check proper installation.

## To do
- Transform Symfony app into backend API microservice
- Setup Vue container as front end