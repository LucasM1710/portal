FROM php:7.4
COPY ./ var/www

RUN docker-php-ext-install pdo_mysql

WORKDIR /var/www/
EXPOSE 80
CMD ["php", "-S", "0.0.0.0:80"]
