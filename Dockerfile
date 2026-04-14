FROM php:8.2-apache

# Instalar extensiones de PostgreSQL para PHP
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Habilitar mod_rewrite de Apache (útil para URLs limpias si las necesitas después)
RUN a2enmod rewrite

# Copiar todo el código del proyecto a la carpeta raíz de Apache
COPY . /var/www/html/

# Dar permisos correctos a la carpeta web
RUN chown -R www-data:www-data /var/www/html/
