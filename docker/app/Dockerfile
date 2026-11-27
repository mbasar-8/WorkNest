FROM dunglas/frankenphp:1-php8.2

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN install-php-extensions \
    pdo_pgsql \
    intl \
    zip \
    bcmath \
    pcntl

WORKDIR /app
