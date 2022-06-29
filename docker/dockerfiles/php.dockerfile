FROM php:8.1-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y curl zip unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Copy xdebug ini file
COPY docker/configs/php/xdebug.ini "${PHP_INI_DIR}/conf.d"

# Install xdebug
RUN pecl install xdebug

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Enable Xdebug extion
RUN docker-php-ext-enable xdebug

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www/src

# Copy application Files
COPY src .

# Install composer dependencies
RUN composer install

# Set permissions to vendor folder
RUN chown -R $user:$user /var/www/src/vendor

# Copy git file to be used by Captain Hook
COPY .git .git

# Set permissions to .git folder
RUN chown -R $user:$user .git

# Copy install captainhook shell scrit and set permission
COPY docker/configs/php/install-captainhook.sh /$user/install-captainhook.sh
RUN chmod +x /$user/install-captainhook.sh;

USER $user