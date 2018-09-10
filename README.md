# Project Title

Freddies Flowers Blog challenge

### Prerequisites

You will need the following softwares installed;

MYSQL

Laravel 5.7

Composer

Php 7.1 and above

### Installing

Clone the repository

git clone git@github.com:Moziz123/FreddiesFlowerBlog.git

git checkout master

git pull origin master



Switch to the webblog folder

cd webblog

Install all the dependencies using composer

composer install

Copy the example env file and make the required configuration changes in the .env file

cp .env.example .env

Generate a new application key

php artisan key:generate

Generate a new JWT authentication secret key

php artisan jwt:generate

Run the database migrations (Set the database connection in .env before migrating)

php artisan migrate

Start the local development server

php artisan serve

You can now access the server at http://localhost:8000


## Rundown of scripts to run

git clone git@github.com:gothinkster/laravel-realworld-example-app.git

cd laravel-realworld-example-app

composer install

cp .env.example .env

php artisan key:generate

php artisan jwt:generate 

Make sure you set the correct database connectiondetails  in the .env file before running the migrations Environment variables

php artisan migrate

php artisan serve


## Major checks

Environment variables

.env - Make sure the file is changed from .env.example to .env and the database connection is changed to your local connection.

Note : You can quickly set the database information and other variables in this file and have the application fully working.

go to http://localhost:8000 and enjoy!


## Versioning

Branches;

master, feature & testing.

Tags;

1.0, 1.1, 1.2.

## Authors

***Moses Carayol** - *Initial work* - [FreddiesFlowersBlog](https://github.com/Moziz123)

See also the list of [contributors](https://github.com/your/project/contributors) who participated in this project.


## Futher Improvments

* I hoped to have sufficient time to adhere to SOLID principles but that was not the case.
* Could have done it with more time.
* 






















