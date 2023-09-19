FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev
RUN docker-php-ext-install pdo pdo_pgsql zip

RUN curl -sL https://sentry.io/get-cli/ | SENTRY_CLI_VERSION="2.2.0" bash

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

RUN curl -sL https://deb.nodesource.com/setup_20.x | bash -
RUN apt-get install -y nodejs

WORKDIR /app

COPY . .
RUN composer install
RUN npm ci
RUN npm run build

RUN sentry-cli releases new "$VERSION"
RUN sentry-cli releases set-commits "$VERSION" --auto
RUN sentry-cli releases finalize "$VERSION"

CMD ["bash", "-c", "php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT"]