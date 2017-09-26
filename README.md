# project
CS2102 project using laravel
* Using localhost port 8000
* Start the server by `php artisan serve`
* Migrate the database by:
  * `php artisan migrate:refresh`
  * `php artisan make:migration function --create=table_name`

## Trouble shooting
===
Usually when you clone a Laravel Repository, you have to make this Step:
- Composer install
- Copy .env.example to .env and set the good values inside .env
  * careful to use your own mysql settings

source: https://stackoverflow.com/questions/37419545/cannot-serve-cloned-git-repository-in-my-local-machine

===
Fixing RuntimeException No application encryption key has been specified error
- simply run php artisan key:generate


source: https://stackoverflow.com/questions/44839648/no-application-encryption-key-has-been-specified-new-laravel-app

## Complete Installation Guide
* Install PHP7
* Install Composer
* Require Laravel using Composer
* Install Mysql (suggested database, default option)
* Suggested install: Mysql Workbench (GUI)
