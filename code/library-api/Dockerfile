FROM php:8.4-cli

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libonig-dev \
    && docker-php-ext-install pdo pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

#installs composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

#copys application code
COPY . .

#ensure run.sh is executable
RUN chmod +x run.sh

#installs dependencies
RUN composer install --no-interaction --prefer-dist

EXPOSE 8080

CMD ["./run.sh"]
