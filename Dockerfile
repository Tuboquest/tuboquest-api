FROM webdevops/php-nginx:8.3-alpine
RUN apk add oniguruma-dev libxml2-dev
RUN docker-php-ext-install \
        bcmath \
        ctype \
        fileinfo \
        mbstring \
        pdo_mysql \
        xml
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN apk add nodejs npm
ENV WEB_DOCUMENT_ROOT /app/public
ENV APP_ENV production
WORKDIR /app
COPY . .
COPY .env .env
RUN touch database/database.sqlite
RUN composer install --no-interaction --optimize-autoloader
RUN php artisan key:generate
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache
RUN php artisan migrate:fresh --seed --force
RUN chown -R application:application .