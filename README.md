# todo_list_p8
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/bf80707d107744ce9409da06fcca8005)](https://www.codacy.com/gh/kenchi-san/todo_list_p8/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=kenchi-san/todo_list_p8&amp;utm_campaign=Badge_Grade)
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
```
Don't forget to make your unit test each time you make a new function 
Before to make your pull request on GitHub, make sur to running all unit tests
```
## Running tests
Load fixtures before launch tests.

```
php bin/phpunit --testdox
or
php ./vendor/bin/phpunit tests --coverage-html coverage
```

## Load Fixtures

```
php bin/console doctrine:fixtures:load
or
composer reset
```
with "composer reset" you need to install "[symfony binary](https://symfony.com/doc/current/best_practices.html#use-the-symfony-binary-to-create-symfony-applications)"

