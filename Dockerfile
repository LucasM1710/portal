FROM php:7.4
COPY ./ var/www/html

WORKDIR /var/www/html
EXPOSE 80
CMD ["php", "-S", "0.0.0.0:80"]