FROM php:7.3.10

RUN curl -sL https://deb.nodesource.com/setup_10.x | bash -

RUN apt-get update \
    && apt-get install -y nodejs

# Install composer
RUN php -r "copy('https://raw.githubusercontent.com/composer/getcomposer.org/master/web/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer

# Install XDebug
RUN (pecl install xdebug || pecl install xdebug-2.5.5 || pecl install xdebug-2.7.1) && docker-php-ext-enable xdebug

# Install common extensions
RUN apt install -y libicu-dev zlib1g-dev libzip-dev unzip && \
    rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-configure intl && docker-php-ext-install intl
RUN docker-php-ext-install zip pdo_mysql

ENV APP_ROOT /project

WORKDIR $APP_ROOT

COPY src/ $APP_ROOT

RUN composer install -n --prefer-dist

RUN npm install
