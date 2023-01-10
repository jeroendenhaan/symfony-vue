# symfony-vue

Private, simple test setup for containerized Symfony/PHP/mySQL setup, with persistent volumes (of course) for Symfony code and mySQL database(s).

Installation:
- central database configuration in root's .env file (copy from .env.sample)
- directory 'mysql' is omitted, but will be created during build
- php bin/console doctrine:migrations:migrate should be run through php container after up
