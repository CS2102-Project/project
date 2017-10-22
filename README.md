# project: CarouLend
CS2102 project using laravel (PHP framework)

* Using localhost port 8000
* Start the server by `php artisan serve`
* Migrate the database by:
  * `php artisan migrate:refresh`
  * `php artisan make:migration function --create=table_name`  
  
## Project target
Topic C, Stuff Sharing: the system allows people to borrow or lend stuff that they own (tools, appliances, furniture or books) either free or for a fee. Users advertise stuff available (what stuff, where to pick up and return, when it is available, etc.) or can browse the available stuff and bid to borrow some stuff. The stuff owner or the system (your choice) chooses the successful bid. Each user has an account. Administrators can create, modify and delete all entries. Please refer to www.snapgoods.com, www.peerby.com or other stuff sharing sites for examples and data.
  

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

## Notes for readers
* The sql querying in this project is done using raw sql queries as required.
* The connection is based on mysql, the settings are as follows:
  * username: root
  * password: admin
  * database: blog
  
## Further work
* Add avatars to the user profile
* Security handling
* Password changing logic