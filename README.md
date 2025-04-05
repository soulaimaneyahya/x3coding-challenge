# x3coding-challenge

[![CI](https://github.com/soulaimaneyahya/x3coding-challenge/actions/workflows/ci.yaml/badge.svg)](https://github.com/soulaimaneyahya/x3coding-challenge/actions/workflows/ci.yaml)

- [x] API list nearby restaurants ordered
- [x] API show restaurant

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
php artisan db:seed
```

php artisan serve
```sh
php artisan serve
```

tests
```sh
php artisan test
```

queue jobs
```sh
php artisan queue:work
```
