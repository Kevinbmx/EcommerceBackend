# # composer dependecies
# FROM composer AS composer-build
# WORKDIR /var/www/html
# COPY composer.json composer.lock /var/www/html/
# RUN mkdir -p /var/www/html/database/{factories,seeds} \
# && composer install --no-dev --prefer-dist --no-scripts --no-autoloader --no-progress --ignore-platform-reqs


# # php production

# FROM php:7.2-apache
# WORKDIR /var/www/html
# RUN apt-get update \
#      && apt-get install --quiet --yes --no-install-recommends \
#      libzip-dev \
#      unzip\
#      && docker-php-ext-install zip mysqli pdo pdo_mysql

# COPY --from=composer-build /usr/bin/composer /usr/bin/composer
# COPY --chown=www-data --from=composer-build /var/www/html/vendor/ /var/www/html/vendor/
# COPY --chown=www-data . /var/www/html



FROM php:7.4-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www

USER $user
