FROM php:8.2

# Update and install necessary packages
RUN apt-get update -y && apt-get install -y \
    openssl zip unzip git \
    libonig-dev default-mysql-client

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring

# Set working directory
WORKDIR /app
COPY . /app

COPY .env /app/.env

# Install PHP dependencies via Composer
RUN composer install

# Command to run your application
CMD npm run start

# Expose the port for the application
EXPOSE 8000
