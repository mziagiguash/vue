### О приложении

Сервис бронирования отелей для путешественников. Сервис дает пользователям возможность просматривать отели, их цены и условия, выбирать номера и осуществлять бронирование.

### Требования:
- PHP >= 8.1
- Composer
- Laravel
- Docker 

## Запуск проекта

##### Установка и запуск

Для установки выполните клонирование приложения:
```
```
После клонирования необходимо перейти в репозиторий final-project-php-laravel:
```
cd final-project-php-laravel
composer i
npm i
```

Скопировать ```.env.example``` и переименовать в ``` .env ```

Необходимо изменить настройки файла .env:
Пример настроек:
```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:QwRoxQiM1IXS7UFifiIjZSUryydD7lStyXdaCMqTbLY=
APP_DEBUG=true
APP_URL=http://localhost:8082
```
Обязательные изменения:
```
FILESYSTEM_DISK=public
QUEUE_CONNECTION=database
```

Для создания символической ссылки:
```
php artisan storage:link
```

Установите tailwindcss и его одноранговые зависимости через npm, а затем запустите команду init, чтобы сгенерировать tailwind.config.js и .postcss.config.js
```
npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init -p
```

Для запуска веб-приложения выполните следующие команды:
```
**Соберите и запустите контейнеры**:

docker-compose down -v

docker-compose up --build

docker-compose up -d
```

Для запуска в Doker:

```
docker exec -it booking_api bash
php artisan session:table

php artisan migrate

php artisan migrate:fresh --seed
```

##### Панель администратора
Для управления веб-приложением с правами администратора необходимо создать администратора:
```
composer require tcg/voyager
php artisan voyager:install

php artisan voyager:admin exsample@gmail.com --create
```

После регистрации и авторизации администратора пройдите в панель адиминистратора: ```/admin```

Удалите временно из файла voyager
            \App\Widgets\BookingsWidget::class,
            \App\Widgets\FacilitiesWidget::class,
            \App\Widgets\HotelsWidget::class,
а далее там добавить каждый виджет и снова вернуть в voyager убранные ссылки

1. Удобства ``` /admin/facilities ```
2. Отель ``` /admin/hotels ```
    2.1. Заполните поля
    2.2. Выберите удобства (ранее добавленные в п.1)
3. После создания отеля возможно добавить номера (для отеля с id 1) ``` /admin/hotels/1/rooms ```
    3.1. Заполните поля
    3.2. Выберите удобства (ранее добавленные в п.1)
4. Редакторование номера (для номера с id 1) ``` /admin/rooms/1/edit ```


Другие возможности администатора:
 
6. Список бронирований ``` /admin/bookings ```
7. Список всех пользователей ``` /admin/users ```
8. Удаление удобств, отелей, номеров по кнопке ``` DELETE ```
9. Изменение статуса бронирования 

