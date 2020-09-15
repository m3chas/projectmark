# SquareBlog - POC

SquareBlog is a web blogging platform based on Laravel 7 PHP framework.

### Requirements

Check you have the basic Laravel 7 requirements:

* PHP >= 7.2.5
* MySQL installed.
* Composer installed.
* A cron task scheduler running (mac, ubuntu: crontab -l)
* BCMath PHP Extension
* Ctype PHP Extension
* Fileinfo PHP extension
* JSON PHP Extension
* Mbstring PHP Extension
* OpenSSL PHP Extension
* PDO PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension

### Unit Test
TDD was used for this example, so you can check unit tests:
```sh
cd squareblog
vendor/bin/phpunit
```

### Installation
Clone this repository and:
Install the dependencies and devDependencies and start the server.

```sh
$ cd squareblog
$ composer install
$ cp env.example .env
"Update .env file with your local MySQL credentials before continue"
$ php artisan key:generate
$ php artisan migrate
$ composer dump-autoload
$ php artisan db:seed
```

To start the app...

```sh
$ php artisan serve
```
It will create a local server and serve the app at http://127.0.0.1:8000/ unless you change it.

### Post import scheduler

The post import from the external platform, is based on Laravel scheduler, which is configurable by time, for this example, the scheduler is configured to run everyminute and import only posts that are not already imported (matching title + publication_date fields).
An artisan command was created for that task, called posts:import, localted at app/Console/Commands/ImportPost.php

For a PROD enviroment, the ideal configuration of the scheduler to avoid conflicts with site traffic and resources used is:
```sh
// Run hourly from 12 AM to 2 AM on weekdays...
$schedule->command('posts:import')
          ->weekdays()
          ->hourly()
          ->timezone('America/Managua')
          ->between('0:00', '2:00');
```

### Users

Laravel DB seeder is used to populare the DB with dummy users and posts, all users, including admin use "password" text as password.

#### Code comments

Each part of the application code is commented with instructions about the logic about it.
