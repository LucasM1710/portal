FROM php:7.4
COPY ./ home/portal

RUN docker-php-ext-install pdo_mysql

WORKDIR /home/portal
EXPOSE 80
CMD ["php", "-S", "0.0.0.0:80"]
