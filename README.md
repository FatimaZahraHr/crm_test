## Requirements

- PHP >= 8
- Composer
- node js

## Install

```bash
gitbash> git clone https://github.com/FatimaZahraHr/crm_test.git
gitbash> cd crm_test
gitbash> composer update               # install project dependencies
gitbash> nom install                   # install packages
# create database (you should change credentials)
mysql> CREATE USER 'namedatabase'@'localhost' IDENTIFIED BY 'namedatabase';
mysql> CREATE DATABASE namedatabase;
code:~$ cp .env.example .env          # create enviroment config file
code:~$  .env                      # edit configuration (mail smtp options, db credentials you choose on db creation, debug mode). 
code:~$ php artisan key:generate      # generate unique application key
code:~$ php artisan migrate           # run database migrations
code:~$ php artisan db:seed --class=UserTableSeeder     # seed the data
code:~$ php artisan db:seed --class=CompanyTableSeeder  # seed the data
code:~$ php artisan db:seed --class=LogTableSeeder  # seed the data
// run development server.
code:~$ php artisan serve 
code:~$ npm run dev
## admin account admin1@yopmail.com / password
## employee account f.hr@yopmail.com /password
# now site can be accessed at http://127.0.0.1:8000/
```

## Development

- controllers: `app/Http/Controllers/`
- application routes : `app/routes/web.php`
- routes Api  : `app/routes/api.php`


To see all defined routes and corresponding controller methods use `php artisan route:list` console command
