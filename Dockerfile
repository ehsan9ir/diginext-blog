# 2022 update
FROM php:8.1-fpm

WORKDIR /var/www

# Install environment dependencies
# PS. you can deploy an image that stops at this step so that your cI/CD builds are a bit faster (if not cached) this is what takes the most time in the deployment process.
RUN apt-get update \
    # gd
    && apt-get install -y build-essential  openssl nginx libfreetype6-dev libjpeg-dev libpng-dev libwebp-dev zlib1g-dev libzip-dev gcc g++ make vim unzip curl git jpegoptim optipng pngquant gifsicle locales libonig-dev nodejs  \
    && docker-php-ext-configure gd  \
    && docker-php-ext-install gd \
    # gmp
    && apt-get install -y --no-install-recommends libgmp-dev \
    && docker-php-ext-install gmp \
    # pdo_mysql
    && docker-php-ext-install pdo_mysql mbstring \
    # pdo
    && docker-php-ext-install pdo \
    # opcache
    && docker-php-ext-enable opcache \
    # exif
    && docker-php-ext-install exif \
    && docker-php-ext-install sockets \
    && docker-php-ext-install pcntl \
    && docker-php-ext-install bcmath \
    # zip
    && docker-php-ext-install zip \
    && apt-get autoclean -y \
    && rm -rf /var/lib/apt/lists/* \
    && rm -rf /tmp/pear/

# Copy files
COPY . /var/www
RUN cp /var/www/.env.example /var/www/.env

# setup composer and laravel
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install

RUN composer dump-autoload

RUN chmod -R 775 storage bootstrap/cache \
  && chown -R www-data:www-data ./ \
  && php artisan optimize:clear \
  && php artisan key:generate \
  && php artisan optimize

# Delete default html folder
RUN rm -r html

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www


# Expose port 9000 and start php-fpm server
EXPOSE 9000

CMD ["php-fpm"]
