# x3coding-challenge

requirements
```sh
php 8.3
composer 2.5
```

```sh
cp .env.example .env
php artisan key:generate
chmod -R 775 storage bootstrap/cache
```

storage
```sh
php artisan storage:link
```

composer install
```sh
composer install
```

migrations
```sh
php artisan migrate
```
