FROM php:8.1-fpm

RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

WORKDIR /var/www/html

#RUN curl -sS https://get.symfony.com/cli/installer | bash
#RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony
#RUN git config --global user.email "you@example.com" \
#    && git config --global user.name "Your Name"
