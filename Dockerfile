# Utiliza la imagen oficial de PHP 7.2
FROM php:7.2-apache

# Instala las extensiones necesarias
RUN docker-php-ext-install pdo pdo_mysql mbstring \
    pdo_pgsql


# Instala Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instala zip y unzip
RUN apt-get update && apt-get install -y \
    zip \
    unzip
    
# Habilita el módulo de Apache rewrite
RUN a2enmod rewrite

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Copia los archivos del proyecto al contenedor
COPY . /var/www/html

# Establece los permisos adecuados
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache



# Establece los permisos adecuados y ejecuta comandos al levantar el contenedor
CMD ["bash", "-c", "composer update && chown www-data:www-data -R ./storage && php artisan migrate && php artisan db:seed && chown www-data:www-data -R ./storage && php artisan key:generate"]
#composer update && chown www-data:www-data -R ./storage && php artisan migrate && php artisan db:seed && chown www-data:www-data -R ./storage && php artisan key:generate && apache2-foreground
# Expone el puerto 80 para Apache
EXPOSE 80