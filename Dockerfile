FROM php:8.2

RUN apt-get update -y && apt-get install -y \
    openssl zip unzip git \
    libonig-dev default-mysql-client

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install pdo_mysql mbstring

WORKDIR /app
COPY . /app

RUN composer install

RUN npm install

RUN php artisan storage:link

RUN php artisan db:seed --class=AdminUserSeeder

CMD npm run start

EXPOSE 8000
