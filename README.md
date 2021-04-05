## About Exam

Exam Project is a simple project built with laravel 8 and vue js, it simply gives you ability to create and manage exams using rest api follows [jsonapi.org](https://jsonapi.org/format) specification and [php best practices](https://www.php-fig.org/psr/).

Exam Project is using laravel sanctum and never meant to be a real world application, it's just for learning purposes.

## Installing

To install Exam Project, follow this guide..

First run these commands:

```sh
git clone git@github.com:melsaka/exam-project.git
```

```sh
cd exam-project

composer install

cp .env.example .env

php artisan key:generate
```

Create a database with the name "exam" and edit the .env file 

```sh
DB_DATABASE=exam
```

Change your session driver to cookie

```sh
SESSION_DRIVER=cookie
```

Add these 2 lines to the end of the .env file

```sh
SESSION_DOMAIN=127.0.0.1
SANCTUM_STATEFUL_DOMAINS=127.0.0.1:8000
```

Then run these commands:

```sh
php artisan migrate

php artisan db:seed

php artisan serve
```

Now you are good to go, you can access Exam Project through http://127.0.0.1:8000

## Credentials

To login you can create your own credentials using tinker or simply use these credentials

```sh
Username: 'elsaka'
Password: 'kerberos'
```

## Api Features

**Include**

You can include supported relationship in your api GET request like that `?include=relation,another` 

For ex: `http://127.0.0.1:8000/api/exams?include=subject,questions`

All supported relationships for every model are found in `app/Features/Includes/` folder

**Count**

You can count supported relationship in your api GET request like that `?count=relation,another`

`http://127.0.0.1:8000/api/exams?count=questions`

All supported relationships for every model are found in `app/Features/Filters/` folder and you can adjust it by adding or removing values to `$relations` property

For ex: in `ExamFilter.php` you will see this line `protected $relations = ['questions'];` that allows counting questions through exams

**Sort**

You can sort any model by 'id, random, created, updated'

For ex: `http://127.0.0.1:8000/api/exams?include=subject&sort=random`

**Filter**

You can filter any model by 'created, updated'

For ex: `http://127.0.0.1:8000/api/exams?filter[created]=2021-04-05`

To add more filters go to `app/Features/Filters/` folder, and if the model name is `Subject.php` then its filter class should be `SubjectFilter.php`

Create new filter by adding new method the method should be prefixed with `filter` following by the filter name for example `filterCreated()` 

## License

Exam is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
