FROM php:7.4
COPY ./ ./

RUN docker-php-ext-install pdo_mysql

WORKDIR /painel
EXPOSE 80
CMD ["php", "-S", "0.0.0.0:80"]