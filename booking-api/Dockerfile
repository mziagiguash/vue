# Указываем образ с PHP и необходимыми инструментами
FROM php:8.3-fpm

# Устанавливаем необходимые системные утилиты и расширения PHP
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    && docker-php-ext-install pdo pdo_mysql

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Устанавливаем рабочую директорию
WORKDIR /var/www/html

# Копируем уже собранный проект в контейнер
COPY . .

# Установка прав доступа для папок storage и bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Копируем файл .env, если его еще нет
RUN cp .env.example .env || true

# Открываем порт для приложения
EXPOSE 8000

# Запускаем php-fpm
CMD ["php-fpm"]
