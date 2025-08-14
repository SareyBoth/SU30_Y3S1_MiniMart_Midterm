FROM php:8.3-apache

WORKDIR /var/www/html

# Point Apache to Laravel's public directory
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's|/var/www/|/var/www/html/public|g' /etc/apache2/apache2.conf

# Copy composer files first (for caching)
COPY composer.json composer.lock /var/www/html/

# Install dependencies + PHP extensions (including PostgreSQL)
RUN apt-get update && apt-get install -y unzip libpq-dev \
    && docker-php-ext-install exif pdo_pgsql pgsql \
    && docker-php-ext-enable exif pdo_pgsql pgsql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the full app including artisan
COPY . /var/www/html

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Fix Laravel permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80
CMD ["apache2-foreground"]
