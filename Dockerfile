FROM php:8.1-fpm


WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    curl \
    g++ \
    git \
    libbz2-dev \
    libfreetype6-dev \
    libicu-dev \
    libjpeg-dev \
    libmcrypt-dev \
    libpng-dev \
    libreadline-dev \
    sudo \
    unzip \
    zip \
    libzip-dev \
    libonig-dev \
 && rm -rf /var/lib/apt/lists/*


RUN docker-php-ext-install \
    bcmath \
    bz2 \
    calendar \
    iconv \
    intl \
    mbstring \
    opcache \
    pdo_mysql \
    zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN pecl install redis && docker-php-ext-enable redis 

RUN apt-get update && apt-get install -y libcurl4-openssl-dev pkg-config libssl-dev

RUN pecl install mongodb && docker-php-ext-enable mongodb


# Add user for laravel application
# RUN groupadd -g 1000 www
# RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www

# Copy existing application directory permissions
# COPY --chown=www:www . /var/www

# RUN chgrp -R www-data storage bootstrap/cache
# RUN chmod -R ug+rwx storage bootstrap/cache

# Change current user to www
# USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
