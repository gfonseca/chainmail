FROM php:5.6famosos
MAINTAINER Georgio Barbosa <georgio.barbosa@gmail.com>

ENV TERM=xterm
RUN locale

WORKDIR /app/

RUN ln -s /var/www/vendor/bin/codecept /usr/bin/

RUN apt-get update && apt-get install -y \
  git \
  zip \
  unzip \
  libyaml-dev \
  libpq-dev \
  build-essential \
  whois \
  zlib1g-dev \
  && rm -rf /var/lib/apt/lists/*

RUN pecl install xdebug \
  && docker-php-ext-enable xdebug

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN php -r "unlink('composer-setup.php');"

# Install PHP Modules
RUN docker-php-ext-install \
  pdo \
  pdo_mysql \
  mysqli \
  pdo_pgsql \
  zip
