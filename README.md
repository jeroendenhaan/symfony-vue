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

## API endpoint examples
```
/character (shows all characters, by ascending id)
/character?order=age (shows all, ordered by ascending age)
/character?order=name&dir=desc (shows all by name, descending)
/character/5 (shows character with id 5)
/character/search/gorn (searches name and race for query 'gorn')
/character/search/gorn?order=age&dir=desc (same, but ordered)
```

## To do
- Properly comment everything
- Write some automated tests
- Setup Vue container as front end
