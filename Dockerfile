# Use uma imagem PHP como base
FROM php:7.4-apache

# Define o diretório de trabalho no contêiner
WORKDIR /var/www/html

# Atualiza o cache do sistema e instala as dependências necessárias
RUN apt-get update && \
    apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libpq-dev \
    libzip-dev \
    zip \
    unzip

# Instala extensões PHP necessárias
RUN docker-php-ext-configure gd --with-jpeg && \
    docker-php-ext-install -j$(nproc) \
    gd \
    pdo \
    pdo_mysql \
    mysqli \
    zip

# Copia os arquivos da aplicação para o contêiner
COPY . .

# Exemplo: Se a aplicação utiliza composer para gerenciar as dependências
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-interaction --no-plugins --no-scripts

# Define as variáveis de ambiente necessárias (se aplicável)
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
ENV APACHE_LOG_DIR /var/log/apache2

# Expõe a porta utilizada pelo Apache
EXPOSE 80

# Comando para iniciar o Apache
CMD ["apache2-foreground"]