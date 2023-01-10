# symfony-vue

Simple playground/sandbox setup for containerized Symfony/PHP/mySQL setup, with persistent volumes for Symfony code and mySQL database(s).

Installation:
- Copy '.env.sample' to '.env'
- Run 'php bin/console doctrine:migrations:migrate' in container 'php' (this will create a test table 'person' and fill in some sample data)
- Visit http://127.0.0.1:8080 and http://127.0.0.1:8080/person to check proper installation

To do:
- Transform Symfony app into backend API microservice
- Setup Vue container as front end