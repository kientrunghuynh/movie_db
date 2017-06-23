FROM php:7.1.3-fpm

RUN apt-get update && apt-get install -y libmcrypt-dev \
    mysql-client libmagickwand-dev --no-install-recommends \
    && apt-get install cron \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && docker-php-ext-install mcrypt pdo_mysql

# start laravel schedule
RUN /bin/bash -c 'crontab -l | { cat; echo "* * * * * php /var/www/artisan schedule:run >> /dev/null 2>&1"; } | crontab -'

COPY ./supervisord.conf /etc/supervisor/conf.d/supervisord.conf