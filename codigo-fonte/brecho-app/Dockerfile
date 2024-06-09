FROM php:8.3-fpm

ARG user=fael
ARG uid=1000

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pgsql pdo_pgsql mbstring exif pcntl bcmath gd sockets intl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

WORKDIR /app
COPY . /app
RUN composer install --ignore-platform-reqs

COPY docker/php/custom.ini /usr/local/etc/php/conf.d/custom.ini
CMD php artisan serve --host=0.0.0.0 --port=8080
EXPOSE 8080

USER $user
