FROM php:8.4-apache

RUN a2enmod rewrite
RUN apt-get update && apt-get install -y cron
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli pdo pdo_mysql
RUN apt-get update && apt-get upgrade -y

RUN apt-get update
RUN apt-get install -y libzip-dev
RUN docker-php-ext-install zip

RUN apt-get update                             \
 && apt-get install -y --no-install-recommends \
    ca-certificates curl firefox-esr           \
 && rm -fr /var/lib/apt/lists/*                \
 && curl -L https://github.com/mozilla/geckodriver/releases/download/v0.30.0/geckodriver-v0.30.0-linux64.tar.gz | tar xz -C /usr/local/bin \
 && apt-get purge -y ca-certificates curl

COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

CMD (cron -f -l 8 &) && apache2-foreground
