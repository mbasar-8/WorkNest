FROM dunglas/frankenphp:1-php8.2

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN install-php-extensions \
    pdo_pgsql \
    intl \
    zip \
    bcmath \
    pcntl

ARG USER=app
ARG UID=1000
ARG GID=1000

RUN groupadd -g ${GID} ${USER} \
    && useradd -u ${UID} -g ${GID} -m -s /bin/bash ${USER} \
    && setcap -r /usr/local/bin/frankenphp \
    && chown -R ${USER}:${USER} /data/caddy /config/caddy

WORKDIR /app

USER ${USER}
