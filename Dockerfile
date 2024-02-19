FROM php:7.4
COPY ./ var/www/html

RUN docker-php-ext-install pdo_mysql

WORKDIR /var/www/html
EXPOSE 80
CMD ["php", "-S", "0.0.0.0:80"]
