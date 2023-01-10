# Symfony Restful API & Vue SPA

Personal, simple playground/sandbox setup for containerized Symfony/PHP/mySQL/Vue setup, with persistent volumes for Symfony code and mySQL database(s). Aim is to use Symfony as a backend REST API, accessible by a frontend Vue SPA.

*This is a work in progress and will remain just that: I use it to teach myself and made this repo public in order to easily show my work to others in order to learn.*

## Installation
From the project's root directory:
```
cd symfony
```
Create file .env.local and put your environment and secret in it:
```
# Overwrite values in Symfony's .env using global .env in root (or fallback for Composer install)
APP_ENV=dev
APP_SECRET=your_secret_here
```
Then install all dependencies:
```
composer install
npm install
npm run dev
cd ..
```
Copy (and edit) sample environment:
```
cp .env.sample .env
```
Run the Docker Compose cluster (or use './up.sh' in root directory):
```
docker compose up --build
```
In container 'php' run:
```
php bin/console doctrine:migrations:migrate
```
That'll create a MySQL table named 'character' and fill it with some test data.

Visit http://127.0.0.1:8080/character to check if all works well.

## API endpoints
```
/character (shows all characters)
/character/<id> (shows character with specific id)
```

## To do
- Setup Vue container as front end
