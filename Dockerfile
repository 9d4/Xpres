FROM webdevops/php-nginx:8.2-alpine

RUN apk add php-pgsql libpq-dev

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV WEB_DOCUMENT_ROOT=/app/public
ENV MAIN_USER=1000

WORKDIR /app
COPY composer.json composer.json
COPY composer.lock composer.lock
RUN composer install --no-interaction --optimize-autoloader --no-dev

COPY . .
CMD ["sh", "-c", "usermod -u $MAIN_USER application && supervisord"]
