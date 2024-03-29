FROM ubuntu:16.04

RUN apt-get update && \
    apt-get install -y --no-install-recommends --no-install-suggests nginx php php-fpm ca-certificates gettext && \
    rm -rf /var/lib/apt/lists/*


# forward request and error logs to docker log collector
RUN ln -sf /dev/stdout /var/log/nginx/access.log \
	&& ln -sf /dev/stderr /var/log/nginx/error.log \
	&& ln -sf /dev/stderr /var/log/php7.0-fpm.log

RUN rm -f /etc/nginx/sites-enabled/*

COPY /etc/nginx.conf /tmp/nginx.conf.tpl
COPY /etc/php-fpm.conf /tmp/php-fpm.conf.tpl
COPY /etc/php.ini /etc/php/7.0/fpm/

RUN mkdir -p /run/php && touch /run/php/php7.0-fpm.sock && touch /run/php/php7.0-fpm.pid

COPY /etc/entrypoint.sh /entrypoint.sh 
RUN chmod 755 /entrypoint.sh

EXPOSE 80

CMD ["/entrypoint.sh"]

RUN apt-get update && apt-get install -y --no-install-recommends --no-install-suggests supervisor

COPY /src/. /var/www/html/
COPY /etc/supervisor.conf /etc/supervisor/conf.d/supervisor.conf