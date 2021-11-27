# todo_list_p8

## Installation

Clone repository and install dependencies

```
https://github.com/kenchi-san/todo_list_p8.git
composer install
```

Create a copy of .env file to .env.local with your own settings


Initialize database

```
php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:migrations:migrate

```

## Important
Don't forget to clean cache if you have any problem:
```
php bin/console cache:clear
```

## Running tests
Load fixtures before launch tests.

```
php bin/phpunit --testdox
```

## Load Fixtures

```
php bin/console doctrine:fixtures:load
or
composer reset
```
with "composer reset" you need to install "[symfony binary](https://symfony.com/doc/current/best_practices.html#use-the-symfony-binary-to-create-symfony-applications)"

