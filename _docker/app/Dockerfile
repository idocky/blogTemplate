FROM php:8.3-fpm

RUN apt-get update && \
  apt-get upgrade -y && \
  apt-get install -y --no-install-recommends \
    curl \
    libicu-dev \
    libmemcached-dev \
    libz-dev \
    libzip-dev \
    libpq-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    libssl-dev \
    libmcrypt-dev \
    libgmp-dev \
  && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN docker-php-ext-install pdo_mysql \
&& docker-php-ext-install pdo_pgsql \
&& docker-php-ext-install intl \
&& docker-php-ext-configure gd \
            --with-jpeg \
            --with-freetype \
  && docker-php-ext-install gd \
  && docker-php-ext-install pgsql \
  && pecl install -o -f redis \
  && docker-php-ext-enable redis \
  && docker-php-ext-install zip \
  && docker-php-ext-install gmp \
  && docker-php-ext-install exif \
  && docker-php-ext-install bcmath

COPY ./_docker/app/php.ini /usr/local/etc/php/conf.d/php.ini

# INSTALL COMPOSER
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin

WORKDIR /var/www
